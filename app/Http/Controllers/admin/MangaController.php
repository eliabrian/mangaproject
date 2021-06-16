<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMangaRequest;
use App\Http\Requests\UpdateMangaRequest;
use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    public function __construct(Manga $manga)
    {
        $this->manga = $manga;
    }

    public function index()
    {
        return view('admin.manga.index');
    }

    public function create()
    {
        return view('admin.manga.create');
    }

    public function store(StoreMangaRequest $request)
    {
        $data = $request->only(['name', 'slug', 'status', 'summary']);

        $created = Manga::create($data);

        if ($created) {
            return redirect(route('admin.manga.index'))->with('status', 'Manga created!')->with('type', 'sucess');;
        }
    }

    public function edit(Manga $manga)
    {
        return view('admin.manga.edit', compact('manga'));
    }

    public function update(UpdateMangaRequest $request, Manga $manga)
    {
        $data = $request->only(['name', 'slug', 'status', 'summary', 'cover']);
        
        // Image Upload Handler
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $isCoverExists = Storage::exists($manga->slug . '/cover.jpg');

            if ($isCoverExists) {
                $deleted = Storage::delete($manga->slug . '/cover.jpg');
            }
            
            $cover->storePubliclyAs($manga->slug, 'cover.jpg', 'spaces');
        }

        $data['cover'] = Storage::url($manga->slug . '/cover.jpg');

        $updated = Manga::where('id', $manga->id)->update($data);

        if($updated){
            return redirect(route('admin.manga.edit', $request->slug))->with('status', 'Manga updated !')->with('type', 'success');;
        }
    }

    public function ajax(Request $request)
    {
        return $this->manga->datatable();
    }

    public function chapterAjax(Request $request)
    {
        $chapters = $this->manga->find($request->manga_id)->chapters;
        return $this->manga->chapterDatatable($chapters);
    }
}
