import './bootstrap';
import 'flowbite';

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';

window.Alpine = Alpine
Alpine.start()


// Initialize Swiper
const swiper = new Swiper('.mySwiper', {
    modules: [Navigation, Pagination, Autoplay],
    loop: true,
    // autoplay: {
    //     delay: 3000,
    // },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        640: { slidesPerView: 1 },
        768: { slidesPerView: 2 },
        1024: { slidesPerView: 3 }
    }
});