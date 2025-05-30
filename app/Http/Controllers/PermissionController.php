<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:delete permission',only:['destroy']),
            new Middleware('permission:update permission',only:['update','edit']),
            new Middleware('permission:create permission',only:['store','create']),
            new Middleware('permission:view permission',only:['index','show'])
        ];

    }
    public function index(){
        return view('role-permission.permission.index',['permissions'=>Permission::all()]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>['required','string','unique:permissions,name']
        ]);
        Permission::create(
            ['name' => $request->name]
        );
        return redirect('admin/permissions')->with('status','Permission Created Successfully!');
    }
    public function create(){
        return view('role-permission.permission.create');
    }
    public function edit(Permission $permission){
        return view('role-permission.permission.edit',['permission'=>$permission]);
    }
    public function update(Request $request, Permission $permission){
        $request->validate([
            'name'=>['required','string','unique:permissions,name,'.$permission->id]
        ]);
        $permission->update(
            ['name' => $request->name]
        );
        return redirect('admin/permissions')->with('status','Permission Updated Successfully!');
    
    }
    public function destroy(Permission $permission){
        $permission->delete();
        return redirect('admin/permissions')->with('status','Permission Deleted Successfully!');
    }
}
