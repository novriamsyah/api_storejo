<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductGallery;
use App\Models\ProductCategory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description',
        'tags',
        'categories_id',
    ];

    public function galleries(): HasMany
    {
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'categories_id', 'id');
    }
}
