<header class="bg-white  flex items-center h-[5rem] px-[1rem]  sticky top-0 ">
<nav class="flex justify-between items-center w-full">
    <div>
        {{-- for back btn --}}
    </div>
    <ul class="flex items-center gap-6">
        @auth
            <li class="flex gap-2">
                <x-heroicon-o-phone class="size-6"/>
                <span>Support</span>
            </li>
            <li >
                <x-heroicon-o-bell class="size-6"/>
            </li>
            <li>
                <x-heroicon-o-language class="size-6"/>
            </li>
            <x-molecules.user-popover/>
        @endauth
        @guest
            <li>
                <a href="{{route("register")}}">Register</a>
            </li>
            <li>
                <a href="{{route("login")}}" class="bg-indigo-500 text-white p-4 rounded-lg hover:bg-indigo-600">Login</a>
            </li>
        @endguest
    </ul>
</nav>
</header>
