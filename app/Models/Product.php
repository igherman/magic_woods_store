<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category_id',
        'sku',
        'stock',
        'is_visible',
        'is_featured',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_visible' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images')
            ->useFallbackUrl('/images/placeholder.jpg')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(200);
                
                $this->addMediaConversion('large')
                    ->width(800)
                    ->height(800);
            });
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (! $product->slug) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
} 