@props(["name" => "", "label"=>"","required" => false,"value" => "","class" => ""])
<div>
@if($label)
<label class="block text-sm font-medium text-gray-700 mb-1">
{{ $label }}
</label>
@endif
<div class="relative flex flex-col justify-center">
    <textarea
    {{$attributes}} 
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    @class([
        "w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500",
        $class
    ])
    @required($required)
    ></textarea>
</div>
@error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
</div>
{{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
