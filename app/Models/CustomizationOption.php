<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizationOption extends Model
{
    use HasFactory;

    // اسم الجدول
    protected $table = 'customization_options';

    // الحقول التي يمكن ملؤها
    protected $fillable = [
        'product_customization_id',
        'option_value',
    ];

    // العلاقة مع جدول product_customization
    public function customization()
    {
        return $this->belongsTo(ProductCustomization::class);
    }
}