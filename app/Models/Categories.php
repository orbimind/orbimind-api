<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kblais\QueryFilter\Filterable;

class Categories extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'title',
        'description'
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string'
    ];

    public function posts()
    {
        return $this->belongsToMany(Posts::class);
    }
}
