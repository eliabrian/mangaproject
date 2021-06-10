<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Manga;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
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
                $images[$i - 1]->storePubliclyAs($manga->slug . '/' . $chapter->slug,
                    $i . '.jpg', 'spaces');
            }
        }

        if ($chapter) {
            return redirect(route('admin.manga.edit', ['manga' => $manga->slug]))->with('status', 'Chapter created!');
        }

    }

    public function edit(Manga $manga, Chapter $chapter)
    {
        return view('admin.chapter.edit', compact('manga','chapter'));
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        $data = $request->only(['name', 'chapter_number', 'manga_id', 'slug']);
        
        $manga = $chapter->manga;

        if (!count(Chapter::where('slug', $request->slug)->get())) {
    
            $files = Storage::allFiles($manga->slug . '/' . $chapter->slug);
    
            $updated = Chapter::where('slug', $chapter->slug)
                ->where('manga_id', $request->manga_id)
                ->update($data);
    
            $newChapter = Chapter::where('slug', $request->slug)->first();
    
            if ($chapter->slug != $newChapter->slug) {
                for ($i = 1; $i <= count($files); $i++) {
                    Storage::move($manga->slug . '/' . $chapter->slug . '/' . $i . '.jpg',
                        $manga->slug . '/' . $newChapter->slug. '/' . $i . '.jpg');
                }
            }
    
            if ($updated) {
                return redirect(route('admin.manga.edit', ['manga' => $manga->slug]))->with('status', 'Chapter updated!')->with('type', 'success');;
            }
        }

        return redirect(route('admin.manga.edit', ['manga' => $manga->slug]))->with('status', 'Chapter not updated! (Message: Use a different name or chapter number).')->with('type', 'danger');
    }
}
