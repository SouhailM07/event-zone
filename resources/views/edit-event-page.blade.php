<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <x-atoms.metall :title="__('edit-event.page_title')"/>
    <x-atoms.tailwindcss/>
</head>
<body>
<div class="max-w-5xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex items-start justify-between mb-8">
        <div>
            <a href="{{route('inventory.index')}}"
               class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-2">
                <x-heroicon-o-arrow-left class="w-4 h-4"/>
                {{ __('edit-event.back_inventory') }}
            </a>

            <h1 class="text-2xl font-bold text-gray-900">
                {{ __('edit-event.edit_event') }}
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                {{ __('edit-event.subtitle') }}
            </p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('events.update',$event->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 space-y-8">
        @csrf

        <!-- Title -->
        <x-atoms.input
            :value="$event->title"
            :label="__('edit-event.event_title')"
            name="title"
            :placeholder="__('edit-event.title_placeholder')" />

        <!-- Category -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('edit-event.categories') }}
            </label>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($categories as $category)
                    <label class="flex items-center gap-2">
                        <input type="checkbox"
                               name="categories[]"
                               value="{{ $category->id }}"
                               {{$event->categories->contains('id',$category->id) ? "checked" :""}}
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <span class="text-gray-700">{{ $category->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Description -->
        <x-atoms.textarea
            :value="$event->description"
            name="description"
            rows="4"
            :placeholder="__('edit-event.description_placeholder')"
            :label="__('edit-event.description')" />

        <!-- Thumbnail -->
        <x-atoms.one-img-input
            :value="$event->thumbnail"
            name="thumbnail"
            :label="__('edit-event.thumbnail')"
            id="thumbnailPreview"/>

        <div class="grid grid-cols-2 gap-6">
            <x-atoms.input :value="$event->location" name="location"
                :label="__('edit-event.location')" />

            <x-atoms.input :value="$event->coordination" name="coordination"
                :label="__('edit-event.coordination')" />
        </div>

        <!-- Pricing & Quantity -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <x-atoms.input :value="$event->price" name="price" type="number"
                :label="__('edit-event.price')" id="price"/>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('edit-event.tickets_quantity') }}
                </label>

                <div class="flex gap-4 mb-2">
                    <x-atoms.input-radio
                        :label="__('edit-event.infinite')"
                        name="quantity_type"
                        value="infinite" checked/>

                    <x-atoms.input-radio
                        :label="__('edit-event.custom')"
                        name="quantity_type"
                        value="custom"/>
                </div>

                <x-atoms.input
                    name="quantity"
                    :placeholder="__('edit-event.quantity_placeholder')"
                    type="number"
                    id="quantity"/>
            </div>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-atoms.input :value="$event->started_at" type='datetime-local'
                name='started_at'
                :label="__('edit-event.start_date')" />

            <x-atoms.input :value="$event->end_at" type='datetime-local'
                name='end_at'
                :label="__('edit-event.end_date')" />
        </div>

        <input type="hidden" name="validation" value="pending">

        <!-- Submit -->
        <div class="flex justify-end gap-4 pt-6 border-t">

            <button type="reset"
                    class="px-5 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                {{ __('edit-event.reset') }}
            </button>

            <button type="submit"
                    class="px-6 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 flex items-center gap-2">
                <x-heroicon-o-plus class="w-5 h-5"/>
                {{ __('edit-event.update_event') }}
            </button>

        </div>
    </form>
</div>
</body>
</html>
