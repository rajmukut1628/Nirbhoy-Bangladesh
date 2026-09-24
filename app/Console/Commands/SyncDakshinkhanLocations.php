<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Thana;
use App\Models\Ward;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncDakshinkhanLocations extends Command
{
    protected $signature = 'nirbhoy:sync-dakshinkhan';

    protected $description = 'Add or update Dakshinkhan and its DNCC wards without duplicates';

    public function handle(): int
    {
        $this->info('Syncing Dakshinkhan location data...');

        $dhaka = District::query()
            ->whereRaw('LOWER(TRIM(name_en)) = ?', ['dhaka'])
            ->first();

        if (!$dhaka) {
            $this->error('Dhaka district was not found.');
            return self::FAILURE;
        }

        $wards = [
            47 => [
                'name_bn' => 'ওয়ার্ড ৪৭',
                'name_en' => 'Ward 47',
                'areas_bn' => 'ফায়দাবাদ, কোটবাড়ী, মৌশাইর, চালাবন',
                'areas_en' => 'Faidabad, Kotbari, Moushair, Chalabon',
            ],

            48 => [
                'name_bn' => 'ওয়ার্ড ৪৮',
                'name_en' => 'Ward 48',
                'areas_bn' => 'দক্ষিণখান, সোনারখোলা, হলান, আনল, বরুয়া, জামুন',
                'areas_en' => 'Dakshinkhan, Sonarkhola, Holan, Anol, Barua, Jamun',
            ],

            49 => [
                'name_bn' => 'ওয়ার্ড ৪৯',
                'name_en' => 'Ward 49',
                'areas_bn' => 'কাওলার, আশকোনা, গাওয়াইর',
                'areas_en' => 'Kawlar, Ashkona, Gawair',
            ],

            50 => [
                'name_bn' => 'ওয়ার্ড ৫০',
                'name_en' => 'Ward 50',
                'areas_bn' => 'মোল্লারটেক, ইরশাল, আজমপুর',
                'areas_en' => 'Mollartek, Irshal, Azampur',
            ],
        ];

        try {
            DB::transaction(function () use ($dhaka, $wards) {

                /*
                |--------------------------------------------------------------------------
                | Dakshinkhan Thana
                |--------------------------------------------------------------------------
                | Existing record থাকলে duplicate create হবে না.
                | Manual data existing record-কে update করবে.
                */

                $thana = Thana::query()
                    ->where('district_id', $dhaka->id)
                    ->where(function ($query) {
                        $query->where('name_bn', 'দক্ষিণখান')
                            ->orWhereRaw(
                                'LOWER(TRIM(name_en)) = ?',
                                ['dakshinkhan']
                            );
                    })
                    ->first();

                if ($thana) {
                    $thana->update([
                        'name_bn' => 'দক্ষিণখান',
                        'name_en' => 'Dakshinkhan',
                        'city_corporation_code' => 'DNCC',
                        'is_metropolitan' => true,
                        'is_active' => true,
                    ]);

                    $this->line('UPDATED: দক্ষিণখান');
                } else {
                    $thana = Thana::create([
                        'district_id' => $dhaka->id,
                        'name_bn' => 'দক্ষিণখান',
                        'name_en' => 'Dakshinkhan',
                        'code' => 'DHAKA-DNCC-DAKSHINKHAN',
                        'city_corporation_code' => 'DNCC',
                        'is_metropolitan' => true,
                        'is_active' => true,
                    ]);

                    $this->info('CREATED: দক্ষিণখান');
                }

                /*
                |--------------------------------------------------------------------------
                | Wards
                |--------------------------------------------------------------------------
                */

                foreach ($wards as $number => $data) {

                    $ward = Ward::query()
                        ->where('thana_id', $thana->id)
                        ->where('ward_number', $number)
                        ->first();

                    if ($ward) {
                        $ward->update([
                            'name_bn' => $data['name_bn'],
                            'name_en' => $data['name_en'],
                            'areas_bn' => $data['areas_bn'],
                            'areas_en' => $data['areas_en'],
                            'is_active' => true,
                        ]);

                        $this->line(
                            "UPDATED: {$data['name_bn']}"
                        );

                        continue;
                    }

                    Ward::create([
                        'thana_id' => $thana->id,
                        'ward_number' => $number,
                        'name_bn' => $data['name_bn'],
                        'name_en' => $data['name_en'],
                        'code' => "DNCC-DAKSHINKHAN-W{$number}",
                        'areas_bn' => $data['areas_bn'],
                        'areas_en' => $data['areas_en'],
                        'is_active' => true,
                    ]);

                    $this->info(
                        "CREATED: {$data['name_bn']}"
                    );
                }
            });

        } catch (\Throwable $e) {
            $this->error('Sync failed: ' . $e->getMessage());

            return self::FAILURE;
        }

        $thana = Thana::where('district_id', $dhaka->id)
            ->where('name_en', 'Dakshinkhan')
            ->first();

        $wardCount = $thana
            ? Ward::where('thana_id', $thana->id)->count()
            : 0;

        $this->newLine();
        $this->info('Dakshinkhan synchronization completed.');
        $this->line("Thana: দক্ষিণখান");
        $this->line("Total wards: {$wardCount}");

        return self::SUCCESS;
    }
}