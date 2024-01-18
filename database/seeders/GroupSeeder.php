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
            ['group_name'=>'เกษตรและอุตสาหกรรมอาหาร(AGRO)'],
            ['group_name'=>'เสินค้าอุปโภคบริโภค(CONSUMP)'],
            ['group_name'=>'ธุรกิจการเงิน(FINCIAL)'],
            ['group_name'=>'สินค้าอุตสาหกรรม(INDUS)'],
            ['group_name'=>'อสังหาริมทรัพย์และก่อสร้าง(PROPCON)'],
            ['group_name'=>'เทรัพยากร(RESOURC)'],
            ['group_name'=>'บริการ(SERVICE )'],
            ['group_name'=>'เทคโนโลยี(TECH)'],
        ];
        foreach ($groups as $key => $group) {
            Group::create($group);
        }
    }
}
