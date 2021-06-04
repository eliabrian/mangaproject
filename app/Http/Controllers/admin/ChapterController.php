<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Manga;
use App\Http\Requests\StoreChapterRequest;

class ChapterController extends Controller
{
    public function __construct(Chapter $chapter)
    {
        $this->chapter = $chapter;
    }

    public function create(Manga $manga)
    {
        return view('admin.chapter.create', compact('manga'));
    }

    public function store(StoreChapterRequest $request)
    {
        $data = $request->only(['name', 'slug', 'chapter_number', 'manga_id']);
        
        dd($request);
        // if($request->hasFile('images')) {
        //     $images = $request->file('images');
        //     $chapter = Chapter::create($data);

        //     foreach ($images as $image) {
        //         $chapter->attachMedia($image);
        //     }
        // }

    }

    public function edit(Chapter $chapter)
    {
        dd($chapter);
    }
}
