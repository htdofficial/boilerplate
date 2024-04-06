<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $role = Role::create([
            'name' => 'administrator',
            'created_by' => $user->id
        ]);

        $role->routes()->create([
            'route_name' => '*',
            'created_by' => $user->id
        ]);

        $user->roles()->attach($role, ['created_by' => $user->id]);

    }
}
