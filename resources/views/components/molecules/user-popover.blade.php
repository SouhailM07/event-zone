<li>
    <button data-popover-target="popover-default" type="button">
        <img 
            src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
            class="min-w-[3.4rem] h-[3.4rem] p-2 bg-gray-200 rounded-full" alt="avatar"/>
    </button>

    <div data-popover id="popover-default" role="tooltip" class="absolute z-10 invisible inline-block w-72 text-sm text-body transition-opacity duration-300 bg-neutral-primary-soft border border-default rounded-base shadow-xs opacity-0">

        {{-- Header --}}
        <div class="px-3 flexBetween py-2 bg-neutral-tertiary border-b border-default rounded-t-base">
            <h3 class="font-medium text-heading">{{ auth()->user()->name }}</h3>
            @if(auth()->user()->account_verified)
                <span class="text-sm text-green-600 flex items-center gap-1">
                    <x-heroicon-o-shield-check class="size-4 inline text-green-600"/>
                    {{ __('user.verified_user') }}
                </span>
            @else
                <span class="text-sm text-red-600 flex items-center gap-1">
                    <x-heroicon-o-x-circle class="size-4 inline text-red-600"/>
                    {{ __('user.unverified_user') }}
                </span>
            @endif
        </div>

        {{-- Links --}}
        <ul class="py-2 text-lg">
            @php
                $links = [
                    ["label" => __('user.view_profile'), "link" => "profile", "icon" => "user"],
                    ["label" => __('user.logout'), "link" => "/logout", "icon" => "power"]
                ];
            @endphp
            @foreach ($links as $link)
                <li class="flexBetween hover:bg-indigo-400 px-[1rem] hover:text-white m-2 rounded-sm">
                    <a href="{{ $link['link'] }}" class="py-[1rem] w-full inline-block!">{{ $link['label'] }}</a>
                    <x-dynamic-component :component="'heroicon-o-' . $link['icon']" class="inline size-6"/>
                </li>
            @endforeach
        </ul>

        {{-- Footer: Email --}}
        <div class="px-3 py-2 flexBetween bg-neutral-tertiary border-b border-default rounded-b-base">
            <h3 class="font-medium text-heading">{{ auth()->user()->email }}</h3>
            @if(auth()->user()->email_verified_at)
                <span class="text-sm text-green-600 flex items-center gap-1">
                    <x-heroicon-o-shield-check class="size-4 inline text-green-600"/>
                    {{ __('user.verified') }}
                </span>
            @else
                <span class="text-sm text-red-600 flex items-center gap-1">
                    <x-heroicon-o-x-circle class="size-4 inline text-red-600"/>
                    {{ __('user.unverified') }}
                </span>
            @endif
        </div>

    </div>
</li>
