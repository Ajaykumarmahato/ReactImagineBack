<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::get();
        return $this->respond($permission);
    }
    public function moduleRolePermission($roleId)
    {
        $role = Role::where('id', $roleId)->with('permissions')->first();
        $finalPermissions = [];
        $rolespermissionIds = [];
        if ($role) {
            if (count($role['permissions']) > 0) {
                foreach ($role['permissions'] as $rp) {
                    array_push($rolespermissionIds, $rp['id']);
                }
            }
            $permissions = Permission::all();
            $modules = [];
            foreach ($permissions as $permission) {
                $permissionName = explode('|', $permission->name);
                array_push($modules, $permissionName[1]);
            }
            $finalModules = array_unique($modules);
            $finalModu = [];
            foreach ($finalModules as $fm) {
                $finalModu['moduleName'] = $fm;
                $finalModu['action'] = [];
                foreach ($permissions as $permission) {
                    $hasPermission = false;
                    if (in_array($permission->id, $rolespermissionIds)) {
                        $hasPermission = true;
                    }
                    $permissionName = explode('|', $permission->name);
                    if ($permissionName[1] == $fm) {
                        array_push($finalModu['action'], ['id' => $permission->id, 'name' => $permissionName[0], 'hasPermission' => $hasPermission]);
                    }
                }
                array_push($finalPermissions, $finalModu);
            }
        }
        return $this->respond(collect($finalPermissions));
    }

    public function getModulePermisson()
    {
        $permissions = Permission::all();
        $modules = [];
        foreach ($permissions as $permission) {
            $permissionName = explode('|', $permission->name);
            array_push($modules, $permissionName[1]);
        }
        $finalModules = array_unique($modules);
        $finalPermissions = [];
        $finalModu = [];
        foreach ($finalModules as $fm) {
            $finalModu['moduleName'] = $fm;
            $finalModu['action'] = [];
            foreach ($permissions as $permission) {
                $permissionName = explode('|', $permission->name);
                if ($permissionName[1] == $fm) {
                    array_push($finalModu['action'], ['id' => $permission->id, 'name' => $permissionName[0]]);
                }
            }
            array_push($finalPermissions, $finalModu);
        }
        return $this->respond(collect($finalPermissions));
    }
}
