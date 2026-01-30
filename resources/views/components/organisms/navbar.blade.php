<header class="bg-white flex items-center h-[5rem] pr-[1rem] sticky top-0 z-[20]">
    <nav class="flex justify-between items-center w-full gap-[1rem]">
        {{-- Logo --}}
        <img src="{{ asset('images/logo.png') }}" alt="logo" height="120" width="120" class="size-[5rem] object-fill"/>

        {{-- Search & Category --}}
        <form action="{{ route('events.index') }}" method="GET" class="w-full grid grid-cols-[1fr_12rem] gap-[1rem]">
            @csrf
            <x-atoms.input class="w-full" icon="magnifying-glass" name="title" placeholder="{{ __('navbar.search') }}"/>
            <select name="category" onchange="this.form.submit()" id="categories" class="rounded-2xl px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                <option value="">{{ __('navbar.all') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </form>

        {{-- Right Links --}}
        <ul class="flex items-center gap-6">
            {{-- Support --}}
            <li>
                <a href="{{ route('support') }}" class="flex gap-2">
                    <x-heroicon-o-phone class="size-6"/>
                    <span>{{ __('navbar.support') }}</span>
                </a>
            </li>

            {{-- Language Switcher --}}
            <x-molecules.lang-btn/>

            {{-- Authenticated User --}}
            @auth
                <x-molecules.user-popover/>
            @endauth

            {{-- Guest Links --}}
            @guest
                <li>
                    <a href="{{ route('register') }}">{{ __('navbar.register') }}</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="bg-indigo-500 text-white p-4 rounded-lg hover:bg-indigo-600">{{ __('navbar.login') }}</a>
                </li>
            @endguest
        </ul>
    </nav>
</header>
