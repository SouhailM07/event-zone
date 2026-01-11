<header class="bg-white  flex items-center h-[5rem] pr-[1rem]  sticky top-0 z-[20]">
<nav class="flex justify-between items-center w-full gap-[1rem]">
            <img src={{asset("images/logo.png")}} alt="logo" height="120" width="120" class="size-[5rem]  object-fill"/>
    <div class="w-full grid grid-cols-[1fr_12rem] gap-[1rem]">
        {{-- for back btn --}}
        <x-atoms.input class="w-full " icon="magnifying-glass" name="event_search" placeholder="search"/>
                <select name="roleId" onchange="this.form.submit()" id="countries" class=" rounded-2xl px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm  focus:ring-brand focus:border-brand shadow-xs placeholder:text-body ">
                    {{-- <option selected value={{$selectedUser['role_id']}}>{{$selectedUser['role']->name}}</option> --}}
                    @foreach ($categories as $category)
                    <option value={{$category['id']}}>{{$category['name']}}</option>
                    @endforeach
                </select>
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