<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faBehance, faDribbble, faFacebookF, faInstagram, faXTwitter } from '@fortawesome/free-brands-svg-icons';
import { faStarOfLife } from '@fortawesome/free-solid-svg-icons';
</script>

<template>
    <footer class="w-full bg-gray-200">
        <div class="max-w-7xl mx-auto px-4 pt-16 pb-0 sm:pb-16 flex flex-col sm:grid sm:grid-cols-4 sm:items-end">
            <div class="sm:col-span-2 mb-6 sm:mb-0">
                <h2 class="text-4xl font-bold">LET'S MAKE<br>IT HAPPEN</h2>
            </div>

            <div class="flex flex-col gap-2 mb-6 sm:mb-0">
                <h2 class="text-xl font-bold">Social Media</h2>
                <div class="flex gap-4">
                    <FontAwesomeIcon :icon="faFacebookF" size="lg" />
                    <FontAwesomeIcon :icon="faInstagram" size="lg" />
                    <FontAwesomeIcon :icon="faBehance" size="lg" />
                    <FontAwesomeIcon :icon="faXTwitter" size="lg" />
                    <FontAwesomeIcon :icon="faDribbble" size="lg" />
                </div>
            </div>

            <div class="mb-6 sm:mb-0">
                <h2 class="text-xl font-bold">Contact</h2>
                <h2>info@actdigital.agency</h2>
            </div>
        </div>

        <div class="relative flex overflow-hidden group pb-10">
            <div class="flex whitespace-nowrap group-hover:paused animate-scroll">
                <h3 class="text-6xl sm:text-9xl font-bold ml-4">
                    <span>
                        Photography
                        <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                    </span>
                </h3>

                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>
            </div>

            <div class="flex whitespace-nowrap group-hover:paused animate-scroll" aria-hidden="true">
                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>

                <h3 class="text-6xl sm:text-9xl font-bold ml-4">Photography
                    <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                </h3>
            </div>
        </div>

        <div class="flex justify-between max-w-7xl p-4 mx-auto">
            <span class="text-gray-400 text-xl">&copy; {{ new Date().getFullYear() }} act! Digital Agency</span>
            <span class="text-gray-400 text-xl">Privacy Policy</span>
        </div>
    </footer>
</template>
