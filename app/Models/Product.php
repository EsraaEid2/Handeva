<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'price', 'category_id', 'stock_quantity', 'vendor_id', 
        'image_urls', 'is_visible', 'is_traditional', 'is_customizable', 'price_after_discount'
    ];

    // Relationship to Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship with ProductImage
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', 1);
     }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customizations()
    {
        return $this->hasMany(ProductCustomization::class);
    }

}