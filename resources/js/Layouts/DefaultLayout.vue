<script setup>
import { Head } from '@inertiajs/vue3';
import NavbarHeader from '@/Components/NavbarHeader.vue';
import NavbarHeaderDark from '@/Components/NavbarHeaderDark.vue';
import Footer from '@/Components/Footer.vue';
import CursorFollower from '@/Components/CursorFollower.vue';

defineProps({
    title: String,
    navbarType: {
        type: String,
        default: 'light'
    }
});
</script>

<template>

    <Head>
        <title>{{ title }}</title>

        <meta name="description" content="Deskripsi default aplikasi Anda. Ini bisa di-override per halaman.">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <slot name="meta" />
    </Head>

    <CursorFollower />

    <div class="flex flex-col min-h-screen">
        <component :is="navbarType === 'inverse' ? NavbarHeaderDark : NavbarHeader" />

        <slot name="fullwidth" />

        <main>
            <div class="mx-auto w-11/12 sm:w-10/12 flex-grow transition-colors duration-500">
                <slot />
            </div>

            <slot name="fullwidth2" />

            <div class="mx-auto w-11/12 sm:w-10/12 flex-grow transition-colors duration-500">
                <slot name="afterFullwidth2" />
            </div>
        </main>


        <Footer />
    </div>
</template>
