<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public $fillable = ['page_id', 'ann'];

    public function __get($property)
    {
        switch ($property) {
            case 'slug':
                return $this->page->slug;
            case 'title':
                return $this->page->title;
            default:
                return parent::__get($property);
        }
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $widthOfSlot = 360;
        $heightOfSlot = 250;
        $maxPxDensity = 2;

        $this
            ->addMediaConversion('tile')
            ->width($widthOfSlot * $maxPxDensity)
            ->fit(Manipulations::FIT_CROP, $widthOfSlot * $maxPxDensity, $heightOfSlot * $maxPxDensity)
            ->withResponsiveImages()
            ->nonQueued();
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function isPublished()
    {
        return $this->page->isPublished();
    }
}
