@php
    $eventsStatus = ["approved", "pending", "rejected"]; // keep for comparison
@endphp

<x-templates.home-template :title="__('inventory.title')">
<div class="p-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            {{ __('inventory.my_events') }}
        </h1>
    </div>

    <!-- Filters -->
    <form action="{{ route('inventory.index') }}" method="GET" class="w-full grid grid-cols-[1fr_12rem_12rem] gap-[1rem] ">
        <x-atoms.input :value="request('title')" class="w-full" icon="magnifying-glass" name="title" :placeholder="__('inventory.search')" />
        
        <select name="category" class="rounded-2xl px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
            <option selected value="">{{ __('inventory.all') }}</option>
            @foreach ($categories as $category)
            <option
                @selected(request('category') == $category->id)
                value="{{ $category['id'] }}">
                {{ $category['name'] }}
            </option>
            @endforeach
        </select>

        <select name="validation" class="rounded-2xl px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
            <option selected value="">{{ __('inventory.all') }}</option>
            @foreach ($eventsStatus as $status)
            <option
                @selected(request('validation') == $status)
                value="{{ $status }}">
                {{ __('inventory.status.'.$status) }}
            </option>
            @endforeach
        </select>
    </form>

    <!-- Events Grid -->
    <div class="mt-[2rem] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <x-molecules.event-card :event="$event" type="private" />
        @empty
            <div class="col-span-full text-center py-16 text-gray-500">
                <x-heroicon-o-calendar-days class="w-10 h-10 mx-auto mb-3" />
                {{ __('inventory.no_events') }}
            </div>
        @endforelse
    </div>
</div>
</x-templates.home-template>
