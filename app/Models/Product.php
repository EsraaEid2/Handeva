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

    // Optionally, if you have an Image model, define the relationship
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}