<!DOCTYPE html>

<html lang="bn">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="নির্ভয় বাংলাদেশ - নিরাপদভাবে অভিযোগ জমা দিন এবং পর্যালোচিত জনস্বার্থ সংশ্লিষ্ট তথ্য দেখুন।"
    >

    <meta name="theme-color" content="#020617">

    <title>
        নির্ভয় বাংলাদেশ | নিরাপদ অভিযোগ ও পর্যালোচিত তথ্য
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @livewireStyles


    {{-- ============================================================
        PREMIUM PAGE STYLES
    ============================================================ --}}

    <style>

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family:
                Arial,
                "Noto Sans Bengali",
                sans-serif;
        }


        /* =========================================================
           GLOBAL
        ========================================================= */

        [x-cloak] {
            display: none !important;
        }

        ::selection {
            background: #10b981;
            color: #020617;
        }


        /* =========================================================
           BACKGROUND GRID
        ========================================================= */

        .premium-grid {
            background-image:
                linear-gradient(
                    rgba(255,255,255,.035) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(255,255,255,.035) 1px,
                    transparent 1px
                );

            background-size: 42px 42px;
        }


        /* =========================================================
           GLASS
        ========================================================= */

        .glass-dark {
            background: rgba(15, 23, 42, .68);

            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);

            border: 1px solid rgba(255,255,255,.08);
        }

        .glass-light {
            background: rgba(255,255,255,.76);

            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);

            border: 1px solid rgba(226,232,240,.85);
        }


        /* =========================================================
           ANIMATED ORBS
        ========================================================= */

        .orb {
            position: absolute;
            border-radius: 9999px;
            filter: blur(90px);
            pointer-events: none;
            opacity: .55;
        }

        .orb-one {
            width: 440px;
            height: 440px;
            background: rgba(16,185,129,.18);
            top: -170px;
            left: -170px;

            animation: orbOne 12s ease-in-out infinite alternate;
        }

        .orb-two {
            width: 520px;
            height: 520px;
            background: rgba(59,130,246,.12);
            right: -200px;
            top: 180px;

            animation: orbTwo 15s ease-in-out infinite alternate;
        }

        .orb-three {
            width: 360px;
            height: 360px;
            background: rgba(244,63,94,.10);
            bottom: -140px;
            left: 38%;

            animation: orbThree 13s ease-in-out infinite alternate;
        }

        @keyframes orbOne {

            from {
                transform: translate3d(0, 0, 0) scale(1);
            }

            to {
                transform: translate3d(80px, 70px, 0) scale(1.15);
            }
        }

        @keyframes orbTwo {

            from {
                transform: translate3d(0, 0, 0) scale(1);
            }

            to {
                transform: translate3d(-100px, 50px, 0) scale(.92);
            }
        }

        @keyframes orbThree {

            from {
                transform: translate3d(0, 0, 0);
            }

            to {
                transform: translate3d(60px, -60px, 0);
            }
        }


        /* =========================================================
           LIVE DOT
        ========================================================= */

        .live-dot {
            position: relative;
        }

        .live-dot::after {
            content: "";
            position: absolute;
            inset: -5px;
            border-radius: 9999px;
            border: 1px solid rgba(52,211,153,.55);

            animation: livePulse 1.8s ease-out infinite;
        }

        @keyframes livePulse {

            0% {
                transform: scale(.65);
                opacity: 1;
            }

            100% {
                transform: scale(1.8);
                opacity: 0;
            }
        }


        /* =========================================================
           FEATURED CARD
        ========================================================= */

        .featured-image {
            transition:
                transform .8s cubic-bezier(.2,.8,.2,1),
                filter .5s ease;
        }

        .featured-card:hover .featured-image {
            transform: scale(1.055);
        }

        .featured-overlay {
            background:
                linear-gradient(
                    180deg,
                    rgba(2,6,23,.03) 15%,
                    rgba(2,6,23,.22) 45%,
                    rgba(2,6,23,.96) 100%
                );
        }


        /* =========================================================
           CARD HOVER
        ========================================================= */

        .premium-card {
            transition:
                transform .35s ease,
                box-shadow .35s ease,
                border-color .35s ease;
        }

        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow:
                0 30px 70px -35px rgba(15,23,42,.35);
        }


        /* =========================================================
           SHINE BUTTON
        ========================================================= */

        .shine-button {
            position: relative;
            overflow: hidden;
        }

        .shine-button::after {

            content: "";

            position: absolute;

            top: -100%;
            left: -60%;

            width: 45%;
            height: 300%;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255,255,255,.35),
                    transparent
                );

            transform: rotate(25deg);

            transition: left .7s ease;
        }

        .shine-button:hover::after {
            left: 130%;
        }


        /* =========================================================
           MARQUEE
        ========================================================= */

        .ticker-track {
            animation: tickerMove 28s linear infinite;
            width: max-content;
        }

        .ticker:hover .ticker-track {
            animation-play-state: paused;
        }

        @keyframes tickerMove {

            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }


        /* =========================================================
           SCROLL REVEAL
        ========================================================= */

        .reveal {
            opacity: 0;
            transform: translateY(24px);

            transition:
                opacity .75s ease,
                transform .75s ease;
        }

        .reveal.reveal-visible {
            opacity: 1;
            transform: translateY(0);
        }


        /* =========================================================
           FLOAT
        ========================================================= */

        .floating {
            animation: floating 4.5s ease-in-out infinite;
        }

        @keyframes floating {

            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }
        }


        /* =========================================================
           SCROLLBAR
        ========================================================= */

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #020617;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 999px;
            border: 2px solid #020617;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }


        /* =========================================================
           REDUCED MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }

            .reveal {
                opacity: 1;
                transform: none;
            }
        }

    </style>

</head>


<body
    class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden"
>


{{-- ================================================================
    HEADER
================================================================ --}}

<header
    id="siteHeader"
    class="fixed inset-x-0 top-0 z-50
           border-b border-white/10
           bg-slate-950/80
           backdrop-blur-xl
           transition-all duration-300"
>

    <div
        class="mx-auto max-w-7xl
               px-4 sm:px-6 lg:px-8"
    >

        <div
            class="flex h-[76px]
                   items-center justify-between
                   gap-4"
        >


            {{-- ====================================================
                BRAND
            ==================================================== --}}

            <a
                href="{{ route('home') }}"
                class="group flex items-center gap-3"
            >

                <div
                    class="relative flex h-11 w-11
                           items-center justify-center
                           overflow-hidden rounded-2xl
                           bg-gradient-to-br
                           from-emerald-400 to-emerald-600
                           text-lg font-black text-slate-950
                           shadow-lg shadow-emerald-500/20"
                >

                    নি

                    <div
                        class="absolute inset-0
                               bg-gradient-to-br
                               from-white/30 to-transparent
                               opacity-0
                               transition
                               group-hover:opacity-100"
                    ></div>

                </div>


                <div>

                    <div
                        class="text-lg font-black
                               tracking-tight text-white
                               sm:text-xl"
                    >
                        নির্ভয় বাংলাদেশ
                    </div>

                    <div
                        class="hidden text-[11px]
                               text-slate-400 sm:block"
                    >
                        নিরাপদ অভিযোগ • পর্যালোচিত তথ্য
                    </div>

                </div>

            </a>


            {{-- ====================================================
                DESKTOP NAVIGATION
            ==================================================== --}}

            <nav
                class="hidden items-center
                       gap-7 lg:flex"
            >

                <a
                    href="#featured"
                    class="text-sm font-semibold
                           text-slate-300
                           transition hover:text-white"
                >
                    হট লিস্ট
                </a>

                <a
                    href="#directory"
                    class="text-sm font-semibold
                           text-slate-300
                           transition hover:text-white"
                >
                    তথ্য খুঁজুন
                </a>

                <a
                    href="#how-it-works"
                    class="text-sm font-semibold
                           text-slate-300
                           transition hover:text-white"
                >
                    কীভাবে কাজ করে
                </a>

                <a
                    href="#safety"
                    class="text-sm font-semibold
                           text-slate-300
                           transition hover:text-white"
                >
                    নিরাপত্তা
                </a>

            </nav>


            {{-- ====================================================
                RIGHT CTA
            ==================================================== --}}

            <div class="flex items-center gap-2">

                <a
                    href="{{ url('/report') }}"
                    class="shine-button
                           inline-flex items-center
                           justify-center gap-2
                           rounded-xl
                           bg-emerald-400
                           px-4 py-2.5
                           text-sm font-black
                           text-slate-950
                           shadow-lg shadow-emerald-500/20
                           transition
                           hover:bg-emerald-300
                           sm:px-5"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-4 w-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    <span class="hidden sm:inline">
                        অভিযোগ করুন
                    </span>

                    <span class="sm:hidden">
                        অভিযোগ
                    </span>

                </a>


                {{-- Mobile Menu Button --}}

                <button
                    id="mobileMenuButton"
                    type="button"
                    aria-label="মেনু খুলুন"
                    class="flex h-10 w-10
                           items-center justify-center
                           rounded-xl border
                           border-white/10
                           text-white
                           lg:hidden"
                >

                    <svg
                        id="menuOpenIcon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    <svg
                        id="menuCloseIcon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="hidden h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            d="M6 6l12 12M18 6L6 18"
                        />
                    </svg>

                </button>

            </div>

        </div>


        {{-- ========================================================
            MOBILE MENU
        ======================================================== --}}

        <div
            id="mobileMenu"
            class="hidden border-t
                   border-white/10
                   pb-5 pt-3 lg:hidden"
        >

            <div class="grid gap-1">

                <a
                    href="#featured"
                    class="mobile-menu-link
                           rounded-xl px-4 py-3
                           text-sm font-semibold
                           text-slate-300
                           transition hover:bg-white/5
                           hover:text-white"
                >
                    হট লিস্ট
                </a>

                <a
                    href="#directory"
                    class="mobile-menu-link
                           rounded-xl px-4 py-3
                           text-sm font-semibold
                           text-slate-300
                           transition hover:bg-white/5
                           hover:text-white"
                >
                    এলাকা অনুযায়ী খুঁজুন
                </a>

                <a
                    href="#how-it-works"
                    class="mobile-menu-link
                           rounded-xl px-4 py-3
                           text-sm font-semibold
                           text-slate-300
                           transition hover:bg-white/5
                           hover:text-white"
                >
                    কীভাবে কাজ করে
                </a>

                <a
                    href="#safety"
                    class="mobile-menu-link
                           rounded-xl px-4 py-3
                           text-sm font-semibold
                           text-slate-300
                           transition hover:bg-white/5
                           hover:text-white"
                >
                    নিরাপত্তা
                </a>

            </div>

        </div>

    </div>

</header>



{{-- ================================================================
    MAIN
================================================================ --}}

<main class="pt-[76px]">


{{-- ================================================================
    FEATURED / HOT SECTION
    PAGE STARTS WITH ACTUAL POSTS
================================================================ --}}

<section
    id="featured"
    class="premium-grid relative
           overflow-hidden bg-slate-950
           text-white"
>

    <div class="orb orb-one"></div>
    <div class="orb orb-two"></div>
    <div class="orb orb-three"></div>


    <div
        class="relative mx-auto
               max-w-7xl
               px-4 py-10
               sm:px-6 sm:py-14
               lg:px-8 lg:py-16"
    >


        {{-- ========================================================
            SECTION HEADER
        ======================================================== --}}

        <div
            class="mb-7 flex flex-col
                   gap-5
                   md:flex-row
                   md:items-end
                   md:justify-between"
        >

            <div>

                <div
                    class="mb-3 inline-flex
                           items-center gap-2
                           rounded-full
                           border border-red-400/20
                           bg-red-400/10
                           px-3 py-1.5
                           text-xs font-bold
                           text-red-300"
                >

                    <span
                        class="live-dot h-2 w-2
                               rounded-full bg-red-400"
                    ></span>

                    গুরুত্বপূর্ণ প্রকাশিত তথ্য

                </div>

                <p
                    class="mt-3 max-w-2xl
                           text-sm leading-6
                           text-slate-400 sm:text-base"
                >
                    প্রশাসনিক পর্যালোচনার পর প্রকাশের জন্য
                    অনুমোদিত গুরুত্বপূর্ণ তথ্য এখানে দেখানো হয়।
                </p>

            </div>

        </div>



        {{-- ========================================================
            FEATURED PROFILES AVAILABLE
        ======================================================== --}}

        @if($featuredProfiles->isNotEmpty())

            @php
                $mainProfile = $featuredProfiles->first();
                $sideProfiles = $featuredProfiles->skip(1)->take(4);
            @endphp


            <div
                class="grid gap-5
                       lg:grid-cols-12"
            >


                {{-- =================================================
                    MAIN FEATURED CARD
                ================================================= --}}

                <article
                    class="featured-card group
                           relative min-h-[460px]
                           overflow-hidden rounded-[30px]
                           border border-white/10
                           bg-slate-900
                           shadow-2xl
                           lg:col-span-8
                           lg:min-h-[560px]"
                >


                    {{-- Image --}}

                    @if($mainProfile->photo)

                        <img
                            src="{{ asset('storage/' . $mainProfile->photo) }}"
                            alt="{{ $mainProfile->name }}"
                            class="featured-image
                                   absolute inset-0
                                   h-full w-full
                                   object-cover"
                        >

                    @else

                        <div
                            class="featured-image
                                   absolute inset-0
                                   flex items-center
                                   justify-center
                                   bg-gradient-to-br
                                   from-slate-800
                                   via-slate-900
                                   to-slate-950"
                        >

                            <div
                                class="flex h-32 w-32
                                       items-center justify-center
                                       rounded-full
                                       border border-white/10
                                       bg-white/5
                                       text-5xl font-black
                                       text-slate-500"
                            >
                                {{ mb_substr($mainProfile->name, 0, 1) }}
                            </div>

                        </div>

                    @endif


                    <div
                        class="featured-overlay
                               absolute inset-0"
                    ></div>


                    {{-- Top Badge --}}

                    <div
                        class="absolute left-5 top-5
                               flex flex-wrap gap-2
                               sm:left-7 sm:top-7"
                    >

                        <span
                            class="rounded-full
                                   bg-red-500
                                   px-3 py-1.5
                                   text-xs font-black
                                   text-white
                                   shadow-lg"
                        >
                            HOT LIST
                        </span>

                        <span
                            class="rounded-full
                                   border border-white/15
                                   bg-black/35
                                   px-3 py-1.5
                                   text-xs font-bold
                                   text-white
                                   backdrop-blur-lg"
                        >
                            পর্যালোচিত
                        </span>

                    </div>


                    {{-- Main Content --}}

                    <div
                        class="absolute inset-x-0
                               bottom-0 p-6
                               sm:p-8 lg:p-10"
                    >

                        @if($mainProfile->organization)

                            <div
                                class="mb-3 text-sm
                                       font-semibold
                                       text-emerald-300"
                            >
                                {{ $mainProfile->organization }}
                            </div>

                        @endif


                        <h2
                            class="max-w-3xl
                                   text-3xl font-black
                                   leading-tight
                                   sm:text-4xl
                                   lg:text-5xl"
                        >
                            {{ $mainProfile->name }}
                        </h2>


                        @if($mainProfile->alias)

                            <p
                                class="mt-2 text-sm
                                       text-slate-300"
                            >
                                পরিচিত নাম:
                                {{ $mainProfile->alias }}
                            </p>

                        @endif


                        {{-- Location --}}

                        <div
                            class="mt-5 flex
                                   flex-wrap gap-2"
                        >

                            @if($mainProfile->district)

                                <span
                                    class="rounded-lg
                                           border border-white/10
                                           bg-white/10
                                           px-3 py-1.5
                                           text-xs font-semibold
                                           text-slate-200
                                           backdrop-blur"
                                >
                                    {{ $mainProfile->district->name_bn }}
                                </span>

                            @endif


                            @if($mainProfile->thana)

                                <span
                                    class="rounded-lg
                                           border border-white/10
                                           bg-white/10
                                           px-3 py-1.5
                                           text-xs font-semibold
                                           text-slate-200
                                           backdrop-blur"
                                >
                                    {{ $mainProfile->thana->name_bn }}
                                </span>

                            @elseif($mainProfile->upazila)

                                <span
                                    class="rounded-lg
                                           border border-white/10
                                           bg-white/10
                                           px-3 py-1.5
                                           text-xs font-semibold
                                           text-slate-200
                                           backdrop-blur"
                                >
                                    {{ $mainProfile->upazila->name_bn }}
                                </span>

                            @endif


                            @if($mainProfile->area)

                                <span
                                    class="rounded-lg
                                           border border-white/10
                                           bg-white/10
                                           px-3 py-1.5
                                           text-xs font-semibold
                                           text-slate-200
                                           backdrop-blur"
                                >
                                    {{ $mainProfile->area }}
                                </span>

                            @endif

                        </div>


                        @if($mainProfile->description)

                            <p
                                class="mt-5 max-w-3xl
                                       text-sm leading-6
                                       text-slate-300
                                       sm:text-base"
                            >
                                {{ \Illuminate\Support\Str::limit(
                                    $mainProfile->description,
                                    220
                                ) }}
                            </p>

                        @endif


                        <p
                            class="mt-5 max-w-3xl
                                   border-t border-white/10
                                   pt-4 text-[11px]
                                   leading-5 text-slate-400"
                        >
                            প্রকাশিত তথ্য প্রশাসনিক পর্যালোচনার
                            ভিত্তিতে প্রদর্শিত হচ্ছে। এটি কোনো
                            আদালতের রায় বা অপরাধী ঘোষণার সমতুল্য নয়।
                        </p>

                    </div>

                </article>



                {{-- =================================================
                    RIGHT COLUMN
                ================================================= --}}

                <div
                    class="grid gap-5
                           sm:grid-cols-2
                           lg:col-span-4
                           lg:grid-cols-1"
                >


                    @forelse($sideProfiles as $profile)

                        <article
                            class="premium-card
                                   relative min-h-[220px]
                                   overflow-hidden
                                   rounded-[24px]
                                   border border-white/10
                                   bg-slate-900"
                        >

                            @if($profile->photo)

                                <img
                                    src="{{ asset('storage/' . $profile->photo) }}"
                                    alt="{{ $profile->name }}"
                                    class="absolute inset-0
                                           h-full w-full
                                           object-cover"
                                >

                            @else

                                <div
                                    class="absolute inset-0
                                           bg-gradient-to-br
                                           from-slate-800
                                           to-slate-950"
                                ></div>

                            @endif


                            <div
                                class="absolute inset-0
                                       bg-gradient-to-t
                                       from-slate-950
                                       via-slate-950/60
                                       to-transparent"
                            ></div>


                            <div
                                class="absolute inset-x-0
                                       bottom-0 p-5"
                            >

                                <div
                                    class="mb-2 inline-flex
                                           rounded-full
                                           bg-red-500/90
                                           px-2.5 py-1
                                           text-[10px]
                                           font-black
                                           text-white"
                                >
                                    HOT
                                </div>


                                <h3
                                    class="text-xl font-black
                                           text-white"
                                >
                                    {{ $profile->name }}
                                </h3>


                                <p
                                    class="mt-1 text-xs
                                           text-slate-300"
                                >

                                    @if($profile->area)

                                        {{ $profile->area }}

                                    @elseif($profile->thana)

                                        {{ $profile->thana->name_bn }}

                                    @elseif($profile->upazila)

                                        {{ $profile->upazila->name_bn }}

                                    @elseif($profile->district)

                                        {{ $profile->district->name_bn }}

                                    @else

                                        পর্যালোচিত তথ্য

                                    @endif

                                </p>

                            </div>

                        </article>

                    @empty


                        {{-- If only one hot profile exists --}}

                        <div
                            class="glass-dark
                                   flex min-h-[220px]
                                   flex-col justify-between
                                   rounded-[24px]
                                   p-6"
                        >

                            <div>

                                <div
                                    class="mb-4 flex h-11 w-11
                                           items-center justify-center
                                           rounded-2xl
                                           bg-emerald-400/10
                                           text-emerald-300"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="h-5 w-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v4m0 4h.01M10.3 3.7 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"
                                        />
                                    </svg>

                                </div>

                                <h3
                                    class="text-xl font-black"
                                >
                                    তথ্য জানাতে চান?
                                </h3>

                                <p
                                    class="mt-2 text-sm
                                           leading-6
                                           text-slate-400"
                                >
                                    কোনো অ্যাকাউন্ট তৈরি না করেই
                                    অভিযোগ ও সংশ্লিষ্ট তথ্য জমা দিতে পারবেন।
                                </p>

                            </div>


                            <a
                                href="{{ url('/report') }}"
                                class="mt-6 inline-flex
                                       items-center
                                       text-sm font-bold
                                       text-emerald-300"
                            >
                                অভিযোগ করুন →
                            </a>

                        </div>

                    @endforelse


                    {{-- Complaint CTA card --}}

                    <a
                        href="{{ url('/report') }}"
                        class="premium-card
                               group relative
                               min-h-[180px]
                               overflow-hidden
                               rounded-[24px]
                               bg-gradient-to-br
                               from-emerald-400
                               to-emerald-500
                               p-6 text-slate-950"
                    >

                        <div
                            class="absolute -right-10
                                   -top-10 h-36 w-36
                                   rounded-full
                                   bg-white/20
                                   transition
                                   duration-500
                                   group-hover:scale-125"
                        ></div>


                        <div
                            class="relative flex h-full
                                   flex-col justify-between"
                        >

                            <div>

                                <div
                                    class="text-xs font-black
                                           uppercase tracking-widest
                                           text-emerald-950/60"
                                >
                                    নিরাপদ জমাদান
                                </div>

                                <h3
                                    class="mt-2 text-2xl
                                           font-black"
                                >
                                    অভিযোগ করুন
                                </h3>

                                <p
                                    class="mt-2 max-w-xs
                                           text-sm font-medium
                                           leading-6
                                           text-emerald-950/75"
                                >
                                    Login বা Registration প্রয়োজন নেই।
                                </p>

                            </div>


                            <div
                                class="mt-5 flex
                                       items-center
                                       justify-between"
                            >

                                <span
                                    class="text-sm font-black"
                                >
                                    শুরু করুন
                                </span>

                                <span
                                    class="flex h-10 w-10
                                           items-center
                                           justify-center
                                           rounded-full
                                           bg-slate-950
                                           text-white
                                           transition
                                           group-hover:translate-x-1"
                                >
                                    →
                                </span>

                            </div>

                        </div>

                    </a>

                </div>

            </div>


        {{-- ========================================================
            NO FEATURED PROFILE YET
        ======================================================== --}}

        @else

            <div
                class="grid gap-5
                       lg:grid-cols-12"
            >

                <div
                    class="glass-dark
                           relative overflow-hidden
                           rounded-[30px]
                           p-7 sm:p-10
                           lg:col-span-8
                           lg:p-12"
                >

                    <div
                        class="absolute -right-20
                               -top-20 h-72 w-72
                               rounded-full
                               bg-emerald-400/10
                               blur-3xl"
                    ></div>


                    <div class="relative">

                        <span
                            class="inline-flex
                                   rounded-full
                                   border border-emerald-400/20
                                   bg-emerald-400/10
                                   px-3 py-1.5
                                   text-xs font-bold
                                   text-emerald-300"
                        >
                            নির্ভয় বাংলাদেশ
                        </span>


                        <h2
                            class="mt-6 max-w-3xl
                                   text-3xl font-black
                                   leading-tight
                                   sm:text-4xl
                                   lg:text-5xl"
                        >
                            নিরাপদে তথ্য দিন,
                            <span class="text-emerald-400">
                                জনস্বার্থে সহায়তা করুন।
                            </span>
                        </h2>


                        <p
                            class="mt-5 max-w-2xl
                                   text-sm leading-7
                                   text-slate-400
                                   sm:text-base"
                        >
                            বর্তমানে Hot List-এ কোনো প্রকাশিত
                            profile নেই। Admin কর্তৃক পর্যালোচিত,
                            অনুমোদিত ও Public করা তথ্য এখানে
                            স্বয়ংক্রিয়ভাবে দেখা যাবে।
                        </p>


                        <div
                            class="mt-8 flex
                                   flex-col gap-3
                                   sm:flex-row"
                        >

                        </div>

                    </div>

                </div>


                <div
                    class="glass-dark
                           rounded-[30px]
                           p-7
                           lg:col-span-4"
                >

                    <div
                        class="flex h-12 w-12
                               items-center justify-center
                               rounded-2xl
                               bg-emerald-400/10
                               text-emerald-300"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12l2 2 4-4m5-4.5A11.9 11.9 0 0 1 12 3a11.9 11.9 0 0 1-8 2.5V11c0 5.25 3.44 9.75 8 11 4.56-1.25 8-5.75 8-11V5.5Z"
                            />
                        </svg>

                    </div>


                    <h3
                        class="mt-5 text-xl
                               font-black"
                    >
                        প্রকাশের আগে পর্যালোচনা
                    </h3>


                    <p
                        class="mt-3 text-sm
                               leading-7
                               text-slate-400"
                    >
                        জমা পড়া কোনো অভিযোগ সরাসরি
                        Public Page-এ প্রকাশ করা হয় না।
                    </p>


                    <div
                        class="mt-7 space-y-3
                               text-sm text-slate-300"
                    >

                        <div class="flex gap-3">
                            <span class="text-emerald-400">✓</span>
                            Login প্রয়োজন নেই
                        </div>

                        <div class="flex gap-3">
                            <span class="text-emerald-400">✓</span>
                            Admin review প্রয়োজন
                        </div>

                        <div class="flex gap-3">
                            <span class="text-emerald-400">✓</span>
                            অনুমোদনের পর Public
                        </div>

                    </div>

                </div>

            </div>

        @endif

    </div>

</section>



{{-- ================================================================
    DIRECTORY INTRO + LIVEWIRE DIRECTORY
================================================================ --}}

<section
    id="directory"
    class="relative overflow-hidden
           bg-slate-50"
>

    {{-- Background decoration --}}

    <div
        class="pointer-events-none
               absolute inset-x-0 top-0
               h-96
               bg-gradient-to-b
               from-emerald-50/80
               to-transparent"
    ></div>


    <div
        class="relative mx-auto
               max-w-7xl
               px-4 pb-20 pt-20
               sm:px-6
               lg:px-8"
    >


        {{-- Header --}}

        <div
            class="reveal mx-auto
                   mb-10 max-w-3xl
                   text-center"
        >

            <div
                class="inline-flex items-center
                       gap-2 rounded-full
                       border border-emerald-200
                       bg-emerald-50
                       px-4 py-2
                       text-xs font-black
                       text-emerald-700"
            >
                এলাকা ভিত্তিক অনুসন্ধান
            </div>


            <h2
                class="mt-5
                       text-3xl font-black
                       tracking-tight
                       text-slate-950
                       sm:text-4xl
                       lg:text-5xl"
            >
                আপনার এলাকার
                <span class="text-emerald-600">
                    প্রকাশিত তথ্য
                </span>
                খুঁজুন
            </h2>


            <p
                class="mx-auto mt-4
                       max-w-2xl
                       text-sm leading-7
                       text-slate-500
                       sm:text-base"
            >
                বিভাগ ও জেলা নির্বাচন করার পর
                উপজেলা–ইউনিয়ন অথবা শহরাঞ্চলে
                থানা–ওয়ার্ড–এলাকা অনুযায়ী তথ্য খুঁজুন।
            </p>

        </div>


        {{-- ========================================================
            LIVEWIRE DIRECTORY
        ======================================================== --}}

        <div
            class="reveal
                   rounded-[32px]
                   border border-slate-200/80
                   bg-white
                   p-2
                   shadow-[0_30px_100px_-50px_rgba(15,23,42,.30)]
                   sm:p-3"
        >

            @livewire('public.directory')

        </div>

    </div>

</section>



{{-- ================================================================
    HOW IT WORKS
================================================================ --}}

<section
    id="how-it-works"
    class="border-y border-slate-200
           bg-white"
>

    <div
        class="mx-auto max-w-7xl
               px-4 py-20
               sm:px-6
               lg:px-8"
    >

        <div
            class="reveal flex flex-col
                   gap-5
                   lg:flex-row
                   lg:items-end
                   lg:justify-between"
        >

            <div class="max-w-2xl">

                <div
                    class="text-xs font-black
                           uppercase
                           tracking-[.2em]
                           text-emerald-600"
                >
                    প্রক্রিয়া
                </div>


                <h2
                    class="mt-3
                           text-3xl font-black
                           tracking-tight
                           text-slate-950
                           sm:text-4xl"
                >
                    কীভাবে কাজ করে?
                </h2>


                <p
                    class="mt-4
                           text-sm leading-7
                           text-slate-500
                           sm:text-base"
                >
                    অভিযোগ জমা দেওয়া থেকে প্রকাশ পর্যন্ত
                    তথ্য একটি নির্দিষ্ট পর্যালোচনা প্রক্রিয়ার
                    মধ্য দিয়ে যায়।
                </p>

            </div>


            <a
                href="{{ url('/report') }}"
                class="inline-flex
                       items-center gap-2
                       text-sm font-black
                       text-emerald-700
                       transition
                       hover:text-emerald-600"
            >
                অভিযোগ করুন
                <span>→</span>
            </a>

        </div>



        <div
            class="mt-12 grid gap-5
                   md:grid-cols-2
                   xl:grid-cols-4"
        >


            {{-- STEP 1 --}}

            <article
                class="reveal premium-card
                       rounded-[26px]
                       border border-slate-200
                       bg-slate-50 p-6"
            >

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-2xl
                           bg-slate-950
                           text-sm font-black
                           text-white"
                >
                    01
                </div>


                <h3
                    class="mt-6 text-xl
                           font-black
                           text-slate-950"
                >
                    অভিযোগ জমা
                </h3>


                <p
                    class="mt-3 text-sm
                           leading-7
                           text-slate-500"
                >
                    সংশ্লিষ্ট ব্যক্তি, ঘটনা, এলাকা এবং
                    প্রয়োজনীয় বিবরণ জমা দিন।
                </p>

            </article>



            {{-- STEP 2 --}}

            <article
                class="reveal premium-card
                       rounded-[26px]
                       border border-slate-200
                       bg-slate-50 p-6"
            >

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-2xl
                           bg-slate-950
                           text-sm font-black
                           text-white"
                >
                    02
                </div>


                <h3
                    class="mt-6 text-xl
                           font-black
                           text-slate-950"
                >
                    প্রমাণ সংযুক্ত
                </h3>


                <p
                    class="mt-3 text-sm
                           leading-7
                           text-slate-500"
                >
                    প্রয়োজন হলে ছবি, ভিডিও, অডিও
                    অথবা ডকুমেন্ট সংযুক্ত করুন।
                </p>

            </article>



            {{-- STEP 3 --}}

            <article
                class="reveal premium-card
                       rounded-[26px]
                       border border-slate-200
                       bg-slate-50 p-6"
            >

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-2xl
                           bg-slate-950
                           text-sm font-black
                           text-white"
                >
                    03
                </div>


                <h3
                    class="mt-6 text-xl
                           font-black
                           text-slate-950"
                >
                    পর্যালোচনা
                </h3>


                <p
                    class="mt-3 text-sm
                           leading-7
                           text-slate-500"
                >
                    Admin জমা দেওয়া তথ্য ও প্রমাণ
                    পর্যালোচনা করে প্রয়োজনীয় সিদ্ধান্ত নেবেন।
                </p>

            </article>



            {{-- STEP 4 --}}

            <article
                class="reveal premium-card
                       rounded-[26px]
                       border border-emerald-200
                       bg-emerald-50 p-6"
            >

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-2xl
                           bg-emerald-500
                           text-sm font-black
                           text-slate-950"
                >
                    04
                </div>


                <h3
                    class="mt-6 text-xl
                           font-black
                           text-slate-950"
                >
                    অনুমোদিত প্রকাশ
                </h3>


                <p
                    class="mt-3 text-sm
                           leading-7
                           text-slate-600"
                >
                    শুধুমাত্র প্রকাশযোগ্য হিসেবে অনুমোদিত
                    তথ্য Public Directory-তে দেখা যাবে।
                </p>

            </article>

        </div>

    </div>

</section>



{{-- ================================================================
    SAFETY
================================================================ --}}

<section
    id="safety"
    class="premium-grid relative
           overflow-hidden
           bg-slate-950 text-white"
>

    <div
        class="absolute -left-32
               top-0 h-96 w-96
               rounded-full
               bg-emerald-500/10
               blur-3xl"
    ></div>


    <div
        class="relative mx-auto
               max-w-7xl
               px-4 py-20
               sm:px-6
               lg:px-8"
    >

        <div
            class="grid gap-12
                   lg:grid-cols-12
                   lg:items-center"
        >


            {{-- Left --}}

            <div
                class="reveal
                       lg:col-span-5"
            >

                <div
                    class="text-xs font-black
                           uppercase
                           tracking-[.2em]
                           text-emerald-400"
                >
                    নিরাপত্তা ও গোপনীয়তা
                </div>


                <h2
                    class="mt-4
                           text-3xl font-black
                           leading-tight
                           sm:text-4xl"
                >
                    সংবেদনশীল তথ্য
                    <span class="text-emerald-400">
                        Public নয়
                    </span>
                </h2>


                <p
                    class="mt-5 max-w-xl
                           text-sm leading-7
                           text-slate-400
                           sm:text-base"
                >
                    অভিযোগকারীর ব্যক্তিগত যোগাযোগের তথ্য,
                    প্রকাশের অনুপযোগী প্রমাণ এবং অভ্যন্তরীণ
                    প্রশাসনিক পর্যালোচনার তথ্য সাধারণ দর্শকের
                    জন্য প্রদর্শন করা হবে না।
                </p>


                <a
                    href="{{ url('/report') }}"
                    class="shine-button
                           mt-7 inline-flex
                           items-center justify-center
                           rounded-xl
                           bg-emerald-400
                           px-6 py-3.5
                           text-sm font-black
                           text-slate-950
                           transition
                           hover:bg-emerald-300"
                >
                    নিরাপদে অভিযোগ করুন
                </a>

            </div>



            {{-- Right --}}

            <div
                class="grid gap-4
                       sm:grid-cols-2
                       lg:col-span-7"
            >


                <div
                    class="reveal glass-dark
                           premium-card
                           rounded-[24px]
                           p-6"
                >

                    <div
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-2xl
                               bg-emerald-400/10
                               text-emerald-300"
                    >
                        01
                    </div>


                    <h3
                        class="mt-5
                               text-lg font-black"
                    >
                        Reporter-এর তথ্য
                    </h3>


                    <p
                        class="mt-2 text-sm
                               leading-6
                               text-slate-400"
                    >
                        ব্যক্তিগত যোগাযোগের তথ্য
                        Public Directory-তে দেখানো হবে না।
                    </p>

                </div>



                <div
                    class="reveal glass-dark
                           premium-card
                           rounded-[24px]
                           p-6"
                >

                    <div
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-2xl
                               bg-blue-400/10
                               text-blue-300"
                    >
                        02
                    </div>


                    <h3
                        class="mt-5
                               text-lg font-black"
                    >
                        সংবেদনশীল Evidence
                    </h3>


                    <p
                        class="mt-2 text-sm
                               leading-6
                               text-slate-400"
                    >
                        Raw evidence সাধারণ Public Page-এ
                        সরাসরি প্রকাশ করা হবে না।
                    </p>

                </div>



                <div
                    class="reveal glass-dark
                           premium-card
                           rounded-[24px]
                           p-6"
                >

                    <div
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-2xl
                               bg-amber-400/10
                               text-amber-300"
                    >
                        03
                    </div>


                    <h3
                        class="mt-5
                               text-lg font-black"
                    >
                        Review ছাড়া প্রকাশ নয়
                    </h3>


                    <p
                        class="mt-2 text-sm
                               leading-6
                               text-slate-400"
                    >
                        জমা পড়া অভিযোগ সরাসরি
                        Public Directory-তে প্রদর্শিত হবে না।
                    </p>

                </div>



                <div
                    class="reveal glass-dark
                           premium-card
                           rounded-[24px]
                           p-6"
                >

                    <div
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-2xl
                               bg-red-400/10
                               text-red-300"
                    >
                        04
                    </div>


                    <h3
                        class="mt-5
                               text-lg font-black"
                    >
                        প্রকাশ নিয়ন্ত্রিত
                    </h3>


                    <p
                        class="mt-2 text-sm
                               leading-6
                               text-slate-400"
                    >
                        শুধুমাত্র Admin কর্তৃক Public করার
                        অনুমতি দেওয়া তথ্য প্রদর্শিত হবে।
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ================================================================
    IMPORTANT NOTICE
================================================================ --}}

<section class="bg-slate-50">

    <div
        class="mx-auto max-w-5xl
               px-4 py-14
               sm:px-6
               lg:px-8"
    >

        <div
            class="reveal relative
                   overflow-hidden
                   rounded-[28px]
                   border border-amber-200
                   bg-amber-50
                   p-6 sm:p-8"
        >

            <div
                class="absolute -right-12
                       -top-12 h-40 w-40
                       rounded-full
                       bg-amber-300/20
                       blur-2xl"
            ></div>


            <div
                class="relative flex
                       flex-col gap-5
                       sm:flex-row"
            >

                <div
                    class="flex h-12 w-12
                           shrink-0 items-center
                           justify-center
                           rounded-2xl
                           bg-amber-200/70
                           text-amber-900"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-6 w-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.3 3.7 2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"
                        />
                    </svg>

                </div>


                <div>

                    <h2
                        class="text-xl font-black
                               text-amber-950"
                    >
                        গুরুত্বপূর্ণ নোটিশ
                    </h2>


                    <p
                        class="mt-3 text-sm
                               leading-7
                               text-amber-950/75"
                    >
                        এই প্ল্যাটফর্মে কোনো অভিযোগ জমা পড়লেই
                        সংশ্লিষ্ট ব্যক্তিকে অপরাধী হিসেবে ঘোষণা করা হয় না।
                        জমা দেওয়া তথ্য প্রশাসনিক পর্যালোচনার মধ্য দিয়ে যায়।
                        শুধুমাত্র প্রকাশের জন্য অনুমোদিত তথ্যই Public Page-এ
                        প্রদর্শিত হয়। প্রকাশিত তথ্যও কোনো আদালতের রায়ের
                        বিকল্প নয়।
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


</main>



{{-- ================================================================
    FOOTER
================================================================ --}}

<footer
    class="premium-grid
           bg-black
           text-slate-400"
>

    <div
        class="mx-auto max-w-7xl
               px-4 pb-7 pt-14
               sm:px-6
               lg:px-8"
    >


        <div
            class="grid gap-10
                   md:grid-cols-3"
        >


            {{-- ====================================================
                BRAND
            ==================================================== --}}

            <div>

                <div
                    class="flex items-center gap-3"
                >

                    <div
                        class="flex h-10 w-10
                               items-center justify-center
                               rounded-xl
                               bg-emerald-500
                               font-black
                               text-slate-950"
                    >
                        নি
                    </div>


                    <h2
                        class="text-xl font-bold
                               text-white"
                    >
                        নির্ভয় বাংলাদেশ
                    </h2>

                </div>


                <p
                    class="mt-4 max-w-sm
                           text-sm leading-6"
                >
                    নিরাপদ অভিযোগ গ্রহণ, প্রশাসনিক পর্যালোচনা
                    এবং অনুমোদিত জনস্বার্থ সংশ্লিষ্ট তথ্য
                    প্রকাশের প্ল্যাটফর্ম।
                </p>

            </div>



            {{-- ====================================================
                LINKS
            ==================================================== --}}

            <div>

                <h3
                    class="font-bold text-white"
                >
                    গুরুত্বপূর্ণ লিংক
                </h3>


                <div
                    class="mt-4 space-y-3
                           text-sm"
                >

                    <a
                        href="#featured"
                        class="block transition
                               hover:text-white"
                    >
                        হোম
                    </a>

                    <a
                        href="#directory"
                        class="block transition
                               hover:text-white"
                    >
                        যাচাইকৃত তথ্য
                    </a>

                    <a
                        href="#how-it-works"
                        class="block transition
                               hover:text-white"
                    >
                        কীভাবে কাজ করে
                    </a>

                    <a
                        href="{{ url('/report') }}"
                        class="block transition
                               hover:text-white"
                    >
                        অভিযোগ করুন
                    </a>

                </div>

            </div>



            {{-- ====================================================
                POLICY
            ==================================================== --}}

            <div>

                <h3
                    class="font-bold text-white"
                >
                    তথ্য ব্যবহারের নীতি
                </h3>


                <p
                    class="mt-4 text-sm
                           leading-6"
                >
                    যাচাই ছাড়া কোনো অভিযোগ Public Page-এ
                    প্রকাশ করা হয় না। ব্যক্তিগত ও সংবেদনশীল
                    তথ্যের প্রকাশ সীমিত রাখা হয়।
                </p>

            </div>

        </div>



        {{-- ========================================================
            FOOTER BOTTOM
        ======================================================== --}}

        <div
            class="mt-12 flex
                   flex-col items-center
                   justify-between gap-5
                   border-t border-white/10
                   pt-7
                   md:flex-row"
        >

            <p
                class="text-xs text-slate-600"
            >
                © {{ date('Y') }} নির্ভয় বাংলাদেশ।
                সর্বস্বত্ব সংরক্ষিত।
            </p>


            {{-- Public user login নেই --}}
            <a
                href="{{ route('admin.login') }}"
                class="text-[11px]
                       text-slate-700
                       transition
                       hover:text-slate-400"
            >
                Admin Login
            </a>

        </div>

    </div>

</footer>



{{-- ================================================================
    MOBILE FLOATING REPORT BUTTON
================================================================ --}}

<a
    href="{{ url('/report') }}"
    class="fixed bottom-5 right-5
           z-40
           flex h-14 w-14
           items-center justify-center
           rounded-full
           bg-emerald-400
           text-slate-950
           shadow-2xl
           shadow-emerald-500/30
           transition
           hover:scale-105
           hover:bg-emerald-300
           sm:hidden"
    aria-label="অভিযোগ করুন"
>

    <svg
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2.3"
        class="h-6 w-6"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 5v14M5 12h14"
        />
    </svg>

</a>



{{-- ================================================================
    LIVEWIRE
================================================================ --}}

@livewireScripts



{{-- ================================================================
    PAGE JAVASCRIPT
================================================================ --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        /*
        ============================================================
        MOBILE MENU
        ============================================================
        */

        const menuButton =
            document.getElementById('mobileMenuButton');

        const mobileMenu =
            document.getElementById('mobileMenu');

        const menuOpenIcon =
            document.getElementById('menuOpenIcon');

        const menuCloseIcon =
            document.getElementById('menuCloseIcon');


        if (
            menuButton &&
            mobileMenu &&
            menuOpenIcon &&
            menuCloseIcon
        ) {

            menuButton.addEventListener(
                'click',
                function () {

                    mobileMenu.classList.toggle('hidden');

                    menuOpenIcon.classList.toggle('hidden');

                    menuCloseIcon.classList.toggle('hidden');

                }
            );


            document
                .querySelectorAll('.mobile-menu-link')
                .forEach(function (link) {

                    link.addEventListener(
                        'click',
                        function () {

                            mobileMenu.classList.add('hidden');

                            menuOpenIcon.classList.remove('hidden');

                            menuCloseIcon.classList.add('hidden');

                        }
                    );

                });

        }



        /*
        ============================================================
        HEADER EFFECT
        ============================================================
        */

        const header =
            document.getElementById('siteHeader');


        function updateHeader() {

            if (!header) {
                return;
            }


            if (window.scrollY > 20) {

                header.classList.add(
                    'shadow-2xl',
                    'shadow-black/20'
                );

            } else {

                header.classList.remove(
                    'shadow-2xl',
                    'shadow-black/20'
                );

            }

        }


        updateHeader();

        window.addEventListener(
            'scroll',
            updateHeader,
            {
                passive: true
            }
        );



        /*
        ============================================================
        SCROLL REVEAL
        ============================================================
        */

        const revealItems =
            document.querySelectorAll('.reveal');


        if ('IntersectionObserver' in window) {

            const revealObserver =
                new IntersectionObserver(
                    function (entries, observer) {

                        entries.forEach(
                            function (entry) {

                                if (
                                    entry.isIntersecting
                                ) {

                                    entry.target
                                        .classList
                                        .add(
                                            'reveal-visible'
                                        );

                                    observer.unobserve(
                                        entry.target
                                    );

                                }

                            }
                        );

                    },
                    {
                        threshold: 0.10,
                        rootMargin:
                            '0px 0px -30px 0px'
                    }
                );


            revealItems.forEach(
                function (item) {
                    revealObserver.observe(item);
                }
            );

        } else {

            revealItems.forEach(
                function (item) {

                    item.classList.add(
                        'reveal-visible'
                    );

                }
            );

        }

    });

</script>


</body>

</html>