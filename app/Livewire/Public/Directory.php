<?php

namespace App\Livewire\Public;

use App\Models\Accused;
use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Ward;
use Livewire\Component;

class Directory extends Component
{
    public $division_id = '';
    public $district_id = '';

    // upazila | thana
    public $location_type = '';

    // Rural
    public $upazila_id = '';
    public $union_id = '';

    // City
    public $thana_id = '';
    public $ward_id = '';
    public $area_id = '';

    public $search = '';

    /*
    |--------------------------------------------------------------------------
    | Dependent Dropdown Reset
    |--------------------------------------------------------------------------
    */

    public function updatedDivisionId(): void
    {
        $this->district_id = '';
        $this->resetLocalLocation();
    }

    public function updatedDistrictId(): void
    {
        $this->resetLocalLocation();
    }

    public function updatedLocationType(): void
    {
        $this->upazila_id = '';
        $this->union_id = '';

        $this->thana_id = '';
        $this->ward_id = '';
        $this->area_id = '';
    }

    public function updatedUpazilaId(): void
    {
        $this->union_id = '';
    }

    public function updatedThanaId(): void
    {
        $this->ward_id = '';
        $this->area_id = '';
    }

    public function updatedWardId(): void
    {
        $this->area_id = '';
    }

    /*
    |--------------------------------------------------------------------------
    | Reset
    |--------------------------------------------------------------------------
    */

    private function resetLocalLocation(): void
    {
        $this->location_type = '';

        $this->upazila_id = '';
        $this->union_id = '';

        $this->thana_id = '';
        $this->ward_id = '';
        $this->area_id = '';
    }

    public function resetFilters(): void
    {
        $this->division_id = '';
        $this->district_id = '';

        $this->resetLocalLocation();

        $this->search = '';
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        /*
        |--------------------------------------------------------------------------
        | Division
        |--------------------------------------------------------------------------
        */

        $divisions = Division::query()
            ->where('is_active', true)
            ->orderBy('name_bn')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | District
        |--------------------------------------------------------------------------
        */

        $districts = collect();

        if ($this->division_id) {
            $districts = District::query()
                ->where('division_id', $this->division_id)
                ->where('is_active', true)
                ->orderBy('name_bn')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Upazila
        |--------------------------------------------------------------------------
        */

        $upazilas = collect();

        if ($this->district_id) {
            $upazilas = Upazila::query()
                ->where('district_id', $this->district_id)
                ->where('is_active', true)
                ->orderBy('name_bn')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Union
        |--------------------------------------------------------------------------
        */

        $unions = collect();

        if ($this->upazila_id) {
            $unions = Union::query()
                ->where('upazila_id', $this->upazila_id)
                ->where('is_active', true)
                ->orderBy('name_bn')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Thana
        |--------------------------------------------------------------------------
        */

        $thanas = collect();

        if ($this->district_id) {
            $thanas = Thana::query()
                ->where('district_id', $this->district_id)
                ->where('is_active', true)
                ->orderBy('name_bn')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Ward
        |--------------------------------------------------------------------------
        */

        $wards = collect();

        if ($this->thana_id) {
            $wards = Ward::query()
                ->where('thana_id', $this->thana_id)
                ->where('is_active', true)
                ->orderBy('ward_number')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Area
        |--------------------------------------------------------------------------
        |
        | Ward-linked এবং সরাসরি Thana-linked দুই ধরনের Area আসবে।
        |--------------------------------------------------------------------------
        */

        $areas = collect();

        if ($this->thana_id) {
            $areasQuery = Area::query()
                ->where('thana_id', $this->thana_id)
                ->where('is_active', true);

            if ($this->ward_id) {
                $areasQuery->where(function ($query) {
                    $query
                        ->where('ward_id', $this->ward_id)

                        // Thana-level areas are still searchable/selectable.
                        ->orWhereNull('ward_id');
                });
            }

            $areas = $areasQuery
                ->orderBy('name_bn')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Public Profiles
        |--------------------------------------------------------------------------
        */

        $profiles = Accused::query()
            ->where('verification_status', 'approved')
            ->where('is_public', true)

            /*
             * Division
             */
            ->when(
                $this->division_id,
                fn ($query) =>
                    $query->where(
                        'division_id',
                        $this->division_id
                    )
            )

            /*
             * District
             */
            ->when(
                $this->district_id,
                fn ($query) =>
                    $query->where(
                        'district_id',
                        $this->district_id
                    )
            )

            /*
             * Upazila
             */
            ->when(
                $this->location_type === 'upazila'
                && $this->upazila_id,

                fn ($query) =>
                    $query->where(
                        'upazila_id',
                        $this->upazila_id
                    )
            )

            /*
             * Union
             */
            ->when(
                $this->location_type === 'upazila'
                && $this->union_id,

                fn ($query) =>
                    $query->where(
                        'union_id',
                        $this->union_id
                    )
            )

            /*
             * Thana
             */
            ->when(
                $this->location_type === 'thana'
                && $this->thana_id,

                fn ($query) =>
                    $query->where(
                        'thana_id',
                        $this->thana_id
                    )
            )

            /*
             * Ward
             */
            ->when(
                $this->location_type === 'thana'
                && $this->ward_id,

                fn ($query) =>
                    $query->where(
                        'ward_id',
                        $this->ward_id
                    )
            )

            /*
             * Area
             *
             * accuseds table-এ এখন আলাদা area_id নেই।
             * তাই Area select করলে existing text "area" field দিয়ে
             * matching করা হচ্ছে।
             */
            ->when(
                $this->location_type === 'thana'
                && $this->area_id,

                function ($query) {

                    $area = Area::find($this->area_id);

                    if ($area) {
                        $query->where(function ($q) use ($area) {
                            $q->where(
                                'area',
                                'like',
                                '%' . $area->name_bn . '%'
                            )
                            ->orWhere(
                                'area',
                                'like',
                                '%' . $area->name_en . '%'
                            );
                        });
                    }
                }
            )

            /*
             * Search
             */
            ->when(
                trim($this->search) !== '',

                function ($query) {

                    $search =
                        '%' . trim($this->search) . '%';

                    $query->where(function ($q) use ($search) {

                        $q->where(
                            'name',
                            'like',
                            $search
                        )
                        ->orWhere(
                            'alias',
                            'like',
                            $search
                        )
                        ->orWhere(
                            'phone',
                            'like',
                            $search
                        )
                        ->orWhere(
                            'organization',
                            'like',
                            $search
                        )
                        ->orWhere(
                            'occupation',
                            'like',
                            $search
                        )
                        ->orWhere(
                            'area',
                            'like',
                            $search
                        );
                    });
                }
            )

            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Hot List
        |--------------------------------------------------------------------------
        */

        $hotProfiles = Accused::query()
            ->where(
                'verification_status',
                'approved'
            )
            ->where(
                'is_public',
                true
            )
            ->where(
                'is_hot',
                true
            )
            ->orderByRaw(
                'hot_order IS NULL'
            )
            ->orderBy(
                'hot_order'
            )
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view(
            'livewire.public.directory',
            [
                'divisions' => $divisions,
                'districts' => $districts,

                'upazilas' => $upazilas,
                'unions' => $unions,

                'thanas' => $thanas,
                'wards' => $wards,
                'areas' => $areas,

                'profiles' => $profiles,
                'hotProfiles' => $hotProfiles,
            ]
        );
    }
}