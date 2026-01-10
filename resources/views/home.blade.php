<x-templates.home-template title="home" >
<div class="flex h-[80vh] gap-3">
                <div class="w-full">
                    <img src="{{asset('images/auth.jpg')}}" class="h-[80vh] w-full rounded-md"/>
                </div>
                <div class="flex  flex-col justify-between">
                    <div   inline-datepicker data-date="02/25/2024"></div>
                                    <x-organisms.live-stats/>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-6 py-8">
    <!-- Section Title -->
    <x-organisms.events-container/>
</div>

</x-templates.home-template>