<?php

namespace Database\Seeders;

use App\Models\loaitin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class themMoTaChoLoaiTin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loaitin = [
            ['idLT'=>1,'MoTa'=>'Tin tức về chính trị'],
            ['idLT'=>2,'MoTa'=>'Tin tức về thời sự'],
            ['idLT'=>3,'MoTa'=>'Tin tức về thế giới'],
            ['idLT'=>4,'MoTa'=>'Tin tức về kinh tế'],
            ['idLT'=>5,'MoTa'=>'Tin tức về du lịch'],
            ['idLT'=>6,'MoTa'=>'Tin tức về văn hóa'],
            ['idLT'=>7,'MoTa'=>'Tin tức về giải trí'],
            ['idLT'=>8,'MoTa'=>'Tin tức về thể thao'],
            ['idLT'=>9,'MoTa'=>'Tin tức về sức khỏe']
        ];
        foreach($loaitin as $loai){
            loaitin::updateOrCreate(
                ['idLT'=>$loai['idLT']],
                [
                    'MoTa'=>$loai['MoTa'],
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]
                );
        }
        
    }
}
