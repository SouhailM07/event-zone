<div class="  min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-6 space-y-6">

        {{-- Title --}}
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">
                Verify your email
            </h1>
            <p class="mt-2 text-sm text-gray-600">
                Thanks for signing up! Before getting started, please verify your email
                address by clicking the link we just emailed to you.
            </p>
        </div>

        {{-- Success Message --}}
        @if (session('status') === 'verification-link-sent')
            <div class="rounded-lg bg-green-50 border border-green-200 p-3 text-sm text-green-700">
                A new verification link has been sent to your email address.
            </div>
        @endif

        {{-- Actions --}}
        <div class="flex flex-col gap-3">
            {{-- Resend Verification --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full py-2 px-4 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
                >
                    Resend Verification Email
                </button>
            </form>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="w-full py-2 px-4 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
                >
                    Log Out
                </button>
            </form>
        </div>

    </div>
</div>
