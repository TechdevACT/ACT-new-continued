<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { ref } from 'vue';

const props = defineProps({
    project: Object,
    categories: Array
});

const projectGalleries = ref(props.project.project_galleries);

const form = useForm({
    _method: 'PUT',
    title: props.project.title,
    description: props.project.description,
    slug: props.project.slug,
    category_id: props.project.category_id,
    project_overview: props.project.project_overview,
    project_challenges: props.project.project_challenges,
    project_objectives: props.project.project_objectives,
    project_final_outcome: props.project.project_final_outcome,
    thumbnail: null,
    galleries: [],
    background: null
});

const formatSlug = () => {
    form.slug = form.slug
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^a-z0-9\-]/g, '')
        .replace(/-+/g, '-');
};

const submit = () => {
    form.post(route('projectsSetting.update', props.project.id), {
        onError: (errors) => {
            console.log(errors);
        },
    });
};

const deleteGalleryImage = (imageId, index) => {
    if (confirm('Are you sure you want to delete this image?' + imageId)) {
        router.delete(route('gallery.delete', imageId), {
            preserveScroll: true,
            onSuccess: () => {
                projectGalleries.value.splice(index, 1);
            }
        });
    }
}
</script>

<template>

    <Head title="Edit Project" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Project: {{ project.title }}</h2>
        </template>

        <div class="sm:py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <InputLabel for="title" value="Project Title" />
                                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title"
                                    required autofocus />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="mb-4">
                                <div class="grid sm:grid-cols-4 gap-4">
                                    <div class="sm:col-span-3">
                                        <InputLabel for="slug" value="Project Slug" />
                                        <TextInput id="slug" type="text" class="mt-1 block w-full" v-model="form.slug"
                                            @blur="formatSlug" required autofocus />
                                        <InputError class="mt-2" :message="form.errors.slug" />
                                    </div>
                                    <div>
                                        <InputLabel for="category_id" value="Category" />
                                        <select id="category_id"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            v-model="form.category_id" required>
                                            <option value="">Select Category</option>
                                            <option v-for="category in categories" :value="category.id"
                                                :key="category.id">{{
                                                    category.name }}</option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.category_id" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <InputLabel for="description" value="Description" />
                                <textarea id="description"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.description" rows="4"></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="mb-4">
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div>
                                        <InputLabel for="overview" value="Overview" />
                                        <textarea id="overview"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            v-model="form.project_overview" rows="4"></textarea>
                                        <InputError class="mt-2" :message="form.errors.project_overview" />
                                    </div>
                                    <div>
                                        <InputLabel for="challenges" value="Challenges" />
                                        <textarea id="challenges"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            v-model="form.project_challenges" rows="4"></textarea>
                                        <InputError class="mt-2" :message="form.errors.project_challenges" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div>
                                        <InputLabel for="objectives" value="Objectives" />
                                        <textarea id="objectives"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            v-model="form.project_objectives" rows="4"></textarea>
                                        <InputError class="mt-2" :message="form.errors.project_objectives" />
                                    </div>
                                    <div>
                                        <InputLabel for="final_output" value="Final Output" />
                                        <textarea id="final_output"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            v-model="form.project_final_outcome" rows="4"></textarea>
                                        <InputError class="mt-2" :message="form.errors.project_final_outcome" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div>
                                        <InputLabel for="thumbnail" value="Change Thumbnail" />
                                        <input type="file" @input="form.thumbnail = $event.target.files[0]"
                                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                        <InputError class="mt-2" :message="form.errors.thumbnail" />
                                        <div v-if="project.thumbnail" class="mt-4">
                                            <p class="text-sm font-medium text-gray-700">Current Thumbnail:</p>
                                            <img :src="`/storage/${project.thumbnail}`" :alt="project.name"
                                                class="mt-2 h-32 w-32 object-cover rounded-md">
                                        </div>
                                    </div>
                                    <div>
                                        <InputLabel for="background" value="Change Background" />
                                        <input type="file" @input="form.background = $event.target.files[0]"
                                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                        <InputError class="mt-2" :message="form.errors.background" />
                                        <div v-if="project.background" class="mt-4">
                                            <p class="text-sm font-medium text-gray-700">Current Background:</p>
                                            <img :src="`/storage/${project.background}`" :alt="project.title"
                                                class="mt-2 h-32 w-32 object-cover rounded-md">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <InputLabel for="galleries" value="Add New Gallery Images" />
                                <input type="file" @input="form.galleries = $event.target.files" multiple
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
                                <InputError class="mt-2" :message="form.errors.galleries" />

                                <div v-if="project.project_galleries.length > 0" class="mt-6">
                                    <p class="text-sm font-medium text-gray-700">Current Gallery:</p>
                                    <div class="mt-2 grid gap-4">
                                        <div class="mt-2 grid grid-cols-1 md:grid-cols-4 gap-4">
                                            <div v-for="(gallery, index) in projectGalleries" :key="gallery.id"
                                                class="relative group">

                                                <div class="relative w-full" style="padding-top: 100%;">
                                                    <img :src="`/storage/${gallery.image}`" alt="Gallery Image"
                                                        class="absolute inset-0 w-full h-full object-cover rounded-md">
                                                </div>

                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-md">
                                                    <DangerButton @click="deleteGalleryImage(gallery.id, index)"
                                                        type="button">
                                                        Delete
                                                    </DangerButton>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update Project
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
