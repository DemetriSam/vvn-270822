<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'slug', 'type', 'params', 'text-content', 'description', 'title', 'published'];

    protected $casts = [
        'params' => 'array',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $widthOfArticleColumn = 547;
        $this
            ->addMediaConversion('widthOfArticleColumn')
            ->width($widthOfArticleColumn)
            ->nonQueued();
    }
}
