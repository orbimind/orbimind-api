<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'category_id' => 'array'
    ];
}
