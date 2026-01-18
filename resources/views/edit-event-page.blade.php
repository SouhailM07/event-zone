<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="New Event"/>
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
                Back to inventory
            </a>

            <h1 class="text-2xl font-bold text-gray-900">Edit Event</h1>
            <p class="text-sm text-gray-500 mt-1">
                Edit event and publish it for users
            </p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 space-y-8">
        @csrf

        <!-- Title -->
        <x-atoms.input :value="$event->title" label="Event Title" name="title" placeholder="Music Festival 2024" />
        <!-- Category -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Event Categories
    </label>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach($categories as $category)
            <label class="flex items-center gap-2">
                <input type="checkbox" 
                       name="categories[]" 
                       value="{{ $category->id }}"
                       {{$event->categories->contains('id',$category->id) ? "checked" :""  }}
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
       <x-atoms.textarea :value="$event->description" name="description" rows="4" placeholder="Describe your event..." label="Description" /> 
        <!-- Thumbnail -->
        <x-atoms.one-img-input :value="$event->thumbnail" name="thumbnail" label="Event Thumbnail" id="thumbnailPreview"/>
        <div class="grid grid-cols-2 gap-6">
            <x-atoms.input :value="$event->location" name="location"  label="Location" placeholder="Algiers, Algeria" />
            <x-atoms.input :value="$event->coordination" name="coordination"  label="Coordination" placeholder="36.7538, 3.0588" />
        </div>

        <!-- Pricing & Quantity -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Price -->
            <x-atoms.input :value="$event->price" name="price" type="number"  label="Price (DA)" />
            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tickets Quantity
                </label>
                <div class="flex gap-2 items-center">

                    <x-atoms.input-radio label=""/>
                    <div class="flex gap-4 mb-2">
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="quantity_type" value="infinite" checked>
                            Infinite
                        </label>
                        
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="quantity_type" value="custom">
                            Custom
                        </label>
                    </div>
                    {{-- <x-atoms.input type="number" id="quantity"/> --}}
                    <input type="number" id="quantity" name="quantity"
                    class="w-full rounded-lg border-gray-300"
                    placeholder="Enter quantity">
                </div>
            </div>
            </div>

        <!-- Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-atoms.input :value="$event->started_at" type='datetime-local' name='started_at' label="Start Date & Time"/>
            <x-atoms.input :value="$event->end_at" type='datetime-local' name='end_at' label="End Date & Time (Optional)" />
        </div>

        <input type="hidden" name="validation" value="pending">

        <!-- Submit -->
        <div class="flex justify-end gap-4 pt-6 border-t">
            <button type="reset"
                    class="px-5 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                Reset
            </button>

            <button type="submit"
                    class="px-6 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 flex items-center gap-2">
                <x-heroicon-o-plus class="w-5 h-5"/>
                Update Event
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
