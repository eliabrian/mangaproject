<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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

    public function ajax(Request $request)
    {
        return $this->manga->datatable();
    }
}
