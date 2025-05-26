<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tin;
use App\Models\loaitin;
use Carbon\Carbon;

class HomeController extends Controller
{
    function home(){
        $listtin = Tin::join('loaitin','tin.idLT','=','loaitin.idLT')->select('tin.*','loaitin.TenLoai','loaitin.slug as slugLT')->where('status','=',1)->limit(5)->get();
        $listloai = loaitin::all();
        $tintuc = Tin::where('status','=',1)->latest()->limit(15)->get();
        $tin24h = Tin::where([['created_at', '>=', Carbon::now()->subDay()],['status','=',1]])->take(8)->get();
        $tinNB = Tin::where([['NoiBat','=',1],['status','=',1]])->orderBy('created_at','DESC')->limit(5)->get();
        $tinXN = Tin::where([['status','=',1]])->orderBy('Xem','DESC')->limit(15)->get();
        $thoiSu = Tin::where([['idLT','=',2],['status','=',1]])->latest()->limit(4)->get();
        $theGioi = Tin::where([['idLT','=',3],['status','=',1]])->latest()->limit(4)->get();
        return view('home',[
            'listtin'=>$listtin,
            'listloai'=>$listloai,
            'tintuc'=>$tintuc,
            'tinNB'=>$tinNB,
            'tin24h'=>$tin24h,
            'thoiSu'=>$thoiSu,
            'theGioi'=>$theGioi,
            'tinXN'=>$tinXN
        ]);
    }
}
