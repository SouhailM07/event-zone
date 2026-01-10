<x-templates.home-template title="categories">
    <ul class="grid sm:grid-cols-2  md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($categories as $category )
            <li class="h-[4rem] "><a href="#" class="bg-slate-300 rounded  size-full grid place-items-center">
                {{$category->name}}
                </a></li>
        @endforeach
    </ul>
</x-templates.home-template>