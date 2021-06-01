<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMangaRequest;
use App\Http\Requests\UpdateMangaRequest;
use App\Models\Manga;
use Illuminate\Http\Request;

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
            return redirect(route('admin.manga.index'))->with('status', 'Manga created!');
        }
    }

    public function edit(Manga $manga)
    {
        return view('admin.manga.edit', compact('manga'));
    }

    public function update(UpdateMangaRequest $request, Manga $manga)
    {
        $data = $request->only(['name', 'slug', 'status', 'summary']);
        $updated = Manga::where('id', $manga->id)->update($data);
        if($updated){
            return redirect(route('admin.manga.edit', $manga->slug))->with('status', 'Manga updated !');
        }
    }

    public function ajax(Request $request)
    {
        return $this->manga->datatable();
    }
}
