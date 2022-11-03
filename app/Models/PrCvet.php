<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PrCvet extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'images',
        'published',
        'pr_collection_id',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();

        $this
            ->addMediaConversion('product')
            ->withResponsiveImages()
            ->nonQueued();
    }

    /**
     * @var array
     */
    public $resizes = [
        ['product', 574, 574],
        ['product', 689, 689],
        ['product', 861, 861],
        ['product', 1148, 1148],
        ['product', 414, 700],
        ['product', 621, 1050],
        ['product', 828, 1400],
        ['rec', 320, 320],
        ['rec', 480, 480],
        ['rec', 640, 640],
        ['rec', 325, 325],
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * */
    public function prCollection(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PrCollection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(\App\Models\PrImage::class, 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
