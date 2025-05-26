<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\loaitin;

class QuangcaoController extends Controller
{
    public function index(){
        return view('admin.quangcao',['listloai'=>loaitin::all()]);
    }
}
