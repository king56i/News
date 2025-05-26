<?php

use App\Http\Controllers\nhaBaoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NguoidungController;
use App\Http\Controllers\Admin\BaivietController;
use App\Http\Controllers\Admin\LoaitinController;
use App\Http\Controllers\Admin\BinhluanController;
use App\Http\Controllers\Admin\QuangcaoController;
use App\Models\binhluan as bl;
use App\Http\Controllers\binhluan;
use App\Models\loaitin;
use App\Models\Tin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['role:super-admin|admin','auth'],'prefix'=>'admin'],function(){
    Route::get('/',[AdminController::class,'index']);
    Route::resource('permissions',App\Http\Controllers\PermissionController::class);
    Route::delete('permissions/{permission}/delete',[App\Http\Controllers\PermissionController::class,'destroy']);
    Route::resource('roles',App\Http\Controllers\RoleController::class);
    Route::delete('roles/{role}/delete',[App\Http\Controllers\RoleController::class,'destroy'])
    ->middleware('permission:delete role');
    Route::get('roles/{role}/give-permissions',[App\Http\Controllers\RoleController::class,'addPermissionToRole']);
    Route::put('roles/{role}/give-permissions',[App\Http\Controllers\RoleController::class,'givePermissionToRole']);
    
    Route::resource('users',App\Http\Controllers\UserController::class);
    Route::delete('users/{user}/delete',[App\Http\Controllers\UserController::class,'destroy']);
    //Loai
    Route::resource('loai',LoaitinController::class);
    Route::delete('loai/{loaitin}/delete',[App\Http\Controllers\Admin\LoaiTinController::class,'destroy']);
    //Binh luan
    Route::resource('binhluan',BinhluanController::class);
    Route::delete('binhluan/{binhluan}/delete',[App\Http\Controllers\Admin\BinhluanController::class,'destroy']);
    //Bai Viet
    Route::resource('bai-viet',BaivietController::class);
    Route::delete('bai-viet/{Tin}/delete',[App\Http\Controllers\Admin\BaiVietController::class,'destroy']);
    Route::patch('bai-viet/{Tin}/duyet',[BaivietController::class,'duyet'])->name('baiviet.duyet');
});
Route::group(['middleware'=>['role:journalist','auth'],'prefix'=>'journalist'],function(){
    Route::resource('bai-viet',nhaBaoController::class);
    Route::delete('bai-viet/{Tin}/delete',[nhaBaoController::class,'destroy']);
});

Route::post('binhluan',[binhluan::class,'store']);
Route::get('binhluan/{id}',[binhluan::class,'index']);
Route::delete('/binhluan/{id}', [binhluan::class, 'destroy']);


Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/admin/qly-bl',[BinhluanController::class,'index'])->name('qly.bl');

Route::view('/tin-24h','tin-24h',['tin'=>Tin::where([['created_at', '>=', Carbon::now()->subDay()],['status','=',1]])->get()]);
Route::view('/tinmoi','tinmoi',['tinmoi'=>Tin::where('status','=',1)->latest()->get()])->name('tinmoi');

Route::view('/dang-nhap/form-dang-nhap','dangnhap',['listloai'=>loaitin::all()])->name('form-dn');
Route::view('/dang-ky/form-dang-ky','dangky',['listloai'=>loaitin::all()])->name('form-dk');
// Route::post('/dang-nhap',[UserController::class,'dn'])->name('user.dn');
// Route::post('/dang-ky',[UserController::class,'dk'])->name('user.dk');
Route::get('/loai/{loaitinSlug}',function(loaitin $loaitinSlug){
    $ttl = $loaitinSlug->tins()->get();
    return view('tintrongloai',['tintrongloai'=>$ttl,'listloai'=>loaitin::all()]);
})->name('loaitin.ref');
Route::get('tin/{Tin}',[BaivietController::class,'show'])->name('chitiettin');
Route::bind('loaitinSlug', function ($slug) {
    return loaitin::where('slug', $slug)->firstOrFail();
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
