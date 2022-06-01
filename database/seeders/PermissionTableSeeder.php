<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = Module::all();
        foreach ($modules as $module) {
            $permissions = [
                [
                    'name' => 'view|' . $module->name,
                    'guard_name' => 'api',
                ],
                [
                    'name' => 'view-all|' . $module->name,
                    'guard_name' => 'api',
                ],
                [
                    'name' => 'create|' . $module->name,
                    'guard_name' => 'api',
                ],
                [
                    'name' => 'update|' . $module->name,
                    'guard_name' => 'api',
                ],
                [
                    'name' => 'delete|' . $module->name,
                    'guard_name' => 'api',
                ]
            ];
            if ($module['name'] == 'Dashboard') {
                $permissions = [
                    [
                        'name' => 'view|' . $module->name,
                        'guard_name' => 'api',
                    ],
                ];
            }

            foreach ($permissions as $key => $value) {
                Permission::create($value);
            }
        }
    }
}
