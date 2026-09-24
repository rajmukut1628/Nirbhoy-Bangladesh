<div class="min-h-screen bg-slate-50">

    {{-- =====================================================
        TOP HEADER
    ====================================================== --}}
    <header class="relative overflow-hidden bg-slate-950 text-white border-b border-white/10">

        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-72 h-72
                        rounded-full bg-emerald-500/10 blur-3xl"></div>

            <div class="absolute -bottom-32 right-0 w-96 h-96
                        rounded-full bg-blue-500/10 blur-3xl"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-5 sm:px-6 py-5
                    flex items-center justify-between gap-5">

            <a href="{{ route('home') }}"
               class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl
                            bg-emerald-500 text-slate-950
                            flex items-center justify-center
                            font-black text-lg shadow-lg">
                    নি
                </div>

                <div>
                    <h1 class="text-xl font-black">
                        নির্ভয় বাংলাদেশ
                    </h1>

                    <p class="text-xs text-slate-400 mt-1">
                        নিরাপদ অভিযোগ ও তথ্য প্রদান
                    </p>
                </div>

            </a>


            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2
                      border border-white/10
                      bg-white/5 hover:bg-white/10
                      px-4 py-2.5 rounded-xl
                      text-sm font-semibold
                      text-slate-300 hover:text-white transition">

                <span>←</span>
                <span class="hidden sm:inline">হোমে ফিরুন</span>

            </a>

        </div>

    </header>



    {{-- =====================================================
        SUCCESS SCREEN
    ====================================================== --}}

    @if($submitted)

        <main class="max-w-3xl mx-auto px-5 py-16">

            <div class="bg-white border border-slate-200
                        rounded-3xl p-7 md:p-12
                        text-center shadow-xl shadow-slate-200/50">

                <div class="w-20 h-20 mx-auto
                            rounded-full bg-emerald-100
                            flex items-center justify-center">

                    <div class="w-12 h-12 rounded-full
                                bg-emerald-500 text-white
                                flex items-center justify-center
                                text-2xl font-black">
                        ✓
                    </div>

                </div>

                <p class="text-emerald-600
                          text-sm font-black
                          tracking-wider mt-7">
                    SUBMISSION SUCCESSFUL
                </p>

                <h2 class="text-3xl md:text-4xl
                           font-black text-slate-950 mt-3">
                    অভিযোগ সফলভাবে জমা হয়েছে
                </h2>

                <p class="text-slate-500 mt-4 leading-7">
                    আপনার অভিযোগটি গ্রহণ করা হয়েছে এবং এখন
                    প্রশাসনিক পর্যালোচনার জন্য
                    <strong class="text-slate-700">Pending</strong>
                    অবস্থায় রয়েছে।
                </p>


                <div class="mt-8 rounded-2xl
                            bg-slate-950 text-white
                            p-6">

                    <p class="text-xs text-slate-400 uppercase tracking-widest">
                        আপনার Tracking Code
                    </p>

                    <p class="text-2xl md:text-3xl
                              font-black tracking-wider mt-3
                              text-emerald-400">
                        {{ $trackingCode }}
                    </p>

                </div>


                <div class="mt-5 rounded-xl
                            bg-amber-50 border border-amber-200
                            p-4 text-sm text-amber-900">
                    Tracking Code-টি সংরক্ষণ করে রাখুন।
                </div>


                <a href="{{ route('home') }}"
                   class="inline-flex mt-8
                          bg-emerald-500 hover:bg-emerald-400
                          text-slate-950
                          px-7 py-3.5 rounded-xl
                          font-black transition">

                    হোম পেজে ফিরে যান

                </a>

            </div>

        </main>

    @else



    {{-- =====================================================
        PAGE INTRO
    ====================================================== --}}

    <section class="relative overflow-hidden bg-slate-950 text-white">

        <div class="absolute inset-0 pointer-events-none">

            <div class="absolute left-1/4 top-0
                        w-96 h-96 bg-emerald-500/10
                        rounded-full blur-3xl">
            </div>

        </div>


        <div class="relative max-w-6xl mx-auto
                    px-5 sm:px-6
                    pt-12 pb-24">

            <div class="max-w-3xl">

                <div class="inline-flex items-center gap-2
                            bg-emerald-500/10
                            border border-emerald-400/20
                            text-emerald-300
                            rounded-full px-4 py-2
                            text-xs font-bold">

                    <span class="w-2 h-2 bg-emerald-400 rounded-full"></span>

                    PUBLIC REPORT SUBMISSION

                </div>


                <h2 class="text-4xl md:text-5xl
                           font-black mt-6 leading-tight">

                    নিরাপদভাবে
                    <span class="text-emerald-400">
                        অভিযোগ জমা দিন
                    </span>

                </h2>

            </div>

        </div>

    </section>



    {{-- =====================================================
        MAIN FORM
    ====================================================== --}}

    <main class="relative max-w-5xl mx-auto
                 px-4 sm:px-6
                 -mt-12 pb-20">

        <form wire:submit="submit"
              class="space-y-7">
              @if($submitError)
    <div
        class="rounded-2xl border border-red-200
               bg-red-50 px-5 py-4
               text-sm font-semibold text-red-700"
    >
        {{ $submitError }}
    </div>
