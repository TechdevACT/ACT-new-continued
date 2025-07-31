<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-lg text-center sm:text-left sm:text-xl font-semibold leading-tight text-gray-800"
            >
                Settings
            </h2>
        </template>

        <div class="py-4 mx-4">
            <div class="sm:mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-md rounded-lg"
                >
                    <div class="py-6 px-4 text-gray-900">
                        Settings Page
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
