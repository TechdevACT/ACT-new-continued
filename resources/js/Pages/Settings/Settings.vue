<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import HomeHero from './Partials/HomeHero.vue';
import { Head, Link } from '@inertiajs/vue3';
import HomeAbout from './Partials/HomeAbout.vue';
import HomeImageClient from './Partials/HomeImageClient.vue';
import HomeExpertise from './Partials/HomeExpertise.vue';

</script>

<template>

    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-lg text-center sm:text-left sm:text-xl font-semibold leading-tight text-gray-800">
                Settings
            </h2>
        </template>

        <div class="py-4 mx-4">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

                <Link :href="route('dashboard')">Ea</Link>
                
                <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                    <HomeHero />
                </div>
                <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                    <HomeAbout />
                </div>
                <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                    <HomeImageClient />
                </div>
                <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                    <HomeExpertise />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
