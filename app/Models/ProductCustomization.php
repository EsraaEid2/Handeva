<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCustomization extends Model
{
    use HasFactory;

    // اسم الجدول
    protected $table = 'product_customization';

    // الحقول التي يمكن ملؤها
    protected $fillable = [
        'product_id',
        'custom_type',
    ];

    // العلاقة مع جدول customization_options
    public function options()
    {
        return $this->hasMany(CustomizationOption::class);
    }

    // العلاقة مع جدول products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}