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
            ],
            [
                'ipdetail_name' => 'ชื่อเจ้าของ',
            ],
            [
                'ipdetail_name' => 'เลขทะเบียน',
            ],
            [
                'ipdetail_name' => 'วันที่ยื่นคำขอ',
            ],
            [
                'ipdetail_name' => 'ประเภทงาน',
            ],
            [
                'ipdetail_name' => 'ชื่อผลงาน',
            ],
            [
                'ipdetail_name' => 'ที่อยู่ผู้ติดต่อ',
            ],
            [
                'ipdetail_name' => 'ชื่อผู้ขอ',
            ],
            [
                'ipdetail_name' => 'วันสิ้นอายุ',
            ],
            [
                'ipdetail_name' => 'ชื่อการประดิษฐ์',
            ],
            [
                'ipdetail_name' => 'ที่อยู่ผู้ขอ',
            ],
            [
                'ipdetail_name' => 'เลขที่สิทธิบัตร',
            ],
            [
                'ipdetail_name' => 'วันที่ออกสิทธิบัตร',
            ],
            [
                'ipdetail_name' => 'ชื่อเครื่องหมาย',
            ],
            [
                'ipdetail_name' => 'เจ้าของเครื่องหมาย',
            ],
            [
                'ipdetail_name' => 'ที่อยู่เจ้าของเครื่องหมาย',
            ],
            [
                'ipdetail_name' => 'ชื่อการประดิษฐ์การออกแบบผลิตภัณฑ์',
            ],
            [
                'ipdetail_name' => 'ทะเบียนเลขที่',
            ],
            [
                'ipdetail_name' => 'เลขที่อนุสิทธิบัตร',
            ],
            [
                'ipdetail_name' => 'วันที่ออกอนุสิทธิบัตร',
            ],

        ];
        foreach ($ipdetails as $key => $ipdetail) {
            IPdetail::create($ipdetail);
        }
    }
}
