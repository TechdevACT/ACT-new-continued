<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="relative flex min-h-screen flex-col items-center justify-center bg-gray-100 pt-6 sm:pt-0 p-4 overflow-hidden">

        <div class="absolute -top-40 -right-40 h-80 w-80 rounded-full bg-[#99ca3d]/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-40 h-96 w-96 rounded-full bg-[#99ca3d]/20 blur-3xl pointer-events-none"></div>

        <div class="z-10">
            <Link href="/">
                <ApplicationLogo class="h-24 w-auto" />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white/90 backdrop-blur-sm px-6 py-8 shadow-xl sm:max-w-md rounded-2xl border border-white/50 z-10">
            <slot />
        </div>
    </div>
</template>
