<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class loaitin extends Model
{
    use HasFactory;
    protected $table = 'loaitin';
    protected $primaryKey = 'idLT';
    protected $fillable = [
        'idLT',
        'TenLoai',
        'AnHien',
        'slug',
        'MoTa',
    ];
    public function tins(){
        return $this->hasMany(Tin::class,'idLT');
    }
}
