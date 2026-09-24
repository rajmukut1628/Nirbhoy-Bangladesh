<?php

namespace App\Console\Commands;

use App\Models\Area;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SyncDhakaCityLocations extends Command
{
    protected $signature = 'nirbhoy:sync-dhaka-city';

    protected $description =
        'Sync Dhaka metropolitan thanas and common local areas without duplicates';

    public function handle(): int
    {
        $this->info('Starting Dhaka City location sync...');
        $this->newLine();

        /*
        |--------------------------------------------------------------------------
        | Find Dhaka District
        |--------------------------------------------------------------------------
        */

        $dhaka = District::query()
            ->where(function ($query) {
                $query->whereRaw(
                    'LOWER(TRIM(name_en)) = ?',
                    ['dhaka']
                )
                ->orWhere('name_bn', 'ঢাকা');
            })
            ->first();

        if (!$dhaka) {
            $this->error('Dhaka district was not found.');

            return self::FAILURE;
        }

        /*
        |--------------------------------------------------------------------------
        | Dhaka Metropolitan Thanas + Searchable Areas
        |--------------------------------------------------------------------------
        |
        | Areas are for public location/search convenience.
        | They are NOT being classified as police stations.
        |--------------------------------------------------------------------------
        */

        $locations = [

            [
                'name_en' => 'Adabor',
                'name_bn' => 'আদাবর',
                'areas' => [
                    ['Adabor', 'আদাবর'],
                    ['Shyamoli', 'শ্যামলী'],
                    ['Ring Road', 'রিং রোড'],
                ],
            ],

            [
                'name_en' => 'Badda',
                'name_bn' => 'বাড্ডা',
                'areas' => [
                    ['Badda', 'বাড্ডা'],
                    ['Middle Badda', 'মধ্য বাড্ডা'],
                    ['Merul Badda', 'মেরুল বাড্ডা'],
                    ['Uttar Badda', 'উত্তর বাড্ডা'],
                ],
            ],

            [
                'name_en' => 'Banani',
                'name_bn' => 'বনানী',
                'areas' => [
                    ['Banani', 'বনানী'],
                ],
            ],

            [
                'name_en' => 'Bangshal',
                'name_bn' => 'বংশাল',
                'areas' => [
                    ['Bangshal', 'বংশাল'],
                    ['English Road', 'ইংলিশ রোড'],
                ],
            ],

            [
                'name_en' => 'Bimanbandar',
                'name_bn' => 'বিমানবন্দর',
                'areas' => [
                    ['Airport', 'বিমানবন্দর'],
                    ['Hazrat Shahjalal International Airport', 'হযরত শাহজালাল আন্তর্জাতিক বিমানবন্দর'],
                ],
            ],

            [
                'name_en' => 'Bhashantek',
                'name_bn' => 'ভাসানটেক',
                'areas' => [
                    ['Bhashantek', 'ভাসানটেক'],
                ],
            ],

            [
                'name_en' => 'Cantonment',
                'name_bn' => 'ক্যান্টনমেন্ট',
                'areas' => [
                    ['Cantonment', 'ক্যান্টনমেন্ট'],
                    ['MES', 'এমইএস'],
                ],
            ],

            [
                'name_en' => 'Chawkbazar',
                'name_bn' => 'চকবাজার',
                'areas' => [
                    ['Chawkbazar', 'চকবাজার'],
                    ['Bakshi Bazar', 'বকশীবাজার'],
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | Dakshinkhan
            |--------------------------------------------------------------------------
            | Existing Dakshinkhan record will be reused.
            | Existing Ward 47-50 will NOT be deleted.
            |--------------------------------------------------------------------------
            */

            [
                'name_en' => 'Dakshinkhan',
                'name_bn' => 'দক্ষিণখান',
                'areas' => [
                    ['Dakshinkhan', 'দক্ষিণখান'],
                    ['Faidabad', 'ফায়দাবাদ'],
                    ['Kotbari', 'কোটবাড়ী'],
                    ['Moushair', 'মৌশাইর'],
                    ['Chalabon', 'চালাবন'],
                    ['Sonarkhola', 'সোনারখোলা'],
                    ['Holan', 'হলান'],
                    ['Barua', 'বরুয়া'],
                    ['Kawlar', 'কাওলার'],
                    ['Ashkona', 'আশকোনা'],
                    ['Gawair', 'গাওয়াইর'],
                    ['Mollartek', 'মোল্লারটেক'],
                    ['Azampur', 'আজমপুর'],
                ],
            ],

            [
                'name_en' => 'Darus Salam',
                'name_bn' => 'দারুস সালাম',
                'areas' => [
                    ['Darus Salam', 'দারুস সালাম'],
                    ['Golartek', 'গোলারটেক'],
                ],
            ],

            [
                'name_en' => 'Demra',
                'name_bn' => 'ডেমরা',
                'areas' => [
                    ['Demra', 'ডেমরা'],
                ],
            ],

            [
                'name_en' => 'Dhanmondi',
                'name_bn' => 'ধানমন্ডি',
                'areas' => [
                    ['Dhanmondi', 'ধানমন্ডি'],
                    ['Satmasjid Road', 'সাতমসজিদ রোড'],
                ],
            ],

            [
                'name_en' => 'Gandaria',
                'name_bn' => 'গেন্ডারিয়া',
                'areas' => [
                    ['Gandaria', 'গেন্ডারিয়া'],
                ],
            ],

            [
                'name_en' => 'Gulshan',
                'name_bn' => 'গুলশান',
                'areas' => [
                    ['Gulshan 1', 'গুলশান ১'],
                    ['Gulshan 2', 'গুলশান ২'],
                ],
            ],

            [
                'name_en' => 'Hazaribagh',
                'name_bn' => 'হাজারীবাগ',
                'areas' => [
                    ['Hazaribagh', 'হাজারীবাগ'],
                ],
            ],

            [
                'name_en' => 'Jatrabari',
                'name_bn' => 'যাত্রাবাড়ী',
                'areas' => [
                    ['Jatrabari', 'যাত্রাবাড়ী'],
                    ['Sayedabad', 'সায়েদাবাদ'],
                ],
            ],

            [
                'name_en' => 'Kadamtali',
                'name_bn' => 'কদমতলী',
                'areas' => [
                    ['Kadamtali', 'কদমতলী'],
                    ['Rayerbagh', 'রায়েরবাগ'],
                ],
            ],

            [
                'name_en' => 'Kafrul',
                'name_bn' => 'কাফরুল',
                'areas' => [
                    ['Kafrul', 'কাফরুল'],
                    ['Mirpur 14', 'মিরপুর ১৪'],
                ],
            ],

            [
                'name_en' => 'Kalabagan',
                'name_bn' => 'কলাবাগান',
                'areas' => [
                    ['Kalabagan', 'কলাবাগান'],
                    ['North Road', 'নর্থ রোড'],
                ],
            ],

            [
                'name_en' => 'Kamrangirchar',
                'name_bn' => 'কামরাঙ্গীরচর',
                'areas' => [
                    ['Kamrangirchar', 'কামরাঙ্গীরচর'],
                ],
            ],

            [
                'name_en' => 'Khilgaon',
                'name_bn' => 'খিলগাঁও',
                'areas' => [
                    ['Khilgaon', 'খিলগাঁও'],
                    ['Taltola', 'তালতলা'],
                ],
            ],

            [
                'name_en' => 'Khilkhet',
                'name_bn' => 'খিলক্ষেত',
                'areas' => [
                    ['Khilkhet', 'খিলক্ষেত'],
                    ['Nikunja 1', 'নিকুঞ্জ ১'],
                    ['Nikunja 2', 'নিকুঞ্জ ২'],
                ],
            ],

            [
                'name_en' => 'Kotwali',
                'name_bn' => 'কোতোয়ালি',
                'areas' => [
                    ['Kotwali', 'কোতোয়ালি'],
                    ['Sadarghat', 'সদরঘাট'],
                ],
            ],

            [
                'name_en' => 'Lalbagh',
                'name_bn' => 'লালবাগ',
                'areas' => [
                    ['Lalbagh', 'লালবাগ'],
                    ['Azimpur', 'আজিমপুর'],
                ],
            ],

            [
                'name_en' => 'Mirpur Model',
                'name_bn' => 'মিরপুর মডেল',
                'areas' => [
                    ['Mirpur 1', 'মিরপুর ১'],
                    ['Mirpur 2', 'মিরপুর ২'],
                ],
            ],

            [
                'name_en' => 'Mohammadpur',
                'name_bn' => 'মোহাম্মদপুর',
                'areas' => [
                    ['Mohammadpur', 'মোহাম্মদপুর'],
                    ['Mohammadia Housing', 'মোহাম্মদিয়া হাউজিং'],
                    ['Bosila', 'বসিলা'],
                ],
            ],

            [
                'name_en' => 'Motijheel',
                'name_bn' => 'মতিঝিল',
                'areas' => [
                    ['Motijheel', 'মতিঝিল'],
                    ['Arambagh', 'আরামবাগ'],
                ],
            ],

            [
                'name_en' => 'Mugda',
                'name_bn' => 'মুগদা',
                'areas' => [
                    ['Mugda', 'মুগদা'],
                ],
            ],

            [
                'name_en' => 'New Market',
                'name_bn' => 'নিউ মার্কেট',
                'areas' => [
                    ['New Market', 'নিউ মার্কেট'],
                    ['Nilkhet', 'নীলক্ষেত'],
                    ['Katabon', 'কাঁটাবন'],
                ],
            ],

            [
                'name_en' => 'Pallabi',
                'name_bn' => 'পল্লবী',
                'areas' => [
                    ['Pallabi', 'পল্লবী'],
                    ['Mirpur 11', 'মিরপুর ১১'],
                    ['Mirpur 12', 'মিরপুর ১২'],
                ],
            ],

            [
                'name_en' => 'Paltan',
                'name_bn' => 'পল্টন',
                'areas' => [
                    ['Paltan', 'পল্টন'],
                    ['Naya Paltan', 'নয়া পল্টন'],
                    ['Bijoy Nagar', 'বিজয়নগর'],
                ],
            ],

            [
                'name_en' => 'Ramna',
                'name_bn' => 'রমনা',
                'areas' => [
                    ['Ramna', 'রমনা'],
                    ['Moghbazar', 'মগবাজার'],
                    ['Eskaton', 'ইস্কাটন'],
                ],
            ],

            [
                'name_en' => 'Rampura',
                'name_bn' => 'রামপুরা',
                'areas' => [
                    ['Rampura', 'রামপুরা'],
                    ['Banasree', 'বনশ্রী'],
                ],
            ],

            [
                'name_en' => 'Rupnagar',
                'name_bn' => 'রূপনগর',
                'areas' => [
                    ['Rupnagar', 'রূপনগর'],
                ],
            ],

            [
                'name_en' => 'Sabujbagh',
                'name_bn' => 'সবুজবাগ',
                'areas' => [
                    ['Sabujbagh', 'সবুজবাগ'],
                    ['Basabo', 'বাসাবো'],
                ],
            ],

            [
                'name_en' => 'Shah Ali',
                'name_bn' => 'শাহ আলী',
                'areas' => [
                    ['Shah Ali', 'শাহ আলী'],
                    ['Mirpur 1', 'মিরপুর ১'],
                ],
            ],

            [
                'name_en' => 'Shahbagh',
                'name_bn' => 'শাহবাগ',
                'areas' => [
                    ['Shahbagh', 'শাহবাগ'],
                    ['Bangla Motor', 'বাংলামোটর'],
                    ['Paribagh', 'পরীবাগ'],
                ],
            ],

            [
                'name_en' => 'Shahjahanpur',
                'name_bn' => 'শাহজাহানপুর',
                'areas' => [
                    ['Shahjahanpur', 'শাহজাহানপুর'],
                ],
            ],

            [
                'name_en' => 'Sher-e-Bangla Nagar',
                'name_bn' => 'শেরেবাংলা নগর',
                'areas' => [
                    ['Sher-e-Bangla Nagar', 'শেরেবাংলা নগর'],
                    ['Agargaon', 'আগারগাঁও'],
                ],
            ],

            [
                'name_en' => 'Shyampur',
                'name_bn' => 'শ্যামপুর',
                'areas' => [
                    ['Shyampur', 'শ্যামপুর'],
                    ['Postogola', 'পোস্তগোলা'],
                ],
            ],

            [
                'name_en' => 'Sutrapur',
                'name_bn' => 'সূত্রাপুর',
                'areas' => [
                    ['Sutrapur', 'সূত্রাপুর'],
                ],
            ],

            [
                'name_en' => 'Tejgaon',
                'name_bn' => 'তেজগাঁও',
                'areas' => [
                    ['Tejgaon', 'তেজগাঁও'],
                    ['Farmgate', 'ফার্মগেট'],
                    ['Tejkunipara', 'তেজকুনিপাড়া'],
                    ['Kawran Bazar', 'কারওয়ান বাজার'],
                ],
            ],

            [
                'name_en' => 'Tejgaon Industrial Area',
                'name_bn' => 'তেজগাঁও শিল্পাঞ্চল',
                'areas' => [
                    ['Tejgaon Industrial Area', 'তেজগাঁও শিল্পাঞ্চল'],
                ],
            ],

            [
                'name_en' => 'Turag',
                'name_bn' => 'তুরাগ',
                'areas' => [
                    ['Turag', 'তুরাগ'],
                    ['Diabari', 'দিয়াবাড়ি'],
                    ['Abdullahpur', 'আব্দুল্লাহপুর'],
                ],
            ],

            [
                'name_en' => 'Uttara East',
                'name_bn' => 'উত্তরা পূর্ব',
                'areas' => [
                    ['Uttara', 'উত্তরা'],
                    ['Uttara Sector 1', 'উত্তরা সেক্টর ১'],
                    ['Uttara Sector 2', 'উত্তরা সেক্টর ২'],
                    ['Uttara Sector 3', 'উত্তরা সেক্টর ৩'],
                    ['Uttara Sector 4', 'উত্তরা সেক্টর ৪'],
                    ['Uttara Sector 6', 'উত্তরা সেক্টর ৬'],
                    ['Uttara Sector 8', 'উত্তরা সেক্টর ৮'],
                ],
            ],

            [
                'name_en' => 'Uttara West',
                'name_bn' => 'উত্তরা পশ্চিম',
                'areas' => [
                    ['Uttara', 'উত্তরা'],
                    ['Uttara Sector 7', 'উত্তরা সেক্টর ৭'],
                    ['Uttara Sector 9', 'উত্তরা সেক্টর ৯'],
                    ['Uttara Sector 10', 'উত্তরা সেক্টর ১০'],
                    ['Uttara Sector 11', 'উত্তরা সেক্টর ১১'],
                    ['Uttara Sector 12', 'উত্তরা সেক্টর ১২'],
                    ['Uttara Sector 13', 'উত্তরা সেক্টর ১৩'],
                    ['Uttara Sector 14', 'উত্তরা সেক্টর ১৪'],
                ],
            ],

            [
                'name_en' => 'Uttarkhan',
                'name_bn' => 'উত্তরখান',
                'areas' => [
                    ['Uttarkhan', 'উত্তরখান'],
                ],
            ],

            [
                'name_en' => 'Vatara',
                'name_bn' => 'ভাটারা',
                'areas' => [
                    ['Vatara', 'ভাটারা'],
                    ['Notun Bazar', 'নতুন বাজার'],
                    ['Bashundhara', 'বসুন্ধরা'],
                ],
            ],

            [
                'name_en' => 'Wari',
                'name_bn' => 'ওয়ারী',
                'areas' => [
                    ['Wari', 'ওয়ারী'],
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | Gulistan
            |--------------------------------------------------------------------------
            |
            | Gulistan is being stored as an AREA, not a fake Thana.
            |--------------------------------------------------------------------------
            */

            [
                'name_en' => 'Paltan',
                'name_bn' => 'পল্টন',
                'areas' => [
                    ['Gulistan', 'গুলিস্তান'],
                ],
            ],
        ];

        $stats = [
            'thana_created' => 0,
            'thana_updated' => 0,
            'area_created' => 0,
            'area_updated' => 0,
        ];

        try {

            DB::transaction(function () use (
                $dhaka,
                $locations,
                &$stats
            ) {

                foreach ($locations as $location) {

                    /*
                    |--------------------------------------------------------------------------
                    | Find existing Thana
                    |--------------------------------------------------------------------------
                    */

                    $thana = Thana::query()
                        ->where('district_id', $dhaka->id)
                        ->where(function ($query) use ($location) {

                            $query
                                ->where(
                                    'name_bn',
                                    $location['name_bn']
                                )
                                ->orWhereRaw(
                                    'LOWER(TRIM(name_en)) = ?',
                                    [
                                        mb_strtolower(
                                            trim($location['name_en'])
                                        )
                                    ]
                                );
                        })
                        ->first();

                    /*
                    |--------------------------------------------------------------------------
                    | Update / Create Thana
                    |--------------------------------------------------------------------------
                    */

                    if ($thana) {

                        $thana->update([
                            'name_bn' => $location['name_bn'],
                            'name_en' => $location['name_en'],
                            'city_corporation_code' => null,
                            'is_metropolitan' => true,
                            'is_active' => true,
                        ]);

                        $stats['thana_updated']++;

                    } else {

                        $baseCode =
                            'DHAKA-DMP-' .
                            strtoupper(
                                Str::slug(
                                    $location['name_en'],
                                    '-'
                                )
                            );

                        $code = $baseCode;

                        $counter = 2;

                        while (
                            Thana::where('code', $code)->exists()
                        ) {
                            $code =
                                $baseCode . '-' . $counter;

                            $counter++;
                        }

                        $thana = Thana::create([
                            'district_id' => $dhaka->id,
                            'name_bn' => $location['name_bn'],
                            'name_en' => $location['name_en'],
                            'code' => $code,
                            'city_corporation_code' => null,
                            'is_metropolitan' => true,
                            'is_active' => true,
                        ]);

                        $stats['thana_created']++;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Areas
                    |--------------------------------------------------------------------------
                    */

                    foreach ($location['areas'] as $areaData) {

                        [$areaEn, $areaBn] = $areaData;

                        $area = Area::query()
                            ->where(
                                'thana_id',
                                $thana->id
                            )
                            ->where(function ($query) use (
                                $areaEn,
                                $areaBn
                            ) {
                                $query
                                    ->where(
                                        'name_bn',
                                        $areaBn
                                    )
                                    ->orWhereRaw(
                                        'LOWER(TRIM(name_en)) = ?',
                                        [
                                            mb_strtolower(
                                                trim($areaEn)
                                            )
                                        ]
                                    );
                            })
                            ->first();

                        if ($area) {

                            $area->update([
                                'name_bn' => $areaBn,
                                'name_en' => $areaEn,
                                'is_active' => true,
                            ]);

                            $stats['area_updated']++;

                            continue;
                        }

                        $baseAreaCode =
                            $thana->code .
                            '-AREA-' .
                            strtoupper(
                                Str::slug(
                                    $areaEn,
                                    '-'
                                )
                            );

                        $areaCode = $baseAreaCode;

                        $counter = 2;

                        while (
                            Area::where(
                                'code',
                                $areaCode
                            )->exists()
                        ) {
                            $areaCode =
                                $baseAreaCode .
                                '-' .
                                $counter;

                            $counter++;
                        }

                        Area::create([
                            'thana_id' => $thana->id,
                            'ward_id' => null,

                            'name_bn' => $areaBn,
                            'name_en' => $areaEn,

                            'code' => $areaCode,

                            'alias_bn' => null,
                            'alias_en' => null,

                            'is_active' => true,
                        ]);

                        $stats['area_created']++;
                    }
                }
            });

        } catch (\Throwable $e) {

            $this->newLine();

            $this->error(
                'Dhaka City sync failed: ' .
                $e->getMessage()
            );

            return self::FAILURE;
        }

        /*
        |--------------------------------------------------------------------------
        | Result
        |--------------------------------------------------------------------------
        */

        $this->newLine();

        $this->info(
            'Dhaka City location sync completed.'
        );

        $this->table(
            ['Operation', 'Count'],
            [
                [
                    'Thana created',
                    $stats['thana_created'],
                ],
                [
                    'Thana updated',
                    $stats['thana_updated'],
                ],
                [
                    'Area created',
                    $stats['area_created'],
                ],
                [
                    'Area updated',
                    $stats['area_updated'],
                ],
            ]
        );

        $this->newLine();

        $this->info(
            'Total Dhaka metropolitan Thana records: ' .
            Thana::where(
                'district_id',
                $dhaka->id
            )->count()
        );

        return self::SUCCESS;
    }
}