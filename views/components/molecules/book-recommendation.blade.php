@props(['books'])
<div >
        <div class="flexBetween my-[2rem]">
            <h1 class="text-[2rem] font-medium">Book Recommendations</h1>
            <a href="" class="bg-white rounded-md px-2 py-1"><span>View All</span> 
                <x-heroicon-o-chevron-right class="w-5 h-5 inline-block ml-1"/>
            </a>
        </div>
    <div class="  grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books as $book)
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                    <img src="{{ $book['cover'] }}" alt="{{ $book['title'] }}" class="h-64 w-full object-cover">
            </div>
        @endforeach
    </div>
</div>