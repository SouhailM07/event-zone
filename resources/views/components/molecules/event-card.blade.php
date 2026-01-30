@props(["event","type"=>"public"])

<div class="bg-white min-h-full relative rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300">

    <!-- Image -->
    <div class="relative h-52 overflow-hidden rounded-t-2xl">
        <img
        src="{{ Storage::url($event->thumbnail) }}" 
            {{-- src="{{$event->thumbnail}}" --}}

            alt="{{ $event->title }}"
            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
        />
    </div>

    <!-- Content -->
    <div class="p-5 space-y-3">
<p>{{Storage::url($event->thumbnail) }}</p>
        <!-- Price -->
        <div class="w-full flex justify-end relative">
            <p class="absolute translate-y-[-3rem] bg-emerald-400 font-medium text-black px-4 py-2 rounded-2xl">
                {{ $event->price > 0 
                    ? $event->price . ' DA'
                    : __('event-card.free_event') }}
            </p>
        </div>

        <!-- Title -->
        <div class="flexBetween">
            <h3 class="text-lg font-semibold text-gray-900 leading-tight">
                {{ $event->title }}
            </h3>

            @if($type!=='public')
                <x-atoms.event-status status="{{$event->validation}}"/>
            @endif
        </div>

        <!-- Categories -->
        <div class="gap-2 w-full flex flex-wrap">
            @foreach ($event->categories as $category)
                <span class="bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                    {{$category->name}}
                </span>
            @endforeach
        </div>

        <!-- Date -->
        <div class="flex items-center text-sm text-gray-500 gap-2">
            <x-heroicon-o-calendar class="size-4"/>
            <span>
                {{ \Carbon\Carbon::parse($event->started_at)->format('j M Y') }}
                @if($event->end_at)
                    – {{ \Carbon\Carbon::parse($event->end_at)->format('j M Y') }}
                @endif
            </span>
        </div>

        <!-- Location -->
        <div class="flex items-center text-sm text-gray-500 gap-2">
            <x-heroicon-o-map-pin class="size-4"/>
            <span>{{ $event->location }}</span>
        </div>

    </div>

    <!-- Footer -->
    <div class="px-5 pb-5 flex items-center justify-between">

        <!-- Rating -->
        <div class="text-xs text-gray-500">
            <span class="font-semibold text-gray-700">4.9</span>
            (210 {{ __('event-card.reviews') }})
        </div>

        <!-- CTA -->
        <a
            href="{{ $type === 'public'
                ? route('events.show', $event->id)
                : route('inventory.show', $event->id) }}"
            class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition"
        >
            {{ $type === 'public'
                ? __('event-card.buy')
                : __('event-card.view') }}
        </a>
    </div>


    {{-- PRIVATE ACTIONS --}}
    @if($type=="private")
        <div class="flex gap-2 p-3">

            <a href="{{route('events.edit',$event->id)}}"
               class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200">
                <x-heroicon-o-pencil-square class="w-4 h-4" />
                {{ __('event-card.edit') }}
            </a>

                <x-molecules.dialog modelId="delete-event-modal" title="Warning" >
                    <x-slot:trigger>
                        <button type="button" data-modal-target="delete-event-modal" data-modal-toggle="delete-event-modal" class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm rounded-lg bg-red-100 hover:bg-red-200 text-red-700">
                                <x-heroicon-o-trash class="w-4 h-4" />
                        {{ __('event-card.delete') }}
                        </button>
                    </x-slot:trigger>
                    <p class="my-[2rem]">
                    {{ __('event-card.delete_confirm') }}
                    </p>
                    <x-slot:footer>
                        <div class="grid grid-cols-2 h-[2.8rem] gap-[2rem]">
                            <button data-modal-hide="delete-event-modal" class="border border-black size-full rounded-2xl">                            {{ __('event-card.cancel') }}</button>
                            <form action="{{route("events.destroy",$event->id)}}" method="POST">
                                @csrf
                                @method("delete")
                                <input hidden type="text" name="eventId" value={{$event->id}}>
                                <button type="submit" data-modal-hide="delete-event-modal" class="bg-red-200 text-red-800 size-full rounded-2xl">                                {{ __('event-card.delete') }}</button>
                            </form>
                        </div>
                    </x-slot:footer>
                </x-molecules.dialog>
        </div>
    @endif

</div>
