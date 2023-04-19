<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrCollection;
use App\Models\Color;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_single',
        'category_id',
        'slug',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prCollections()
    {
        return $this->hasMany(PrCollection::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    public function products()
    {
        return $this->hasManyThrough(PrCvet::class, PrCollection::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
}
