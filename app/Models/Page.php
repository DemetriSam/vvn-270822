<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type', 'params', 'text-content', 'description', 'title'];

    protected $casts = [
        'params' => 'array',
    ];
}
