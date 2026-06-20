<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
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
        [$labels, $values] = $this->buildChartData();
        $this->dispatch('chart-updated', labels: $labels, values: $values);
    }

    public function render()
    {
        // === Widget Stats ===
        $totalPost      = Post::count();
        $totalPublished = Post::where('status', 'published')->count();
        $totalDraft     = Post::where('status', 'draft')->count();
        $totalScheduled = Post::where('status', 'scheduled')->count();

        // Perubahan bulan lalu vs bulan ini
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        $newThisMonth       = Post::where('created_at', '>=', $thisMonth)->count();
        $newLastMonth       = Post::whereBetween('created_at', [$lastMonth, $thisMonth])->count();
        $publishedThisMonth = Post::where('status', 'published')
            ->where('updated_at', '>=', $thisMonth)->count();

        // === Data Chart: dinamis berdasarkan $period ===
        [$chartLabels, $chartValues] = $this->buildChartData();

        // === Aktivitas Terbaru ===
        $recentActivity = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('livewire.dashboard', [
            'totalPost'          => $totalPost,
            'totalPublished'     => $totalPublished,
            'totalDraft'         => $totalDraft,
            'totalScheduled'     => $totalScheduled,
            'newThisMonth'       => $newThisMonth,
            'newLastMonth'       => $newLastMonth,
            'publishedThisMonth' => $publishedThisMonth,
            'chartLabels'        => $chartLabels,
            'chartValues'        => $chartValues,
            'recentActivity'     => $recentActivity,
            'period'             => $this->period,
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

    // Hari ini per jam (24 jam terakhir)
    private function chartByHour(): array
    {
        $data = Post::select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->startOfDay())
            ->groupBy('hour')
            ->get()
            ->keyBy('hour');

        $labels = [];
        $values = [];
        for ($h = 0; $h <= 23; $h++) {
            $labels[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
            $values[] = $data->get($h)?->total ?? 0;
        }

        return [$labels, $values];
    }

    // 7 atau N hari terakhir per hari
    private function chartByDay(int $days): array
    {
        $data = Post::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays($days - 1)->startOfDay())
            ->groupBy('date')
            ->get()
            ->keyBy('date');

        $labels = [];
        $values = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date    = Carbon::now()->subDays($i);
            $key     = $date->toDateString();
            $labels[] = $date->locale('id')->isoFormat('ddd, D MMM');
            $values[] = $data->get($key)?->total ?? 0;
        }

        return [$labels, $values];
    }

    // 12 bulan terakhir per bulan (default)
    private function chartByMonth(): array
    {
        $data = Post::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(fn($r) => $r->year . '-' . str_pad($r->month, 2, '0', STR_PAD_LEFT));

        $labels = [];
        $values = [];
        for ($i = 11; $i >= 0; $i--) {
            $date     = Carbon::now()->subMonths($i);
            $key      = $date->format('Y-m');
            $labels[] = $date->locale('id')->isoFormat('MMM YY');
            $values[] = $data->get($key)?->total ?? 0;
        }

        return [$labels, $values];
    }

    // 5 tahun terakhir per tahun
    private function chartByYear(): array
    {
        $data = Post::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subYears(4)->startOfYear())
            ->groupBy('year')
            ->orderBy('year')
            ->get()
            ->keyBy('year');

        $labels = [];
        $values = [];
        for ($i = 4; $i >= 0; $i--) {
            $year     = Carbon::now()->subYears($i)->year;
            $labels[] = (string) $year;
            $values[] = $data->get($year)?->total ?? 0;
        }

        return [$labels, $values];
    }
}