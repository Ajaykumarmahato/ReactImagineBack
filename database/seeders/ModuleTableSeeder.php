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
                "ui_url" => "/category",
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
                "ui_url" => "/admin",
                "ui_component" => "Admin",
                "parent_module_id" => null,
                "is_child_of" => "User"
            ],
            [
                "name" => "Customer",
                "display_name" => "Customer",
                "ui_url" => "/customer",
                "ui_component" => "Customer",
                "parent_module_id" => null,
                "is_child_of" => "User"
            ],
            [
                "name" => "Role",
                "display_name" => "Role",
                "ui_url" => "/role",
                "ui_component" => "Role",
                "parent_module_id" => null,
                "is_child_of" => null
            ],
        ];

        foreach ($modules as $module) {
            if ($module['is_child_of'] != null) {
                $parentModule = Module::where('name', $module['is_child_of'])->first();
                if ($parentModule) {
                    $module['parent_module_id'] = $parentModule->id;
                }
            }
            unset($module['is_child_of']);
            Module::create($module);
        }
    }
}
