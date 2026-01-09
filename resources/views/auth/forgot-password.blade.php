<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="Forgot Password"/>
    <x-atoms.tailwindcss/>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        
        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-900 text-center">
            Forgot your password?
        </h2>

        <!-- Subtitle -->
        <p class="text-sm text-gray-500 text-center mt-2">
            Enter your email address and we’ll send you a password reset link.
        </p>

        <!-- Status -->
        @if (session('status'))
            <div class="mt-4 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <!-- Error -->
        @if ($errors->any())
            <div class="mt-4 rounded-md bg-red-50 px-4 py-3 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email address
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="you@example.com"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500 outline-none"
                >
            </div>

            <button
                type="submit"
                class="w-full rounded-lg bg-indigo-600 py-2.5 text-white font-medium hover:bg-indigo-700 transition"
            >
                Send Reset Link
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
