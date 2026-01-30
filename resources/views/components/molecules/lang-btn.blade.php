@php
    $locales = ['en', 'fr'];
    $currentLocale = app()->getLocale();
@endphp


<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="inline-flex items-center justify-center text-white bg-indigo-600 box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none" type="button">
  <x-heroicon-o-language class="size-5"/>
  {{-- <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/></svg> --}}
  <span class="font-medium translate-x-2 translate-y-2">
    {{$currentLocale  }}
  </span>
</button>

<!-- Dropdown menu -->
<div id="dropdown" class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
    <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownDefaultButton">
        @foreach ($locales as $locale)
        <li>
        <a href="{{ url('/lang/'.$locale) }}" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">{{$locale}}</a>
      </li>
@endforeach
    </ul>
</div>

