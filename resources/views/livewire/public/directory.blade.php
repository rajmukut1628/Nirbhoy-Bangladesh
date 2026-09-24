<div class="space-y-8">

    {{-- ============================================================
        LOCATION SEARCH SECTION
    ============================================================ --}}
    <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">

        <div class="mb-6">
            <p class="mb-2 text-sm font-semibold text-red-600">
                এলাকা ভিত্তিক অনুসন্ধান
            </p>

            <h2 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                এলাকা অনুযায়ী যাচাইকৃত তথ্য খুঁজুন
            </h2>

            <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600">
                বিভাগ, জেলা এবং স্থানীয় প্রশাসনিক এলাকা নির্বাচন করে
                প্রকাশিত ও পর্যালোচিত তথ্য খুঁজুন।
            </p>
        </div>


        {{-- ========================================================
            FILTER BOX
        ======================================================== --}}
        <div class="rounded-2xl bg-slate-50 p-4 sm:p-6">

            <div class="mb-5">
                <h3 class="text-lg font-bold text-slate-900">
                    এলাকা অনুযায়ী খুঁজুন
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    প্রথমে বিভাগ ও জেলা নির্বাচন করুন।
                </p>
            </div>


            {{-- ====================================================
                DIVISION + DISTRICT
            ==================================================== --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                {{-- Division --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        বিভাগ
                    </label>

                    <select
                        wire:model.live="division_id"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3
                               text-sm text-slate-800 outline-none transition
                               focus:border-red-500 focus:ring-2 focus:ring-red-100"
                    >
                        <option value="">
                            বিভাগ নির্বাচন করুন
                        </option>

                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}">
                                {{ $division->name_bn }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- District --}}
                <div wire:key="district-select-{{ $division_id ?: 'none' }}">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        জেলা
                    </label>

                    <select
                        wire:model.live="district_id"
                        @disabled(!$division_id)
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3
                               text-sm text-slate-800 outline-none transition
                               focus:border-red-500 focus:ring-2 focus:ring-red-100
                               disabled:cursor-not-allowed disabled:bg-slate-100
                               disabled:text-slate-400"
                    >
                        <option value="">
                            জেলা নির্বাচন করুন
                        </option>

                        @foreach($districts as $district)
                            <option value="{{ $district->id }}">
                                {{ $district->name_bn }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>


            {{-- ====================================================
                LOCATION TYPE
            ==================================================== --}}
            @if($district_id)

                <div
                    class="mt-4"
                    wire:key="location-type-{{ $district_id }}"
                >
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        এলাকার ধরন
                    </label>

                    <select
                        wire:model.live="location_type"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3
                               text-sm text-slate-800 outline-none transition
                               focus:border-red-500 focus:ring-2 focus:ring-red-100"
                    >
                        <option value="">
                            এলাকার ধরন নির্বাচন করুন
                        </option>

                        @if($upazilas->isNotEmpty())
                            <option value="upazila">
                                উপজেলা / ইউনিয়ন
                            </option>
                        @endif

                        @if($thanas->isNotEmpty())
                            <option value="thana">
                                থানা / ওয়ার্ড / এলাকা
                            </option>
                        @endif
                    </select>
                </div>

            @endif


            {{-- ====================================================
                RURAL LOCATION
                UPAZILA → UNION
            ==================================================== --}}
            @if($district_id && $location_type === 'upazila')

                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">

                    {{-- Upazila --}}
                    <div
                        wire:key="upazila-select-{{ $district_id }}"
                    >
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            উপজেলা
                        </label>

                        <select
                            wire:model.live="upazila_id"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3
                                   text-sm text-slate-800 outline-none transition
                                   focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        >
                            <option value="">
                                উপজেলা নির্বাচন করুন
                            </option>

                            @foreach($upazilas as $upazila)
                                <option value="{{ $upazila->id }}">
                                    {{ $upazila->name_bn }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Union --}}
                    <div
                        wire:key="union-select-{{ $upazila_id ?: 'none' }}"
                    >
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            ইউনিয়ন
                        </label>

                        <select
                            wire:model.live="union_id"
                            @disabled(!$upazila_id)
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3
                                   text-sm text-slate-800 outline-none transition
                                   focus:border-red-500 focus:ring-2 focus:ring-red-100
                                   disabled:cursor-not-allowed disabled:bg-slate-100
                                   disabled:text-slate-400"
                        >
                            <option value="">
                                ইউনিয়ন নির্বাচন করুন
                            </option>

                            @foreach($unions as $union)
                                <option value="{{ $union->id }}">
                                    {{ $union->name_bn }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

            @endif


            {{-- ====================================================
                CITY LOCATION
                THANA → WARD → AREA
            ==================================================== --}}
            @if($district_id && $location_type === 'thana')

                <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">

                    {{-- Thana --}}
                    <div
                        wire:key="thana-select-{{ $district_id }}"
                    >
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            থানা
                        </label>

                        <select
                            wire:model.live="thana_id"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3
                                   text-sm text-slate-800 outline-none transition
                                   focus:border-red-500 focus:ring-2 focus:ring-red-100"
                        >
                            <option value="">
                                থানা নির্বাচন করুন
                            </option>

                            @foreach($thanas as $thana)
                                <option value="{{ $thana->id }}">
                                    {{ $thana->name_bn }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Ward --}}
                    <div
                        wire:key="ward-select-{{ $thana_id ?: 'none' }}"
                    >
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            ওয়ার্ড
                            <span class="font-normal text-slate-400">
                                (ঐচ্ছিক)
                            </span>
                        </label>

                        <select
                            wire:model.live="ward_id"
                            @disabled(!$thana_id || $wards->isEmpty())
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3
                                   text-sm text-slate-800 outline-none transition
                                   focus:border-red-500 focus:ring-2 focus:ring-red-100
                                   disabled:cursor-not-allowed disabled:bg-slate-100
                                   disabled:text-slate-400"
                        >
                            <option value="">
                                @if($thana_id && $wards->isEmpty())
                                    ওয়ার্ড তথ্য পাওয়া যায়নি
                                @else
                                    ওয়ার্ড নির্বাচন করুন
                                @endif
                            </option>

                            @foreach($wards as $ward)
                                <option value="{{ $ward->id }}">
                                    ওয়ার্ড {{ $ward->ward_number }}
                                    @if($ward->name_bn)
                                        — {{ $ward->name_bn }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Area --}}
                    <div
                        wire:key="area-select-{{ $thana_id ?: 'none' }}-{{ $ward_id ?: 'all' }}"
                    >
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            এলাকা
                            <span class="font-normal text-slate-400">
                                (ঐচ্ছিক)
                            </span>
                        </label>

                        <select
                            wire:model.live="area_id"
                            @disabled(!$thana_id || $areas->isEmpty())
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3
                                   text-sm text-slate-800 outline-none transition
                                   focus:border-red-500 focus:ring-2 focus:ring-red-100
                                   disabled:cursor-not-allowed disabled:bg-slate-100
                                   disabled:text-slate-400"
                        >
                            <option value="">
                                @if($thana_id && $areas->isEmpty())
                                    এলাকা তথ্য পাওয়া যায়নি
                                @else
                                    এলাকা নির্বাচন করুন
                                @endif
                            </option>

                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">
                                    {{ $area->name_bn }}

                                    @if($area->name_en)
                                        ({{ $area->name_en }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

            @endif


            {{-- ====================================================
                TEXT SEARCH
            ==================================================== --}}
            <div class="mt-4">

                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    নাম বা তথ্য দিয়ে খুঁজুন
                </label>

                <div class="flex flex-col gap-3 sm:flex-row">

                    <input
                        type="text"
                        wire:model.live.debounce.500ms="search"
                        placeholder="নাম, পরিচিত নাম, প্রতিষ্ঠান বা এলাকা লিখুন..."
                        class="min-w-0 flex-1 rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm text-slate-800
                               outline-none transition
                               placeholder:text-slate-400
                               focus:border-red-500 focus:ring-2
                               focus:ring-red-100"
                    >

                    <button
                        type="button"
                        wire:click="resetFilters"
                        class="rounded-xl border border-slate-300 bg-white
                               px-5 py-3 text-sm font-semibold text-slate-700
                               transition hover:border-slate-400
                               hover:bg-slate-100"
                    >
                        সব ফিল্টার মুছুন
                    </button>

                </div>

            </div>


            {{-- Loading --}}
            <div
                wire:loading
                class="mt-4 text-sm font-medium text-slate-500"
            >
                তথ্য খোঁজা হচ্ছে...
            </div>

        </div>

    </section>


    {{-- ============================================================
        HOT LIST
    ============================================================ --}}
    @if($hotProfiles->isNotEmpty())

        <section class="space-y-5">

            <div>
                <p class="mb-1 text-sm font-semibold text-red-600">
                    গুরুত্বপূর্ণ
                </p>

                <h2 class="text-2xl font-bold text-slate-900">
                    হট লিস্ট
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    প্রশাসনিক পর্যালোচনার পর প্রকাশের জন্য নির্বাচিত তথ্য।
                </p>
            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

                @foreach($hotProfiles as $profile)

                    <article
                        wire:key="hot-profile-{{ $profile->id }}"
                        class="relative overflow-hidden rounded-2xl
                               border border-red-100 bg-white p-5 shadow-sm"
                    >

                        <div class="absolute right-0 top-0 rounded-bl-xl
                                    bg-red-600 px-3 py-1 text-xs
                                    font-bold text-white">
                            হট লিস্ট
                        </div>


                        <div class="pr-16">

                            <h3 class="text-lg font-bold text-slate-900">
                                {{ $profile->name }}
                            </h3>

                            @if($profile->alias)
                                <p class="mt-1 text-sm text-slate-500">
                                    পরিচিত নাম: {{ $profile->alias }}
                                </p>
                            @endif

                        </div>


                        @if($profile->organization)
                            <p class="mt-4 text-sm text-slate-700">
                                <span class="font-semibold">
                                    প্রতিষ্ঠান:
                                </span>

                                {{ $profile->organization }}
                            </p>
                        @endif


                        @if($profile->occupation)
                            <p class="mt-2 text-sm text-slate-700">
                                <span class="font-semibold">
                                    পরিচয়/পেশা:
                                </span>

                                {{ $profile->occupation }}
                            </p>
                        @endif


                        {{-- Location --}}
                        <div class="mt-4 rounded-xl bg-slate-50 p-3">

                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                এলাকা
                            </p>

                            <p class="mt-1 text-sm font-medium text-slate-700">

                                @if($profile->area)
                                    {{ $profile->area }}
                                @elseif($profile->ward)
                                    ওয়ার্ড {{ $profile->ward->ward_number }}
                                @elseif($profile->thana)
                                    {{ $profile->thana->name_bn }}
                                @elseif($profile->union)
                                    {{ $profile->union->name_bn }}
                                @elseif($profile->upazila)
                                    {{ $profile->upazila->name_bn }}
                                @elseif($profile->district)
                                    {{ $profile->district->name_bn }}
                                @else
                                    এলাকা উল্লেখ করা হয়নি
                                @endif

                            </p>

                        </div>


                        <div class="mt-4 border-t border-slate-100 pt-3">

                            <p class="text-xs leading-5 text-slate-500">
                                এই তথ্য প্রকাশের আগে প্রশাসনিকভাবে
                                পর্যালোচনা করা হয়েছে। এটি আদালতের
                                দোষী সাব্যস্ত করার সিদ্ধান্ত নয়।
                            </p>

                        </div>

                    </article>

                @endforeach

            </div>

        </section>

    @endif


    {{-- ============================================================
        SEARCH RESULTS
    ============================================================ --}}
    <section class="space-y-5">

        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="mb-1 text-sm font-semibold text-red-600">
                       পাবলিক ডিরেক্টরি
                </p>

                <h2 class="text-2xl font-bold text-slate-900">
                       যাচাইকৃত প্রকাশিত তথ্য
                </h2>
            </div>


            <div class="text-sm text-slate-500">
                মোট ফলাফল:
                <span class="font-bold text-slate-900">
                    {{ $profiles->count() }}
                </span>
            </div>

        </div>


        @if($profiles->isEmpty())

            <div class="rounded-2xl border border-dashed border-slate-300
                        bg-slate-50 px-6 py-12 text-center">

                <h3 class="text-lg font-bold text-slate-800">
                    কোনো তথ্য পাওয়া যায়নি
                </h3>

                <p class="mx-auto mt-2 max-w-xl text-sm leading-6 text-slate-500">
                    নির্বাচিত এলাকা বা অনুসন্ধানের সাথে মিলে এমন
                    কোনো প্রকাশিত তথ্য বর্তমানে নেই।
                </p>

            </div>

        @else

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

                @foreach($profiles as $profile)

                    <article
                        wire:key="profile-{{ $profile->id }}"
                        class="rounded-2xl border border-slate-200
                               bg-white p-5 shadow-sm transition
                               hover:-translate-y-0.5 hover:shadow-md"
                    >

                        {{-- Name --}}
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">
                                {{ $profile->name }}
                            </h3>

                            @if($profile->alias)
                                <p class="mt-1 text-sm text-slate-500">
                                    পরিচিত নাম: {{ $profile->alias }}
                                </p>
                            @endif
                        </div>


                        {{-- Basic Info --}}
                        <div class="mt-4 space-y-2">

                            @if($profile->organization)
                                <p class="text-sm text-slate-700">
                                    <span class="font-semibold">
                                        প্রতিষ্ঠান:
                                    </span>

                                    {{ $profile->organization }}
                                </p>
                            @endif


                            @if($profile->occupation)
                                <p class="text-sm text-slate-700">
                                    <span class="font-semibold">
                                        পরিচয়/পেশা:
                                    </span>

                                    {{ $profile->occupation }}
                                </p>
                            @endif

                        </div>


                        {{-- Location Details --}}
                        <div class="mt-4 rounded-xl bg-slate-50 p-4">

                            <p class="mb-2 text-xs font-bold uppercase
                                      tracking-wide text-slate-400">
                                অবস্থান
                            </p>


                            @if($profile->division)
                                <p class="text-sm text-slate-700">
                                    <span class="font-semibold">
                                        বিভাগ:
                                    </span>

                                    {{ $profile->division->name_bn }}
                                </p>
                            @endif


                            @if($profile->district)
                                <p class="mt-1 text-sm text-slate-700">
                                    <span class="font-semibold">
                                        জেলা:
                                    </span>

                                    {{ $profile->district->name_bn }}
                                </p>
                            @endif


                            {{-- Rural --}}
                            @if($profile->upazila)

                                <p class="mt-1 text-sm text-slate-700">
                                    <span class="font-semibold">
                                        উপজেলা:
                                    </span>

                                    {{ $profile->upazila->name_bn }}
                                </p>

                            @endif


                            @if($profile->union)

                                <p class="mt-1 text-sm text-slate-700">
                                    <span class="font-semibold">
                                        ইউনিয়ন:
                                    </span>

                                    {{ $profile->union->name_bn }}
                                </p>

                            @endif


                            {{-- City --}}
                            @if($profile->thana)

                                <p class="mt-1 text-sm text-slate-700">
                                    <span class="font-semibold">
                                        থানা:
                                    </span>

                                    {{ $profile->thana->name_bn }}
                                </p>

                            @endif


                            @if($profile->ward)

                                <p class="mt-1 text-sm text-slate-700">
                                    <span class="font-semibold">
                                        ওয়ার্ড:
                                    </span>

                                    {{ $profile->ward->ward_number }}
                                </p>

                            @endif


                            @if($profile->area)

                                <p class="mt-1 text-sm text-slate-700">
                                    <span class="font-semibold">
                                        এলাকা:
                                    </span>

                                    {{ $profile->area }}
                                </p>

                            @endif

                        </div>


                        {{-- Description --}}
                        @if($profile->description)

                            <div class="mt-4">

                                <p class="text-sm leading-6 text-slate-600">
                                    {{ \Illuminate\Support\Str::limit(
                                        $profile->description,
                                        180
                                    ) }}
                                </p>

                            </div>

                        @endif


                        {{-- Status --}}
                        <div class="mt-5 flex items-center justify-between
                                    border-t border-slate-100 pt-4">

                            <span class="inline-flex rounded-full
                                         bg-emerald-50 px-3 py-1
                                         text-xs font-bold text-emerald-700">
                                পর্যালোচিত
                            </span>

                            @if($profile->is_hot)

                                <span class="inline-flex rounded-full
                                             bg-red-50 px-3 py-1
                                             text-xs font-bold text-red-700">
                                    হট লিস্ট
                                </span>

                            @endif

                        </div>


                        {{-- Disclaimer --}}
                        <p class="mt-3 text-xs leading-5 text-slate-400">
                            প্রকাশিত তথ্য প্রশাসনিক পর্যালোচনার ভিত্তিতে
                            প্রদর্শিত হচ্ছে; এটি কোনো আদালতের রায় নয়।
                        </p>

                    </article>

                @endforeach

            </div>

        @endif

    </section>

</div>