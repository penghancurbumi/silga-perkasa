<?php

namespace App\Livewire;

use App\Models\JobCategory;
use App\Models\Lowongan;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class LowonganCreate extends Component
{
    public $title          = '';
    public $job_category_id = '';
    public $employment_type = '';
    public $location       = '';
    public $description    = '';
    public $kualifikasi    = '';
    public $posted_at      = '';
    public $deadline       = '';
    public $status         = '';

    protected function rules(): array
    {
        return [
            'title'           => 'required|string|max:255',
            'job_category_id' => 'required|exists:job_categories,id',
            'employment_type' => 'required|in:full_time,part_time,contract,internship,freelance',
            'location'        => 'required|string|max:255',
            'description'     => 'required|string',
            'kualifikasi'     => 'required|string',
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

        $deskripsi = Purifier::clean($this->description,'quill');
        $kualifikasi = Purifier::clean($this->kualifikasi,'quill');

        if (strip_tags($deskripsi) == ''){
            $this->addError('deskripsi','Deskripsi wajib diisi');
            return;
        }

        if (strip_tags($kualifikasi) == ''){
            $this->addError('kualifikasi','Kualifikasi wajib diisi');
            return;
        }

        Lowongan::create([
            'user_id'         => Auth::id(),
            'title'           => $this->title,
            'job_category_id' => $this->job_category_id,
            'employment_type' => $this->employment_type,
            'location'        => $this->location,
            'description'     => $description,
            'qualification'   => $kualifikasi,
            'posted_at'       => $this->status === 'published' ? now() : ($this->posted_at ?: null),
            'deadline'        => $this->deadline,
            'status'          => $this->status,
            'minimum_experience' => 0,
        ]);

        $statusLabel = $this->status === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft';

        \App\Models\ActivityLog::create([
            'user_id'     => Auth::id(),
            'type'        => 'create_lowongan', // asumsikan Anda memiliki type ini
            'description' => 'Lowongan "' . $this->title . '" ' . $statusLabel,
            'ip_address'  => request()->ip(),
        ]);

        session()->flash('success', 'Lowongan berhasil ' . $statusLabel . '.');

        $this->redirect(route('lowongan'), navigate: true);
    }

    public function render()
    {
        $categories = JobCategory::orderBy('name')->get();

        return view('livewire.lowongan-create', [
            'categories' => $categories,
        ]);
    }
}
