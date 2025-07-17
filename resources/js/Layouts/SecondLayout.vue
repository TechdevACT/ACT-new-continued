<script setup>
import { Head } from '@inertiajs/vue3';
import NavbarSecondHeader from '@/Components/NavbarSecondHeader.vue';
import Footer from '@/Components/Footer.vue';
import CursorFollower from '@/Components/CursorFollower.vue';

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
        <NavbarSecondHeader/>

        <main>

            <slot name="fullwidth" />

            <div class="mx-auto max-w-7xl flex-grow transition-colors duration-500 w-full">
                <slot />
            </div>

            <slot name="fullwidth2" />

            <div class="mx-auto max-w-7xl flex-grow transition-colors duration-500 w-full">
                <slot name="afterFullwidth2" />
            </div>
        </main>


        <Footer />
    </div>
</template>
