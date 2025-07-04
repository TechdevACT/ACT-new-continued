<script setup>
import { Head } from '@inertiajs/vue3';
import NavbarHeader from '@/Components/NavbarHeader.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    title: String,
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

    <div class="flex flex-col min-h-screen">
        <NavbarHeader />

        <main class="mx-auto max-w-7xl flex-grow transition-colors duration-500 w-full">
            <slot />
        </main>

        <Footer />
    </div>
</template>
