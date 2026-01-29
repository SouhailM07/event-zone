@php
    $locals=['en','fr','ar']
@endphp
<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="inline-flex items-center justify-center text-white bg-indigo-600 box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none" type="button">
    <x-heroicon-o-language class="size-6"/>
</button>

<!-- Dropdown menu -->
<div id="dropdown" class="z-10 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
    <ul class="p-2 text-sm text-body font-medium" aria-labelledby="dropdownDefaultButton">
        @foreach ($locals as $local)
      <li>
        <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">{{$local}}</a>
      </li>
        @endforeach
    </ul>
</div>
