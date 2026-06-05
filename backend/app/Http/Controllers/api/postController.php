<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['author', 'category']);

        if($request->filled('status')){
            $query->where('status', $request->status);
        }

        if($request->filled('search')){
            $query->where('title', 'like','%' . $request->search . '%');
        }

        return response()->json($query->latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'status' => 'in:draft,published,scheduled',
            'visibility' => 'in:public,private'
        ]);

        $post = Post::create($validated);

        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        return response()->json($post->load(['author', 'category']));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:posts,slug,' . $post->id,
            'status' => 'sometimes|in:draft,published,scheduled',
        ]);

        $post->update($validated);

        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message'=>'Post deleted successfully']);
    }
}