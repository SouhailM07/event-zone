@props(['name'])

@if($name === 'mail')
<svg xmlns="http://www.w3.org/2000/svg" class="{{ $attributes->merge(['class' => 'w-4 h-4']) }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M16 12l-4 4m0 0l-4-4m4 4V8m8-2H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V8a2 2 0 00-2-2z"/>
</svg>
@endif

@if($name === 'lock')
<svg xmlns="http://www.w3.org/2000/svg" class="{{ $attributes->merge(['class' => 'w-4 h-4']) }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 11c1.657 0 3 1.567 3 3.5S13.657 18 12 18s-3-1.567-3-3.5S10.343 11 12 11zm6 0h-1V8a5 5 0 10-10 0v3H6a2 2 0 00-2 2v9h16v-9a2 2 0 00-2-2z"/>
</svg>
@endif
