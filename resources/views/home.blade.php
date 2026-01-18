<x-templates.home-template title="home" class="overflow-x-hidden ">
<div class="flex h-[80vh] gap-3">
                <div class="w-full">
                    <img src="{{asset('images/auth.jpg')}}" class="h-[80vh] w-full rounded-md"/>
                </div>
                <div class="flex  flex-col justify-between">
                    <div   inline-datepicker data-date="02/25/2024"></div>
                                    <x-organisms.live-stats/>
                </div>
            </div>
            <div class="py-8">
    <!-- Section Title -->
        <x-organisms.events-container/>
</div>

</x-templates.home-template>