@props(['books','link'=>"#",'title'=>'Book Shelf'])
<div >
        <div class="flexBetween my-[2rem]">
            <h1 class="text-[2rem] font-medium">{{$title}}</h1>
            <a href="" class="bg-white rounded-md p-2 drop-shadow-xl"> 
                <x-heroicon-o-squares-2x2 class="size-5"/> 
            </a>
        </div>
    <div class="  grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books as $book)
            <div class="bg-white rounded-lg gap-8 shadow-md overflow-hidden flex flex-col">
                    <img src="{{ $book['cover'] }}" alt="{{ $book['title'] }}" class="h-[10rem]  object-contain"/>
                    <h1 class="text-center font-semibold mb-2">{{ $book['title'] }}</h1>
            </div>
        @endforeach
    </div>
</div>