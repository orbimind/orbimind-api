<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'image' => 'string'
    ];
}
