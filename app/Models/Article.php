<?php

namespace App\Models;

use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = "id";
    protected $guarded = [];
    protected $hidden = [
        'deleted_at'
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
    ];

}
