<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Editor']); 
        Role::create(['guard_name' => 'admin', 'name' => 'Admin']);
        Role::create(['guard_name' => 'admin', 'name' => 'Viewer']);
        Role::create(['guard_name' => 'admin', 'name' => 'Editor']);
        
        Role::create(['guard_name' => 'reader', 'name' => 'Read']); 

    }
}
