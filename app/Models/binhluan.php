<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class binhluan extends Model
{
    protected $table='binhluan';
    protected $fillable = ['NoiDung','Uid','Tinid'];
    public function nguoibinhluan(){
        return $this->belongsTo(User::class,'Uid');
    }
    public function tintuc(){
        return $this->belongsTo(Tin::class,'Tinid');
    }
}
