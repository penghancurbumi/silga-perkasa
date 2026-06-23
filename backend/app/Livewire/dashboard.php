<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Lowongan;
use App\Models\Application;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Dashboard extends Component
{
    public string $period = 'month';

    public function setPeriod(string $value): void
    {
        $this->period = in_array($value, ['day', 'week', 'month', 'year']) ? $value : 'month';

        // Kirim data baru langsung ke JS via event
        [$labels, $postValues, $lowonganValues, $applicationValues] = $this->buildChartData();
        $this->dispatch('chart-updated', labels: $labels, postValues: $postValues, lowonganValues: $lowonganValues, applicationValues: $applicationValues);
    }

    public function render()
    {
        // === Widget Stats ===
        $totalPelamar     = Application::count();
        $pelamarDiterima  = Application::where('status', 'accepted')->count();
        $pelamarDitolak   = Application::where('status', 'rejected')->count();
        $lowonganAktif    = Lowongan::where('status', 'published')->count();

        // Perubahan bulan lalu vs bulan ini
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        $pelamarThisMonth       = Application::where('applied_at', '>=', $thisMonth)->count();
        $pelamarLastMonth       = Application::whereBetween('applied_at', [$lastMonth, $thisMonth])->count();
        $diterimaThisMonth      = Application::where('status', 'accepted')->where('updated_at', '>=', $thisMonth)->count();
        $diterimaLastMonth      = Application::where('status', 'accepted')->whereBetween('updated_at', [$lastMonth, $thisMonth])->count();
        $ditolakThisMonth       = Application::where('status', 'rejected')->where('updated_at', '>=', $thisMonth)->count();
        $ditolakLastMonth       = Application::where('status', 'rejected')->whereBetween('updated_at', [$lastMonth, $thisMonth])->count();
        $lowonganThisMonth      = Lowongan::where('status', 'published')->where('updated_at', '>=', $thisMonth)->count();
        $lowonganLastMonth      = Lowongan::where('status', 'published')->whereBetween('updated_at', [$lastMonth, $thisMonth])->count();

        $pelamarDiff  = $pelamarThisMonth - $pelamarLastMonth;
        $diterimaDiff = $diterimaThisMonth - $diterimaLastMonth;
        $ditolakDiff  = $ditolakThisMonth - $ditolakLastMonth;
        $lowonganDiff = $lowonganThisMonth - $lowonganLastMonth;

        // === Data Chart: dinamis berdasarkan $period ===
        [$chartLabels, $chartPostValues, $chartLowonganValues, $chartApplicationValues] = $this->buildChartData();

        // === Aktivitas Terbaru ===
        $recentActivity = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('livewire.dashboard', [
            'totalPelamar'        => $totalPelamar,
            'pelamarDiterima'     => $pelamarDiterima,
            'pelamarDitolak'      => $pelamarDitolak,
            'lowonganAktif'       => $lowonganAktif,
            'pelamarDiff'         => $pelamarDiff,
            'diterimaDiff'        => $diterimaDiff,
            'ditolakDiff'         => $ditolakDiff,
            'lowonganDiff'        => $lowonganDiff,
            'chartLabels'         => $chartLabels,
            'chartPostValues'     => $chartPostValues,
            'chartLowonganValues' => $chartLowonganValues,
            'chartApplicationValues' => $chartApplicationValues,
            'recentActivity'      => $recentActivity,
            'period'              => $this->period,
        ])->layout('layouts.app');
    }

    private function buildChartData(): array
    {
        return match($this->period) {
            'day'   => $this->chartByHour(),
            'week'  => $this->chartByDay(7),
            'year'  => $this->chartByYear(),
            default => $this->chartByMonth(),
        };
    }

    private function aggregateData($modelClass, $dateColumn, $queryModifier, $periodCount, $periodStep, $formatLabel, $formatKey)
    {
        // Setup initial queries
        $q = $modelClass::query();
        
        // Let modifier apply groups and conditions
        $q = $queryModifier($q);
        $data = $q->get()->keyBy(fn($r) => $formatKey($r));

        $values = [];
        for ($i = $periodCount; $i >= 0; $i--) {
            // we determine the key by period step
            $key = $formatKey(null, $i);
            $values[] = $data->get($key)?->total ?? 0;
        }

        return $values;
    }

    // Hari ini per jam (24 jam terakhir)
    private function chartByHour(): array
    {
        $start = Carbon::now()->startOfDay();

        $labels = [];
        for ($h = 0; $h <= 23; $h++) {
            $labels[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
        }

        $getQuery = function($dateColumn) use ($start) {
            return function($q) use ($dateColumn, $start) {
                return $q->select(DB::raw("HOUR($dateColumn) as hour"), DB::raw('COUNT(*) as total'))
                         ->where($dateColumn, '>=', $start)
                         ->groupBy('hour');
            };
        };

        $formatKey = fn($r, $i = null) => $r ? $r->hour : $i; // i is 0 to 23 (but loop is reversed?)
        
        // Wait, loop in aggregateData is backwards, let's just write them explicitly for simplicity

        $posts = Post::select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $start)->groupBy('hour')->get()->keyBy('hour');
        
        $lowongans = Lowongan::select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $start)->groupBy('hour')->get()->keyBy('hour');

        $applications = Application::select(DB::raw('HOUR(applied_at) as hour'), DB::raw('COUNT(*) as total'))
            ->where('applied_at', '>=', $start)->groupBy('hour')->get()->keyBy('hour');

        $postVals = []; $lowonganVals = []; $appVals = [];
        for ($h = 0; $h <= 23; $h++) {
            $postVals[]     = $posts->get($h)?->total ?? 0;
            $lowonganVals[] = $lowongans->get($h)?->total ?? 0;
            $appVals[]      = $applications->get($h)?->total ?? 0;
        }

        return [$labels, $postVals, $lowonganVals, $appVals];
    }

    // 7 atau N hari terakhir per hari
    private function chartByDay(int $days): array
    {
        $start = Carbon::now()->subDays($days - 1)->startOfDay();

        $posts = Post::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $start)->groupBy('date')->get()->keyBy('date');
        
        $lowongans = Lowongan::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $start)->groupBy('date')->get()->keyBy('date');

        $applications = Application::select(DB::raw('DATE(applied_at) as date'), DB::raw('COUNT(*) as total'))
            ->where('applied_at', '>=', $start)->groupBy('date')->get()->keyBy('date');

        $labels = []; $postVals = []; $lowonganVals = []; $appVals = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $key  = $date->toDateString();
            
            $labels[]       = $date->locale('id')->isoFormat('ddd, D MMM');
            $postVals[]     = $posts->get($key)?->total ?? 0;
            $lowonganVals[] = $lowongans->get($key)?->total ?? 0;
            $appVals[]      = $applications->get($key)?->total ?? 0;
        }

        return [$labels, $postVals, $lowonganVals, $appVals];
    }

    // 12 bulan terakhir per bulan (default)
    private function chartByMonth(): array
    {
        $start = Carbon::now()->subMonths(11)->startOfMonth();

        $posts = Post::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $start)->groupBy('year', 'month')->get()->keyBy(fn($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));
        
        $lowongans = Lowongan::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $start)->groupBy('year', 'month')->get()->keyBy(fn($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));

        $applications = Application::select(DB::raw('MONTH(applied_at) as month'), DB::raw('YEAR(applied_at) as year'), DB::raw('COUNT(*) as total'))
            ->where('applied_at', '>=', $start)->groupBy('year', 'month')->get()->keyBy(fn($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));

        $labels = []; $postVals = []; $lowonganVals = []; $appVals = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $key  = $date->format('Y-m');
            
            $labels[]       = $date->locale('id')->isoFormat('MMM YY');
            $postVals[]     = $posts->get($key)?->total ?? 0;
            $lowonganVals[] = $lowongans->get($key)?->total ?? 0;
            $appVals[]      = $applications->get($key)?->total ?? 0;
        }

        return [$labels, $postVals, $lowonganVals, $appVals];
    }

    // 5 tahun terakhir per tahun
    private function chartByYear(): array
    {
        $start = Carbon::now()->subYears(4)->startOfYear();

        $posts = Post::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $start)->groupBy('year')->get()->keyBy('year');
        
        $lowongans = Lowongan::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $start)->groupBy('year')->get()->keyBy('year');

        $applications = Application::select(DB::raw('YEAR(applied_at) as year'), DB::raw('COUNT(*) as total'))
            ->where('applied_at', '>=', $start)->groupBy('year')->get()->keyBy('year');

        $labels = []; $postVals = []; $lowonganVals = []; $appVals = [];
        for ($i = 4; $i >= 0; $i--) {
            $year = Carbon::now()->subYears($i)->year;
            
            $labels[]       = (string) $year;
            $postVals[]     = $posts->get($year)?->total ?? 0;
            $lowonganVals[] = $lowongans->get($year)?->total ?? 0;
            $appVals[]      = $applications->get($year)?->total ?? 0;
        }

        return [$labels, $postVals, $lowonganVals, $appVals];
    }
}