<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BaiVietRequest;
use App\Models\baiviet;
use App\Models\loaitin;
use App\Models\Tin;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
class BaivietController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:delete tin',only:['destroy']),
            new Middleware('permission:update tin',only:['update','edit']),
            new Middleware('permission:create tin',only:['store','create']),
            new Middleware('permission:view tin',only:['index']),
            new Middleware('permission:duyet tin',only:['duyet'])
        ];

    }
    public function index(){
        $tins = Tin::join('loaitin','tin.idLT','=','loaitin.idLT')->select('tin.*','loaitin.TenLoai')->orderBy('status','ASC')->orderBy('created_at','DESC')->get();
        return view('admin.baiviet',['tins'=>$tins,'listloai'=>loaitin::all()]);
    }
    public function create(){
        return view('admin.form.them.thembaiviet',['listloai'=>loaitin::all()]);
    }
    public function show(Tin $Tin){
        $Tin -> increment('Xem');
        return view('tin',['tin'=>$Tin,'listloai'=>loaitin::all()]);
    }
    public function store(BaiVietRequest $request){
        $data = $request->validated();
        $user = User::find(Auth::user()->id);
        if($user->hasRole(['super-admin','admin'])){
            $data['status']=1;
        }else {
            $data['status']=0;
        }
        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $filePath = 'uploads/bai-viet/';
            $file->move($filePath,$filename);
            $fileUrl = $filePath.$filename;
            $data['thumbnail'] = $fileUrl;
        }
        $data['NgayDang']=now();
        $data['user_id']=Auth::user()->id;
        Tin::create(
            $data,
        );
        return redirect('admin/bai-viet');
    }
    public function edit(Tin $bai_viet){
        return view('admin.form.sua.suabaiviet',['listloai'=>loaitin::all(),'tin'=>$bai_viet]);
    }
    public function update(Tin $bai_viet,BaiVietRequest $request){
        $data = $request->validated();
        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $filePath = 'uploads/bai-viet/';
            $file->move($filePath,$filename);
            $fileUrl = $filePath.$filename;
            $data['thumbnail'] = $fileUrl;
            if(File::exists($bai_viet->thumbnail)){
                File::delete($bai_viet->thumbnail);
            }
        }
        $bai_viet->update($data);
        return redirect('admin/bai-viet');
    }
    public function destroy(Tin $Tin){
        $Tin->delete();
        if(File::exists($Tin->thumbnail)){
            File::delete($Tin->thumbnail);
        }
        return redirect('admin/bai-viet');
    }
    public function duyet(Tin $Tin){
        $Tin->update(['status'=>1]);
        return back();
    }
}
