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
        'name_in_folder',
        'description',
        'images',
        'published',
        'pr_collection_id',
        'color_id',
        'current_price',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();

        $this
            ->addMediaConversion('product_narrow')
            ->withResponsiveImages()
            ->nonQueued();

        $widthOfSlot = 670;
        $heightOfSlot = 565;
        $maxPxDensity = 3;
        $this
            ->addMediaConversion('product_wide')
            ->width($widthOfSlot * $maxPxDensity)
            ->fit(Manipulations::FIT_CROP, $widthOfSlot * $maxPxDensity, $heightOfSlot * $maxPxDensity)
            ->withResponsiveImages()
            ->nonQueued();

        $widthOfSlot = 534;
        $heightOfSlot = 534;
        $this
            ->addMediaConversion('rec')
            ->width($widthOfSlot * $maxPxDensity)
            ->fit(Manipulations::FIT_CROP, $widthOfSlot * $maxPxDensity, $heightOfSlot * $maxPxDensity)
            ->withResponsiveImages()
            ->nonQueued();
    }

    public function __get($property)
    {
        if ($property === 'quantity') {
            return $this->rolls()->pluck('quantity_m2')->sum();
        }
        if ($property === 'price') {
            if ($this->current_price) {
                return $this->current_price;
            }

            return $this->prCollection->default_price;
        }

        if ($property === 'images') {
            return $this->getMedia('images');
        }

        if ($property === 'composition') {
            return $this->prCollection->composition;
        }

        if ($property === 'width') {
            return $this->prCollection->width;
        }

        if ($property === 'height') {
            return $this->prCollection->height;
        }

        return parent::__get($property);
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
    public function prRolls()
    {
        return $this->hasMany(PrRoll::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function category()
    {
        return $this->prCollection->category();
    }
}
