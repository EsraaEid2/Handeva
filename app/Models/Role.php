<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    // Define constants for roles
    const CUSTOMER = 'customer';
    const VENDOR = 'vendor';
    const ADMIN = 'admin';
    
    protected $table = 'roles';

    protected $fillable = [
        'role_type', // 'customer', 'vendor', 'admin'
    ];

    // Define relationships (Role can have many Users)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}