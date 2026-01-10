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
            <a href="{{route('home')}}"
               class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-2">
                <x-heroicon-o-arrow-left class="w-4 h-4"/>
                Back
            </a>

            <h1 class="text-2xl font-bold text-gray-900">Create New Event</h1>
            <p class="text-sm text-gray-500 mt-1">
                Add a new event and publish it for users
            </p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 space-y-8">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="Music Festival 2024">
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

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
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                      placeholder="Describe your event...">{{ old('description') }}</textarea>
        </div>

        <!-- Thumbnail -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Event Thumbnail</label>

            <div class="flex items-center gap-6">
                <div class="w-32 h-32 rounded-lg border bg-gray-50 flex items-center justify-center overflow-hidden">
                    <img id="thumbnailPreview" class="hidden w-full h-full object-cover">
                    <x-heroicon-o-photo id="thumbnailIcon" class="w-10 h-10 text-gray-400"/>
                </div>

                <input type="file" name="thumbnail" accept="image/*"
                       onchange="previewThumbnail(event)"
                       class="text-sm text-gray-600">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <!-- Location -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full rounded-lg border-gray-300"
                       placeholder="Algiers, Algeria">
            </div>

            <!-- Coordinates -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Coordinates (Latitude, Longitude)
                </label>
                <input type="text" name="coordination" value="{{ old('coordination') }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="36.7538, 3.0588">
                @error('coordination')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Pricing & Quantity -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price (DA)</label>
                <input type="number" id="price" name="price" min="0"
                       value="{{ old('price', 0) }}"
                       class="w-full rounded-lg border-gray-300">
            </div>

            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tickets Quantity
                </label>

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

                <input type="number" id="quantity" name="quantity"
                       class="w-full rounded-lg border-gray-300"
                       placeholder="Enter quantity">
            </div>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Start Date & Time
                </label>
                <input type="datetime-local" name="stated_at"
                       class="w-full rounded-lg border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    End Date & Time (Optional)
                </label>
                <input type="datetime-local" name="end_at"
                       class="w-full rounded-lg border-gray-300">
            </div>
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
                Create Event
            </button>
        </div>
    </form>
</div>

<!-- JS -->
<script>
    function previewThumbnail(event) {
        const preview = document.getElementById('thumbnailPreview');
        const icon = document.getElementById('thumbnailIcon');
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = () => {
            preview.src = reader.result;
            preview.classList.remove('hidden');
            icon.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

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
