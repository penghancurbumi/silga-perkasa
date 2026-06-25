<?php

namespace App\Livewire;

use App\Models\JobCategory;
use App\Models\Lowongan;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class LowonganEdit extends Component
{
    public $lowonganId;
    public $title          = '';
    public $job_category_id = '';
    public $employment_type = '';
    public $location       = '';
    public $description    = '';
    public $kualifikasi    = '';
    public $skills         = [];
    public $posted_at      = '';
    public $deadline       = '';
    public $status         = '';

    public function mount($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $this->lowonganId = $lowongan->id;
        $this->title = $lowongan->title;
        $this->job_category_id = $lowongan->job_category_id;
        $this->employment_type = $lowongan->employment_type;
        $this->location = $lowongan->location;
        $this->description = $lowongan->description;
        $this->kualifikasi = $lowongan->qualification;
        $this->skills = $lowongan->skills ?? [];
        $this->posted_at = $lowongan->posted_at ? $lowongan->posted_at->format('Y-m-d\TH:i') : '';
        $this->deadline = $lowongan->deadline ? \Carbon\Carbon::parse($lowongan->deadline)->format('Y-m-d\TH:i') : '';
        $this->status = $lowongan->status;
    }

    protected function rules(): array
    {
        return [
            'title'           => 'required|string|max:255',
            'job_category_id' => 'required|exists:job_categories,id',
            'employment_type' => 'required|in:full_time,part_time,contract,internship,freelance',
            'location'        => 'required|string|max:255',
            'description'     => 'required|string',
            'kualifikasi'     => 'required|string',
            'skills'          => 'nullable|array',
            'skills.*'        => 'string|max:100',
            'posted_at'       => 'nullable|date',
            'deadline'        => 'required|date',
            'status'          => 'required|in:draft,published,closed',
        ];
    }

    protected $messages = [
        'title.required'           => 'Judul lowongan wajib diisi.',
        'job_category_id.required' => 'Kategori wajib dipilih.',
        'job_category_id.exists'   => 'Kategori tidak valid.',
        'employment_type.required' => 'Tipe pekerjaan wajib dipilih.',
        'employment_type.in'       => 'Tipe pekerjaan tidak valid.',
        'location.required'        => 'Lokasi wajib diisi.',
        'description.required'     => 'Deskripsi wajib diisi.',
        'kualifikasi.required'     => 'Kualifikasi wajib diisi.',
        'posted_at.required'       => 'Tanggal Post wajib diisi.',
        'posted_at.date'           => 'Format tanggal mulai tidak valid.',
        'deadline.required'        => 'Deadline wajib diisi.',
        'deadline.date'            => 'Format deadline tidak valid.',
        'status.required'          => 'Status wajib dipilih.',
        'status.in'                => 'Status tidak valid.',
    ];

    public function save($status = null): void
    {
        if ($status !== null) {
            $this->status = $status;
        }

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('lowongan-error');
            throw $e;
        }

        $deskripsi = Purifier::clean($this->description, 'quill');
        $kualifikasi = Purifier::clean($this->kualifikasi, 'quill');

        if (strip_tags($deskripsi) == '') {
            $this->addError('description', 'Deskripsi wajib diisi');
            return;
        }

        if (strip_tags($kualifikasi) == '') {
            $this->addError('kualifikasi', 'Kualifikasi wajib diisi');
            return;
        }

        $lowongan = Lowongan::findOrFail($this->lowonganId);
        $lowongan->update([
            'title'           => $this->title,
            'job_category_id' => $this->job_category_id,
            'employment_type' => $this->employment_type,
            'location'        => $this->location,
            'description'     => $deskripsi,
            'qualification'   => $kualifikasi,
            'skills'          => $this->skills,
            'posted_at'       => $this->status === 'published' ? now() : ($this->posted_at ?: null),
            'deadline'        => $this->deadline,
            'status'          => $this->status,
        ]);

        $statusLabel = $this->status === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft';

        \App\Models\ActivityLog::create([
            'user_id'     => Auth::id(),
            'type'        => 'edit_lowongan', 
            'description' => 'Lowongan "' . $this->title . '" diedit dan ' . $statusLabel,
            'ip_address'  => request()->ip(),
        ]);

        session()->flash('success', 'Lowongan berhasil ' . $statusLabel . '.');

        $this->redirect(route('lowongan'), navigate: true);
    }

    public function render()
    {
        $categories = JobCategory::orderBy('name')->get();

        return view('livewire.lowongan-edit', [
            'categories' => $categories,
        ]);
    }
}
