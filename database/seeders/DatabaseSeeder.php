<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $user=User::create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'password'=>'admin123',
            'dob'=>'1995-01-01'
        ]);
        foreach(Role::all() as $role)
         $user->UserRoles()->create(["role_id"=>$role->id]);
    }
}
