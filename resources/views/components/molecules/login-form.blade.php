<h2 class="text-2xl font-bold text-gray-800">
    {{ __('login.title') }}
</h2>

<p class="text-sm text-gray-500 mt-1">
    {{ __('login.subtitle') }}
</p>

<form class="mt-6 space-y-5" method="POST" action="{{ route('login') }}">
    @csrf

    <!-- EMAIL -->
    <x-atoms.input
        icon="envelope"
        name="email"
        type="email"
        label="{{ __('login.email') }}"
        placeholder="{{ __('login.email_placeholder') }}"
    />

    <!-- PASSWORD -->
    <x-atoms.input
        icon="lock-closed"
        name="password"
        type="password"
        required
        label="{{ __('login.password') }}"
        placeholder="{{ __('login.password_placeholder') }}"
    />

    <!-- OPTIONS -->
    <div class="flex items-center justify-between text-sm">
        <label class="flex items-center gap-2">
            <input name="remember" type="checkbox" class="rounded text-blue-600">
            {{ __('login.remember') }}
        </label>

        <a href="/forgot-password" class="text-blue-600 hover:underline">
            {{ __('login.forgot') }}
        </a>
    </div>

    <!-- LOGIN BUTTON -->
    <button
        type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg transition"
    >
        {{ __('login.button') }}
    </button>

    <!-- SIGN UP -->
    <p class="text-center text-sm text-gray-500">
        {{ __('login.no_account') }}
        <a href="/register" class="text-blue-600 font-medium hover:underline">
            {{ __('login.signup') }}
        </a>
    </p>
</form>
