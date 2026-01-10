<h2 class="text-2xl font-bold text-gray-900 mb-6">Upcoming Events</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($events as $event)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300">
            <!-- Image -->
            <div class="relative h-52 overflow-hidden rounded-t-2xl">
                <img
                    src="{{ $event->thumbnail }}"
                    alt="{{ $event->title }}"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                />

                <!-- Badge -->
                <span class="absolute top-3 left-3 bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                    In Person
                </span>
            </div>

            <!-- Content -->
            <div class="p-5 space-y-3">

                <!-- Title -->
                <h3 class="text-lg font-semibold text-gray-900 leading-tight">
                    {{ $event->title }}
                </h3>

                <!-- Date -->
                <div class="flex items-center text-sm text-gray-500 gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10m-11 8h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>

                    <span>
                        {{ \Carbon\Carbon::parse($event->stated_at)->format('j M Y') }}
                        @if($event->end_at)
                            – {{ \Carbon\Carbon::parse($event->end_at)->format('j M Y') }}
                        @endif
                    </span>
                </div>

                <!-- Location -->
                <div class="flex items-center text-sm text-gray-500 gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5s-3 1.343-3 3 1.343 3 3 3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19.5 10c0 7-7.5 11-7.5 11S4.5 17 4.5 10a7.5 7.5 0 1115 0z"/>
                    </svg>
                    <span>{{ $event->location }}</span>
                </div>

                <!-- Price -->
                <p class="text-sm font-medium text-gray-700">
                    {{ $event->price > 0 ? $event->price . ' DA' : 'Free Event' }}
                </p>
            </div>

            <!-- Footer -->
            <div class="px-5 pb-5 flex items-center justify-between">

                <!-- Avatars + Rating -->
                <div class="flex items-center gap-3">
                    <div class="flex -space-x-2">
                        <img class="w-7 h-7 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=1">
                        <img class="w-7 h-7 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=2">
                        <img class="w-7 h-7 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=3">
                    </div>

                    <div class="text-xs text-gray-500">
                        <span class="font-semibold text-gray-700">4.9</span> (210 Reviews)
                    </div>
                </div>

                <!-- CTA -->
                <a href="{{ route('events.show', $event->id) }}"
                   class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                    Register
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500 col-span-3 text-center">No upcoming events available.</p>
    @endforelse
</div>
