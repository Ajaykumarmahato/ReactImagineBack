<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Dev Admin",
                "email" => "devadmin@gmail.com",
                "email_verified_at" => now(),
                "password" => bcrypt("asdfgh137"),
                "status" => "Enabled",
                "contact_number" => "984512562885"
            ],
            [
                "name" => "User",
                "email" => "user@gmail.com",
                "email_verified_at" => now(),
                "password" => bcrypt("asdfgh137"),
                "status" => "Enabled",
                "contact_number" => "984512562885"
            ]
        ];

        foreach ($users as $user) {
            $createdUser = User::create($user);

            if ($createdUser['name'] == "Dev Admin") {
                $role = Role::where('name', 'Developer Admin')->first();
                $createdUser->assignRole($role);
            }
            if ($createdUser['name'] == "User") {
                $role = Role::where('name', 'User')->first();
                $createdUser->assignRole($role);
            }
        }
    }
}
