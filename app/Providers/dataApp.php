<?php

namespace App\Providers;

use App\Models\loaitin;
use App\Models\Tin;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class dataApp extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*',function($view){
            $view->with('tintuc',Tin::where('status','=',1)->latest()->get())->with('listloai',loaitin::all());
        });
    }
}
