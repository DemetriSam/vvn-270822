<?php

namespace App\Models;

use App\Models\Interfaces\HasPublicStatus;
use App\Models\Traits\PublicStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia, HasPublicStatus
{
    use HasFactory;
    use InteractsWithMedia;
    use PublicStatus;

    protected $fillable = ['name', 'slug', 'type', 'params', 'text-content', 'description', 'title', 'published'];

    protected $casts = [
        'params' => 'array',
    ];

    public function __get($property)
    {
        switch ($property) {
            case 'ann':
                return $this->post->ann;
            default:
                return parent::__get($property);
        }
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $widthOfArticleColumn = 547;
        $maxPxDensity = 2;
        $this
            ->addMediaConversion('widthOfArticleColumn')
            ->width($widthOfArticleColumn * $maxPxDensity)
            ->withResponsiveImages()
            ->nonQueued();
    }

    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
