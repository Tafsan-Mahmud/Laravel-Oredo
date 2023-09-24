<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function role_management (){
       $permission = Permission::all();
       $roles = Role::all();
       $users = User::all();
        return view('Admin.RoleManagement.role_management',[
            'permission' => $permission,
            'roles' => $roles,
            'users' => $users,
        ]);
    }
    function permission_store (Request $request){
        Permission::create([
            'name' => $request->permission,
        ]);
        return back();
    }
    function role_store (Request $request){
        $role = Role::create([
            'name' => $request->role
        ]);
        $role->givePermissionTo($request->permission);
        return back();
    }
    function asign_role (Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back();
    }
    function remove_role_user ($user_id){
        $user = User::find($user_id);
        $user->syncRoles([]);
        $user->syncPermissions([]);
        return back();
    }
    function edit_user_permission ($user_id){
        $user = User::find($user_id);
        $permission = Permission::all();
        return view('Admin.RoleManagement.edit_user_permission',[
            'user' => $user,
            'permission'=>$permission,
        ]);
    }
    function update_user_permission (Request $request){
        $user = User::find($request->user_id);
        $permission = $request->permission;
        $user->syncPermissions($permission);
        return back();
    }
}
