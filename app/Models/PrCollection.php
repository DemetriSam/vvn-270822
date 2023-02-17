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

    public function __get($property)
    {
        switch ($property) {
            case 'composition':
            case 'width':
            case 'height':
                $target = Property::firstWhere('machine_name', $property);

                if (!$target) {
                    return;
                }
                return optional($this->properties->firstWhere('property_id', $target->id))
                    ->value;
            default:
                return parent::__get($property);
        }
    }
}
