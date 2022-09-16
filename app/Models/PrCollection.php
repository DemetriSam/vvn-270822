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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<PrCvet>
     */
    public function prCvets()
    {
        return $this->hasMany(PrCvet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany<PrImage>
     */
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
