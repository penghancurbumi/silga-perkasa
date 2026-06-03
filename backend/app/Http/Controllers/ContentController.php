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
        fputcsv($file, ['ID', 'Title', 'Body', 'Created At']); // headers row

        foreach ($contents as $content) {
            fputcsv($file, [$content->id, $content->title, $content->body, $content->created_at]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
    }
}
