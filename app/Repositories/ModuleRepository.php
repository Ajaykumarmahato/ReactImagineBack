<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository implements ModuleRepositoryInterface
{


    public function get()
    {
        $modules = Module::where('parent_module_id', null)->get();
        if (count($modules) > 0) {
            foreach ($modules as $module) {
                $module['sub_modules'] = Module::where('parent_module_id', $module['id'])->get();
            }
        }
        return $modules;
    }
}
