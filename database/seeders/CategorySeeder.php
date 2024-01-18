<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categorys=[
            ['category_name'=>'ธุรกิจการเกษตร(AGRI)','group_id'=>'1'],
            ['category_name'=>'อาหารและเครื่องดื่ม(FOOD)','group_id'=>'1'],
            ['category_name'=>'แฟชั่น(FASHION)','group_id'=>'2'],
            ['category_name'=>'ของใช้ในครัวเรือนและสำนักงาน(HOME)','group_id'=>'2'],
            ['category_name'=>'ของใช้ส่วนตัวและเวชภัณฑ์(PERSON)','group_id'=>'2'],
            ['category_name'=>'ธนาคาร(BANK)','group_id'=>'3'],
            ['category_name'=>'เงินทุนและหลักทรัพย์(FIN)','group_id'=>'3'],
            ['category_name'=>'ประกันภัยและประกันชีวิต(INSUR)','group_id'=>'3'],
            ['category_name'=>'ยานยนต์(AUTO)','group_id'=>'4'],
            ['category_name'=>'วัสดุอุตสาหกรรมและเครื่องจักร(IMM)','group_id'=>'4'],
            ['category_name'=>'กระดาษและวัสดุการพิมพ์(PAPER)','group_id'=>'4'],
            ['category_name'=>'ปิโตรเคมีและเคมีภัณฑ์(PETRO)','group_id'=>'4'],
            ['category_name'=>'บรรจุภัณฑ์(PKG)','group_id'=>'4'],
            ['category_name'=>'เหล็กและผลิตภัณฑ์โลหะ(STEEL)','group_id'=>'4'],
            ['category_name'=>'วัสดุก่อสร้าง(CONMAT)','group_id'=>'5'],
            ['category_name'=>'บริการรับเหมาก่อสร้าง(CONS)','group_id'=>'5'],
            ['category_name'=>'กองทุนรวมอสังหาริมทรัพย์และกองทรัสต์เพื่อการลงทุนในอสังหาริมทรัพย์(PF&REITs)','group_id'=>'5'],
            ['category_name'=>'พัฒนาอสังหาริมทรัพย์(PROP)','group_id'=>'5'],
            ['category_name'=>'พลังงานและสาธารณูปโภค(ENERG)','group_id'=>'6'],
            ['category_name'=>'เหมืองแร่(MINE)','group_id'=>'6'],
            ['category_name'=>'พาณิชย์(COMM)','group_id'=>'7'],
            ['category_name'=>'การแพทย์(HELTH)','group_id'=>'7'],
            ['category_name'=>'สื่อและสิ่งพิมพ์(MEDIA)','group_id'=>'7'],
            ['category_name'=>'บริการเฉพาะกิจ(PROF)','group_id'=>'7'],
            ['category_name'=>'การท่องเที่ยวและสันทนาการ(TOURISM)','group_id'=>'7'],
            ['category_name'=>'ขนส่งและโลจิสติกส์(TRANS)','group_id'=>'7'],
            ['category_name'=>'ชิ้นส่วนอิเล็กทรอนิกส์(ETRON)','group_id'=>'8'],
            ['category_name'=>'เทคโนโลยีสารสนเทศและการสื่อสาร(ICT)','group_id'=>'8'],

        ];
        foreach ($categorys as $key => $category) {
            Category::create($category);
        }

    }
}