@endif


            {{-- =================================================
                SECTION 1
            ================================================== --}}

            <section class="bg-white
                            border border-slate-200
                            rounded-3xl
                            shadow-xl shadow-slate-200/40
                            overflow-hidden">

                <div class="border-b border-slate-100
                            bg-slate-50/70
                            px-6 md:px-8 py-5">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 shrink-0
                                    rounded-xl bg-slate-950
                                    text-white
                                    flex items-center justify-center
                                    font-black">
                            01
                        </div>

                        <div>
                            <h3 class="text-xl font-black text-slate-950">
                                সংশ্লিষ্ট ব্যক্তির তথ্য
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                যার বিষয়ে অভিযোগ করছেন তার তথ্য প্রদান করুন।
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6 md:p-8">

                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- Name --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                নাম
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                wire:model="accused_name"
                                placeholder="সম্পূর্ণ নাম লিখুন"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       bg-white px-4 py-3
                                       text-slate-900
                                       placeholder:text-slate-400
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                            @error('accused_name')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Alias --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                পরিচিত নাম / উপনাম
                            </label>

                            <input
                                type="text"
                                wire:model="alias"
                                placeholder="যদি থাকে"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                        </div>


                        {{-- Phone --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                ফোন নম্বর
                            </label>

                            <input
                                type="text"
                                wire:model="phone"
                                placeholder="যদি জানা থাকে"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                        </div>


                        {{-- Organization --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                সংগঠন / পরিচয়
                            </label>

                            <input
                                type="text"
                                wire:model="organization"
                                placeholder="সংগঠন, প্রতিষ্ঠান বা অন্যান্য পরিচয়"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                        </div>

                    </div>

                </div>

            </section>



            {{-- =================================================
                SECTION 2 - LOCATION
            ================================================== --}}

            <section class="bg-white
                            border border-slate-200
                            rounded-3xl
                            shadow-sm overflow-hidden">

                <div class="border-b border-slate-100
                            bg-slate-50/70
                            px-6 md:px-8 py-5">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 shrink-0
                                    rounded-xl bg-emerald-500
                                    text-slate-950
                                    flex items-center justify-center
                                    font-black">
                            02
                        </div>

                        <div>
                            <h3 class="text-xl font-black">
                                ঘটনার স্থান
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                ঘটনাটি কোথায় ঘটেছে তা নির্বাচন করুন।
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6 md:p-8">

                    <div class="grid md:grid-cols-2 gap-6">


                        {{-- Division --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                বিভাগ
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                wire:model.live="division_id"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500">

                                <option value="">
                                    বিভাগ নির্বাচন করুন
                                </option>

                                @foreach($divisions as $division)

                                    <option value="{{ $division->id }}">
                                        {{ $division->name_bn }}
                                    </option>

                                @endforeach

                            </select>

                            @error('division_id')
                                <p class="text-red-600 text-sm mt-2">
                                    বিভাগ নির্বাচন করুন।
                                </p>
                            @enderror

                        </div>



                        {{-- District --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                জেলা
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                wire:model.live="district_id"
                                @disabled(!$division_id)
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       disabled:bg-slate-100
                                       disabled:text-slate-400
                                       focus:border-emerald-500
                                       focus:ring-emerald-500">

                                <option value="">
                                    জেলা নির্বাচন করুন
                                </option>

                                @foreach($districts as $district)

                                    <option value="{{ $district->id }}">
                                        {{ $district->name_bn }}
                                    </option>

                                @endforeach

                            </select>

                            @error('district_id')
                                <p class="text-red-600 text-sm mt-2">
                                    জেলা নির্বাচন করুন।
                                </p>
                            @enderror

                        </div>



                        {{-- Upazila --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                উপজেলা
                            </label>

                            <select
                                wire:model.live="upazila_id"
                                @disabled(!$district_id)
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       disabled:bg-slate-100
                                       disabled:text-slate-400
                                       focus:border-emerald-500
                                       focus:ring-emerald-500">

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
                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                ইউনিয়ন
                            </label>

                            <select
                                wire:model="union_id"
                                @disabled(!$upazila_id)
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       disabled:bg-slate-100
                                       disabled:text-slate-400
                                       focus:border-emerald-500
                                       focus:ring-emerald-500">

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


                    {{-- Exact area --}}
                    <div class="mt-6">

                        <label class="block text-sm font-bold text-slate-700">
                            নির্দিষ্ট স্থান / এলাকা
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            wire:model="incident_area"
                            placeholder="যেমন: বাজার, রাস্তা, মহল্লা বা নির্দিষ্ট স্থানের নাম"
                            class="mt-2.5 w-full
                                   rounded-xl border-slate-300
                                   px-4 py-3
                                   focus:border-emerald-500
                                   focus:ring-emerald-500"
                        >

                        @error('incident_area')
                            <p class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>



            {{-- =================================================
                SECTION 3 - INCIDENT
            ================================================== --}}

            <section class="bg-white
                            border border-slate-200
                            rounded-3xl
                            shadow-sm overflow-hidden">

                <div class="border-b border-slate-100
                            bg-slate-50/70
                            px-6 md:px-8 py-5">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 shrink-0
                                    rounded-xl bg-blue-600
                                    text-white
                                    flex items-center justify-center
                                    font-black">
                            03
                        </div>

                        <div>
                            <h3 class="text-xl font-black">
                                ঘটনার বিস্তারিত
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                ঘটনা সম্পর্কে যতটা সম্ভব বিস্তারিত তথ্য দিন।
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6 md:p-8">

                    <div class="grid md:grid-cols-2 gap-6">


                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                ঘটনার তারিখ
                            </label>

                            <input
                                type="date"
                                wire:model="incident_date"
                                max="{{ date('Y-m-d') }}"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                            @error('incident_date')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                আনুমানিক সময়
                            </label>

                            <input
                                type="time"
                                wire:model="incident_time"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                        </div>


                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                দাবিকৃত টাকার পরিমাণ
                            </label>

                            <div class="relative mt-2.5">

                                <span class="absolute left-4 top-1/2
                                             -translate-y-1/2
                                             font-bold text-slate-500">
                                    ৳
                                </span>

                                <input
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    wire:model="amount_demanded"
                                    placeholder="0"
                                    class="w-full rounded-xl
                                           border-slate-300
                                           pl-9 pr-4 py-3
                                           focus:border-emerald-500
                                           focus:ring-emerald-500"
                                >

                            </div>

                        </div>


                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                প্রদান করা হয়ে থাকলে
                            </label>

                            <div class="relative mt-2.5">

                                <span class="absolute left-4 top-1/2
                                             -translate-y-1/2
                                             font-bold text-slate-500">
                                    ৳
                                </span>

                                <input
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    wire:model="amount_paid"
                                    placeholder="0"
                                    class="w-full rounded-xl
                                           border-slate-300
                                           pl-9 pr-4 py-3
                                           focus:border-emerald-500
                                           focus:ring-emerald-500"
                                >

                            </div>

                        </div>

                    </div>


                    <div class="mt-6">

                        <div class="flex justify-between gap-4">

                            <label class="block text-sm font-bold text-slate-700">
                                ঘটনার বিস্তারিত বিবরণ
                                <span class="text-red-500">*</span>
                            </label>

                            <span class="text-xs text-slate-400">
                                বিস্তারিত লিখুন
                            </span>

                        </div>

                        <textarea
                            wire:model="description"
                            rows="8"
                            placeholder="কী ঘটেছে, কীভাবে ঘটেছে, কারা উপস্থিত ছিল এবং অন্যান্য প্রয়োজনীয় তথ্য বিস্তারিত লিখুন..."
                            class="mt-2.5 w-full
                                   rounded-xl border-slate-300
                                   px-4 py-3
                                   resize-y
                                   focus:border-emerald-500
                                   focus:ring-emerald-500"></textarea>

                        @error('description')
                            <p class="text-red-600 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>



            {{-- =================================================
                SECTION 4 - EVIDENCE
            ================================================== --}}

            <section class="bg-white
                            border border-slate-200
                            rounded-3xl
                            shadow-sm overflow-hidden">

                <div class="border-b border-slate-100
                            bg-slate-50/70
                            px-6 md:px-8 py-5">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 shrink-0
                                    rounded-xl bg-violet-600
                                    text-white
                                    flex items-center justify-center
                                    font-black">
                            04
                        </div>

                        <div>
                            <h3 class="text-xl font-black">
                                প্রমাণ সংযুক্ত করুন
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                প্রমাণ থাকলে অভিযোগ যাচাই করা সহজ হবে।
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6 md:p-8">

                    <label class="block cursor-pointer
                                  border-2 border-dashed
                                  border-slate-300
                                  hover:border-emerald-400
                                  hover:bg-emerald-50/40
                                  rounded-2xl
                                  px-6 py-10
                                  text-center transition">

                        <div class="w-14 h-14 mx-auto
                                    rounded-2xl bg-slate-100
                                    flex items-center justify-center
                                    text-2xl">
                            ↑
                        </div>

                        <h4 class="font-black text-lg mt-4">
                            Evidence নির্বাচন করুন
                        </h4>

                        <p class="text-sm text-slate-500 mt-2">
                            ছবি, ভিডিও, অডিও, PDF অথবা Document
                        </p>

                        <p class="text-xs text-slate-400 mt-2">
                            সর্বোচ্চ ১০টি file • প্রতি file সর্বোচ্চ 20MB
                        </p>

                        <input
                            type="file"
                            wire:model="evidence"
                            multiple
                            accept=".jpg,.jpeg,.png,.webp,.pdf,.mp4,.mov,.mp3,.wav,.m4a,.doc,.docx"
                            class="hidden"
                        >

                    </label>


                    {{-- Selected Files --}}
                    @if(count($evidence) > 0)

                        <div class="mt-5
                                    bg-slate-50 border
                                    rounded-xl p-4">

                            <p class="font-bold text-sm">
                                নির্বাচিত File: {{ count($evidence) }} টি
                            </p>

                            <div class="mt-3 space-y-2">

                                @foreach($evidence as $file)

                                    <div class="flex items-center
                                                justify-between gap-3
                                                bg-white border
                                                rounded-lg px-3 py-2">

                                        <span class="text-sm text-slate-600 truncate">
                                            {{ $file->getClientOriginalName() }}
                                        </span>

                                        <span class="text-xs text-emerald-600 font-bold">
                                            Ready
                                        </span>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    <div wire:loading
                         wire:target="evidence"
                         class="mt-4 rounded-xl
                                bg-blue-50 border border-blue-200
                                px-4 py-3 text-sm text-blue-700">

                        Evidence upload হচ্ছে, অপেক্ষা করুন...

                    </div>


                    @error('evidence')
                        <p class="text-red-600 text-sm mt-3">
                            {{ $message }}
                        </p>
                    @enderror

                    @error('evidence.*')
                        <p class="text-red-600 text-sm mt-3">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </section>



            {{-- =================================================
                SECTION 5 - REPORTER
            ================================================== --}}

            <section class="bg-white
                            border border-slate-200
                            rounded-3xl
                            shadow-sm overflow-hidden">

                <div class="border-b border-slate-100
                            bg-slate-50/70
                            px-6 md:px-8 py-5">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 shrink-0
                                    rounded-xl bg-amber-500
                                    text-slate-950
                                    flex items-center justify-center
                                    font-black">
                            05
                        </div>

                        <div>
                            <h3 class="text-xl font-black">
                                আপনার তথ্য
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                এই অংশটি ঐচ্ছিক এবং Public Page-এ দেখানো হবে না।
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6 md:p-8">


                    {{-- Anonymous Box --}}
                    <label class="flex items-start gap-4
                                  cursor-pointer
                                  bg-emerald-50
                                  border border-emerald-200
                                  rounded-2xl p-5">

                        <input
                            type="checkbox"
                            wire:model.live="is_anonymous"
                            class="mt-1 w-5 h-5
                                   rounded border-slate-300
                                   text-emerald-600
                                   focus:ring-emerald-500"
                        >

                        <div>

                            <p class="font-black text-slate-900">
                                আমার পরিচয় গোপন রাখতে চাই
                            </p>

                            <p class="text-sm text-slate-600 mt-1 leading-6">
                                অভিযোগটি Anonymous submission হিসেবে সংরক্ষণ করা হবে।
                            </p>

                        </div>

                    </label>


                    <div class="grid md:grid-cols-3 gap-6 mt-6">

                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                আপনার নাম
                            </label>

                            <input
                                type="text"
                                wire:model="reporter_name"
                                placeholder="ঐচ্ছিক"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                        </div>


                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                ফোন নম্বর
                            </label>

                            <input
                                type="text"
                                wire:model="reporter_phone"
                                placeholder="ঐচ্ছিক"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                        </div>


                        <div>

                            <label class="block text-sm font-bold text-slate-700">
                                Email
                            </label>

                            <input
                                type="email"
                                wire:model="reporter_email"
                                placeholder="ঐচ্ছিক"
                                class="mt-2.5 w-full
                                       rounded-xl border-slate-300
                                       px-4 py-3
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
                            >

                            @error('reporter_email')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </section>



            {{-- =================================================
                FINAL SUBMISSION
            ================================================== --}}

            <section class="bg-slate-950
                            text-white
                            rounded-3xl
                            overflow-hidden shadow-xl">

                <div class="p-6 md:p-8">

                    <div class="flex items-start gap-4">

                        <div class="w-10 h-10 shrink-0
                                    rounded-xl bg-amber-400/10
                                    text-amber-300
                                    flex items-center justify-center
                                    font-black">
                            !
                        </div>

                        <div>

                            <h3 class="font-black text-lg">
                                জমা দেওয়ার আগে নিশ্চিত করুন
                            </h3>

                            <p class="text-sm text-slate-400
                                      mt-2 leading-6">

                                আপনার জানা অনুযায়ী সঠিক তথ্য প্রদান করুন।
                                ইচ্ছাকৃতভাবে মিথ্যা, বিভ্রান্তিকর বা হয়রানিমূলক
                                তথ্য জমা দেওয়া থেকে বিরত থাকুন।

                            </p>

                        </div>

                    </div>


                    <div class="border-t border-white/10 mt-6 pt-6">

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="submit,evidence"
                            class="w-full
                                   bg-emerald-500
                                   hover:bg-emerald-400
                                   disabled:bg-slate-700
                                   disabled:text-slate-400
                                   text-slate-950
                                   font-black text-lg
                                   py-4 px-6
                                   rounded-xl
                                   transition shadow-lg">

                            <span wire:loading.remove
                                  wire:target="submit">
                                অভিযোগ জমা দিন
                            </span>

                            <span wire:loading
                                  wire:target="submit">
                                অভিযোগ জমা হচ্ছে...
                            </span>

                        </button>


                        <p class="text-center text-xs
                                  text-slate-500 mt-4">
                            অভিযোগ জমা হলেই তা Public Page-এ প্রকাশ হবে না।
                        </p>

                    </div>

                </div>

            </section>

        </form>

    </main>

    @endif



    {{-- =====================================================
        FOOTER
    ====================================================== --}}

    <footer class="bg-white border-t">

        <div class="max-w-5xl mx-auto
                    px-5 py-8 text-center">

            <p class="font-bold text-slate-800">
                নির্ভয় বাংলাদেশ
            </p>

            <p class="text-xs text-slate-400 mt-2">
                নিরাপদ অভিযোগ ও যাচাইকৃত তথ্য প্ল্যাটফর্ম
            </p>

            <p class="text-xs text-slate-400 mt-5">
                © {{ date('Y') }} নির্ভয় বাংলাদেশ
            </p>

        </div>

    </footer>

</div>