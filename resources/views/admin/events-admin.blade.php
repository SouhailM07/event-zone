@php
    $eventsStatus=["approved","pending","rejected"];
@endphp
<x-templates.admin-template>
    <main class="p-6">
        <div class="mb-[1rem]">
            <h1 class="text-2xl font-bold mb-6 text-gray-900">Events</h1>
        <form action="{{route("admin.events.index")}}" method="GET" class="w-full grid grid-cols-[1fr_12rem_12rem] gap-[1rem] ">
            <x-atoms.input :value="request('title')" class="w-full " icon="magnifying-glass" name="title" placeholder="search"/>
            <select name="category" class=" rounded-2xl px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm  focus:ring-brand focus:border-brand shadow-xs placeholder:text-body ">
                <option selected value="">All</option>
                @foreach ($categories as $category)
                <option
                    @selected(request('category') == $category->id)
                    value={{$category['id']}}>
                    {{$category['name']}}
                </option>
                @endforeach
            </select>
            <select name="validation"  class=" rounded-2xl px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm  focus:ring-brand focus:border-brand shadow-xs placeholder:text-body ">
                <option selected value="">All</option>
                @foreach ($eventsStatus as $status)
                <option
                    @selected(request('validation') == $status)
                    value={{$status}}>
                    {{$status}}
                </option>
                @endforeach
            </select>
    </form>
    </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            User
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Start Date
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($events as $event)
                        <tr class="hover:bg-gray-50">
                            <!-- User -->
                            <td class="px-6 py-4 flex items-center gap-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $event->user->avatar }}" alt="avatar">
                                <span class="text-gray-900 font-medium">{{ $event->user->name }}</span>
                            </td>

                            <!-- Title -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $event->title }}
                            </td>

                            <!-- Start Date -->
                            <td class="px-6 py-4 text-center text-gray-700">
                                {{ \Carbon\Carbon::parse($event->started_at)->format('j M Y') }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                <x-atoms.event-status :status="$event->validation"/>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.events.show', $event->id) }}" 
                                   class="inline-block px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No upcoming events available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</x-templates.admin-template>
