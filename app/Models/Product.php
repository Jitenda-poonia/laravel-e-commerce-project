<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

use Spatie\Sluggable\SlugOptions;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'name',
        'status',
        'is_featured',
        'sku',
        'qty',
        'stock_status',
        'weight',
        'price',
        'special_price',
        'special_price_from',
        'special_price_to',
        'short_description',
        'description',
        'related_product',
        'url_key',
        'meta_tag',
        'meta_title',
        'meta_description'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();

    }

    public function getSlugUrl()
    {
        return route('customer.product.show', ['slug'=>$this->slug, 'id'=>$this->id]);
    }
}
