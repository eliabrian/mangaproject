<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manga_id',
        'chapter_number',
        'slug',
    ];

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

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
}
