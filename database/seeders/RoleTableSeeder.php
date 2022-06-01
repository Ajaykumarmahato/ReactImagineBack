<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                "name" => "Dveloper Admin",
                "guard_name" => "api"
            ],
            [
                "name" => "System Admin",
                "guard_name" => "api"
            ],
            [
                "name" => "User",
                "guard_name" => "api"
            ],
        ];

        $permissions = Permission::all();
        foreach ($roles as $role) {
            $role = Role::create($role);
            if ($role['name'] == "Developer Admin" || $role['name'] == "System Admin") {
            }
            if ($role['name'] == "User") {
            }
        }
    }
}
