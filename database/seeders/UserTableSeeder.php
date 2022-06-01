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
                "password" => bcrypt("asdfgh137")
            ],
            [
                "name" => "User",
                "email" => "user@gmail.com",
                "email_verified_at" => now(),
                "password" => bcrypt("asdfgh137")
            ]
        ];

        foreach ($users as $user) {
            $createdUser = User::create($user);

            if ($createdUser['name'] == "Dev Admin") {
            }
            if ($createdUser['name'] == "User") {
            }
        }
    }
}
