<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrCvet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'images',
        'published',
        'pr_collection_id'
    ];

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
        ['rec', 325, 325]
    ];

    public function pr_collection()
    {
        return $this->belongsTo(PrCollection::class);
    }

    public function images()
    {
        return $this->morphMany(\App\Models\PrImage::class, 'imageable');
    }
}
