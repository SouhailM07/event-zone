@php
    $selects=[
        ["label" => "fiction", "value" => "fiction"],
        ["label" => "non-fiction", "value" => "non-fiction"],
        ["label" => "science", "value" => "science"],
        ["label" => "history", "value" => "history"],
        ["label" => "biography", "value" => "biography"],
    ];
@endphp




<div class="h-screen aspect-video bg-green-400/30 z-[-1]  absolute top-[-18%] left-[28%] rounded-4xl"></div>
            <section >
                <h1 class="text-[2rem] font-medium mb-4">Discover</h1>
                <article class="flex shadow-md rounded-md p-2 bg-white gap-2">
<form class="min-w-[10rem] mx-auto">
    <x-atoms.selects :selects="$selects" selected="All Categories"/>
</form>
<div class="w-full border-x border-gray-400 px-2 flex items-center ">
    <x-heroicon-o-magnifying-glass class="size-6"/>
    <input type="text" placeholder="search book"  class="w-full indent-[1rem]">
</div>
                    <button class="bg-emerald-600 text-white px-4 py-2 rounded-md">Search</button>
                </article>
            </section>