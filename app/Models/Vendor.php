<?php namespace App\Models;

use App\Models\Role;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'social_links',
        'bio',
        'profile_pic',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationship to Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relationship to Products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Optionally, if you have an Images model, you can define a relationship to it
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);

    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}