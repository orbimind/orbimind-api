<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'post_id',
        'type'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'date' => 'timestamp',
        'post_id' => 'integer',
        'type' => 'string'
    ];
}
