@php
$inputs = [
    [
        "icon" => "tag",
        "label" => "Name",
        "type" => "text",
        "name" => "name",
        "required" => true,
        "placeholder" => "Your Name"
    ],
    [
        "icon" => "envelope",
        "label" => "Email",
        "type" => "email",
        "name" => "email",
        "required" => true,
        "placeholder" => "Your Email"
    ],
    [
        "icon" => "lock-closed",
        "label" => "Password",
        "type" => "password",
        "name" => "password",
        "required" => true,
        "placeholder" => "Your Password"
    ],
    [
        "icon" => "lock-closed",
        "label" => "Confirm Password",
        "type" => "password",
        "name" => "password_confirmation",
        "required" => true,
        "placeholder" => "Confirm Your Password"
    ]
];

@endphp
<h2 class="text-2xl font-bold text-gray-800">
Register Now!
</h2>
<p class="text-sm text-gray-500 mt-1">
Welcome back! Please enter your details.
</p>
<form class="mt-6 space-y-5" method="POST" action="{{ route('register') }}">
@csrf
<!-- EMAIL -->
    @foreach ($inputs as $input)
        <x-atoms.input
            :icon="$input['icon']"
            :label="$input['label']"
            :type="$input['type']"
            :name="$input['name']"
            :required="$input['required']"
            :placeholder="$input['placeholder']"
        />
    @endforeach
                        <button
                        type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg transition"
                    >
                        Register in →
                    </button>
                                        <!-- SIGN UP -->
                    <p class="text-center text-sm text-gray-500">
                        Have an account?
                        <a href="/login" class="text-blue-600 font-medium hover:underline">
                            Sign In
                        </a>
                    </p>