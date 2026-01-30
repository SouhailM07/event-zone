@php
    $stats = [
        [
            'title' => __('live-states.attendees_today'),
            'value' => 248,
            'icon'  => 'users',
            'color' => 'blue',
        ],
        [
            'title' => __('live-states.events_this_month'),
            'value' => 12,
            'icon'  => 'calendar-days',
            'color' => 'purple',
        ],
        [
            'title' => __('live-states.revenue'),
            'value' => '$3,420',
            'icon'  => 'banknotes',
            'color' => 'emerald',
        ],
    ];
@endphp

<!-- Live Stats -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

    @foreach ($stats as $stat)
        <div class="bg-white border border-gray-200 rounded-2xl py-2 px-1 shadow-sm">

            <div class="flex flex-col h-full justify-between ">

                <!-- Title -->
                <p class="text-sm font-medium text-gray-500">
                    {{ $stat['title'] }}
                </p>

                <!-- Icon + Value -->
                <div class="flex items-center justify-between mt-4">

                    <div class="p-3 rounded-xl bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600">
                        <x-heroicon-o-{{ $stat['icon'] }} class="w-6 h-6" />
                    </div>

                    <span class="font-semibold text-gray-900">
                        {{ $stat['value'] }}
                    </span>

                </div>

            </div>

        </div>
    @endforeach

</div>
