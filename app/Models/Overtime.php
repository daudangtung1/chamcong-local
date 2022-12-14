<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'checkin',
        'checkout',
        'totalTime',
        'note',
        'projectName',
        'permission',
    ];

    public function overtimeUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
