<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BangladeshLocationSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $data = [

                [
                    'code' => 'DHA',
                    'bn' => 'ঢাকা',
                    'en' => 'Dhaka',
                    'districts' => [
                        ['DHK', 'ঢাকা', 'Dhaka'],
                        ['FAR', 'ফরিদপুর', 'Faridpur'],
                        ['GAZ', 'গাজীপুর', 'Gazipur'],
                        ['GOP', 'গোপালগঞ্জ', 'Gopalganj'],
                        ['KIS', 'কিশোরগঞ্জ', 'Kishoreganj'],
                        ['MAD', 'মাদারীপুর', 'Madaripur'],
                        ['MAN', 'মানিকগঞ্জ', 'Manikganj'],
                        ['MUN', 'মুন্সীগঞ্জ', 'Munshiganj'],
                        ['NAR', 'নারায়ণগঞ্জ', 'Narayanganj'],
                        ['NRS', 'নরসিংদী', 'Narsingdi'],
                        ['RAJ', 'রাজবাড়ী', 'Rajbari'],
                        ['SHA', 'শরীয়তপুর', 'Shariatpur'],
                        ['TAN', 'টাঙ্গাইল', 'Tangail'],
                    ],
                ],

                [
                    'code' => 'CTG',
                    'bn' => 'চট্টগ্রাম',
                    'en' => 'Chattogram',
                    'districts' => [
                        ['BAN', 'বান্দরবান', 'Bandarban'],
                        ['BRA', 'ব্রাহ্মণবাড়িয়া', 'Brahmanbaria'],
                        ['CHA', 'চাঁদপুর', 'Chandpur'],
                        ['CTG', 'চট্টগ্রাম', 'Chattogram'],
                        ['CUM', 'কুমিল্লা', 'Cumilla'],
                        ['COX', 'কক্সবাজার', "Cox's Bazar"],
                        ['FEN', 'ফেনী', 'Feni'],
                        ['KHA', 'খাগড়াছড়ি', 'Khagrachhari'],
                        ['LAK', 'লক্ষ্মীপুর', 'Lakshmipur'],
                        ['NOA', 'নোয়াখালী', 'Noakhali'],
                        ['RAN', 'রাঙ্গামাটি', 'Rangamati'],
                    ],
                ],

                [
                    'code' => 'KHU',
                    'bn' => 'খুলনা',
                    'en' => 'Khulna',
                    'districts' => [
                        ['BAG', 'বাগেরহাট', 'Bagerhat'],
                        ['CHU', 'চুয়াডাঙ্গা', 'Chuadanga'],
                        ['JAS', 'যশোর', 'Jashore'],
                        ['JHE', 'ঝিনাইদহ', 'Jhenaidah'],
                        ['KHU', 'খুলনা', 'Khulna'],
                        ['KUS', 'কুষ্টিয়া', 'Kushtia'],
                        ['MAG', 'মাগুরা', 'Magura'],
                        ['MEH', 'মেহেরপুর', 'Meherpur'],
                        ['NRL', 'নড়াইল', 'Narail'],
                        ['SAT', 'সাতক্ষীরা', 'Satkhira'],
                    ],
                ],

                [
                    'code' => 'RAJ',
                    'bn' => 'রাজশাহী',
                    'en' => 'Rajshahi',
                    'districts' => [
                        ['BOG', 'বগুড়া', 'Bogura'],
                        ['CHA', 'চাঁপাইনবাবগঞ্জ', 'Chapainawabganj'],
                        ['JOY', 'জয়পুরহাট', 'Joypurhat'],
                        ['NAO', 'নওগাঁ', 'Naogaon'],
                        ['NAT', 'নাটোর', 'Natore'],
                        ['PAB', 'পাবনা', 'Pabna'],
                        ['RAJ', 'রাজশাহী', 'Rajshahi'],
                        ['SIR', 'সিরাজগঞ্জ', 'Sirajganj'],
                    ],
                ],

                [
                    'code' => 'BAR',
                    'bn' => 'বরিশাল',
                    'en' => 'Barishal',
                    'districts' => [
                        ['BAR', 'বরিশাল', 'Barishal'],
                        ['BRG', 'বরগুনা', 'Barguna'],
                        ['BHO', 'ভোলা', 'Bhola'],
                        ['JHA', 'ঝালকাঠি', 'Jhalokathi'],
                        ['PAT', 'পটুয়াখালী', 'Patuakhali'],
                        ['PIR', 'পিরোজপুর', 'Pirojpur'],
                    ],
                ],

                [
                    'code' => 'SYL',
                    'bn' => 'সিলেট',
                    'en' => 'Sylhet',
                    'districts' => [
                        ['HAB', 'হবিগঞ্জ', 'Habiganj'],
                        ['MOU', 'মৌলভীবাজার', 'Moulvibazar'],
                        ['SUN', 'সুনামগঞ্জ', 'Sunamganj'],
                        ['SYL', 'সিলেট', 'Sylhet'],
                    ],
                ],

                [
                    'code' => 'RNG',
                    'bn' => 'রংপুর',
                    'en' => 'Rangpur',
                    'districts' => [
                        ['DIN', 'দিনাজপুর', 'Dinajpur'],
                        ['GAI', 'গাইবান্ধা', 'Gaibandha'],
                        ['KUR', 'কুড়িগ্রাম', 'Kurigram'],
                        ['LAL', 'লালমনিরহাট', 'Lalmonirhat'],
                        ['NIL', 'নীলফামারী', 'Nilphamari'],
                        ['PAN', 'পঞ্চগড়', 'Panchagarh'],
                        ['RNG', 'রংপুর', 'Rangpur'],
                        ['THA', 'ঠাকুরগাঁও', 'Thakurgaon'],
                    ],
                ],

                [
                    'code' => 'MYM',
                    'bn' => 'ময়মনসিংহ',
                    'en' => 'Mymensingh',
                    'districts' => [
                        ['JAM', 'জামালপুর', 'Jamalpur'],
                        ['MYM', 'ময়মনসিংহ', 'Mymensingh'],
                        ['NET', 'নেত্রকোণা', 'Netrokona'],
                        ['SHE', 'শেরপুর', 'Sherpur'],
                    ],
                ],
            ];

            foreach ($data as $divisionData) {

                $division = Division::updateOrCreate(
                    ['code' => $divisionData['code']],
                    [
                        'name_bn' => $divisionData['bn'],
                        'name_en' => $divisionData['en'],
                        'is_active' => true,
                    ]
                );

                foreach ($divisionData['districts'] as $district) {

                    District::updateOrCreate(
                        [
                            'division_id' => $division->id,
                            'name_en' => $district[2],
                        ],
                        [
                            'code' => $divisionData['code'].'-'.$district[0],
                            'name_bn' => $district[1],
                            'name_en' => $district[2],
                            'is_active' => true,
                        ]
                    );
                }
            }
        });
    }
}