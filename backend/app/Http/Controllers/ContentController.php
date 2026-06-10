<?php

namespace App\Http\Controllers; 

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function export()
    {
    // Example: export as CSV
    $contents = Content::all();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="content.csv"',
    ];

    $callback = function () use ($contents) {
        $file = fopen('php://output', 'w');
        fputcsv($file, [
                        'ID', 
                        'Title', 
                        'Slug', 
                        'Content', 
                        'Thumbnail',
                        'Status',
                        'Category',
                        'Author',
                        'Views',
                        'Published At']); // headers row

        foreach ($contents as $content) {
            fputcsv($file, [
                $content->id, 
                $content->title, 
                $content->slug,
                $content->content,
                $content->thumbnail,
                $content->status,
                $content->category,
                $content->author_id,
                $content->views, 
                $content->published_at
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
    }

    public function destroy()
    {
        $post = Post::findOrfail($id);
        $post->delete();

        return redirect()->route('content')->with('success', 'Artikel berhasil di hapus');
    }
}
