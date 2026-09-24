<div class="min-h-screen bg-slate-50">

    <header class="bg-slate-950 text-white">
        <div class="max-w-5xl mx-auto px-5 py-5 flex justify-between items-center">

            <a href="{{ route('home') }}">
                <h1 class="text-xl font-bold">
                    নির্ভয় বাংলাদেশ
                </h1>

                <p class="text-xs text-slate-400 mt-1">
                    নিরাপদ অভিযোগ জমা
                </p>
            </a>

            <a href="{{ route('home') }}"
               class="text-sm text-slate-300 hover:text-white">
                ← হোমে ফিরুন
            </a>

        </div>
    </header>


    <main class="max-w-4xl mx-auto px-5 py-10">

        @if($submitted)

            <div class="bg-white border rounded-3xl p-8 md:p-12 text-center shadow-sm">

                <div class="w-16 h-16 mx-auto rounded-full
                            bg-emerald-100 text-emerald-700
                            flex items-center justify-center
                            text-2xl font-bold">
                    ✓
                </div>

                <h2 class="text-3xl font-bold mt-6">
                    অভিযোগ সফলভাবে জমা হয়েছে
                </h2>

                <p class="text-slate-500 mt-3">
                    আপনার অভিযোগ এখন প্রশাসনিক পর্যালোচনার জন্য Pending অবস্থায় আছে।
                </p>

                <div class="mt-7 bg-slate-100 rounded-2xl p-5">

                    <p class="text-sm text-slate-500">
                        Tracking Code
                    </p>

                    <p class="text-2xl font-black mt-2 tracking-wide">
                        {{ $trackingCode }}
                    </p>

                </div>

                <p class="text-sm text-amber-700 mt-5">
                    Tracking Code সংরক্ষণ করে রাখুন।
                </p>

                <a href="{{ route('home') }}"
                   class="inline-block mt-8
                          bg-slate-950 text-white
                          px-7 py-3 rounded-xl font-bold">
                    হোমে ফিরুন
                </a>

            </div>

        @else

            <div class="mb-8">

                <p class="text-emerald-600 font-bold text-sm">
                    PUBLIC REPORT
                </p>

                <h2 class="text-3xl md:text-4xl font-black mt-2">
                    অভিযোগ জমা দিন
                </h2>

                <p class="text-slate-500 mt-3 leading-7">
                    যতটা সম্ভব সঠিক তথ্য দিন। অভিযোগ জমা হলেই তা
                    Public Page-এ প্রকাশ হবে না; প্রথমে পর্যালোচনা করা হবে।
                </p>

            </div>


            <form wire:submit="submit"
                  class="space-y-6">

                {{-- Accused information --}}
                <section class="bg-white border rounded-2xl p-6 shadow-sm">

                    <h3 class="text-xl font-bold">
                        ১. সংশ্লিষ্ট ব্যক্তির তথ্য
                    </h3>

                    <div class="grid md:grid-cols-2 gap-5 mt-6">

                        <div>
                            <label class="font-semibold text-sm">
                                নাম *
                            </label>

                            <input type="text"
                                   wire:model="accused_name"
                                   class="mt-2 w-full rounded-xl border-slate-300"
                                   placeholder="ব্যক্তির নাম">

                            @error('accused_name')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="font-semibold text-sm">
                                পরিচিত নাম / উপনাম
                            </label>

                            <input type="text"
                                   wire:model="alias"
                                   class="mt-2 w-full rounded-xl border-slate-300">
                        </div>

                        <div>
                            <label class="font-semibold text-sm">
                                ফোন নম্বর
                            </label>

                            <input type="text"
                                   wire:model="phone"
                                   class="mt-2 w-full rounded-xl border-slate-300">
                        </div>

                        <div>
                            <label class="font-semibold text-sm">
                                সংগঠন / পরিচয়
                            </label>

                            <input type="text"
                                   wire:model="organization"
                                   class="mt-2 w-full rounded-xl border-slate-300">
                        </div>

                    </div>

                </section>


                {{-- Location --}}
                <section class="bg-white border rounded-2xl p-6 shadow-sm">

                    <h3 class="text-xl font-bold">
                        ২. ঘটনার স্থান
                    </h3>

                    <div class="grid md:grid-cols-2 gap-5 mt-6">

                        <div>
                            <label class="font-semibold text-sm">
                                বিভাগ *
                            </label>

                            <select wire:model.live="division_id"
                                    class="mt-2 w-full rounded-xl border-slate-300">

                                <option value="">বিভাগ নির্বাচন করুন</option>

                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">
                                        {{ $division->name_bn }}
                                    </option>
                                @endforeach

                            </select>

                            @error('division_id')
                                <p class="text-red-600 text-sm mt-1">
                                    বিভাগ নির্বাচন করুন।
                                </p>
                            @enderror
                        </div>


                        <div>
                            <label class="font-semibold text-sm">
                                জেলা *
                            </label>

                            <select wire:model.live="district_id"
                                    @disabled(!$division_id)
                                    class="mt-2 w-full rounded-xl border-slate-300">

                                <option value="">জেলা নির্বাচন করুন</option>

                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">
                                        {{ $district->name_bn }}
                                    </option>
                                @endforeach

                            </select>

                            @error('district_id')
                                <p class="text-red-600 text-sm mt-1">
                                    জেলা নির্বাচন করুন।
                                </p>
                            @enderror
                        </div>


                        <div>
                            <label class="font-semibold text-sm">
                                উপজেলা
                            </label>

                            <select wire:model.live="upazila_id"
                                    @disabled(!$district_id)
                                    class="mt-2 w-full rounded-xl border-slate-300">

                                <option value="">উপজেলা নির্বাচন করুন</option>

                                @foreach($upazilas as $upazila)
                                    <option value="{{ $upazila->id }}">
                                        {{ $upazila->name_bn }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                        <div>
                            <label class="font-semibold text-sm">
                                ইউনিয়ন
                            </label>

                            <select wire:model="union_id"
                                    @disabled(!$upazila_id)
                                    class="mt-2 w-full rounded-xl border-slate-300">

                                <option value="">ইউনিয়ন নির্বাচন করুন</option>

                                @foreach($unions as $union)
                                    <option value="{{ $union->id }}">
                                        {{ $union->name_bn }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>


                    <div class="mt-5">

                        <label class="font-semibold text-sm">
                            নির্দিষ্ট স্থান / এলাকা *
                        </label>

                        <input type="text"
                               wire:model="incident_area"
                               class="mt-2 w-full rounded-xl border-slate-300"
                               placeholder="রাস্তা, বাজার, এলাকা বা স্থানের নাম">

                        @error('incident_area')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </section>


                {{-- Incident --}}
                <section class="bg-white border rounded-2xl p-6 shadow-sm">

                    <h3 class="text-xl font-bold">
                        ৩. ঘটনার বিস্তারিত
                    </h3>

                    <div class="grid md:grid-cols-2 gap-5 mt-6">

                        <div>
                            <label class="font-semibold text-sm">
                                ঘটনার তারিখ
                            </label>

                            <input type="date"
                                   wire:model="incident_date"
                                   max="{{ date('Y-m-d') }}"
                                   class="mt-2 w-full rounded-xl border-slate-300">
                        </div>

                        <div>
                            <label class="font-semibold text-sm">
                                আনুমানিক সময়
                            </label>

                            <input type="time"
                                   wire:model="incident_time"
                                   class="mt-2 w-full rounded-xl border-slate-300">
                        </div>

                        <div>
                            <label class="font-semibold text-sm">
                                দাবিকৃত টাকার পরিমাণ
                            </label>

                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   wire:model="amount_demanded"
                                   class="mt-2 w-full rounded-xl border-slate-300"
                                   placeholder="৳">
                        </div>

                        <div>
                            <label class="font-semibold text-sm">
                                প্রদান করা হয়ে থাকলে
                            </label>

                            <input type="number"
                                   min="0"
                                   step="0.01"
                                   wire:model="amount_paid"
                                   class="mt-2 w-full rounded-xl border-slate-300"
                                   placeholder="৳">
                        </div>

                    </div>


                    <div class="mt-5">

                        <label class="font-semibold text-sm">
                            ঘটনার বিস্তারিত বিবরণ *
                        </label>

                        <textarea wire:model="description"
                                  rows="7"
                                  class="mt-2 w-full rounded-xl border-slate-300"
                                  placeholder="কী ঘটেছে, কখন ঘটেছে এবং কীভাবে ঘটেছে বিস্তারিত লিখুন..."></textarea>

                        @error('description')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </section>


                {{-- Evidence --}}
                <section class="bg-white border rounded-2xl p-6 shadow-sm">

                    <h3 class="text-xl font-bold">
                        ৪. প্রমাণ সংযুক্ত করুন
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        সর্বোচ্চ ১০টি file। প্রতি file সর্বোচ্চ 20MB।
                    </p>

                    <input type="file"
                           wire:model="evidence"
                           multiple
                           accept=".jpg,.jpeg,.png,.webp,.pdf,.mp4,.mov,.mp3,.wav,.m4a,.doc,.docx"
                           class="mt-5 block w-full">

                    <div wire:loading wire:target="evidence"
                         class="text-sm text-blue-600 mt-3">
                        File upload হচ্ছে...
                    </div>

                    @error('evidence.*')
                        <p class="text-red-600 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </section>


                {{-- Reporter --}}
                <section class="bg-white border rounded-2xl p-6 shadow-sm">

                    <h3 class="text-xl font-bold">
                        ৫. আপনার তথ্য
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        এই অংশ ঐচ্ছিক। তথ্য Public Page-এ দেখানো হবে না।
                    </p>


                    <label class="mt-5 flex items-start gap-3">

                        <input type="checkbox"
                               wire:model.live="is_anonymous"
                               class="mt-1 rounded">

                        <span>
                            <strong>পরিচয় গোপন রাখতে চাই</strong>

                            <span class="block text-sm text-slate-500 mt-1">
                                Anonymous submission হিসেবে সংরক্ষণ করুন।
                            </span>
                        </span>

                    </label>


                    <div class="grid md:grid-cols-3 gap-5 mt-6">

                        <div>
                            <label class="font-semibold text-sm">
                                নাম
                            </label>

                            <input type="text"
                                   wire:model="reporter_name"
                                   class="mt-2 w-full rounded-xl border-slate-300">
                        </div>

                        <div>
                            <label class="font-semibold text-sm">
                                ফোন
                            </label>

                            <input type="text"
                                   wire:model="reporter_phone"
                                   class="mt-2 w-full rounded-xl border-slate-300">
                        </div>

                        <div>
                            <label class="font-semibold text-sm">
                                Email
                            </label>

                            <input type="email"
                                   wire:model="reporter_email"
                                   class="mt-2 w-full rounded-xl border-slate-300">
                        </div>

                    </div>

                </section>


                {{-- Confirmation --}}
                <div class="bg-amber-50 border border-amber-200
                            rounded-2xl p-5 text-sm text-amber-900 leading-6">

                    অভিযোগ জমা দেওয়ার মাধ্যমে আপনি নিশ্চিত করছেন যে
                    আপনার দেওয়া তথ্য আপনার জানা অনুযায়ী সত্য এবং ইচ্ছাকৃতভাবে
                    মিথ্যা বা বিভ্রান্তিকর তথ্য প্রদান করছেন না।

                </div>


                <button type="submit"
                        wire:loading.attr="disabled"
                        wire:target="submit,evidence"
                        class="w-full bg-emerald-500 hover:bg-emerald-400
                               disabled:opacity-50
                               text-slate-950 font-black
                               text-lg py-4 rounded-xl transition">

                    <span wire:loading.remove wire:target="submit">
                        অভিযোগ জমা দিন
                    </span>

                    <span wire:loading wire:target="submit">
                        জমা হচ্ছে...
                    </span>

                </button>

            </form>

        @endif

    </main>

</div>