<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                "name" => "Dashboard",
                "display_name" => "Dashboard",
                "ui_url" => "/dashboard",
                "ui_component" => "Dashboard",
                "parent_module_id" => null,
                "is_child_of" => null
            ],
            [
                "name" => "Category",
                "display_name" => "Category",
                "ui_url" => "/dashboard/category",
                "ui_component" => "Category",
                "parent_module_id" => null,
                "is_child_of" => null
            ],
            [
                "name" => "User",
                "display_name" => "User",
                "ui_url" => null,
                "ui_component" => "User",
                "parent_module_id" => null,
                "is_child_of" => null
            ],
            [
                "name" => "Admin",
                "display_name" => "Admin",
                "ui_url" => "/dashboard/admin",
                "ui_component" => "Admin",
                "parent_module_id" => null,
                "is_child_of" => "User"
            ],
            [
                "name" => "Customer",
                "display_name" => "Customer",
                "ui_url" => "/dashboard/customer",
                "ui_component" => "Customer",
                "parent_module_id" => null,
                "is_child_of" => "User"
            ],
        ];

        foreach ($modules as $module) {
            if ($module['is_child_of'] != null) {
                $parentModule = Module::where('name', $module['name'])->first();
                if ($parentModule) {
                    $module['parent_module_id'] = $parentModule->id;
                }
            }
            unset($module['is_child_of']);
            Module::create($module);
        }
    }
}
