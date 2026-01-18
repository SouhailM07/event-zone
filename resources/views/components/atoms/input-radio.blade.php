@props([
    'label' => '',
    'name',
    'value',
    'checked' => false,
    'class' => ''
])

<label class="flex items-center gap-2 cursor-pointer text-sm">
    <input
        type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        @class([$class,"h-4 w-4 border-gray-300"])
        {{ old($name) === $value || (old($name) === null && $checked) ? 'checked' : '' }}
        {{$attributes}}
    />
    <span class="text-gray-700">{{ $label }}</span>
</label>
