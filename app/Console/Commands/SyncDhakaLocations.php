<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SyncDhakaLocations extends Command
{
    protected $signature = 'nirbhoy:sync-dhaka';

    protected $description =
        'Sync manually verified Dhaka district Upazila and Union data without creating duplicates';

    public function handle(): int
    {
        $this->info('Starting Dhaka location synchronization...');
        $this->newLine();

        /*
        |--------------------------------------------------------------------------
        | Find Dhaka District
        |--------------------------------------------------------------------------
        */

        $dhaka = District::query()
            ->whereRaw('LOWER(TRIM(name_en)) = ?', ['dhaka'])
            ->first();

        if (!$dhaka) {
            $this->error('Dhaka district was not found.');
            return self::FAILURE;
        }

        /*
        |--------------------------------------------------------------------------
        | Manually maintained Dhaka District data
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | This command does NOT delete the imported dataset.
        |
        | Existing matching records = UPDATE
        | Missing records           = CREATE
        |
        */

        $locations = [

            /*
            |--------------------------------------------------------------------------
            | SAVAR
            |--------------------------------------------------------------------------
            */

            [
                'name_en' => 'Savar',
                'name_bn' => 'সাভার',

                'aliases' => [
                    'savar',
                ],

                'unions' => [

                    ['name_en' => 'Savar',       'name_bn' => 'সাভার'],
                    ['name_en' => 'Birulia',     'name_bn' => 'বিরুলিয়া'],
                    ['name_en' => 'Dhamsona',    'name_bn' => 'ধামসোনা'],
                    ['name_en' => 'Shimulia',    'name_bn' => 'শিমুলিয়া'],
                    ['name_en' => 'Ashulia',     'name_bn' => 'আশুলিয়া'],
                    ['name_en' => 'Yearpur',     'name_bn' => 'ইয়ারপুর'],
                    ['name_en' => 'Vakurta',     'name_bn' => 'ভাকুর্তা'],
                    ['name_en' => 'Pathalia',    'name_bn' => 'পাথালিয়া'],
                    ['name_en' => 'Bongaon',     'name_bn' => 'বনগাঁও'],
                    ['name_en' => 'Kaundia',     'name_bn' => 'কাউন্দিয়া'],
                    ['name_en' => 'Tetuljhora',  'name_bn' => 'তেঁতুলঝোড়া'],
                    ['name_en' => 'Aminbazar',   'name_bn' => 'আমিনবাজার'],

                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | DHAMRAI
            |--------------------------------------------------------------------------
            */

            [
                'name_en' => 'Dhamrai',
                'name_bn' => 'ধামরাই',

                'aliases' => [
                    'dhamrai',
                ],

                'unions' => [

                    ['name_en' => 'Amta',          'name_bn' => 'আমতা'],
                    ['name_en' => 'Kushura',       'name_bn' => 'কুশুরা'],
                    ['name_en' => 'Gangutia',      'name_bn' => 'গাংগুটিয়া'],
                    ['name_en' => 'Sutipara',      'name_bn' => 'সূতিপাড়া'],
                    ['name_en' => 'Bhararia',      'name_bn' => 'ভাড়ারিয়া'],
                    ['name_en' => 'Dhamrai',       'name_bn' => 'ধামরাই'],
                    ['name_en' => 'Balia',         'name_bn' => 'বালিয়া'],
                    ['name_en' => 'Nannar',        'name_bn' => 'নান্নার'],
                    ['name_en' => 'Kulla',         'name_bn' => 'কুল্লা'],
                    ['name_en' => 'Jadabpur',      'name_bn' => 'যাদবপুর'],
                    ['name_en' => 'Suapur',        'name_bn' => 'সূয়াপুর'],
                    ['name_en' => 'Sanora',        'name_bn' => 'সানোড়া'],
                    ['name_en' => 'Chauhat',       'name_bn' => 'চৌহাট'],
                    ['name_en' => 'Baisakanda',    'name_bn' => 'বাইশাকান্দা'],
                    ['name_en' => 'Sombhag',       'name_bn' => 'সোমভাগ'],
                    ['name_en' => 'Rowail',        'name_bn' => 'রোয়াইল'],

                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | KERANIGANJ
            |--------------------------------------------------------------------------
            */

            [
                'name_en' => 'Keraniganj',
                'name_bn' => 'কেরাণীগঞ্জ',

                'aliases' => [
                    'keraniganj',
                    'keranigonj',
                ],

                'unions' => [

                    ['name_en' => 'Aganagar',      'name_bn' => 'আগানগর'],
                    ['name_en' => 'Konda',         'name_bn' => 'কোন্ডা'],
                    ['name_en' => 'Kalatia',       'name_bn' => 'কলাতিয়া'],
                    ['name_en' => 'Taranagar',     'name_bn' => 'তারানগর'],
                    ['name_en' => 'Shakta',        'name_bn' => 'শাক্তা'],
                    ['name_en' => 'Kalindi',       'name_bn' => 'কালিন্দী'],
                    ['name_en' => 'Basta',         'name_bn' => 'বাস্তা'],
                    ['name_en' => 'Ruhitpur',      'name_bn' => 'রোহিতপুর'],
                    ['name_en' => 'Zinjira',       'name_bn' => 'জিনজিরা'],
                    ['name_en' => 'Subhadya',      'name_bn' => 'শুভ্যাঢা'],
                    ['name_en' => 'Tegharia',      'name_bn' => 'তেঘরিয়া'],
                    ['name_en' => 'Hazratpur',     'name_bn' => 'হযরতপুর'],

                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | NAWABGANJ
            |--------------------------------------------------------------------------
            */

            [
                'name_en' => 'Nawabganj',
                'name_bn' => 'নবাবগঞ্জ',

                'aliases' => [
                    'nawabganj',
                    'nawabgonj',
                ],

                'unions' => [

                    ['name_en' => 'Baksnagar',       'name_bn' => 'বক্সনগর'],
                    ['name_en' => 'Baruakhali',      'name_bn' => 'বারুয়াখালী'],
                    ['name_en' => 'Kalakopa',        'name_bn' => 'কলাকোপা'],
                    ['name_en' => 'Churain',         'name_bn' => 'চূড়াইন'],
                    ['name_en' => 'Galimpur',        'name_bn' => 'গালিমপুর'],
                    ['name_en' => 'Kailail',         'name_bn' => 'কৈলাইল'],
                    ['name_en' => 'Sholla',          'name_bn' => 'শোল্লা'],
                    ['name_en' => 'Nayansree',       'name_bn' => 'নয়নশ্রী'],
                    ['name_en' => 'Joykrishnapur',   'name_bn' => 'জয়কৃষ্ণপুর'],
                    ['name_en' => 'Bahra',           'name_bn' => 'বাহ্রা'],
                    ['name_en' => 'Bandura',         'name_bn' => 'বান্দুরা'],
                    ['name_en' => 'Agla',            'name_bn' => 'আগলা'],
                    ['name_en' => 'Shikaripara',     'name_bn' => 'শিকারীপাড়া'],
                    ['name_en' => 'Jantrail',        'name_bn' => 'যন্ত্রাইল'],

                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | DOHAR
            |--------------------------------------------------------------------------
            */

            [
                'name_en' => 'Dohar',
                'name_bn' => 'দোহার',

                'aliases' => [
                    'dohar',
                ],

                'unions' => [

                    ['name_en' => 'Nayabari',       'name_bn' => 'নয়াবাড়ী'],
                    ['name_en' => 'Kusumhati',      'name_bn' => 'কুসুমহাটি'],
                    ['name_en' => 'Raipara',        'name_bn' => 'রাইপাড়া'],
                    ['name_en' => 'Sutarpara',      'name_bn' => 'সূতারপাড়া'],
                    ['name_en' => 'Narisha',        'name_bn' => 'নারিশা'],
                    ['name_en' => 'Muksudpur',      'name_bn' => 'মুকসুদপুর'],
                    ['name_en' => 'Mahmudpur',      'name_bn' => 'মাহমুদপুর'],
                    ['name_en' => 'Bilaspur',       'name_bn' => 'বিলাসপুর'],

                ],
            ],

        ];


        $stats = [
            'upazila_created' => 0,
            'upazila_updated' => 0,
            'union_created'   => 0,
            'union_updated'   => 0,
        ];


        try {

            DB::transaction(function () use (
                $dhaka,
                $locations,
                &$stats
            ) {

                foreach ($locations as $upazilaData) {

                    /*
                    |--------------------------------------------------------------------------
                    | Find existing Upazila
                    |--------------------------------------------------------------------------
                    |
                    | First:
                    | District + Bangla name
                    |
                    | Then:
                    | English aliases
                    |
                    */

                    $upazila = Upazila::query()
                        ->where('district_id', $dhaka->id)
                        ->where('name_bn', $upazilaData['name_bn'])
                        ->first();


                    if (!$upazila) {

                        $aliases = array_map(
                            fn ($name) => mb_strtolower(trim($name)),
                            $upazilaData['aliases']
                        );

                        $upazila = Upazila::query()
                            ->where('district_id', $dhaka->id)
                            ->where(function ($query) use ($aliases) {

                                foreach ($aliases as $alias) {

                                    $query->orWhereRaw(
                                        'LOWER(TRIM(name_en)) = ?',
                                        [$alias]
                                    );

                                }

                            })
                            ->first();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Create OR update Upazila
                    |--------------------------------------------------------------------------
                    */

                    if ($upazila) {

                        $upazila->update([
                            'name_bn'   => $upazilaData['name_bn'],
                            'name_en'   => $upazilaData['name_en'],
                            'is_active' => true,
                        ]);

                        $stats['upazila_updated']++;

                        $this->line(
                            'UPDATED Upazila: '
                            . $upazilaData['name_bn']
                        );

                    } else {

                        $upazila = Upazila::create([
                            'district_id' => $dhaka->id,

                            'name_bn' =>
                                $upazilaData['name_bn'],

                            'name_en' =>
                                $upazilaData['name_en'],

                            'code' =>
                                'MANUAL-DHAKA-' .
                                strtoupper(
                                    str_replace(
                                        ' ',
                                        '-',
                                        $upazilaData['name_en']
                                    )
                                ),

                            'is_active' => true,
                        ]);

                        $stats['upazila_created']++;

                        $this->info(
                            'CREATED Upazila: '
                            . $upazilaData['name_bn']
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Sync Unions
                    |--------------------------------------------------------------------------
                    */

                    foreach ($upazilaData['unions'] as $unionData) {

                        /*
                         * Bangla match first.
                         */

                        $union = Union::query()
                            ->where(
                                'upazila_id',
                                $upazila->id
                            )
                            ->where(
                                'name_bn',
                                $unionData['name_bn']
                            )
                            ->first();


                        /*
                         * English fallback.
                         */

                        if (!$union) {

                            $union = Union::query()
                                ->where(
                                    'upazila_id',
                                    $upazila->id
                                )
                                ->whereRaw(
                                    'LOWER(TRIM(name_en)) = ?',
                                    [
                                        mb_strtolower(
                                            trim(
                                                $unionData['name_en']
                                            )
                                        )
                                    ]
                                )
                                ->first();
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Existing Union
                        |--------------------------------------------------------------------------
                        */

                        if ($union) {

                            $union->update([
                                'name_bn' =>
                                    $unionData['name_bn'],

                                'name_en' =>
                                    $unionData['name_en'],

                                'is_active' => true,
                            ]);

                            $stats['union_updated']++;

                            continue;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | New Union
                        |--------------------------------------------------------------------------
                        */

                        $unionCode =
                            'MANUAL-DHAKA-' .
                            $upazila->id .
                            '-' .
                            strtoupper(
                                preg_replace(
                                    '/[^A-Za-z0-9]+/',
                                    '-',
                                    $unionData['name_en']
                                )
                            );


                        Union::create([
                            'upazila_id' =>
                                $upazila->id,

                            'name_bn' =>
                                $unionData['name_bn'],

                            'name_en' =>
                                $unionData['name_en'],

                            'code' =>
                                trim($unionCode, '-'),

                            'is_active' => true,
                        ]);

                        $stats['union_created']++;
                    }
                }
            });

        } catch (\Throwable $e) {

            $this->newLine();

            $this->error(
                'Sync failed: ' . $e->getMessage()
            );

            return self::FAILURE;
        }


        /*
        |--------------------------------------------------------------------------
        | Result
        |--------------------------------------------------------------------------
        */

        $this->newLine();

        $this->info('Dhaka location synchronization completed.');

        $this->newLine();

        $this->table(
            ['Operation', 'Count'],
            [
                [
                    'Upazila created',
                    $stats['upazila_created']
                ],
                [
                    'Upazila updated / duplicate reused',
                    $stats['upazila_updated']
                ],
                [
                    'Union created',
                    $stats['union_created']
                ],
                [
                    'Union updated / duplicate reused',
                    $stats['union_updated']
                ],
            ]
        );

        $this->newLine();

        $this->info(
            'Dhaka now has '
            . Upazila::where(
                'district_id',
                $dhaka->id
            )->count()
            . ' Upazila records.'
        );

        return self::SUCCESS;
    }
}