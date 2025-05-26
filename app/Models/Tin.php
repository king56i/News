<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
class Tin extends Model
{
    protected $table = 'tin';
    protected $fillable = [
        'TieuDe',
        'thumbnail',
        'TomTat',
        'NoiDung',
        'NoiBat',
        'idLT',
        'updated_at',
        'created_at',
        'NgayDang',
        'user_id',
        'status'
    ];
    public function loaitin(){
        return $this->belongsTo(loaitin::class,'idLT');
    }
    public function binhluans(){
        return $this->hasMany(binhluan::class,'Tinid');
    }
    public function nguoidang(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function scopeTitle(Builder $query,string $title):Builder{
        return $query->where('TieuDe','LIKE','%'.$title.'%');
    }
}
