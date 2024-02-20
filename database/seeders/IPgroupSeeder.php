<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IPgroup;

class IPgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ipgroups = [
            ['iptype_id' => '1','ipdetail_id' => '1',],
            ['iptype_id' => '1','ipdetail_id' => '4',],
            ['iptype_id' => '1','ipdetail_id' => '8',],
            // ['iptype_id' => '1','ipdetail_id' => '9',],
            ['iptype_id' => '1','ipdetail_id' => '10',],
            ['iptype_id' => '1','ipdetail_id' => '11',],
            ['iptype_id' => '1','ipdetail_id' => '12',],
            // ['iptype_id' => '1','ipdetail_id' => '13',],
            ['iptype_id' => '2','ipdetail_id' => '1',],
            ['iptype_id' => '2','ipdetail_id' => '4',],
            ['iptype_id' => '2','ipdetail_id' => '8',],
            // ['iptype_id' => '2','ipdetail_id' => '9',],
            ['iptype_id' => '2','ipdetail_id' => '10',],
            ['iptype_id' => '2','ipdetail_id' => '11',],
            ['iptype_id' => '2','ipdetail_id' => '19',],
            // ['iptype_id' => '2','ipdetail_id' => '20',],

            // ['iptype_id' => '3','ipdetail_id' => '1',],
            // ['iptype_id' => '3','ipdetail_id' => '4',],
            // ['iptype_id' => '3','ipdetail_id' => '8',],
            // ['iptype_id' => '3','ipdetail_id' => '9',],
            ['iptype_id' => '3','ipdetail_id' => '11',],
            // ['iptype_id' => '3','ipdetail_id' => '14',],
            ['iptype_id' => '3','ipdetail_id' => '15',],
            // ['iptype_id' => '3','ipdetail_id' => '16',],
            // ['iptype_id' => '3','ipdetail_id' => '17',],
            ['iptype_id' => '4','ipdetail_id' => '1',],
            ['iptype_id' => '4','ipdetail_id' => '4',],
            ['iptype_id' => '4','ipdetail_id' => '8',],
            ['iptype_id' => '4','ipdetail_id' => '9',],
            ['iptype_id' => '4','ipdetail_id' => '12',],
            ['iptype_id' => '4','ipdetail_id' => '13',],
            ['iptype_id' => '4','ipdetail_id' => '17',],

            ['iptype_id' => '5','ipdetail_id' => '1',],
            ['iptype_id' => '5','ipdetail_id' => '2',],
            ['iptype_id' => '5','ipdetail_id' => '3',],
            ['iptype_id' => '5','ipdetail_id' => '4',],
            ['iptype_id' => '5','ipdetail_id' => '5',],
            ['iptype_id' => '5','ipdetail_id' => '6',],
            ['iptype_id' => '5','ipdetail_id' => '7',],

        ];
        foreach ($ipgroups as $key => $ipgroup) {
            IPgroup::create($ipgroup);
        }

    }
}
