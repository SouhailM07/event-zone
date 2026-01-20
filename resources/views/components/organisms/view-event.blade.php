{{-- types for public , private ,admin --}}
@props(["type"=>"public","event"=>""])
<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="View Event"/>
    <x-atoms.tailwindcss/>
</head>
<body class="bg-gray-50 font-sans">

<div class="max-w-6xl mx-auto px-6 py-12">

    <!-- Back Button -->
    <div class="mb-6">
        @switch($type)
            @case("public")
        <a href="{{ route('home') }}" 
           class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium">
            <x-heroicon-o-arrow-left class="w-5 h-5"/>
            Back to Events
        </a>
                @break
            @case('private')
                    <a href="{{ route('inventory.index') }}" 
           class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium">
            <x-heroicon-o-arrow-left class="w-5 h-5"/>
            Back to Inventory
        </a>
        @break
            @case('admin')
                    <a href="{{ route('admin.events.index') }}" 
           class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium">
            <x-heroicon-o-arrow-left class="w-5 h-5"/>
            Back to Events Admin
        </a>
        @endswitch
        
    @if($type=="private"||$type=="admin")
        <x-atoms.event-alert-validation :status="$event->validation"/>
    @endif
    </div>
    <!-- Event Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">

        <!-- Top Row: Image + Details -->
        <div class="grid md:grid-cols-2 gap-8 p-8">

            <!-- Left: Event Image -->
            @if($event->thumbnail)
            <div class="overflow-hidden rounded-xl shadow-inner">
                <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}"
                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
            </div>
            @endif

            <!-- Right: Event Details + Badges + Actions -->
            <div class="flex flex-col justify-between space-y-6">

                <!-- Top Details -->
                <div class="space-y-4">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>

                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 text-sm font-medium">
                        {{-- categories not type fix it --}}
                        <span class="px-3 py-1 rounded-full {{ $event->type === 'public' ? 'bg-blue-100 text-blue-800' : 'bg-gray-200 text-gray-700' }}">
                            {{ ucfirst($event->type) }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-800">
                            {{ $event->price > 0 ? $event->price . ' DA' : 'Free' }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-800">
                            {{ $event->quantity === 0 ? 'Infinite Tickets' : $event->quantity . ' Tickets' }}
                        </span>
                    </div>

                    <!-- Meta Info -->
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
                                {{ \Carbon\Carbon::parse($event->started_at)->format('F j, Y, g:i A') }}
                                @if($event->end_at)
                                    - {{ \Carbon\Carbon::parse($event->end_at)->format('g:i A') }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Bottom Actions -->
                <div class="flex justify-end gap-4 mt-auto">
@if($event->tickets->contains('user_id', auth()->id()))

    <button class="text-white bg-emerald-600 p-2 rounded-md font-semibold">You have this ticket</button>
    
@else
    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}" />
        <input type="hidden" name="event_id" value="{{ $event->id }}" />
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium flex items-center gap-2">
            <x-heroicon-o-ticket class="w-5 h-5"/> Buy Ticket
        </button>
    </form>
@endif
                </div>

            </div>
        </div>

        <!-- Bottom Row: Description -->
        <div class="px-8 pb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Description</h2>
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($event->description)) !!}
            </div>

            <!-- Optional Rejection Reason -->
            @if($event->validation === 'rejected' && $event->whyRejected)
            <div class="bg-red-50 border-l-4 border-red-500 p-4 text-red-700 rounded-md font-medium mt-4">
                <strong>Reason for Rejection:</strong> {{ $event->whyRejected }}
            </div>
            @endif
            @if($type=="admin")
            <form method="POST" action="{{route('admin.events.update',$event->id)}}" class="mt-[2rem]">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Validation</label>
        <div class="flex items-center gap-6">
            <x-atoms.input-radio :checked="$event->validation=='approved'" name="validation" label="Approved" value="approved" class="text-green-600"/>
            <x-atoms.input-radio :checked="$event->validation=='rejected'" name="validation" label="Rejected" value="rejected" class="text-red-600"/>
        </div>
    </div>

    <!-- Textarea for Rejection Reason -->
    <x-atoms.textarea 
        name="whyRejected" 
        rows="4" 
        label="Why Rejected" 
        placeholder="Why was this event rejected?" 
        class="mb-4"
        :value="$event->whyRejected"
   />
<div class="flex justify-end">
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-blue-700">
        Submit
    </button>
</div>
</form>
@endif

</div>
</body>
</html>
