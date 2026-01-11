<h1 class="text-3xl font-bold text-gray-900 mb-6">Upcoming Events</h1>

 <ul class="">
    @forelse($eventsByCategory as $event)
    <h2 class="text-2xl font-bold text-gray-900 my-6">{{$event['type']}}</h2>
    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($event["events"] as $event)
        <x-molecules.event-card :event="$event"/>
    @empty
        <p class="text-gray-500 col-span-3 text-center">No upcoming events available.</p>
        @endforelse
    </ul>
    @empty
        <p class="text-gray-500 col-span-3 text-center">No upcoming events available.</p>
    @endforelse
</ul> 
