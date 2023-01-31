<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nickname',
        'default_price',
        'description',
        'images',
        'published',
        'category_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prCvets()
    {
        return $this->hasMany(PrCvet::class);
    }

    public function properties()
    {
        return $this->belongsToMany(PropertyValue::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(\App\Models\PrImage::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
