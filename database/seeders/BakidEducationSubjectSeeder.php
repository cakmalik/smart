<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BakidEducationSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $informal_subjects_mid = [
            ['code' => 'SN001', 'ar' => 'سفينة النجاة', 'indo' => 'Safinatun Najah'],
            ['code' => 'RH002', 'ar' => 'رابطة الحروف', 'indo' => 'Robithatul Huruf'],
            ['code' => 'HS003', 'ar' => 'هداية الصبيان', 'indo' => 'Hidayatus Shibyan'],
            ['code' => 'LA004', 'ar' => 'اللغة العربية', 'indo' => 'Lughatul Arabiyah'],
            ['code' => 'AA005', 'ar' => 'عقيدة العوام', 'indo' => 'Aqidatul Awam'],
            ['code' => 'AD006', 'ar' => 'الديانة', 'indo' => 'Ad Diyanah'],
            ['code' => 'IM007', 'ar' => 'الإملاء', 'indo' => 'Imla\''],
            ['code' => 'TA008', 'ar' => 'تحفة الأطفال', 'indo' => 'Tuhfatul Athfal'],
            ['code' => 'NS009', 'ar' => 'نظم سفينة', 'indo' => 'Nadzam Safinah'],
            ['code' => 'AT010', 'ar' => 'عقيدة التوحيد', 'indo' => 'Aqidatut Tauhid'],
            ['code' => 'KN011', 'ar' => 'خلاصة نور اليقين', 'indo' => 'Kholashatun Nurul Yaqin'],
            ['code' => 'IF012', 'ar' => 'علم الفقه', 'indo' => 'Ilmu Fiqih'],
            ['code' => 'QM013', 'ar' => 'قاعدة مختصر جدا', 'indo' => 'Qo\'idah Mukhtashar Jiddan'],
            ['code' => 'HM014', 'ar' => 'هداية المستفيد', 'indo' => 'Hidayatul Mustafid'],
            ['code' => 'KB015', 'ar' => 'الخريدة البهية', 'indo' => 'Kharidatul Bahiyah'],
            ['code' => 'TS016', 'ar' => 'التصريف', 'indo' => 'Tashrif'],
            ['code' => 'FQ017', 'ar' => 'فتح القريب', 'indo' => 'Fathul Qarib'],
            ['code' => 'QI018', 'ar' => 'قواعد الإعلال', 'indo' => 'Qawa\'idul I\'lal'],
            ['code' => 'NA019', 'ar' => 'نظم العوامل', 'indo' => 'Nadzam Awamil'],
            ['code' => 'JK020', 'ar' => 'الجواهر الكلامية', 'indo' => 'Jawahirul Kalamiyah'],
            ['code' => 'AN021', 'ar' => 'الأربعين النووية', 'indo' => 'Arba\'in Nawawi'],
            ['code' => 'AS022', 'ar' => 'علم الصرف', 'indo' => 'Ilmu Sharraf'],
            ['code' => 'NA023', 'ar' => 'تسهيل نيل الأماني', 'indo' => 'Tashil Nil Amani'],
            ['code' => 'DT024', 'ar' => 'دروس التاريخ', 'indo' => 'Durusut Tarikh'],
            ['code' => 'NI025', 'ar' => 'نظم العمرطي', 'indo' => 'Nadzm \'Imrithi'],
            ['code' => 'KA026', 'ar' => 'كفاية العوام', 'indo' => 'Kifayatul Awam'],
            ['code' => 'BM027', 'ar' => 'بلوغ المرام', 'indo' => 'Bulughul Maram'],
            ['code' => 'NM028', 'ar' => 'نظم المقصود', 'indo' => 'Nadzm Maqshud'],
            ['code' => 'IM029', 'ar' => 'إيضاح المبهم', 'indo' => 'Iidhahul Mubham'],
            ['code' => 'SW030', 'ar' => 'شرح الورقات', 'indo' => 'Syarh Waraqat'],
            ['code' => 'AI031', 'ar' => 'ألفية لإبن مالك', 'indo' => 'Alfiyah Ibn Malik'],
            ['code' => 'MM032', 'ar' => 'منحة المغيث', 'indo' => 'Minhatul Mughits'],
            ['code' => 'SH033', 'ar' => 'شرح الهدهدي', 'indo' => 'Syarh Hud Hudi'],
            ['code' => 'AF034', 'ar' => 'علم الفرائض', 'indo' => 'Ilmu Faraid'],
            ['code' => 'MF035', 'ar' => 'المبادئ الفقهية', 'indo' => 'Mabadiul Fiqh'],
            ['code' => 'MJ036', 'ar' => 'مختصر جدا', 'indo' => 'Mukhtashar Jiddan'],
            ['code' => 'RB037', 'ar' => 'الرياض البديعة', 'indo' => 'Riyadlul Badi\'ah'],
            ['code' => 'QG038', 'ar' => 'قطر الغيث', 'indo' => 'Qathrul Ghaits'],
            ['code' => 'AT039', 'ar' => 'الأمثلة التصريفية', 'indo' => 'Amtsilatut Tashrif'],
            ['code' => 'KI040', 'ar' => 'قاعدة الكيلاني عزي', 'indo' => 'Qo\'idah Kailani Izzi'],
            ['code' => 'QK041', 'ar' => 'قرأة الكتاب', 'indo' => 'Qiraatul Kitab'],
        ];

        $informal_subject_mtsd = [
            ['code' => 'TT001', 'ar' => 'تحفة الطلاب', 'indo' => 'Tuhfatut Thullab'],
            ['code' => 'IM002', 'ar' => 'الإملاء', 'indo' => 'Imla\''],
            ['code' => 'HL003', 'ar' => 'حلية اللب المصون', 'indo' => 'Hilyatul Lubbil Mashun'],
            ['code' => 'QA004', 'ar' => 'قرة العين', 'indo' => 'Qurratul \'Ain'],
            ['code' => 'AI005', 'ar' => 'ألفية لإبن مالك', 'indo' => 'Alfiyah Ibn Malik'],
            ['code' => 'TMH006', 'ar' => 'تيسير مصطلح الحديث', 'indo' => 'Taisir Musthalah Hadits'],
            ['code' => 'SUB007', 'ar' => 'شرح أم البراهين', 'indo' => 'Syarh Ummul Barahin'],
            ['code' => 'MR008', 'ar' => 'متن الرحبية', 'indo' => 'Matn Rahbiyah'],
            ['code' => 'BM009', 'ar' => 'بلوغ المرام', 'indo' => 'Bulughul Maram'],
            ['code' => 'TKR010', 'ar' => 'تاريخ الخلفاء الراشدين', 'indo' => 'Tarikh Khulafaur Rasyidin'],
            ['code' => 'IH011', 'ar' => 'علم الحساب', 'indo' => 'Ilmu Hisab'],
            ['code' => 'FB012', 'ar' => 'الفرائد البهية', 'indo' => 'Faraidul Bahiyah'],
            ['code' => 'TJ013', 'ar' => 'تفسير الجلالين', 'indo' => 'Tafsir Jalalain'],
            ['code' => 'QM014', 'ar' => 'القول المنير', 'indo' => 'Qaulul Munir'],
            ['code' => 'RA015', 'ar' => 'رسالة أهل السنة', 'indo' => 'Risalah Ahlus Sunnah'],
            ['code' => 'FQ016', 'ar' => 'فتح القريب', 'indo' => 'Fathul Qarib'],
            ['code' => 'MA017', 'ar' => 'متممة الأجرومية', 'indo' => 'Mutammimatul Ajrumiyah'],
            ['code' => 'MM018', 'ar' => 'منحة المغيث', 'indo' => 'Minhatul Mughits'],
            ['code' => 'TA019', 'ar' => 'التبيان في علوم القرآن', 'indo' => 'At Thibyan Fi Ulumil Qur\'an'],
            ['code' => 'NM020', 'ar' => 'نظم المقصود', 'indo' => 'Nadzm Maqshud'],
            ['code' => 'AF021', 'ar' => 'علم الفرائض', 'indo' => 'Ilmu Faraid'],
            ['code' => 'SM022', 'ar' => 'ستين مسئلة', 'indo' => 'Sittiina Mas\'alah'],
            ['code' => 'IM023', 'ar' => 'إيضاح المبهم', 'indo' => 'Iidhahul Mubham'],
            ['code' => 'QK024', 'ar' => 'قرأة الكتاب', 'indo' => 'Qiraatul Kitab'],
        ];

        foreach ($informal_subjects_mid as $subject) {
            \App\Models\Informal\InformalEducationSubject::create([
                'code' => $subject['code'],
                'name' => $subject['indo'],
                'name_ar' => $subject['ar'],
            ]);
        }

        foreach ($informal_subject_mtsd as $subject) {
            // check first
            $check = \App\Models\Informal\InformalEducationSubject::where('name', $subject['indo'])->first();
            if ($check) {
                continue;
            }

            \App\Models\Informal\InformalEducationSubject::create([
                'code' => $subject['code'],
                'name' => $subject['indo'],
                'name_ar' => $subject['ar'],
            ]);
        }
    }
}
