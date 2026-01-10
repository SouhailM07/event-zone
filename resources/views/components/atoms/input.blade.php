@props(["icon"=>"","type" => "text", "name" => "", "label"=>"","placeholder" => "","required" => false,"value" => "","class" => "",'old'=>false])
<div>

@if($label)
<label class="block text-sm font-medium text-gray-700 mb-1">
{{ $label }}
</label>
@endif
<div x-data="{ show: false }" class="relative flex flex-col justify-center">
@if($icon)
    <x-dynamic-component
        :component="'heroicon-o-' . $icon"
        class="translate-x-2 absolute w-5 h-5 text-gray-500"
    />
@endif
    <input
    {{$attributes}} 
    :type="show ? 'text' : '{{ $type }}'"
    {{-- type="{{ $type }}" --}}
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    @class([
         'indent-[1.2rem]'=>$icon,
        'w-full py-2 px-4 rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
        $class
    ])
    @required($required)
    >
    @if($type=="password")
 <button type="button" @click="show = !show" class="absolute right-2">
        <x-heroicon-o-eye x-show="!show" class="w-5 h-5 text-gray-400"/>
        <x-heroicon-o-eye-slash x-show="show" class="w-5 h-5 text-gray-400"/>
    </button>
    @endif
</div>
@error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
</div>
{{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
