<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['author', 'category']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'oldest') { 
            $query->oldest();
        } elseif ($sort === 'views'){
            $query->orderByDesc('views_count');
        }else {
            $query->latest();
        }

        $posts = $query->paginate(10)->withQueryString();

        return view('pages.content', [
            'posts'          => $posts,
            'categories'     => Category::orderBy('name')->get(),
            'totalPosts'     => Post::count(),
            'publishedCount' => Post::where('status', 'published')->count(),
            'draftCount'     => Post::where('status', 'draft')->count(),
            'scheduledCount' => Post::where('status', 'scheduled')->count(),
        ]);
    }
}