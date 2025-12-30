<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // * Using updateOrCreate avoids duplicate entries if you run the seeder multiple times.

        $roles = ['admin',  'user', 'owner'];
        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role]);
        }

    }
}
