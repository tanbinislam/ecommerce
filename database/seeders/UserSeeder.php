<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\User::create(
            [
                'name' => 'Tanbin Islam',
                'email' => 'tanbinislamridoy@gmail.com',
                'user_name' => 'tanbin123456',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );

        $role = Role::findOrCreate('Admin');
        $role2 = Role::findOrCreate('Customer');
        $admin->assignRole($role, $role2);

        \App\Models\User::factory(50)->create();
    }
}
