<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupCellHasMember extends Model
{
    use HasFactory;

    
    protected $guarded = [];

    protected $hidden = [
        'deleted_at'
    ];
   public function groupCell()
    {
        return $this->belongsTo(GroupCell::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
