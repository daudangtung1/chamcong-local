<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'url',
        'name',
    ];

    public function getLevelAttribute()
    {
        return Level::find($this->level_id);
    }
}
