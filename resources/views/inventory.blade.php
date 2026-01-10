<x-templates.home-template title="inventory">
<div class="p-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            My Events
        </h1>

        <a href="{{ route('events.new') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            <x-heroicon-o-plus class="w-5 h-5" />
            Create Event
        </a>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">

                <!-- Image -->
                <div class="relative h-40">
                    <img
                        src="{{ $event->cover_image ?? 'https://picsum.photos/600/400' }}"
                        alt="{{ $event->title }}"
                        class="w-full h-full object-cover"
                    />

                    <!-- Status Badge -->
                    <span class="absolute top-3 left-3 px-3 py-1 text-xs font-medium rounded-full
                        {{ $event->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <!-- Content -->
                <div class="p-4 space-y-3">
                    <h2 class="font-semibold text-lg text-gray-800 truncate">
                        {{ $event->title }}
                    </h2>

                    <!-- Meta -->
                    <div class="text-sm text-gray-500 space-y-1">
                        <div class="flex items-center gap-2">
                            <x-heroicon-o-calendar class="w-4 h-4" />
                            {{ $event->start_date->format('d M Y') }}
                        </div>

                        <div class="flex items-center gap-2">
                            <x-heroicon-o-map-pin class="w-4 h-4" />
                            {{ $event->location }}
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center justify-between pt-3 border-t">
                        <span class="text-sm font-medium text-gray-700">
                            {{ $event->price }} DA
                        </span>

                        <span class="flex items-center gap-1 text-sm text-gray-500">
                            <x-heroicon-o-users class="w-4 h-4" />
                            {{ $event->attendees_count ?? 0 }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 pt-3">
                        <a href="{{ route('events.show', $event) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm rounded-lg bg-gray-100 hover:bg-gray-200">
                            <x-heroicon-o-eye class="w-4 h-4" />
                            View
                        </a>

                        {{-- <a href="{{ route('events.edit', $event) }}" --}}
                        <a href="#"
                           class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200">
                            <x-heroicon-o-pencil-square class="w-4 h-4" />
                            Edit
                        </a>

                        {{-- <form action="{{ route('events.destroy', $event) }}" method="POST"> --}}
                        <form action="#" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                onclick="return confirm('Delete this event?')"
                                class="inline-flex items-center justify-center p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                <x-heroicon-o-trash class="w-4 h-4" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 text-gray-500">
                <x-heroicon-o-calendar-days class="w-10 h-10 mx-auto mb-3" />
                No events published yet.
            </div>
        @endforelse
    </div>
</div>
</x-templates.home-template>