<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferPrayer extends Model
{
    use HasFactory;

    
    protected $guarded = [];

    protected $hidden = [
        'deleted_at'
    ];
}
