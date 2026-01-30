<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <x-atoms.metall :title="__('events.new_title')"/>
    <x-atoms.tailwindcss/>
</head>
<body>
<div class="max-w-5xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex items-start justify-between mb-8">
        <div>
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-2">
                <x-heroicon-o-arrow-left class="w-4 h-4"/>
                {{ __('events.back') }}
            </a>

            <h1 class="text-2xl font-bold text-gray-900">{{ __('events.new_event') }}</h1>
            <p class="text-sm text-gray-500 mt-1">
                {{ __('events.subheading') }}
            </p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 space-y-8">
        @csrf

        <!-- Title -->
        <x-atoms.input :label="__('events.event_title')" name="title" :placeholder="__('events.event_title_placeholder')" />

        <!-- Category -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('events.categories') }}
            </label>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($categories as $category)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" 
                               name="categories[]" 
                               value="{{ $category->id }}"
                               {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <span class="text-gray-700">{{ $category->name }}</span>
                    </label>
                @endforeach
            </div>

            @error('categories')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <x-atoms.textarea name="description" rows="4" :label="__('events.description')" :placeholder="__('events.description_placeholder')" /> 

        <!-- Thumbnail -->
        <x-atoms.one-img-input name="thumbnail" :label="__('events.thumbnail')" id="thumbnailPreview"/>

        <div class="grid grid-cols-2 gap-6">
            <x-atoms.input name="location" :label="__('events.location')" :placeholder="__('events.location_placeholder')" />
            <x-atoms.input name="coordination" :label="__('events.coordination')" :placeholder="__('events.coordination_placeholder')" />
        </div>

        <!-- Pricing & Quantity -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Price -->
            <x-atoms.input name="price" type="number" min="0" :label="__('events.price')" value="0"/>

            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('events.tickets_quantity') }}</label>
                <div class="flex gap-2 items-center">

                    <div class="flex gap-4 mb-2">
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="quantity_type" value="infinite" checked>
                            {{ __('events.infinite') }}
                        </label>
                        
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="quantity_type" value="custom">
                            {{ __('events.custom') }}
                        </label>
                    </div>
                    
                    <input type="number" id="quantity" name="quantity"
                    class="w-full rounded-lg border-gray-300"
                    :placeholder="__('events.quantity_placeholder')">
                </div>
            </div>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-atoms.input type='datetime-local' name='started_at' :label="__('events.start_date')" />
            <x-atoms.input type='datetime-local' name='end_at' :label="__('events.end_date')" />
        </div>

        <input type="hidden" name="validation" value="pending">

        <!-- Submit -->
        <div class="flex justify-end gap-4 pt-6 border-t">
            <button type="reset"
                    class="px-5 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                {{ __('events.reset') }}
            </button>

            <button type="submit"
                    class="px-6 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 flex items-center gap-2">
                <x-heroicon-o-plus class="w-5 h-5"/>
                {{ __('events.create_event') }}
            </button>
        </div>
    </form>
</div>

<!-- JS -->
<script>
    const priceInput = document.getElementById('price');
    const quantityInput = document.getElementById('quantity');
    const radios = document.querySelectorAll('input[name="quantity_type"]');

    function updateQuantity() {
        const price = parseFloat(priceInput.value) || 0;
        const type = document.querySelector('input[name="quantity_type"]:checked').value;

        if (price === 0 || type === 'infinite') {
            quantityInput.value = 0;
            quantityInput.disabled = true;
        } else {
            quantityInput.disabled = false;
        }
    }

    priceInput.addEventListener('input', updateQuantity);
    radios.forEach(r => r.addEventListener('change', updateQuantity));
    updateQuantity();
</script>

</body>
</html>
