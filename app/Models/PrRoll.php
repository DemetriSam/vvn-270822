<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrRoll extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'vendor_code',
        'quantity_m2',
        'pr_cvet_id',
        'supplier_id',
        'slug',
    ];

    protected $casts = [
        'created_at' => 'date:d.m.Y',
        'updated_at' => 'date:d.m.Y',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function prCvet()
    {
        return $this->belongsTo(PrCvet::class);
    }
}
