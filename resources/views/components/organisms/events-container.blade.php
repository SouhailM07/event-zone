<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- Section Title -->
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Upcoming Events</h2>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition duration-300">
                
                <!-- Thumbnail -->
                <div class="w-full h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>

                <!-- Event Info -->
                <div class="p-4 space-y-2">
                    <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $event->title }}</h3>
                    <p class="text-sm text-gray-500 truncate">{{ $event->location }}</p>

                    <p class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($event->stated_at)->format('F j, Y, g:i A') }}
                        @if($event->end_at)
                            - {{ \Carbon\Carbon::parse($event->end_at)->format('g:i A') }}
                        @endif
                    </p>

                    <p class="text-sm text-gray-700 font-medium">
                        Price: {{ $event->price > 0 ? $event->price . ' DA' : 'Free' }}
                    </p>

                    <div class="mt-2">
                        <a href="{{ route('events.show', $event->id) }}"
                           class="block text-center py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-3 text-center">No upcoming events available.</p>
        @endforelse
    </div>
</div>
