@props(["navLink"])

@php
    // Get current path WITHOUT locale prefix
    $currentPath = request()->path();

    // Supported locales
    $locales = ['en', 'fr', 'ar'];

    // Remove locale prefix if present
    $segments = explode('/', $currentPath);
    if (in_array($segments[0], $locales)) {
        array_shift($segments);
    }
    $cleanPath = implode('/', $segments);

    // Clean navLink path (remove leading slash)
    $linkPath = ltrim($navLink['link'], '/');
@endphp

<li class="flex items-center gap-4 hover:bg-emerald-700 hover:text-white p-1 rounded-md">
    <x-dynamic-component 
        :component="'heroicon-s-' . $navLink['icon']"
        @class([
            'bg-emerald-600! text-white!' => $cleanPath === $linkPath,
            'size-8 text-gray-500 bg-gray-200 p-2 rounded-md ',
        ])
    />
    
    <span>

        {{ $navLink['label'] }}
    </span>
</li>
