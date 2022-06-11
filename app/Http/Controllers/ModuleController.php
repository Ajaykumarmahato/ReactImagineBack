<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Repositories\ModuleRepositoryInterface;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $module;

    public function __construct(ModuleRepositoryInterface $module)
    {
        $this->module = $module;
    }


    public function get()
    {
        return $this->respond($this->module->get());
    }
}
