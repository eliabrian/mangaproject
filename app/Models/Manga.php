<?php

namespace App\Models;

use Carbon\Carbon;
use DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'summary'
    ];

    public function getUpdatedAtAttribute($value)
	{
		return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Jakarta')
            ->toDateTimeString();
    }

    public function getCreatedAtAttribute($value)
	{
		return Carbon::createFromTimestamp(strtotime($value))
        ->timezone('Asia/Jakarta')
        ->toDateTimeString();
    }

    public function datatable()
    {
        $mangas = $this->all();
        return DataTables::of($mangas)
            ->editColumn('created_at', function(Manga $manga){
                return date('d F Y', strtotime($manga->created_at));
            })
            ->editColumn('updated_at', function(Manga $manga){
                return date('d F Y', strtotime($manga->updated_at));
            })
            ->addColumn('action', function(Manga $manga){
                return view('admin.layouts._action', ['id' => $manga->slug, 'route' => 'admin.manga.edit'])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
