<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="w-full max-w-md">

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold">
                    নির্ভয় বাংলাদেশ
                </h1>

                <p class="text-gray-500 mt-2">
                    অ্যাডমিন প্যানেল
                </p>
            </div>

            <form wire:submit="login" class="space-y-5">

                <div>
                    <label class="block mb-2 font-medium">
                        অ্যাডমিন ইমেইল
                    </label>

                    <input
                        type="email"
                        wire:model="email"
                        autocomplete="email"
                        class="w-full border rounded-lg px-4 py-3"
                        placeholder="admin@example.com"
                    >

                    @error('email')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        পাসওয়ার্ড
                    </label>

                    <input
                        type="password"
                        wire:model="password"
                        autocomplete="current-password"
                        class="w-full border rounded-lg px-4 py-3"
                    >

                    @error('password')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <label class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        wire:model="remember"
                    >

                    <span class="text-sm text-gray-600">
                        লগইন মনে রাখুন
                    </span>
                </label>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full bg-gray-900 text-white
                           rounded-lg py-3 font-semibold"
                >
                    <span wire:loading.remove wire:target="login">
                        লগইন
                    </span>

                    <span wire:loading wire:target="login">
                        যাচাই করা হচ্ছে...
                    </span>
                </button>

            </form>

            <div class="mt-6 text-center">
                <a
                    href="{{ route('home') }}"
                    class="text-sm text-gray-500 hover:underline"
                >
                    ওয়েবসাইটে ফিরে যান
                </a>
            </div>

        </div>

    </div>

</div>