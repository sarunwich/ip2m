<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $groups=[
            ['group_name'=>'เกษตรและอุตสาหกรรมอาหาร(AGRO)','image'=>'3.png','order'=>3],
            ['group_name'=>'เสินค้าอุปโภคบริโภค(CONSUMP)','image'=>'1.png','order'=>1],
            ['group_name'=>'ธุรกิจการเงิน(FINCIAL)','image'=>'5.png','order'=>5],
            ['group_name'=>'สินค้าอุตสาหกรรม(INDUS)','image'=>'7.png','order'=>7],
            ['group_name'=>'อสังหาริมทรัพย์และก่อสร้าง(PROPCON)','image'=>'2.png','order'=>2],
            ['group_name'=>'เทรัพยากร(RESOURC)','image'=>'8.png','order'=>8],
            ['group_name'=>'บริการ(SERVICE )','image'=>'6.png','order'=>6],
            ['group_name'=>'เทคโนโลยี(TECH)','image'=>'4.png','order'=>4],
        ];
        foreach ($groups as $key => $group) {
            Group::create($group);
        }
    }
}
