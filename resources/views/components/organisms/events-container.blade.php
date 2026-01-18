<h1 class="text-3xl font-bold text-gray-900 mb-6">Upcoming Events</h1>

@forelse($eventsByCategory as $category)
    <h2 class="text-2xl font-bold text-gray-900 my-6">{{ $category['type'] }}</h2>
    
    <div class="swiper mySwiper ">
        <div class="swiper-wrapper gap-[1rem]  min-h-[20rem]">
            @forelse ($category['events'] as $event)
                <div class="swiper-slide gap-[1rem] h-auto! ">
                    <x-molecules.event-card  :event="$event"/>
                </div>
            @empty
                <p class="text-gray-500 text-center w-full py-4">No upcoming events available.</p>
            @endforelse
        </div>
        
        {{-- Pagination & Navigation --}}
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next bg-emerald-400 rounded-full p-2"></div>
        <div class="swiper-button-prev bg-emerald-400 rounded-full p-2"></div>
    </div>
@empty
    <div class="text-gray-500 text-center py-4 ">No upcoming events available.</div>
@endforelse
