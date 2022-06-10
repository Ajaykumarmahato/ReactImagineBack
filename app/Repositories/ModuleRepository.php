<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository implements ModuleRepositoryInterface
{


    public function all()
    {
        return Module::all();
    }
}
