<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,SoftDeletes;

    
    public const RELATION_CATEGORY = 'category';

    protected $table = "events";
    protected $primaryKey = "id";

    protected $guarded = [];

    protected $hidden = [
        'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }
}
