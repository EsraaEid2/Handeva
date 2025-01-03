<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customization extends Model
{
    use HasFactory, SoftDeletes;
 
   protected $fillable= ['custom_type'];
   protected $table = 'customizations'; 
   
   
   public function options()
   {
       return $this->hasMany(CustomizationOption::class);
   }

   public function products()
   {
       return $this->hasMany(ProductCustomization::class);
   }
}