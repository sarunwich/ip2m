<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IPtype;

class IPtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $iptypes=[
            [
                'iptype_name'=>'สิทธิบัตร',
            ],
            [
                'iptype_name'=>'อนุสิทธิบัตร',
            ],
            [
                'iptype_name'=>'เครื่องหมายการค้า',
            ],
            [
                'iptype_name'=>'สิทธิบัตรการออกแบบผลิตภัณฑ์',
            ],
            [
                'iptype_name'=>'ลิขสิทธิ์',
            ],
            [
                'iptype_name'=>'นวัตกรรมอื่น ๆ',
            ],

        ];
        foreach ($iptypes as $key => $iptype) {
            IPtype::create($iptype);
        }
    }
}
