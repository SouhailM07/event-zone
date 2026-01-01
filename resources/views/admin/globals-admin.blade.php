<x-templates.admin-template title="Global Settings">
    <main class="p-[1rem]">
        <section class="bg-white border border-gray-400 max-w-[60rem] mx-auto rounded-md p-[1rem]">
            <h1 class="text-2xl font-semibold mb-4">Global Settings</h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.globals.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- LOGO --}}
                <div class="flex items-center gap-6">
                    <div>
                        @if($globals?->website_logo)
                            <img src="{{ asset('storage/'.$globals->website_logo) }}"
                                 class="h-24 border rounded p-2 bg-white" />
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Website Logo</label>
                        <input type="file" name="website_logo" class="mt-1" />
                    </div>
                </div>

                {{-- WEBSITE NAME --}}
                <div>
                    <label class="block text-sm font-medium">Website Name</label>
                    <input type="text" name="website_name"
                           value="{{ old('website_name', $globals->website_name ?? '') }}"
                           class="w-full border rounded p-2" />
                </div>

                {{-- CONTACT NUMBERS --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Contact Numbers</label>

                    @php
                        $phones = $globals?->contact_numbers
                            ? explode(',', $globals->contact_numbers)
                            : [''];
                    @endphp

                    <div id="phones" class="space-y-2">
                        @foreach($phones as $phone)
                            <div class="flex gap-2">
                                <input type="text"
                                       name="contact_numbers[]"
                                       value="{{ trim($phone) }}"
                                       class="flex-1 border rounded p-2"
                                       placeholder="+213..." />
                                <button type="button"
                                        class="remove-phone bg-red-500 text-white px-3 rounded">
                                    ✕
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="addPhone"
                            class="mt-2 bg-green-600 text-white px-4 py-1 rounded">
                        Add Number
                    </button>
                </div>

                {{-- CONTACT EMAIL --}}
                <div>
                    <label class="block text-sm font-medium">Contact Email</label>
                    <input type="email" name="contact_email"
                           value="{{ old('contact_email', $globals->contact_email ?? '') }}"
                           class="w-full border rounded p-2" />
                </div>

                {{-- ADDRESS --}}
                <div>
                    <label class="block text-sm font-medium">Address</label>
                    <input type="text" name="address"
                           value="{{ old('address', $globals->address ?? '') }}"
                           class="w-full border rounded p-2" />
                </div>

                {{-- ABOUT US --}}
                <div>
                    <label class="block text-sm font-medium">About Us</label>
                    <textarea name="about_us" rows="4"
                              class="w-full border rounded p-2">{{ old('about_us', $globals->about_us ?? '') }}</textarea>
                </div>

                <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Save Settings
                </button>
            </form>
        </section>
    </main>

    {{-- JS --}}
    <script>
        const phones = document.getElementById('phones');
        document.getElementById('addPhone').onclick = () => {
            phones.insertAdjacentHTML('beforeend', `
                <div class="flex gap-2">
                    <input type="text" name="contact_numbers[]" class="flex-1 border rounded p-2" />
                    <button type="button" class="remove-phone bg-red-500 text-white px-3 rounded">✕</button>
                </div>
            `);
        };

        phones.addEventListener('click', e => {
            if (e.target.classList.contains('remove-phone')) {
                e.target.parentElement.remove();
            }
        });
    </script>
</x-templates.admin-template>
