<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $table = 'roles';
    
    const ROLE_ADMIN = 3;
    const ROLE_USER = 1;
    const ROLE_VENDOR = 2;

    protected $fillable = [
        'role_type', // 'customer', 'vendor', 'admin'
    ];

    // Define relationships (Role can have many Users)
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    
}