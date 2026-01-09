<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="Reset Password"/>
    <x-atoms.tailwindcss/>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-900 text-center">
            Reset your password
        </h2>

        <!-- Subtitle -->
        <p class="text-sm text-gray-500 text-center mt-2">
            Choose a strong password to secure your account.
        </p>

        <!-- Error -->
        @if ($errors->any())
            <div class="mt-4 rounded-md bg-red-50 px-4 py-3 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->email }}">

            <!-- New Password -->
                <x-atoms.input label="New Password" type="password" name="password" required placeholder="••••••••"/>
                <x-atoms.input label="Confirm Password" type="password" name="password_confirmation" required placeholder="••••••••"/>
            <!-- Submit -->
            <button
                type="submit"
                class="w-full rounded-lg bg-indigo-600 py-2.5 text-white font-medium hover:bg-indigo-700 transition"
            >
                Reset Password
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition">
                Back to login
            </a>
        </div>

    </div>

</body>
</html>
