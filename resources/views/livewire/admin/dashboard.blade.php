<div class="min-h-screen bg-gray-100">

    <header class="bg-white border-b">

        <div class="max-w-7xl mx-auto px-6 py-4
                    flex justify-between items-center">

            <div>
                <h1 class="text-xl font-bold">
                    নির্ভয় বাংলাদেশ
                </h1>

                <p class="text-sm text-gray-500">
                    অ্যাডমিন ড্যাশবোর্ড
                </p>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <button
                    type="submit"
                    class="bg-gray-900 text-white
                           px-4 py-2 rounded-lg"
                >
                    লগআউট
                </button>
            </form>

        </div>

    </header>


    <main class="max-w-7xl mx-auto px-6 py-8">

        <h2 class="text-2xl font-bold mb-6">
            Dashboard Overview
        </h2>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

            <div class="bg-white rounded-xl p-6 shadow-sm">
                <p class="text-gray-500">
                    Pending Reports
                </p>

                <p class="text-3xl font-bold mt-2">
                    {{ $pendingReports }}
                </p>
            </div>


            <div class="bg-white rounded-xl p-6 shadow-sm">
                <p class="text-gray-500">
                    Under Review
                </p>

                <p class="text-3xl font-bold mt-2">
                    {{ $underReviewReports }}
                </p>
            </div>


            <div class="bg-white rounded-xl p-6 shadow-sm">
                <p class="text-gray-500">
                    Approved Reports
                </p>

                <p class="text-3xl font-bold mt-2">
                    {{ $approvedReports }}
                </p>
            </div>


            <div class="bg-white rounded-xl p-6 shadow-sm">
                <p class="text-gray-500">
                    Hot List
                </p>

                <p class="text-3xl font-bold mt-2">
                    {{ $hotProfilesCount }}
                </p>
            </div>

        </div>


        <div class="mt-8 bg-white rounded-xl shadow-sm p-6">

            <h3 class="text-lg font-bold mb-4">
                Management
            </h3>

            <div class="flex flex-wrap gap-3">

                <a
                    href="#"
                    class="border px-4 py-2 rounded-lg"
                >
                    Pending Reports
                </a>

                <a
                    href="#"
                    class="border px-4 py-2 rounded-lg"
                >
                    Approved Reports
                </a>

                <a
                    href="#"
                    class="border px-4 py-2 rounded-lg"
                >
                    Accused Management
                </a>

                <a
                    href="#"
                    class="border px-4 py-2 rounded-lg"
                >
                    Hot List
                </a>

            </div>

        </div>

    </main>

</div>