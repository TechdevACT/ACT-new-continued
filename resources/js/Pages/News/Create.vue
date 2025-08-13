<script setup>
import { useForm } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { watch } from 'vue';

const emit = defineEmits(['cancel']);

const form = useForm({
    title: '',
    slug: '',
    image: null,
    content: '',
});

const handleImageUpload = (event) => {
    form.image = event.target.files[0];
};

const submit = () => {
    const parser = new DOMParser();
    const doc = parser.parseFromString(form.content, 'text/html');
    doc.querySelectorAll('h2').forEach(h2 => {
        h2.classList.add('text-2xl', 'font-bold', 'mt-4');
    });
    form.content = doc.body.innerHTML;

    form.post(route('blog.store'), {
        onSuccess: () => {
            form.reset();
        }
    });
};
</script>

<template>
    <div class="py-4 mx-4">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8 bg-white p-6 rounded-xl shadow">

            <!-- Judul Blog -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" id="title" v-model="form.title"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Masukkan judul">
                <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</div>
            </div>

            <!-- Slug Blog -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" id="slug" v-model="form.slug" @blur="formatSlug"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Masukkan slug" />
                <div v-if="form.errors.slug" class="text-red-500 text-sm mt-1">{{ form.errors.slug }}</div>
            </div>

            <!-- Gambar -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" id="image" accept="image/*" @change="handleImageUpload" class="mt-1 block w-full">
                <div v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</div>
            </div>

            <!-- Konten -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                <QuillEditor theme="snow" v-model:content="form.content" content-type="html" class="bg-white"
                    style="height: 300px" />
                <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-between mt-4">
                <button class="py-1 px-4 rounded-xl bg-gray-300" @click="emit('cancel')">
                    Cancel
                </button>

                <button @click="submit" :disabled="form.processing"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</template>
