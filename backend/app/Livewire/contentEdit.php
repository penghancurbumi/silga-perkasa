<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Category;
use App\Models\ActivityLog;
use App\Notifications\ArticleNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon; 

class ContentEdit extends Component
{
    use WithFileUploads;

    public $postId;
    public $title;
    public $slug;
    public $content;
    public $category_id;
    public $published_at;
    public $thumbnail;
    public $existingThumbnail;
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

    public function mount($id)
    {
        $post = Post::findOrFail($id);

        $this->postId                = $post->id;
        $this->title                 = $post->title;
        $this->slug                  = $post->slug;
        $this->content               = $post->content;
        $this->category_id           = $post->category_id;
        $this->existingThumbnail     = $post->thumbnail;
        $this->categories            = Category::orderBy('name')->get();

        $this->published_at = $post->published_at
        ? Carbon::parse($post->published_at)->format('Y-m-d\TH:i')
        : null;
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save($status)
    {

        try{
            $this->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|unique:posts,slug,' . $this->postId,
                'content' => 'required',
                'category_id' => 'nullable|exists:categories,id',
                'thumbnail' => 'nullable|image|max:5120',
                'published_at' => 'nullable'
            ]);

            $thumbnailPath = $this->existingThumbnail;
            if ($this->thumbnail){
                $thumbnailPath = $this->thumbnail?->store('thumbnails', 'public');
            }

            $post = Post::findOrFail($this->postId);
            $post->update([
                'title'      => $this->title,
                'slug'       => $this->slug,
                'content'    => $this->content,
                'category_id'=> $this->category_id,
                'published_at'=> $this->published_at,
                'status'    => $status,
                'author_id' => auth()->id(),
                'thumbnail' => $thumbnailPath
            ]);

            $statusLabel = match($status) {
                'published' => 'dipublikasikan',
                'draft'     => 'disimpan sebagai draft',
                'scheduled' => 'dijadwalkan',
                default     => $status,
            };

            ActivityLog::create([
                'user_id'     => Auth::id(),
                'type'        => 'edit_post',
                'description' => 'Artikel "' . $this->title . '" diedit dan ' . $statusLabel,
                'ip_address'  => request()->ip(),
            ]);

            auth()->user()->notify(new ArticleNotification(
                message: 'Artikel "' . $post->title . '" diedit dan' . $statusLabel,
                type : 'edit_post',
                post: $post,
            ));

            $this->dispatch('edit-success');

        }catch(\Illuminate\Validation\ValidationException $e){
            $this->dispatch('edit-error');
            throw $e;
        }catch(\Exception $e){
            \Illuminate\Support\Facades\Log::error('Content Edit Error: ' . $e->getMessage());
            $this->dispatch('edit-error');
        }
    }

    public function render()
    {
        return view('pages.content-edit',[
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}