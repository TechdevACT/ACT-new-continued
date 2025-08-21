<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faBehance, faDribbble, faFacebookF, faInstagram, faXTwitter } from '@fortawesome/free-brands-svg-icons';
import { faStarOfLife } from '@fortawesome/free-solid-svg-icons';

const icons = [
    { icon: faFacebookF, link: 'https://www.facebook.com' },
    { icon: faInstagram, link: 'https://www.instagram.com' },
    { icon: faBehance, link: 'https://www.behance.net' },
    { icon: faXTwitter, link: 'https://twitter.com' },
    { icon: faDribbble, link: 'https://dribbble.com' },
]
</script>

<template>
    <footer class="w-full bg-gray-200 dark:bg-zinc-950 transition-colors duration-500">
        <div
            class="max-w-7xl mx-auto px-4 pt-16 pb-0 sm:pb-16 flex flex-col sm:grid sm:grid-cols-4 sm:items-end text-black dark:text-white">
            <div class="sm:col-span-2 mb-6 sm:mb-0">
                <h2 class="text-4xl sm:text-4xl font-bold">Lets make it happen</h2>
            </div>
            <div class="flex flex-col gap-2 mb-6 sm:mb-0">
                <h2 class="text-xl font-semibold">Social Media</h2>
                <div class="flex -ml-3">
                    <a v-for="(icon, index) in icons" :key="index" :href="icon.link" target="_blank"
                        rel="noopener noreferrer"
                        class="group relative w-10 h-10 flex items-center justify-center text-black dark:text-white hover:text-white dark:hover:text-black overflow-hidden rounded-full">
                        <span
                            class="absolute inset-0 rounded-full scale-0 bg-black dark:bg-white transition-transform duration-300 ease-out group-hover:scale-100 z-0"></span>
                        <FontAwesomeIcon :icon="icon.icon" size="lg" class="relative z-10" />
                    </a>
                </div>
            </div>
            <div class="mb-6 sm:mb-0">
                <h2 class="text-xl font-semibold">Contact</h2>
                <h2 class="text-gray-700 dark:text-gray-300 h-10 mt-2">info@actdigital.agency</h2>
            </div>
        </div>

        <div class="relative flex overflow-hidden group pb-10 text-black dark:text-white">
            <div class="flex whitespace-nowrap group-hover:paused animate-scroll" aria-hidden="true">
                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Creative Creation
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>

                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>

                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Company Profile
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>

                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Packaging
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>
                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Creative Creation
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>

                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>

                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Company Profile
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>

                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Packaging
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>
            </div>
        </div>

        <div class="flex flex-row items-center justify-between gap-2 max-w-7xl p-4 mx-auto text-center sm:text-left">
            <span class="text-gray-500 dark:text-gray-400 text-base sm:text-xl">
                &copy; {{ new Date().getFullYear() }} act! digital agency
            </span>
            <span class="text-gray-500 dark:text-gray-400 text-base sm:text-xl">Privacy Policy</span>
        </div>
    </footer>
</template>
