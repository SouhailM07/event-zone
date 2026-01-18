@props([
    "name" => "",
    "label" => "",
    "required" => false,
    "class" => "",
    "value" => null, // <-- pass existing image URL here
])

@php
    $previewId = 'thumbnailPreview_' . $name;
    $iconId = 'thumbnailIcon_' . $name;
    $hasValue = !empty($value);
@endphp

<div>
    @if($label)
        <label class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <div class="flex items-center gap-6">
        <div class="w-32 h-32 rounded-lg border bg-gray-50 flex items-center justify-center overflow-hidden">
            <img 
                id="{{ $previewId }}" 
                class="{{ $hasValue ? 'block' : 'hidden' }} w-full h-full object-cover" 
                src="{{ $hasValue ? $value : '' }}"
            >
            <x-heroicon-o-photo 
                id="{{ $iconId }}" 
                class="{{ $hasValue ? 'hidden' : 'w-10 h-10 text-gray-400' }}"
            />
        </div>

        <input
            {{$attributes}}
            type="file"
            name="{{ $name }}"
            accept="image/*"
            data-preview="{{ $previewId }}"
            data-icon="{{ $iconId }}"
            onchange="previewThumbnail(event)"
            @class([
                "text-sm text-gray-600",
                $class
            ])
            @required($required)
        >
    </div>

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<script>
    function previewThumbnail(event) {
        const input = event.target;
        const preview = document.getElementById(input.dataset.preview);
        const icon = document.getElementById(input.dataset.icon);
        const file = input.files[0];

        if (!file) {
            preview.classList.add('hidden');
            icon.classList.remove('hidden');
            preview.src = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = () => {
            preview.src = reader.result;
            preview.classList.remove('hidden');
            icon.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
</script>
