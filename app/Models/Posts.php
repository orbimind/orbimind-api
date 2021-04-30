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
        'date',
        'status',
        'content',
        'category_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'title' => 'string',
        'date' => 'timestamp',
        'status' => 'boolean',
        'content' => 'string',
        'category_id' => 'integer'
    ];
}
