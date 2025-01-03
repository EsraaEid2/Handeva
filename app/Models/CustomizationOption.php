<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizationOption extends Model
{
    use HasFactory;

    protected $fillable = ['customization_id', 'option_value'];

    public function customization()
    {
        return $this->belongsTo(Customization::class);
    }
}