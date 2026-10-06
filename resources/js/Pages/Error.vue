<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Link } from '@inertiajs/vue3';
import { faArrowLeftLong } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { computed } from 'vue';

const props = defineProps({
    status: { type: Number, default: 404 },
});

const messages = {
    403: { title: 'Forbidden', text: 'You do not have permission to access this page.' },
    404: { title: 'Page Not Found', text: "Sorry, the page you are looking for doesn't exist or has been moved." },
    419: { title: 'Page Expired', text: 'Your session has expired. Please refresh and try again.' },
    429: { title: 'Too Many Requests', text: 'Please slow down and try again in a moment.' },
    500: { title: 'Server Error', text: 'Something went wrong on our end. Please try again later.' },
    503: { title: 'Service Unavailable', text: "We'll be back shortly. Please try again later." },
};

const info = computed(() => messages[props.status] ?? messages[404]);
</script>

<template>
    <DefaultLayout :title="`${props.status} ${info.title} -`">
        <section class="flex flex-col items-center justify-center text-center gap-6 py-24 sm:py-32 animate-fade transition-all duration-500">
            <h1 class="text-8xl sm:text-[12rem] leading-none font-bold text-black dark:text-white">
                {{ props.status }}<span class="text-yellow-500">.</span>
            </h1>
            <h2 class="text-2xl sm:text-4xl font-bold uppercase dark:text-white">{{ info.title }}</h2>
            <p class="sm:w-3/5 text-base sm:text-lg font-inter font-normal text-[#262626] dark:text-white">
                {{ info.text }}
            </p>
            <Link href="/"
                class="mt-4 inline-flex items-center gap-3 rounded-full bg-black dark:bg-white text-white dark:text-black px-8 py-3 font-semibold uppercase transition-all duration-300 hover:bg-yellow-500 hover:text-black">
                <FontAwesomeIcon :icon="faArrowLeftLong" />
                Back to Home
            </Link>
        </section>
    </DefaultLayout>
</template>
