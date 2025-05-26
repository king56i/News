<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\loaitin;
use App\Models\Tin;
use App\Models\binhluan as bl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Binhluan extends Controller
{
    public function index($id){
        try {
            $tin = Tin::with('binhluans.nguoibinhluan')->findOrFail($id);
            
            return response()->json([
                'comments' => $tin->binhluans,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không tìm thấy dữ liệu'], 404);
        }
    }
    public function store(Request $request){
        
    try{
        $validated = $request->validate([
            'comment' => 'required|string|max:500', 
        ]);
        bl::create([
            'NoiDung'=>$request->comment,
            'Tinid'=>$request->Tinid,
            'Uid'=>Auth::user()->id
        ]);
        return response()->json(['success' => true, 'message' => 'Comment added successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Server error, please try again later.'], 500);
    }
    }
    public function destroy($id)
{
    try {
        // Tìm bình luận bằng ID
        $comment = bl::findOrFail($id);
        
        // Kiểm tra quyền của người dùng nếu cần
        // Ví dụ, chỉ cho phép người tạo bình luận hoặc quản trị viên xóa bình luận
        if ($comment->Uid != Auth::user()->id && !User::findOrFail(Auth::user()->id)->hasRole('admin') && !User::findOrFail(Auth::user()->id)->hasRole('super-admin')) {
            return response()->json(['error' => 'Bạn không có quyền xóa bình luận này.'], 403);
        }

        // Xóa bình luận
        $comment->delete();

        return response()->json(['success' => true, 'message' => 'Bình luận đã được xóa'], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Không thể xóa bình luận'], 500);
    }
}
}