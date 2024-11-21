<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role_name' => 'Customer', 'role_type' => 0],
            ['role_name' => 'Vendor', 'role_type' => 1],
            ['role_name' => 'Admin', 'role_type' => 2],
        ]);
    }
}