<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'content'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'date' => 'timestamp',
        'content' => 'string'
    ];
}
