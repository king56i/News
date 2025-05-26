<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:delete role',only:['destroy']),
            new Middleware('permission:update role',only:['update','edit','addPermissionToRole','givePermissionToRole']),
            new Middleware('permission:create role',only:['store','create']),
            new Middleware('permission:view role',only:['index','show'])
        ];
    }
    public function index(){
        return view('role-permission.role.index',['roles'=>Role::all()]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>['required','string','unique:roles,name']
        ]);
        Role::create(
            ['name' => $request->name]
        );
        return redirect('admin/roles')->with('status','Role Created Successfully!');
    }
    public function create(){
        return view('role-permission.role.create');
    }
    public function edit(Role $role){
        return view('role-permission.role.edit',['role'=>$role]);
    }
    public function update(Request $request, Role $role){
        $request->validate([
            'name'=>['required','string','unique:roles,name,'.$role->id]
        ]);
        $role->update(
            ['name' => $request->name]
        );
        return redirect('admin/roles')->with('status','Role Updated Successfully!');
    
    }
    public function destroy(Role $role){
        $role->delete();
        return redirect('admin/roles')->with('status','Role Deleted Successfully!');
    }
    public function addPermissionToRole(Role $role){
        $permissions = Permission::get(); 
        $rolePermissions = DB::table('role_has_permissions')
                            ->where('role_has_permissions.role_id',$role->id)
                            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                            ->all();
        return view('role-permission.role.add-permissions',[
            'role'=>$role,
            'permissions'=>$permissions,
            'rolePermissions'=>$rolePermissions
        ]);
    }
    public function givePermissionToRole(Request $request,Role $role){
        $request->validate([
            'permission'=>'required'
        ]);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status','Permissions added to role');
    }
}
