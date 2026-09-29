<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import { ref } from 'vue';

const props = defineProps({
    services: {
        type: Array,
        default: () => []
    }
});

const defaultServices = props.services.length > 0 
    ? props.services.map(s => ({
        id: s.id,
        name: s.name,
        description: s.description,
        image: null,
        existing_image: s.image,
        preview_url: null,
        url: s.url
    }))
    : [
        {
            name: '',
            description: '',
            image: null,
            preview_url: null,
            url: '',
        },
    ];

const form = useForm({
    services: defaultServices,
});

const handleFileChange = (e, index) => {
    const file = e.target.files[0];
    if (file) {
        form.services[index].image = file;
        form.services[index].preview_url = URL.createObjectURL(file);
    } else {
        form.services[index].image = null;
        form.services[index].preview_url = null;
    }
};



const removeService = (index) => {
    form.services.splice(index, 1);
    collapsedState.value.splice(index, 1);
};

// Collapse state — default: only first service is expanded
const collapsedState = ref(
    defaultServices.map((_, i) => i !== 0)
);

const toggleCollapse = (index) => {
    collapsedState.value[index] = !collapsedState.value[index];
};

const addService = () => {
    form.services.push({
        id: null,
        name: '',
        description: '',
        image: null,
        preview_url: null,
        url: '',
    });
    // New service starts expanded
    collapsedState.value.push(false);
};
</script>

<template>
    <section>
        <header class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Pengaturan Layanan (Expertise)</h2>
            <p class="mt-2 text-sm text-gray-600">
                Kelola daftar layanan yang akan ditampilkan pada bagian Expertise di halaman utama. Anda dapat menambah, mengubah, atau menghapus layanan.
            </p>
        </header>

        <form @submit.prevent="form.post(route('service.store'), { forceFormData: true })" class="space-y-8">
            <div v-for="(service, index) in form.services" :key="index"
                class="bg-gray-50 border border-gray-200 rounded-xl relative shadow-sm transition hover:shadow-md overflow-hidden">

                <!-- Card Header (always visible, clickable to collapse) -->
                <div
                    class="flex justify-between items-center px-6 py-4 cursor-pointer select-none"
                    :class="collapsedState[index] ? 'border-b-0' : 'border-b border-gray-200'"
                    @click="toggleCollapse(index)"
                >
                    <div class="flex items-center gap-3">
                        <!-- Collapse icon -->
                        <svg
                            class="w-4 h-4 text-gray-500 transition-transform duration-200"
                            :class="{ 'rotate-180': !collapsedState[index] }"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        >
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="font-medium text-lg text-gray-800">
                            Layanan #{{ index + 1 }}
                            <span v-if="service.name" class="text-sm font-normal text-gray-500 ml-2">— {{ service.name }}</span>
                        </h3>
                    </div>
                    <button type="button" v-if="form.services.length > 1" @click.stop="removeService(index)"
                        class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md text-sm font-medium transition">
                        Hapus
                    </button>
                </div>

                <!-- Collapsible Content -->
                <Transition
                    enter-active-class="transition-all duration-300 ease-out"
                    enter-from-class="opacity-0 max-h-0"
                    enter-to-class="opacity-100 max-h-[2000px]"
                    leave-active-class="transition-all duration-200 ease-in"
                    leave-from-class="opacity-100 max-h-[2000px]"
                    leave-to-class="opacity-0 max-h-0"
                >
                    <div v-show="!collapsedState[index]" class="px-6 pb-6 pt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Kolom Kiri -->
                            <div class="space-y-6">
                                <!-- Nama Layanan -->
                                <div>
                                    <InputLabel :for="`name-${index}`" value="Nama Layanan" required />
                                    <TextInput :id="`name-${index}`" type="text" class="mt-1 block w-full"
                                        v-model="form.services[index].name" placeholder="Contoh: Creative Creation" required />
                                    <InputError class="mt-2" :message="form.errors[`services.${index}.name`]" />
                                </div>

                                <!-- URL Detail Layanan -->
                                <div>
                                    <InputLabel :for="`url-${index}`" value="URL Detail Layanan" />
                                    <TextInput :id="`url-${index}`" type="text" class="mt-1 block w-full"
                                        v-model="form.services[index].url" placeholder="Contoh: /services/creative-creation" />
                                    <InputError class="mt-2" :message="form.errors[`services.${index}.url`]" />
                                </div>

                                <!-- Gambar Layanan -->
                                <div>
                                    <InputLabel :for="`image-${index}`" value="Gambar Latar (Background)" :required="!service.existing_image" />

                                    <div v-if="service.preview_url || service.existing_image" class="mt-2 mb-3">
                                        <img :src="service.preview_url || service.existing_image" class="h-40 w-full object-cover rounded-lg shadow-sm border border-gray-300" />
                                        <p v-if="service.existing_image && !service.preview_url" class="text-xs text-gray-500 mt-2">Gambar saat ini. Upload file baru jika ingin mengubahnya.</p>
                                        <p v-else class="text-xs text-blue-500 mt-2">Preview gambar baru.</p>
                                    </div>

                                    <input :id="`image-${index}`" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700 transition" accept="image/*"
                                        @change="e => handleFileChange(e, index)" :required="!service.existing_image && !service.image" />
                                    <InputError class="mt-2" :message="form.errors[`services.${index}.image`]" />
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="h-full flex flex-col">
                                <InputLabel :for="`description-${index}`" value="Deskripsi Singkat" required />
                                <div class="mt-1 flex-grow">
                                    <QuillEditor theme="snow" v-model:content="form.services[index].description" content-type="text"
                                        class="bg-white rounded-md h-full min-h-[250px]" placeholder="Tuliskan deskripsi layanan di sini..." />
                                </div>
                                <InputError class="mt-2" :message="form.errors[`services.${index}.description`]" />
                            </div>
                        </div>
                    </div>
                </Transition>
            </div>

            <!-- Tombol tambah layanan -->
            <div class="flex justify-center border-2 border-dashed border-gray-300 rounded-xl p-4 hover:bg-gray-50 transition cursor-pointer" @click="addService">
                <button type="button" class="text-gray-600 font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Layanan Baru
                </button>
            </div>

            <!-- Tombol simpan -->
            <div class="flex items-center gap-4 bg-gray-100 p-4 rounded-xl border border-gray-200">
                <PrimaryButton :disabled="form.processing" class="px-8 py-3">Simpan Perubahan</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out duration-300" enter-from-class="opacity-0 scale-95"
                    leave-active-class="transition ease-in-out duration-300" leave-to-class="opacity-0 scale-95">
                    <div v-if="form.recentlySuccessful" class="flex items-center gap-2 text-green-600 font-medium bg-green-50 px-3 py-1.5 rounded-md border border-green-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Berhasil disimpan!
                    </div>
                </Transition>
            </div>
        </form>
    </section>
</template>
