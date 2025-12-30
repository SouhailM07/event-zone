
<header class="relative z-[1] ">
            <nav class="flex items-center justify-end ">
                <ul class="flex items-center gap-4 ">
                    <li data-popover-target="popover-default" class="flex items-center gap-2">
                        <img class="size-[2.8rem] rounded-full" src="https://ui-avatars.com/api/?name=User&background=random&color=fff&size=128" alt="avatar"/>
                        <span>shadow warrior</span>
                    <x-heroicon-o-chevron-down class="size-4"/></li>
                    </li>
                    <div data-popover id="popover-default" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-body transition-opacity duration-300 bg-neutral-primary-soft border border-default rounded-base shadow-xs opacity-0">
<ul class="px-3 py-2 space-y-1">
    <!-- Profile -->
    <li>
        <a 
            href="/profile" 
            class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-emerald-500/15 dark:hover:bg-emerald-600/20 transition-colors"
        >
            <x-heroicon-s-user class="w-5 h-5 text-emerald-600 dark:text-emerald-400" />
            <span class=" ">Profile</span>
        </a>
    </li>

    <!-- Logout -->
    <li>
        <form method="POST" >
            @csrf
            <button 
                type="submit" 
                class="w-full flex items-center gap-2 px-3 py-2 rounded-md  hover:bg-emerald-600/20 transition-colors text-left"
            >
                <x-heroicon-s-arrow-left-on-rectangle class="w-5 h-5 text-emerald-600 dark:text-emerald-400" />
                <span class= dark:text-gray-200">Logout</span>
            </button>
        </form>
    </li>
</ul>


    <div data-popper-arrow></div>
</div>
                    <li>
                        <x-heroicon-o-bell class="size-6"/>
                    </li>
                </ul>
            </nav>
        </header>