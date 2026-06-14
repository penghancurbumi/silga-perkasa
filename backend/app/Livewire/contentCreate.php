<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon; 

class ContentCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $existingThumbnail = null; 
    public $slug;
    public $content;
    public $category_id;
    public $published_at;
    public $thumbnail;
    public $categories = [];

    protected $messages = [
        'title.required' => 'Judul wajib diisi',
        'slug.required' => 'slug wajib diisi',
        'slug.unique' => 'slug sudah di gunakan',
        'content.required' => 'konten wajib di isi',
        'thumbnail.required' => 'thumbnail wajib di isi',
        'category_id.required' => 'kategori wajb di isi',
        'published_at.required' => 'tanggal publikasi wajib di isi',
    ];

    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save($status)
    {
        
        // error-2 validasi gagal
        try{
             $this->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|unique:posts,slug',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'thumbnail' => 'required|image|max:5120',
                'published_at' => 'required'
            ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            if($status === 'published'){
                $this->dispatch('published-error-2');
            }elseif($status === 'draft'){
                $this->dispatch('draft-error-2');
            }elseif($status === 'scheduled'){
                $this->dispatch('scheduled-error-2');
            }
            throw $e;
        }
        
        //error-1 gagal simpan ke database
        try{
             $thumbnailPath = $this->thumbnail?->store('thumbnails', 'public');

            Post::create([
                'title' => $this->title,
                'slug' => $this->slug,
                'content' => $this->content,
                'category_id' => $this->category_id,
                'published_at' => $this->published_at,
                'status' => $status,
                'author_id' => auth()->id(),
                'thumbnail' => $thumbnailPath
            ]);

            $this->reset(['title','slug','content','category_id','thumbnail','published_at']);

            $statusLabel = match($status) {
                'published' => 'dipublikasikan',
                'draft'     => 'disimpan sebagai draft',
                'scheduled' => 'dijadwalkan',
                default     => $status,
            };

            ActivityLog::create([
                'user_id'     => Auth::id(),
                'type'        => 'create_post',
                'description' => 'Artikel "' . $this->title . '" ' . $statusLabel,
                'ip_address'  => request()->ip(),
            ]);

            auth()->user()->notify(new ArticleNotification(
                message: 'Artikel "' . $this->title . '" berhasil ' . $statusLabel,
                type: $status,
                post: $post,
            ));

            if($status === 'published'){
                $this->dispatch('published-success');
            }elseif($status === 'draft'){
                $this->dispatch('draft-success');
            }elseif($status === 'scheduled'){
                $this->dispatch('scheduled-success');
            }

        }catch(\Exception $e) {
            if($status === 'published'){
                $this->dispatch('published-error-1');
            }elseif($status === 'draft'){
                $this->dispatch('draft-error-1');
            }elseif($status === 'scheduled'){
                $this->dispatch('scheduled-error-1');
            }
        }
       
    }

    public function render()
    {
        return view('pages.content-create');
    }
}