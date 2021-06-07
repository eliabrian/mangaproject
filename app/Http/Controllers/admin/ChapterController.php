<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Manga;
use App\Http\Requests\StoreChapterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $chapter = Chapter::create($data);

        $manga = $chapter->manga;
        if($request->hasFile('images')) {
            $images = $request->file('images');

            for ($i = 1; $i <= count($images); $i++) {
                $images[$i - 1]->storePubliclyAs($manga->slug . '/' . $chapter->slug, $i . '.jpg', 'spaces');
            }
        }

        if ($chapter) {
            return redirect(route('admin.manga.edit', ['manga' => $manga->slug]))->with('status', 'Chapter created!');
        }

    }

    public function edit(Chapter $chapter)
    {
        dd($chapter);
    }
}
