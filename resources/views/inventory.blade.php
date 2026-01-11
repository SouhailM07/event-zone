<x-templates.home-template title="inventory">
<div class="p-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            My Events
        </h1>

    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <x-molecules.event-card :event=$event type="private"/>
        @empty
            <div class="col-span-full text-center py-16 text-gray-500">
                <x-heroicon-o-calendar-days class="w-10 h-10 mx-auto mb-3" />
                No events published yet.
            </div>
        @endforelse
    </div>
</div>
</x-templates.home-template>