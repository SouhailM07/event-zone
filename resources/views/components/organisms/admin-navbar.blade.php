<style>
  /* Hide default scrollbar */
  #navContainer::-webkit-scrollbar {
    display: none;
  }
  #navContainer {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
  }
</style>
<header id="navContainer" class="sticky bg-white top-0 overflow-x-auto flex gap-4 cursor-grab rounded-xl p-4 select-none">
  <nav class='flexBetween w-full gap-[2rem]' id="nav">
        <h1 class="text-2xl font-bold min-w-[12rem] text-gray-800 ">
            <x-heroicon-o-shield-check class="w-8 h-8 inline-block text-blue-600 mr-2"/>
            <span>Admin Panel</span>
        </h1>
    <ul class="flex gap-6 select-none">
        @php
            $navLinks=[
                ["label"=>'dashboard','link'=>"admin-panel/dashboard","icon"=>"chart-bar-square"],
                ["label"=>'users','link'=>"admin-panel/users","icon"=>"users"],
                ["label"=>'events','link'=>"admin-panel/events","icon"=>"rocket-launch"],
                ["label"=>'reports','link'=>"admin-panel/reports","icon"=>"exclamation-triangle"],
                ["label"=>'activities logs','link'=>"admin-panel/logs","icon"=>"presentation-chart-line"],
                ["label"=>'Global Data','link'=>"admin-panel/globals","icon"=>"globe-alt"],
                ["label"=>'Exit','link'=>"","icon"=>"arrow-right-start-on-rectangle","class"=>"bg-red-500 text-white"]
    ];
            $currentRoute= request()->path();
        @endphp
        @foreach ($navLinks as $navLink)
            <li>
                <a href="{{ '/'.$navLink['link'] }}" 
                @class([$navLink['class']??"","bg-indigo-600 text-white"=>$currentRoute==$navLink['link'],"whitespace-nowrap flex p-2  rounded items-center gap-4 text-gray-700 hover:bg-indigo-500 hover:text-white"])>
                    <x-dynamic-component :component="'heroicon-o-'.$navLink['icon']" name="{{ $navLink['icon'] }}" class="size-6"/>
                    <span class="text-sm font-medium">{{ ucfirst($navLink['label']) }}</span>
                </a>
            </li>
            @endforeach
    </ul>
    </nav>
</header>

<script>
const slider = document.getElementById('navContainer');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
  isDown = true;
  slider.classList.add('cursor-grabbing');
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});

slider.addEventListener('mouseleave', () => {
  isDown = false;
  slider.classList.remove('cursor-grabbing');
});

slider.addEventListener('mouseup', () => {
  isDown = false;
  slider.classList.remove('cursor-grabbing');
});

slider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const walk = (x - startX) * 2; // scroll-fast
  slider.scrollLeft = scrollLeft - walk;
});
</script>