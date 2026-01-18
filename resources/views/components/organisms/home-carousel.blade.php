<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<div class="swiper homeSwiper h-[80vh] rounded-xl overflow-hidden">
    <div class="swiper-wrapper">

        @forelse($events as $event)
            <div class="swiper-slide relative">
                
                {{-- Background image --}}
                <img
                    src="{{ asset('storage/'.$event->thumbnail) }}"
                    class="absolute inset-0 w-full h-full object-cover"
                    alt="{{ $event->title }}"
                />

                {{-- Dark overlay --}}
                <div class="absolute inset-0 bg-black/50"></div>

                {{-- Content --}}
                <div class="relative z-10 h-full flex items-end p-10">
                    <div class="max-w-xl text-white space-y-4">
                        <span class="inline-block px-3 py-1 text-xs bg-indigo-600 rounded-full">
                            {{ $event->location }}
                        </span>

                        <h2 class="text-4xl font-bold">
                            {{ $event->title }}
                        </h2>

                        <p class="text-sm text-gray-200 line-clamp-3">
                            {{ $event->description }}
                        </p>

                        <div class="flex items-center gap-4">
                            <span class="text-lg font-semibold">
                                {{ $event->price > 0 ? $event->price.' DA' : 'Free' }}
                            </span>

                            <a
                                href="{{ route('events.show', $event->id) }}"
                                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-sm font-semibold transition"
                            >
                                View Event
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="swiper-slide flex items-center justify-center text-gray-500">
                No upcoming events
            </div>
        @endforelse

    </div>

    {{-- Navigation --}}
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    {{-- Pagination --}}
    <div class="swiper-pagination"></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    new Swiper(".homeSwiper", {
        loop: true,
        speed: 800,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        effect: "fade",
        fadeEffect: {
            crossFade: true,
        },
    });
</script>
