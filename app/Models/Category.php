<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrCollection;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
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
}
