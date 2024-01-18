<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $statuss=[
            ['status_name'=>'รออนุมัติ'],
            ['status_name'=>'อนุมัติ'],
            ['status_name'=>'ไม่อนุมัติ'],
        ];
        foreach ($statuss as $key => $status) {
            Status::create($status);
        }
    }
}
