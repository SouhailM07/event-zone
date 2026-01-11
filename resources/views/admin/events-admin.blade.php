<x-templates.admin-template>
    <main class="">
        <ul>

            @forelse ($events as $event)
                <li class="h-[4rem] p-[1rem] items-center border-b-gray-400 border-b grid grid-cols-5">
                    <div class="flex gap-4 ">
                        <span><img class="size-[2rem] bg-gray-300 rounded-full p-1" src="{{$event->user->avatar}}" alt="avatar"></span>
                        <span>{{$event->user->name}}</span>
                    </div>
                    <span>{{$event['title']}}</span>
                    <span class="text-center">{{ \Carbon\Carbon::parse($event->stated_at)->format('j M Y') }}</span>
                    <span ><x-atoms.event-status :status="$event['validation']"/></span>
                    {{-- actions --}}
                    <button class=" bg-indigo-700 text-white p-2 rounded-md">View</button>
                </li>
            @empty
            <li class="text-gray-500 col-span-3 text-center">No upcoming events available.</li>
            @endforelse
        </ul>
    </main>
</x-templates.admin-template>