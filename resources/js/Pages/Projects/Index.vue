<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    projects: Array,
});


const deleteProject = (id) => {
    if (confirm('Are you sure you want to delete this project? This action cannot be undone.')) {
        router.delete(route('projectsSetting.destroy', id), {
            preserveScroll: true,
        });
    }
};

const getImageUrl = (path) => {
    if (path) {
        return `/storage/${path}`;
    }
    return 'https://placehold.co/600x400/e2e8f0/cbd5e0?text=No+Image';
}
</script>

<template>

    <Head title="Projects" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Projects List</h2>
                <Link :href="route('projectsSetting.create')">
                <PrimaryButton>Create Project</PrimaryButton>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div v-if="projects.data.length > 0"
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <div v-for="project in projects.data" :key="project.id"
                                class="border rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <img :src="getImageUrl(project.thumbnail)" :alt="project.title"
                                    class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">{{ project.title }}</h3>
                                    <p class="text-gray-600 text-sm line-clamp-3">{{ project.description }}</p>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 border-t flex justify-end space-x-2">
                                    <Link :href="route('projectsSetting.edit', project.id)">
                                    <button
                                        class="px-3 py-1 text-sm text-blue-600 bg-blue-100 hover:bg-blue-200 rounded-md">Edit</button>
                                    </Link>
                                    <DangerButton @click="deleteProject(project.id)" class="text-sm">
                                        Delete
                                    </DangerButton>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <p class="text-center text-gray-500">No projects found.
                                <Link :href="route('projectsSetting.create')" class="text-indigo-600 hover:underline">
                                Create one
                                now!</Link>
                            </p>
                        </div>
                        <div class="mt-6">
                            <div class="flex justify-center mt-4 space-x-2">
                                <button v-for="page in projects.links" :key="page.url"
                                    @click="page.url && router.get(page.url)" v-html="page.label"
                                    :class="['px-3 py-1 rounded', page.active ? 'bg-indigo-500 text-white' : 'bg-gray-200']" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
