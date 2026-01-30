@php
$inputs = [
    [
        "icon" => "tag",
        "type" => "text",
        "name" => "name",
        "required" => true,
        "label" => __('register.inputs.name.label'),
        "placeholder" => __('register.inputs.name.placeholder'),
        "old"=>true
    ],
    [
        "icon" => "envelope",
        "type" => "email",
        "name" => "email",
        "required" => true,
        "label" => __('register.inputs.email.label'),
        "placeholder" => __('register.inputs.email.placeholder')
    ],
    [
        "icon" => "lock-closed",
        "type" => "password",
        "name" => "password",
        "required" => true,
        "label" => __('register.inputs.password.label'),
        "placeholder" => __('register.inputs.password.placeholder')
    ],
    [
        "icon" => "lock-closed",
        "type" => "password",
        "name" => "password_confirmation",
        "required" => true,
        "label" => __('register.inputs.password_confirmation.label'),
        "placeholder" => __('register.inputs.password_confirmation.placeholder')
    ]
];
@endphp

<h2 class="text-2xl font-bold text-gray-800">
    {{ __('register.title') }}
</h2>
<p class="text-sm text-gray-500 mt-1">
    {{ __('register.subtitle') }}
</p>

<form class="mt-6 space-y-5" method="POST" action="{{ route('register') }}">
    @csrf
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
        {{ __('register.submit') }} →
    </button>

    <p class="text-center text-sm text-gray-500">
        {{ __('register.signin_text') }}
        <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">
            {{ __('register.signin_link') }}
        </a>
    </p>
</form>
