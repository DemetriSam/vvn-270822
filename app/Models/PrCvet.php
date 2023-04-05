<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected const MIN_QUANTITY_M2 = 8;

    protected $fillable = [
        'title',
        'name_in_folder',
        'description',
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
            return $this->prRolls()->pluck('quantity_m2')->sum();
        }
        if ($property === 'price') {
            $price = $this->current_price ? $this->current_price :
                $this->prCollection->default_price;

            $currency = $this->prCollection->currency_of_price;
            $rate = Rate::firstWhere('currency', $currency)->rate;
            return round($price * $rate, 0) . ',00 руб./кв.метр';
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

    public function prCollection(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PrCollection::class);
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

    public function isPublished()
    {
        return $this->published === 'true';
    }

    public function retract()
    {
        $this->published = 'false';
        $this->save();
    }

    public function publish()
    {
        $this->published = 'true';
        $this->save();
    }

    public function updatePublicStatusByQuantity()
    {
        if ($this->quantity < self::MIN_QUANTITY_M2) {
            $this->retract();
        } else {
            $this->publish();
        }
    }
}
