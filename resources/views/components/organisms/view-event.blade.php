{{-- types for public , private ,admin --}}
@props(["type"=>"public","event"=>""])
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <x-atoms.metall :title="__('events.view_title')"/>
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
                    {{ __('events.back_to_events') }}
                </a>
                @break
            @case('private')
                <a href="{{ route('inventory.index') }}" 
                   class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium">
                    <x-heroicon-o-arrow-left class="w-5 h-5"/>
                    {{ __('events.back_to_inventory') }}
                </a>
                @break
            @case('admin')
                <a href="{{ route('admin.events.index') }}" 
                   class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium">
                    <x-heroicon-o-arrow-left class="w-5 h-5"/>
                    {{ __('events.back_to_admin_events') }}
                </a>
                @break
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
                    <img 
        src="{{ Storage::url($event->thumbnail) }}" 
 alt="{{ $event->title }}"
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                </div>
            @endif

{{-- <p>{{Storage::url($event->thumbnail) }}</p> --}}
            <!-- Right: Event Details + Badges + Actions -->
            <div class="flex flex-col justify-between space-y-6">

                <!-- Top Details -->
                <div class="space-y-4">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>

                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 text-sm font-medium">
                        <span class="px-3 py-1 rounded-full {{ $event->type === 'public' ? 'bg-blue-100 text-blue-800' : 'bg-gray-200 text-gray-700' }}">
                            {{ __('events.type_' . $event->type) }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-800">
                            {{ $event->price > 0 ? $event->price . ' DA' : __('events.free') }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-800">
                            {{ $event->quantity === 0 ? __('events.infinite_tickets') : $event->quantity . ' ' . __('events.tickets') }}
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
                        <button class="text-white bg-emerald-600 p-2 rounded-md font-semibold">
                            {{ __('events.you_have_ticket') }}
                        </button>
                    @else
                        <form action="{{ route('tickets.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}" />
                            <input type="hidden" name="event_id" value="{{ $event->id }}" />
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium flex items-center gap-2">
                                <x-heroicon-o-ticket class="w-5 h-5"/>
                                {{ __('events.buy_ticket') }}
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>

        <!-- Bottom Row: Description -->
        <div class="px-8 pb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('events.description') }}</h2>
            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($event->description)) !!}
            </div>

            <!-- Optional Rejection Reason -->
            @if($event->validation === 'rejected' && $event->whyRejected)
                <div class="bg-red-50 border-l-4 border-red-500 p-4 text-red-700 rounded-md font-medium mt-4">
                    <strong>{{ __('events.reason_rejected') }}:</strong> {{ $event->whyRejected }}
                </div>
            @endif

            @if($type=="admin")
                <form method="POST" action="{{ route('admin.events.update',$event->id) }}" class="mt-[2rem]">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('events.validation') }}</label>
                        <div class="flex items-center gap-6">
                            <x-atoms.input-radio :checked="$event->validation=='approved'" name="validation" :label="__('events.approved')" value="approved" class="text-green-600"/>
                            <x-atoms.input-radio :checked="$event->validation=='rejected'" name="validation" :label="__('events.rejected')" value="rejected" class="text-red-600"/>
                        </div>
                    </div>

                    <!-- Textarea for Rejection Reason -->
                    <x-atoms.textarea 
                        name="whyRejected" 
                        rows="4" 
                        :label="__('events.why_rejected')" 
                        :placeholder="__('events.why_rejected_placeholder')" 
                        class="mb-4"
                        :value="$event->whyRejected"
                    />
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-blue-700">
                            {{ __('events.submit') }}
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
</body>
</html>
