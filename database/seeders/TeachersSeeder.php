<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $picture = ['sakchan.jpg', 'tonglun.jpg', 'wiphasith.jpg', 'thongmee.jpg', 'anyawee.jpg', 'wathakan.jpg', 'atipat.jpg', 'jeeranun.jpg', 'boonlueo.jpg', 'nipon.jpg', 'narasuk.jpg', 'attapol.jpg', 'anutchai.jpg'];
        foreach ($picture as $value) {
            $source_path = public_path('Asset/main/img/teacher/' . $value);
            $destination_path = 'teacher_image/' . $value;
            if (File::exists($source_path)) {
                Storage::disk('public')->put($destination_path, File::get($source_path));
                $path_member_img[] = $destination_path;
            } else {
                echo "File not found: $source_path";
            }
        }

        $signature = ['sakchan.png', 'tonglun.png', 'wiphasith.png', 'thongmee.png', 'anyawee.png', 'wathakan.png', 'atipat.png', 'jeeranun.png', 'boonlueo.png', 'nipon.png', 'narasuk.png', 'attapol.png', 'anutchai.png'];
        foreach ($signature as $value) {
            $source_path = public_path('Asset/main/img/signature/' . $value);
            $destination_path = 'signature_image/' . $value;
            if (File::exists($source_path)) {
                Storage::disk('public')->put($destination_path, File::get($source_path));
                $signature_img[] = $destination_path;
            } else {
                echo "File not found: $source_path";
            }
        }

        DB::table('teachers')->insert([
            'prefix' => 'ผู้ช่วยศาสตราจารย์ ดร.',
            'name' => 'ศักดิ์ชาญ',
            'surname' => 'เหลืองมณีโรจน์',
            'academic_position' => 'ผู้ช่วยศาสตราจารย์',
            'educational_qualification' => 'PhD Computer Science, University of Southampton, The United Kingdom, วศ.ม วิศวกรรมไฟฟ้า สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง, วศ.บ วิศวกรรมไฟฟ้าคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีมหานคร',
            'branch' => 'PhD Computer Science, วศ.ม วิศวกรรมไฟฟ้า, วศ.บ วิศวกรรมไฟฟ้าคอมพิวเตอร์',
            'user_type' => 'Branch head',
            'email' => 'tsakchan@hotmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[0] ?? null,
            'signature_image' => $signature_img[0] ?? null,
            'username' => 'sakchan',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์สิบเอก',
            'name' => 'ทองล้วน',
            'surname' => 'สิงห์นันท์',
            'academic_position' => 'อาจารย์',
            'educational_qualification' => 'ค.อ.ม เทคโนโลยีคอมพิวเตอร์ สถาบันเทคโนโลยีพระจอมเกล้าพระนครเหนือ, ค.อ.บ วิศวกรรมคอมพิวเตอร์ สถาบันเทคโนโลยีราชมงคลล้านนา วิทยาเขตภาคพายัพ',
            'branch' => 'ค.อ.ม เทคโนโลยีคอมพิวเตอร์, ค.อ.บ วิศวกรรมคอมพิวเตอร์',
            'user_type' => 'Teacher',
            'email' => 'Singnant6@gmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[1] ?? null,
            'signature_image' => $signature_img[1] ?? null,
            'username' => 'tongluan',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์ ดร.',
            'name' => 'วิภาสิทธ์',
            'surname' => 'หิรัญรัตน์',
            'academic_position' => 'อาจารย์',
            'educational_qualification' => 'วส.ด. เทคโนโลยีสารสนเทศ มหาวิทยาลัยเทคโนโลยีสุรนารี, ค.อ.ม เทคโนโลยีคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ, วท.บ. วิทยาการคอมพิวเตอร์ มหาวิทยาลัยมหาสารคาม',
            'branch' => 'วส.ด. เทคโนโลยีสารสนเทศ, ค.อ.ม เทคโนโลยีคอมพิวเตอร์, วท.บ. วิทยาการคอมพิวเตอร์',
            'user_type' => 'Teacher',
            'email' => 'Wiphasith@hotmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[2] ?? null,
            'signature_image' => $signature_img[2] ?? null,
            'username' => 'wiphasith',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'ผู้ช่วยศาสตราจารย์ ดร.',
            'name' => 'ทองมี',
            'surname' => 'ละครพล',
            'academic_position' => 'ผู้ช่วยศาสตราจารย์',
            'educational_qualification' => 'ปร.ด เทคโนโลยีและการสื่อสารการศึกษา มหาวิทยาลัยมหาสารคาม, กศ.ม เทคโนโลยีและการสื่อสารการศึกษา มหาวิทยาลัยมหาสารคาม, วท.บ สถิติประยุกต์ มหาวิทยาลัยราชภัฎมหาสารคาม',
            'branch' => 'ปร.ด เทคโนโลยีและการสื่อสารการศึกษา, กศ.ม เทคโนโลยีและการสื่อสารการศึกษา, วท.บ สถิติประยุกต์',
            'user_type' => 'Teacher',
            'email' => 'tomranbo@hotmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[3] ?? null,
            'signature_image' => $signature_img[3] ?? null,
            'username' => 'tongme',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์ ดร.',
            'name' => 'อัญวีณ์',
            'surname' => 'ไชยวชิระกัมพล',
            'academic_position' => 'อาจารย์',
            'educational_qualification' => 'ปร.ด วิศวกรรมไฟฟ้าและคอมพิวเตอร์ มหาวิทยาลัยมหาสารคาม, วท.ม วิทยาการคอมพิวเตอร์ มหาวิทยาลัยขอนแก่น, วท.บ วิทยาการคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีราชมงคลตะวันออก วิทยาเขตบางพระ',
            'branch' => 'ปร.ด วิศวกรรมไฟฟ้าและคอมพิวเตอร์, วท.ม วิทยาการคอมพิวเตอร์, วท.บ วิทยาการคอมพิวเตอร์',
            'user_type' => 'Teacher',
            'email' => 'anyawee_chai@hotmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[4] ?? null,
            'signature_image' => $signature_img[4] ?? null,
            'username' => 'anyawee',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์',
            'name' => 'วาทการ',
            'surname' => 'มูลไชยสุข',
            'academic_position' => 'อาจารย์',
            'educational_qualification' => 'กำลังศึกษา PhD( Asian Institute of Technology), วศ.ม การวัดคุม สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง, วศ.บ วิศวกรรมไฟฟ้า วิศวกรรมไฟฟ้า มหาวิทยาลัยภาคตะวันออกเฉียงเหนือ',
            'branch' => 'วศ.ม การวัดคุม, วศ.บ วิศวกรรมไฟฟ้า',
            'user_type' => 'Teacher',
            'email' => null,
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[5] ?? null,
            'signature_image' => $signature_img[5] ?? null,
            'username' => 'wathakan',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์ ดร.',
            'name' => 'อธิปัตย์',
            'surname' => 'ฤทธิรณ',
            'academic_position' => 'อาจารย์',
            'educational_qualification' => 'ค.อ.ม. เทคโนโลยีคอมพิวเตอร์ สถาบันเทคโนโลยีพระจอมเกล้าพระนครเหนือ, ค.บ. คอมพิวเตอร์ศึกษา สถาบันราชภัชบุรีรัมย์',
            'branch' => 'ค.อ.ม. เทคโนโลยีคอมพิวเตอร์, ค.บ. คอมพิวเตอร์ศึกษา',
            'user_type' => 'Teacher',
            'email' => 'atp_rmuti@hotmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[6] ?? null,
            'signature_image' => $signature_img[6] ?? null,
            'username' => 'atipat',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์',
            'name' => 'จีรนันท์',
            'surname' => 'ตะสันเทียะ',
            'academic_position' => 'อาจารย์',
            'educational_qualification' => 'ค.อ.ม เทคโนโลยีคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ, วท.บ วิทยาการคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีราชมงคลธัญบุรี',
            'branch' => 'ค.อ.ม เทคโนโลยีคอมพิวเตอร์, วท.บ วิทยาการคอมพิวเตอร์',
            'user_type' => 'Admin',
            'email' => 'jeeranunt.ta@gmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[7] ?? null,
            'signature_image' => $signature_img[7] ?? null,
            'username' => 'jeeranun',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์',
            'name' => 'บุญเหลือ',
            'surname' => 'นาบำรุง',
            'academic_position' => 'อาจารย์',
            'educational_qualification' => 'วศ.ม วิศวกรรมไฟฟ้า-คอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีมหานคร, ค.อ.บ วิศวกรรมคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์',
            'branch' => 'วศ.ม วิศวกรรมไฟฟ้า-คอมพิวเตอร์, ค.อ.บ วิศวกรรมคอมพิวเตอร์',
            'user_type' => 'Teacher',
            'email' => 'boonlueo_elec1@hotmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[8] ?? null,
            'signature_image' => $signature_img[8] ?? null,
            'username' => 'boonlueo',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์',
            'name' => 'นิพนธ์',
            'surname' => 'พิมพ์เบ้าธรรม',
            'academic_position' => 'อาจารย์',
            'educational_qualification' => 'ค.อ.ม เทคโนโลยีคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ, ค.อ.บ วิศวกรรมคอมพิวเตอร์ มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน วิทยาเขตสุรินทร์',
            'branch' => 'ค.อ.ม เทคโนโลยีคอมพิวเตอร์, ค.อ.บ วิศวกรรมคอมพิวเตอร์',
            'user_type' => 'Teacher',
            'email' => 'Nipon.pi@rmuti.ac.th',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[9] ?? null,
            'signature_image' => $signature_img[9] ?? null,
            'username' => 'nipon',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'ผู้ช่วยศาสตราจารย์',
            'name' => 'นราศักดิ์',
            'surname' => 'วงษ์วาสน์',
            'academic_position' => 'ผู้ช่วยศาสตราจารย์',
            'educational_qualification' => 'วศ.ม วิศวกรรมไฟฟ้า (ระบบสมองกลฝังตัว) มหาวิทยาลัยเทคโนโลยีมหานคร, วศ.บ วิศวกรรมไฟฟ้า (วิศวกรรมอิเล็กทรอนิกส์ ) มหาวิทยาลัยเทคโนโลยีมหานคร',
            'branch' => 'วศ.ม วิศวกรรมไฟฟ้า (ระบบสมองกลฝังตัว), วศ.บ วิศวกรรมไฟฟ้า (วิศวกรรมอิเล็กทรอนิกส์ )',
            'user_type' => 'Teacher',
            'email' => 'narasuk2525@gmail.com',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[10] ?? null,
            'signature_image' => $signature_img[10] ?? null,
            'username' => 'narasuk',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'ผู้ช่วยศาสตราจารย์',
            'name' => 'อัตพล',
            'surname' => 'คุณเลิศ',
            'academic_position' => 'ผู้ช่วยศาสตราจารย์',
            'educational_qualification' => 'วท.ม เทคโนโลยีสารสนเทศ มหาวิทยาลัยขอนแก่น, วท.บ เทคโนโลยีสารสนเทศ มหาวิทยาลัยอุบลราชธานี',
            'branch' => 'วท.ม เทคโนโลยีสารสนเทศ, วท.บ เทคโนโลยีสารสนเทศ',
            'user_type' => 'Teacher',
            'email' => 'Attapol.ku@rmuti.ac.th',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[11] ?? null,
            'signature_image' => $signature_img[11] ?? null,
            'username' => 'attapol',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('teachers')->insert([
            'prefix' => 'อาจารย์ ดร.',
            'name' => 'อนัตต์ชัย',
            'surname' => 'ชุติภาสเจริญ',
            'academic_position' => 'ผู้ช่วยศาสตราจารย์',
            'educational_qualification' => 'ปร.ด. (คอมพิวเตอร์ศึกษา) มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ, ค.อ.ม. (เทคโนโลยีคอมพิวเตอร์) มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ, ค.อ.บ. (เทคโนโลยีคอมพิวเตอร์) มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ',
            'branch' => 'ปร.ด. (คอมพิวเตอร์ศึกษา), ค.อ.ม. (เทคโนโลยีคอมพิวเตอร์), ค.อ.บ. (เทคโนโลยีคอมพิวเตอร์)',
            'user_type' => 'Teacher',
            'email' => 'anuschai.ch@rmuti.ac.th',
            'email_verified_at' => now(),
            'tel' => null,
            'id_line' => null,
            'teacher_image' => $path_member_img[12] ?? null,
            'signature_image' => $signature_img[12] ?? null,
            'username' => 'anutchai',
            'password' => Hash::make('password'),
            'account_status' => true,
            'created_by' => null,
            'updated_by' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}