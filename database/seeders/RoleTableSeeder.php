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
                "name" => "Developer Admin",
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
                $role->syncPermissions($permissions);
            }
            if ($role['name'] == "User") {
                foreach ($permissions as $permission) {
                    $exploded = explode('|', $permission['name']);
                    if ($exploded[1] == "Category" || ($exploded[1] == "User" && $exploded[0] == "view-my-detail") || $exploded[1] == "Nominal Account") {
                        $permission->assignRole($role);
                    }
                }
            }
        }
    }
}
