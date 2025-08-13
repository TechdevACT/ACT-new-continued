<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import Create from './Create.vue';

const activeTab = ref('allBlog');

const handleCancel = () => {
    activeTab.value = 'allBlog';
};
</script>

<template>

    <Head title="Blog" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-lg text-center sm:text-left sm:text-xl font-semibold leading-tight text-gray-800">
                    All Blog
                </h2>

                <button
                    :class="['py-1 px-4 rounded-xl', activeTab === 'addBlog' ? 'bg-gray-900 text-white' : 'bg-gray-300']"
                    @click="activeTab = 'addBlog'">
                    Add New Blog
                </button>
            </div>
        </template>

        <div class="py-4 mx-4">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <template v-if="activeTab === 'addBlog'">
                    <Create @cancel="handleCancel" />
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
