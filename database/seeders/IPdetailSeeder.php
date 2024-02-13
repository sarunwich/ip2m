<?php

namespace Database\Seeders;

use App\Models\IPdetail;
use Illuminate\Database\Seeder;

class IPdetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ipdetails = [
            [
                'ipdetail_name' => 'เลขที่คำขอ',
                'type'=>'text'
                
            ],
            [
                'ipdetail_name' => 'ชื่อเจ้าของ',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'เลขทะเบียน',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'วันที่ยื่นคำขอ',
                'type'=>'date'
            ],
            [
                'ipdetail_name' => 'ประเภทงาน',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'ชื่อผลงาน',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'ที่อยู่ผู้ติดต่อ',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'ชื่อผู้ขอ',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'วันสิ้นอายุ',
                'type'=>'date'
            ],
            [
                'ipdetail_name' => 'ชื่อการประดิษฐ์',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'ที่อยู่ผู้ขอ',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'เลขที่สิทธิบัตร',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'วันที่ออกสิทธิบัตร',
                'type'=>'date'
            ],
            [
                'ipdetail_name' => 'ชื่อเครื่องหมาย',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'เจ้าของเครื่องหมาย',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'ที่อยู่เจ้าของเครื่องหมาย',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'ชื่อการประดิษฐ์การออกแบบผลิตภัณฑ์',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'ทะเบียนเลขที่',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'เลขที่อนุสิทธิบัตร',
                'type'=>'text'
            ],
            [
                'ipdetail_name' => 'วันที่ออกอนุสิทธิบัตร',
                'type'=>'date'
            ],

        ];
        foreach ($ipdetails as $key => $ipdetail) {
            IPdetail::create($ipdetail);
        }
    }
}
