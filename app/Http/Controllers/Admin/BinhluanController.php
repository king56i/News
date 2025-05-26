<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\loaitin;
use App\Models\binhluan;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class BinhluanController extends Controller implements HasMiddleware
{
    public static function middleware():array{
        return [
            new Middleware('permission:delete binhluan',only:['destroy']),
            new Middleware('permission:view binhluan',only:['index'])
        ];

    }
    public function index(){
        $binhluan = binhluan::all();

        return view('admin.binhluan',['binhluan'=>$binhluan]);
    }
    public function destroy(binhluan $binhluan){
        $binhluan->delete();
        return redirect('admin/binhluan');
    }
}