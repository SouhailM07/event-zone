@php
$navLinks = [
["label" => "discover",    "link" => "/",     "icon" => "home",           "isForUser" => false],
["label" => "categories",    "link" => "/category",     "icon" => "squares-2x2",      "isForUser" => false],
["label" => "my library",  "link" => "/library",      "icon" => "book-open",      "isForUser" => true],
["label" => "favorite",    "link" => "/favorite",     "icon" => "heart",          "isForUser" => true],
["label" => "settings",    "link" => "/settings",     "icon" => "cog-8-tooth",            "isForUser" => true],
["label" => "help",        "link" => "/help",         "icon" => "question-mark-circle", "isForUser" => false],
// ["label" => "logout",      "link" => "/logout",       "icon" => "arrow-left-on-rectangle", "isForUser" => true],
];

@endphp

    <aside class="justify-between w-[14.8rem] h-screen flex flex-col sticky top-0 capitalize px-6 pb-2 pt-4 drop-shadow-2xl bg-white">
                <div>
        <div class="flexBetween mb-4">
            <h1 class="text-lg">menu</h1>
            <button class="border rounded-md border-black p-2 size-8">
                <x-heroicon-o-bars-3 class="size-4"/>
            </button>
        </div>
        <ul class="space-y-2">
                        @foreach($navLinks as $navLink)
                        @if(!$navLink["isForUser"])
                        <x-atoms.navlink :navLink="$navLink"/>
                        @endif
                        @endforeach
                    </ul>
                    <hr class="my-4 border-none h-px bg-gray-300 rounded-full"/>
                    <ul class="space-y-2">
                        @foreach($navLinks as $navLink)
                        @if($navLink["isForUser"])
                        <x-atoms.navlink :navLink="$navLink"/>
                        @endif
                        @endforeach
                    </ul>

                    </div>
                    <div class="mt-4">
                        <img src="/images/logo.jpg" alt="logo" class="w-full aspect-square rounded-xl  "/>
                    </div>
                </aside>
                <script>
                    let btn=document.querySelector("aside button");
    btn.onclick=()=>{
        let aside=document.querySelector("aside");
        let menuH1=document.querySelector("aside h1");
        let logo =document.querySelector("aside img");
        btn.classList.toggle("mx-auto");
        logo.classList.toggle("p-3");
        menuH1.classList.toggle("hidden");
        aside.classList.toggle("w-[14.8rem]");
        aside.classList.toggle("w-18");
        aside.classList.toggle("px-6");
        let listspans=document.querySelectorAll("aside ul li");
        listspans.forEach(li=>{
            li.classList.toggle("justify-center");
        });
        let labels=document.querySelectorAll("aside ul li span");
        labels.forEach(label=>{
            label.classList.toggle("hidden");
        });
    }
</script>