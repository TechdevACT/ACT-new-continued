<script setup>
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faFacebookF, faLinkedinIn, faXTwitter } from '@fortawesome/free-brands-svg-icons';
import { faStarOfLife } from '@fortawesome/free-solid-svg-icons';
import Testimonials from '@/Components/Testimonials.vue';

const props = defineProps({
    data_about: {
        type: Object
    },
    testimonials: {
        type: Array,
        default: () => []
    }
})

// const clients = [
//     'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Vector-6.svg',
//     'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Vector-5.svg',
//     'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Vector-4.svg',
//     'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Vector-2.svg',
//     'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Vector.svg',
//     'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Vector-1.svg'
// ];
</script>

<template>
    <DefaultLayout title="About Us -" navbar-type="inverse">
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <template #fullwidth>
            <section
                class="w-full h-screen bg-[url('/images/about/bg-about.png')] dark:bg-[url('/images/about/bg-about-dark.jpg')] bg-cover bg-center py-12 -mt-[102px] sm:-mt-[88px] animate-fade transition-all duration-500">
                <div class="text-center text-3xl font-bold h-full flex items-center justify-center">
                    <div class="flex flex-col gap-2 uppercase max-w-7xl">
                        <h2 class="text-4xl sm:text-6xl text-white dark:text-black transition-all duration-500">
                            {{ data_about.data_about.heading_big + " " + data_about.data_about.heading_big2 }}</h2>
                    </div>
                </div>
            </section>
        </template>

        <section class="py-10 mx-4">
            <div class="flex flex-col w-full">
                <h2 class="text-4xl sm:text-7xl font-bold dark:text-white mb-4">
                    {{ data_about.data_about.heading }}
                </h2>
                <div class="flex justify-end mb-10 mt-6 sm:mt-10">
                    <div class="sm:w-1/2">
                        <h2 class="text-lg sm:text-xl leading-relaxed text-justify text-[#262626] dark:text-white font-inter font-normal">
                            <div v-html="data_about.data_about.description"></div>
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="sm:py-10 mx-4">
            <span class="text-2xl font-medium">/ {{ data_about.data_about.approach_title }}</span>
            <div class="flex flex-col w-full mt-2">
                <h2 class="text-4xl sm:text-7xl font-bold dark:text-white mb-4">
                    {{ data_about.data_about.approach_heading }}
                </h2>
                <div class="flex justify-end mb-10 mt-6 sm:mt-10">
                    <div class="sm:w-1/2">
                        <h2 class="text-lg sm:text-xl leading-relaxed text-justify text-[#262626] dark:text-white font-inter font-normal">
                            <div v-html="data_about.data_about.approach_description"></div>
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="sm:py-10 mx-4 mb-10">
            <span class="text-2xl font-medium">/ {{ data_about.data_about.expertise_title }}</span>
            <div class="relative flex overflow-hidden group pb-10 text-black dark:text-white">
                <div class="flex whitespace-nowrap group-hover:paused animate-scroll" aria-hidden="true">
                    <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                        <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                    </h3>

                    <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                        <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                    </h3>

                    <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                        <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                    </h3>

                    <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                        <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                    </h3>

                    <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                        <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                    </h3>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">
                <Link href="/services"
                    class="group w-max mt-4 relative inline-flex items-center justify-center overflow-hidden rounded-full px-8 py-3 text-base font-medium text-black transition-all duration-500 border-2 border-yellow-400 hover:text-white">
                    
                    <!-- Default Yellow Background -->
                    <div class="absolute inset-0 bg-yellow-400 w-full h-full z-0"></div>
                    
                    <!-- Sliding Black Background (Side to Side) -->
                    <div class="absolute left-0 top-0 h-full w-0 bg-black transition-all duration-500 ease-out group-hover:w-full z-10"></div>
                    
                    <span class="relative z-20 flex items-center">
                        All Services
                        <span class="ml-3 flex items-center gap-1">
                            <span class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400"></span>
                            <span class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400"></span>
                        </span>
                    </span>
                </Link>
            </div>
        </section>

        <template #fullwidth2>
            <Testimonials :items="testimonials"/>
        </template>

        <template #afterFullwidth2>
            <section class="sm:py-10 mx-4 my-10">
                <span class="text-2xl font-medium">/ {{ data_about.data_about.emphasis_title }}</span>
                <div class="flex flex-col w-full mt-2">
                    <h2 class="text-4xl sm:text-7xl font-bold dark:text-white mb-4">
                        {{ data_about.data_about.emphasis_heading }}
                    </h2>
                    <div class="flex justify-end mb-4 sm:mb-10 mt-6 sm:mt-10">
                        <div class="sm:w-1/2">
                            <h2 class="text-lg sm:text-xl leading-relaxed text-justify text-[#262626] dark:text-white font-inter font-normal">
                                <div v-html="data_about.data_about.emphasis_description"></div>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 sm:grid-cols-6 gap-6">
                    <div v-for="c in clients" class="flex h-20 sm:h-32 rounded-2xl border shadow">
                        <img :src="c" alt="" class="p-4">
                    </div>
                </div>
            </section>
        </template>
    </DefaultLayout>
</template>
