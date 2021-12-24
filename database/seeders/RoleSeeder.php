<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creates Initial roles for application users
        
        $roles = ['Super Admin', 'Admin', 'Manager', 'Support', 'Customer'];

        foreach($roles as $role)
        {
            Role::findOrCreate($role);
        } 
       
    }
}
