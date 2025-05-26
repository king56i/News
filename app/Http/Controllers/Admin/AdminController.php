<?php

namespace App\Http\Controllers\Admin;
use App\Models\loaitin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
class AdminController extends Controller
{
    public function index(){
        return redirect('admin/bai-viet');
    }

}
