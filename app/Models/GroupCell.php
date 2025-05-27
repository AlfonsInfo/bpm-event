<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCell extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'deleted_at'
    ];

    // Jika ingin langsung akses Users (tanpa akses pivot model)
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_cell_has_members', 'group_cell_id', 'user_id')
                    ->withTimestamps();
    }

}
