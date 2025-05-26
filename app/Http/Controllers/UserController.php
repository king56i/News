<?php

namespace App\Http\Controllers;
use App\Models\loaitin;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:delete user',only:['destroy']),
            new Middleware('permission:update user',only:['update','edit']),
            new Middleware('permission:create user',only:['store','create']),
            new Middleware('permission:view user',only:['index','show'])
        ];

    }
    public function index(){
        $users = User::get();
        return view('role-permission.user.index',['users'=>$users]);
    }
    public function create(){
        return view('role-permission.user.create',['roles'=>Role::pluck('name','name')->all()]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|string|min:8|max:20',
            'roles'=>'required'
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);
        return redirect('admin/users')->with('status','User Created Successfully With Roles!');
    }
    public function edit(User $user){
        $userRoles = $user->roles()->pluck('name','name')->all();
        return view('role-permission.user.edit',['user'=>$user,'roles'=>Role::pluck('name','name')->all(),'userRoles'=>$userRoles]);
    }
    public function update(Request $request, User $user){
        $request->validate([
            'name'=>'required|string|max:255',
            'password'=>'nullable|string|min:8|max:20',
            'roles'=>'required'
        ]);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
        ];
        if(!empty($request->password)){
            $data += [
            'password'=>Hash::make($request->password),
            ] ;
        }
        $user->update($data);
        $user->syncRoles($request->roles);
        return redirect('admin/users')->with('status','User Updated Successfully With Roles');
    }
    public function destroy(User $user){
        $user->delete();
        return redirect('admin/users')->with('status','User Deleted Successfully!');
    }
}
