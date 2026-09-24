<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class UpazilaUnionSeeder extends Seeder
{
    public function run(): void
    {
        $districtFile = database_path('data/districts.csv');
        $upazilaFile  = database_path('data/upazilas.csv');
        $unionFile    = database_path('data/unions.csv');

        foreach ([$districtFile, $upazilaFile, $unionFile] as $file) {
            if (!file_exists($file)) {
                throw new RuntimeException(
                    'Required file not found: ' . $file
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | STEP 1: Build external district ID -> our DB district ID map
        |--------------------------------------------------------------------------
        */

        $districtMap = [];

        $handle = fopen($districtFile, 'r');

        while (($row = fgetcsv($handle)) !== false) {

            if (count($row) < 4) {
                continue;
            }

            $externalDistrictId = trim($row[0]);
            $nameEn             = trim($row[2]);
            $nameBn             = trim($row[3]);

            /*
             * First match English name.
             */
            $district = District::whereRaw(
                'LOWER(TRIM(name_en)) = ?',
                [mb_strtolower($nameEn)]
            )->first();

            /*
             * Fallback: Bangla name.
             */
            if (!$district) {
                $district = District::where(
                    'name_bn',
                    $nameBn
                )->first();
            }

            /*
             * Handle common spelling differences.
             */
            if (!$district) {

                $aliases = [
                    'Barisal'     => 'Barishal',
                    'Comilla'     => 'Cumilla',
                    'Jessore'     => 'Jashore',
                    'Bogra'       => 'Bogura',
                    'Chittagong'  => 'Chattogram',
                    'Coxsbazar'   => "Cox's Bazar",
                    'Coxs Bazar'  => "Cox's Bazar",
                ];

                if (isset($aliases[$nameEn])) {

                    $district = District::whereRaw(
                        'LOWER(TRIM(name_en)) = ?',
                        [mb_strtolower($aliases[$nameEn])]
                    )->first();
                }
            }

            if (!$district) {
                fclose($handle);

                throw new RuntimeException(
                    "District mapping failed: {$nameEn} / {$nameBn}"
                );
            }

            $districtMap[$externalDistrictId] = $district->id;
        }

        fclose($handle);


        if (count($districtMap) !== 64) {
            throw new RuntimeException(
                'Expected 64 mapped districts, found: '
                . count($districtMap)
            );
        }


        /*
        |--------------------------------------------------------------------------
        | STEP 2: Import Upazila + Union
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $upazilaFile,
            $unionFile,
            $districtMap
        ) {

            /*
             * Clear previous incomplete location data.
             */

            Union::query()->delete();
            Upazila::query()->delete();


            /*
            |--------------------------------------------------------------------------
            | Import Upazilas
            |--------------------------------------------------------------------------
            |
            | CSV:
            | id,district_id,name,bn_name,url
            |
            */

            $upazilaMap = [];

            $handle = fopen($upazilaFile, 'r');

            if (!$handle) {
                throw new RuntimeException(
                    'Unable to open upazilas.csv'
                );
            }

            while (($row = fgetcsv($handle)) !== false) {

                if (count($row) < 4) {
                    continue;
                }

                $externalUpazilaId  = trim($row[0]);
                $externalDistrictId = trim($row[1]);
                $nameEn             = trim($row[2]);
                $nameBn             = trim($row[3]);

                if (!isset($districtMap[$externalDistrictId])) {

                    throw new RuntimeException(
                        "No district mapping for external district ID: "
                        . $externalDistrictId
                    );
                }

                $upazila = Upazila::create([
                    'district_id' =>
                        $districtMap[$externalDistrictId],

                    'name_bn' => $nameBn,

                    'name_en' => $nameEn,

                    'code' =>
                        'UPZ-' .
                        str_pad(
                            $externalUpazilaId,
                            4,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'is_active' => true,
                ]);

                /*
                 * External Upazila ID -> actual database ID
                 */
                $upazilaMap[$externalUpazilaId] = $upazila->id;
            }

            fclose($handle);


            /*
            |--------------------------------------------------------------------------
            | Import Unions
            |--------------------------------------------------------------------------
            |
            | CSV:
            | id,upazila_id,name,bn_name,url
            |
            */

            $handle = fopen($unionFile, 'r');

            if (!$handle) {
                throw new RuntimeException(
                    'Unable to open unions.csv'
                );
            }

            while (($row = fgetcsv($handle)) !== false) {

                if (count($row) < 4) {
                    continue;
                }

                $externalUnionId   = trim($row[0]);
                $externalUpazilaId = trim($row[1]);
                $nameEn            = trim($row[2]);
                $nameBn            = trim($row[3]);

                if (!isset($upazilaMap[$externalUpazilaId])) {

                    throw new RuntimeException(
                        "No Upazila mapping for external Upazila ID: "
                        . $externalUpazilaId
                    );
                }

                Union::create([
                    'upazila_id' =>
                        $upazilaMap[$externalUpazilaId],

                    'name_bn' => $nameBn,

                    'name_en' => $nameEn,

                    'code' =>
                        'UNI-' .
                        str_pad(
                            $externalUnionId,
                            5,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'is_active' => true,
                ]);
            }

            fclose($handle);
        });


        /*
        |--------------------------------------------------------------------------
        | FINAL RESULT
        |--------------------------------------------------------------------------
        */

        $this->command->newLine();

        $this->command->info(
            'Districts mapped: ' . count($districtMap)
        );

        $this->command->info(
            'Upazilas imported: ' . Upazila::count()
        );

        $this->command->info(
            'Unions imported: ' . Union::count()
        );

        $this->command->newLine();

        $this->command->info(
            'Location import completed successfully.'
        );
    }
}