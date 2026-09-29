<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { QuillEditor } from '@vueup/vue-quill';

const props = defineProps({
    data_fe: {
        type: Object
    },
    images: {
        type: Object,
    }
})

const form = useForm({
    title: props.data_fe.industry_title || '',
    heading: props.data_fe.industry_heading || '',
    description: props.data_fe.industry_description || '',
    images: [...props.images.map(item => item.path)],
});

const fileInput = ref(null);
const imagePreviews = ref([...form.images]);
const imageLimitExceeded = ref(false);

// Drag and Drop state
const draggedIndex = ref(null);
const dragOverIndex = ref(null);

function dragStart(index) {
    draggedIndex.value = index;
}

function dragOver(index) {
    dragOverIndex.value = index;
}

function dragLeave() {
    dragOverIndex.value = null;
}

function drop(targetIndex) {
    const from = draggedIndex.value;
    if (from === null || from === targetIndex) {
        draggedIndex.value = null;
        dragOverIndex.value = null;
        return;
    }
    const previewItem = imagePreviews.value.splice(from, 1)[0];
    imagePreviews.value.splice(targetIndex, 0, previewItem);
    const formItem = form.images.splice(from, 1)[0];
    form.images.splice(targetIndex, 0, formItem);
    draggedIndex.value = null;
    dragOverIndex.value = null;
}

function handleImageUpload(event) {
    imageLimitExceeded.value = false;
    const files = event.target.files;

    if (!files) return;

    if (form.images.length + files.length > 6) {
        imageLimitExceeded.value = true;
        fileInput.value.value = '';
        return;
    }

    for (const file of files) {
        form.images.push(file);
        imagePreviews.value.push(URL.createObjectURL(file));
    }

    fileInput.value.value = '';
}

function removeImage(index) {
    form.images.splice(index, 1);
    imagePreviews.value.splice(index, 1);
    imageLimitExceeded.value = false;
}

function submit() {
    form.post(route('settings.industryUpdate'), {
        _method: 'patch',
        onError: (errors) => {
            console.log(form.value);
        },
    });
}

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Bagian Industri
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Perbarui informasi Industry di halaman utama.
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
            <div class="flex flex-col md:flex-row gap-6">

                <div class="grid w-full md:w-1/2 gap-4 content-start">
                    <div>
                        <InputLabel for="title" value="Judul" required />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required />
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>
                    <div>
                        <InputLabel for="title2" value="Heading" required />
                        <TextInput id="title2" type="text" class="mt-1 block w-full" v-model="form.heading" required />
                        <InputError class="mt-2" :message="form.errors.heading" />
                    </div>
                    <div>
                        <InputLabel for="description" value="Deskripsi" required />
                        <QuillEditor theme="snow" v-model:content="form.description" content-type="html" class="bg-white"
                            style="height: 300px" />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <input id="industry_images" ref="fileInput" type="file" class="hidden" multiple accept="image/*"
                        @change="handleImageUpload" />

                    <InputError class="mt-2" :message="form.errors.images" />
                    <p v-if="imageLimitExceeded" class="text-sm text-red-600 mt-2">
                        Anda hanya dapat mengunggah maksimal 6 gambar.
                    </p>

                    <div v-if="imagePreviews.length" class="mb-4">
                        <p class="text-xs text-gray-400 mb-2 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                <circle cx="9" cy="5" r="1.5"/><circle cx="15" cy="5" r="1.5"/>
                                <circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/>
                                <circle cx="9" cy="19" r="1.5"/><circle cx="15" cy="19" r="1.5"/>
                            </svg>
                            Drag gambar untuk mengubah urutan
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <div
                                v-for="(preview, index) in imagePreviews"
                                :key="index"
                                class="relative group rounded-lg transition-all duration-150 cursor-grab active:cursor-grabbing"
                                draggable="true"
                                @dragstart="dragStart(index)"
                                @dragover.prevent="dragOver(index)"
                                @dragleave="dragLeave"
                                @drop.prevent="drop(index)"
                                :class="{
                                    'opacity-40 scale-95': draggedIndex === index,
                                    'ring-2 ring-green-500 ring-offset-2 scale-[1.03]': dragOverIndex === index && draggedIndex !== index,
                                }"
                            >
                                <div class="absolute top-1 left-1 z-10 bg-black/50 rounded p-0.5 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                                        <circle cx="9" cy="5" r="1.5"/><circle cx="15" cy="5" r="1.5"/>
                                        <circle cx="9" cy="12" r="1.5"/><circle cx="15" cy="12" r="1.5"/>
                                        <circle cx="9" cy="19" r="1.5"/><circle cx="15" cy="19" r="1.5"/>
                                    </svg>
                                </div>
                                <div class="absolute bottom-1 left-1 z-10 bg-black/50 text-white text-xs font-semibold rounded px-1.5 py-0.5 leading-none">
                                    {{ index + 1 }}
                                </div>
                                <img :src="preview" class="aspect-square w-full object-cover rounded-lg shadow-md select-none" alt="Image preview" draggable="false" />
                                <button @click.prevent="removeImage(index)"
                                    class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"
                                    aria-label="Hapus gambar">
                                    <span class="font-bold text-lg leading-none">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <InputLabel for="industry_images" value="Gambar Industri (Maks. 6 file)" />

                    <SecondaryButton @click.prevent="fileInput.click()" class="mt-1">
                        Pilih Gambar
                    </SecondaryButton>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Simpan</PrimaryButton>
                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                        Tersimpan.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>