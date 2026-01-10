@php
    $navItems = [
        ["label" => "Home", "url" => "/", "icon" => "home"],
        ["label" => "Categories", "url" => "categories", "icon" => "tag"],
        ["label" => "My Tickets", "url" => "/profile", "icon" => "ticket"],
        ["label" => "My Favorite Events", "url" => "/profile", "icon" => "bookmark"],
        ["label" => "Inventory", "url" => "/inventory", "icon" => "squares-2x2"],
    ];
    $currentRoute = request()->path();
@endphp
<aside class="min-w-[5rem] flex flex-col justify-between items-center pb-[1rem] drop-shadow-2xl bg-white [height:calc(100vh-5rem)] top-20 sticky">
    <div class=" w-full ">
        <ul class="w-full ">
            @foreach ($navItems as $navItem)
            <li class="relative w-full">
                <a href="{{ $navItem['url'] }}" @class(["bg-indigo-500 text-white"=>$navItem['url']==$currentRoute,"flex flex-col items-center py-4 hover:bg-gray-200 min-w-full "])>
                    <x-dynamic-component :component="'heroicon-o-'.$navItem['icon']" class="w-6 h-6"/>
                </a>
            </li>
            @endforeach
            @auth
            @if(auth()->user()->role->name=='admin')
            <li class="relative">
                <a href="/admin-panel/users" @class(["flex flex-col items-center py-4 hover:bg-gray-200 bg-red-500 text-white"])>
                    <x-heroicon-o-shield-check class="w-6 h-6"/>
                </a>
            </li>
            @endif
            @endauth
        </ul>
            </div>
            <a href="{{route('events.new')}}" class="bg-indigo-500 text-white w-4/5 aspect-square rounded-xl flex flex-col items-center flexCenter hover:bg-gray-200">
                <x-heroicon-o-plus class="size-[1.8rem]"/>
            </a>
</aside>