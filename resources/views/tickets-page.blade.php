<x-templates.home-template :title="__('tickets.title')">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('tickets.title') }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tickets as $ticket)
                <div class="bg-white min-w-full flex shadow-md rounded-xl overflow-hidden border border-gray-200 hover:shadow-lg transition duration-300">
                    <div class="bg-indigo-500 gap-4 flex-col flex items-center justify-center p-6">
                        <img src="{{ asset('images/qr.png') }}" 
                             alt="{{ __('tickets.qr_alt', ['id' => $ticket->id]) }}" 
                             class="min-w-32 h-32">
                        <p class="text-white font-medium">
                            {{ $ticket->used ? __('tickets.ended') : __('tickets.valid') }}
                        </p>
                    </div>

                    <!-- Ticket Info -->
                    <div class="p-4">
                        <h2 class="text-gray-700 mb-2 font-semibold">{{ $ticket->event->title }}</h2>
                        <p class="text-gray-500 mb-2">
                            {{ __('tickets.event_date') }}: {{ $ticket->event->created_at->format('d M, Y') }}
                        </p>
                        <p class="text-gray-500 mb-2">
                            {{ __('tickets.ticket_id') }}: <span class="font-mono">{{ $ticket->id }}</span>
                        </p>
                        <p class="text-gray-500">
                            {{ __('tickets.user') }}: {{ $ticket->user->name }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-400 py-20">
                    <p class="text-xl mb-2">{{ __('tickets.no_tickets') }}</p>
                    <a href="{{ route('home') }}" class="text-indigo-600 hover:underline font-semibold">
                        {{ __('tickets.browse_events') }}
                    </a>
                </div>
            @endforelse
        </div>
    </div>

</x-templates.home-template>
