@php
    $stats = [
    [
        'title' => 'Attendees Today',
        'value' => 248,
        'icon'  => 'users',
        'color' => 'blue',
    ],
    [
        'title' => 'Events This Month',
        'value' => 12,
        'icon'  => 'calendar-days',
        'color' => 'purple',
    ],
    [
        'title' => 'Revenue',
        'value' => '$3,420',
        'icon'  => 'banknotes',
        'color' => 'emerald',
    ],
];
@endphp
<!-- Live Stats -->
<div class="grid grid-cols-1 sm:grid-cols-3 ">

    @foreach ($stats as $stat)
        <div class="bg-white border border-gray-200 rounded-2xl p-3 shadow-sm">

            <!-- Card Content -->
            <div class="flex flex-col h-full justify-between">

                <!-- Top: Title -->
                <p class="text-sm font-medium text-gray-500">
                    {{ $stat['title'] }}
                </p>

                <!-- Bottom: Icon + Value -->
                <div class="flex items-center justify-between mt-4">

                    <div class="p-3 rounded-xl bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600">
                        <x-heroicon-o-{{ $stat['icon'] }} class="w-6 h-6" />
                    </div>

                    <span class=" font-semibold text-gray-900">
                        {{ $stat['value'] }}
                    </span>

                </div>

            </div>

        </div>
    @endforeach

</div>
