<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kblais\QueryFilter\Filterable;

class Posts extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
        'rating',
        'category_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'status' => 'bool',
        'rating' => 'integer',
        'category_id' => 'array'
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function categories()
    {
        return $this->hasMany(Categories::class);
    }
}
