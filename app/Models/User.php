<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Order;
use App\Models\OrderItem;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'address',
        'phone_number',
        'age',
        'points',
        'is_deleted',
        'is_pending_vendor',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Define relationship to Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
    // Define the relationship with the Wishlist model
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Define the relationship with the Review model
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0);
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function contactUsMessages()
    {
        return $this->hasMany(ContactUs::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }


}