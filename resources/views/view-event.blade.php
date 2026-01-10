<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="view event"/>
    <x-atoms.tailwindcss/>
</head>
<body>
    
<div class="max-w-5xl mx-auto px-6 py-8">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('home') }}" 
           class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800">
            <x-heroicon-o-arrow-left class="w-5 h-5"/>
            Back to Events
        </a>
    </div>

    <!-- Event Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">

        <!-- Banner / Thumbnail -->
        <div class="w-full h-64 md:h-96 overflow-hidden">
            
            <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}"
                 class="w-full h-full object-cover">
        </div>

        <!-- Event Details -->
        <div class="p-6 space-y-4">

            <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>

            <div class="flex flex-wrap items-center gap-4 text-gray-500 text-sm">
                <div class="flex items-center gap-1">
                    <x-heroicon-o-map-pin class="w-5 h-5"/>
                    <span>{{ $event->location }}</span>
                </div>
                @if($event->coordination)
                <div class="flex items-center gap-1">
                    <x-heroicon-o-map-pin class="w-5 h-5"/>
                    <span>{{ $event->coordination }}</span>
                </div>
                @endif
                <div class="flex items-center gap-1">
                    <x-heroicon-o-calendar class="w-5 h-5"/>
                    <span>
                        {{ \Carbon\Carbon::parse($event->stated_at)->format('F j, Y, g:i A') }}
                        @if($event->end_at)
                            - {{ \Carbon\Carbon::parse($event->end_at)->format('g:i A') }}
                        @endif
                    </span>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-6 text-gray-700">
                <span class="font-medium">Price: {{ $event->price > 0 ? $event->price . ' DA' : 'Free' }}</span>
                <span class="font-medium">Tickets: {{ $event->quantity === 0 ? 'Infinite' : $event->quantity }}</span>
                <span class="font-medium">Status: 
                    <span class="capitalize {{ $event->validation === 'approved' ? 'text-green-600' : ($event->validation === 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $event->validation }}
                    </span>
                </span>
            </div>

            <hr class="my-4 border-gray-200">

            <!-- Description -->
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($event->description)) !!}
            </div>

            <!-- Optional CTA -->
            <div class="mt-6">
                <a href="{{ route('home') }}" 
                   class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Back to Events
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>