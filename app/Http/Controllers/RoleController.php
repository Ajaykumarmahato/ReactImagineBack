<?php

namespace App\Http\Controllers;

use App\ApiCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::with('permissions')->get();

        return $this->respond($roles);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $role = Role::where('name', $data['name'])->first();
        if ($role != null) {
            return $this->respondErrorWithMessage('Role Name Already Exists', ApiCode::FORBIDDEN, ApiCode::FORBIDDEN);
        } else {
            DB::transaction(function () use ($data) {
                $createdRole = Role::create([
                    'name' => $data['name'],
                    'guard_name' => 'api'
                ]);
                $createdRole->syncPermissions($data['permissions']);
            });
            return $this->respond(null, 'Role Added Successfully.');
        }
    }
    public function editRolePermissions(Request $request)
    {
        $data = $request->all();
        $role = Role::where('id', $data['roleId'])->first();
        if ($role == null) {
            return $this->respondErrorWithMessage('Role Not found', ApiCode::FORBIDDEN, ApiCode::FORBIDDEN);
        } else {
            $role->syncPermissions($data['permissions']);
            return $this->respond(null, 'Permissions Updated Successfully.');
        }
    }


    public function delete($roleId)
    {
        $userHasRole = DB::table('model_has_roles')->where('role_id', $roleId)->get();
        if (count($userHasRole) > 0) {
            return $this->respondErrorWithMessage('Role Cannot Be Deleted.', ApiCode::FORBIDDEN, ApiCode::FORBIDDEN);
        } else {
            Role::where('id', $roleId)->delete();
            return $this->respond(null, 'Role Deleted Successfully.');
        }
    }
}
