<script setup>
import { useForm } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { watch } from 'vue';

const emit = defineEmits(['cancel']);

const form = useForm({
    title: '',
    slug: '',
    excerpt: '',
    image: null,
    content: '',
});

const props = defineProps({
    formData: { type: Object, default: null }
});

watch(
    () => props.formData,
    (val) => {
        form.title = val?.title ?? '';
        form.slug = val?.slug ?? '';
        form.content = val?.content ?? '';
        form.excerpt = val?.excerpt ?? '';
    },
    { immediate: true }
);

const formatSlug = () => {
    form.slug = form.slug
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^a-z0-9\-]/g, '')
        .replace(/-+/g, '-');
};

const handleImageUpload = (event) => {
    form.image = event.target.files[0];
};

const submit = () => {
    const parser = new DOMParser();
    const doc = parser.parseFromString(form.content, 'text/html');

    doc.querySelectorAll('h1').forEach(h1 => {
        h1.classList.add('text-4xl', 'mt-4');
    });
    doc.querySelectorAll('h2').forEach(h2 => {
        h2.classList.add('text-3xl', 'mt-4');
    });
    doc.querySelectorAll('p').forEach(p => {
        p.classList.add('text-xl', 'mt-4');
    });
    doc.querySelectorAll('ol').forEach(ol => {
        ol.classList.add('list-decimal', 'list-inside', 'space-y-1', 'pl-4', 'mt-4');
    });
    doc.querySelectorAll('ul').forEach(ul => {
        ul.classList.add('list-disc', 'list-inside', 'space-y-1', 'pl-4', 'mt-4');
    });
    doc.querySelectorAll('a').forEach(a => {
        a.classList.add('text-blue-600', 'hover:underline');
    });
    form.content = doc.body.innerHTML;

    if (props.formData?.id) {
        form.transform(data => ({
            ...data,
            _method: 'PUT',
        })).post(route('blog.update', props.formData.id), {
            onSuccess: () => {
                form.reset();
                emit('cancel');
            },
            onError: (errors) => {
                console.error(errors);
            }
        });
    } else {
        form.post(route('blog.store'), {
            onSuccess: () => {
                form.reset();
                emit('cancel');
            }
        });
    }
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

            <!-- Excerpt Blog -->
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                <input type="text" id="excerpt" v-model="form.excerpt"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Masukkan deskripsi singkat">
                <div v-if="form.errors.excerpt" class="text-red-500 text-sm mt-1">{{ form.errors.excerpt }}</div>
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
