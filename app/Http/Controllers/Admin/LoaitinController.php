<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoaiTinRequest;
use Illuminate\Http\Request;
use App\Models\loaitin;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
class LoaitinController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:delete loai',only:['destroy']),
            new Middleware('permission:update loai',only:['update','edit']),
            new Middleware('permission:create loai',only:['store','create']),
            new Middleware('permission:view loai',only:['index','show']),
        ];

    }
    public function index(){
        return view('admin.loaitin',['listloai'=>loaitin::all()]);
    }
    public function create(){
        return view('admin.form.them.themloai',['listloai'=>loaitin::all()]);
    }
    public function store(LoaiTinRequest $request){
        $data = $request->validated();
        $data["slug"] = Str::slug($request->TenLoai);
        loaitin::create(
            $data
        );
        return redirect('admin/loai');
    }
    public function edit(loaitin $loai){
        return view('admin.form.sua.sualoai',['loaitin'=>$loai]);
    }
    public function update(loaitin $loai, LoaiTinRequest $request){
        $data = $request->validated();
        $data["slug"] = Str::slug($request->TenLoai);
        $loai->update(
            $data
        );
        return redirect('admin/loai');
    }
    public function destroy(loaitin $loaitin){
        $loaitin->delete();
        return redirect('admin/loai');
    }
}