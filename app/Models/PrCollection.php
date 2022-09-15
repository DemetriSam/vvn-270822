<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'description',
        'images',
        'published',
    ];

    public function prCvets()
    {
        return $this->hasMany(PrCvet::class);
    }

    public function images()
    {
        return $this->morphMany(\App\Models\PrImage::class, 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Category>
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
