<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\nhaBaoRequest;
use App\Models\baiviet;
use App\Models\loaitin;
use App\Models\Tin;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
class nhaBaoController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:delete tin',only:['destroy']),
            new Middleware('permission:update tin',only:['update','edit']),
            new Middleware('permission:create tin',only:['store','create']),
            new Middleware('permission:view tin',only:['index']),
        ];

    }
    public function index(){
        $tins = User::find(Auth::user()->id)->tins()->join('loaitin','tin.idLT','=','loaitin.idLT')->select('tin.*','loaitin.TenLoai')->orderBy('status','ASC')->orderBy('created_at','DESC')->get();
        return view('qly-bv',['tins'=>$tins,'listloai'=>loaitin::all()]);
    }
    public function create(){
        return view('journalist.form.them.thembaiviet',['listloai'=>loaitin::all()]);
    }
    public function store(nhaBaoRequest $request){
        $data = $request->validated();
        $data['status']=0;
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
        return redirect('journalist/bai-viet');
    }
    public function edit(Tin $bai_viet){
        return view('journalist.form.sua.suabaiviet',['listloai'=>loaitin::all(),'tin'=>$bai_viet]);
    }
    public function update(Tin $bai_viet,nhaBaoRequest $request){
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
        return redirect('journalist/bai-viet');
    }
    public function destroy(Tin $Tin){
        $Tin->delete();
        if(File::exists($Tin->thumbnail)){
            File::delete($Tin->thumbnail);
        }
        return redirect('journalist/bai-viet');
    }
}
