<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function login(Request $request):JsonResponse{
        $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required|string:8|max:255',
        ]);
        $user = User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            throw ValidationException::withMessages([
                'email'=>['Bạn đã nhập sai tài khoản hoặc mật khẩu']
            ]);
        }
        
        $token = $user->createToKen('api-token')->plainTextToken;
        return response()->json([
            'message'=>'Đăng nhập thành công!',
            'token_type'=>'Bearer',
            'token'=>$token
        ],200);
    }
    public function register(Request $request):JsonResponse{
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email|max:255',
            'password'=>'required|string:8|max:255',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        if($user){
            $token = $user->createToKen('api-token')->plainTextToken;
            return response()->json([
                'message'=>'Đăng ký thành công!',
                'token_type'=>'Bearer',
                'token'=>$token
            ],201);
        }else{
            return response()->json([
                'message'=>'Đăng ký không thành công thành công!',
            ],500);
        }
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=>'Logged out successfully'
        ]);
    }
}
