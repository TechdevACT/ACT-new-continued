<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    services: [
        {
            name: '',
            description: '',
            image: null,
            url: '',
        },
    ],
});

const handleFileChange = (e, index) => {
    form.services[index].image = e.target.files[0];
};

const addService = () => {
    form.services.push({
        name: '',
        description: '',
        image: null,
        url: '',
    });
};

const removeService = (index) => {
    form.services.splice(index, 1);
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Bagian Service</h2>
            <p class="mt-1 text-sm text-gray-600">Tambahkan satu atau lebih layanan untuk halaman utama.</p>
        </header>

        <form @submit.prevent="form.post(route('service.store'), { forceFormData: true })" class="mt-6 space-y-6">
            <div v-for="(service, index) in form.services" :key="index"
                class="border p-4 rounded-md space-y-4 relative">
                <button type="button" v-if="form.services.length > 1" @click="removeService(index)"
                    class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-sm">Hapus</button>

                <!-- Nama Layanan -->
                <div>
                    <InputLabel :for="`name-${index}`" value="Layanan" required />
                    <TextInput :id="`name-${index}`" type="text" class="mt-1 block w-full"
                        v-model="form.services[index].name" required />
                    <InputError class="mt-2" :message="form.errors[`services.${index}.name`]" />
                </div>

                <!-- Deskripsi Layanan -->
                <div>
                    <InputLabel :for="`description-${index}`" value="Deskripsi" required />
                    <TextInput :id="`description-${index}`" type="text" class="mt-1 block w-full"
                        v-model="form.services[index].description" required />
                    <InputError class="mt-2" :message="form.errors[`services.${index}.description`]" />
                </div>

                <!-- Gambar Layanan -->
                <div>
                    <InputLabel :for="`image-${index}`" value="Gambar" required />
                    <input :id="`image-${index}`" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*"
                        @change="e => handleFileChange(e, index)" required />
                    <InputError class="mt-2" :message="form.errors[`services.${index}.image`]" />
                </div>

                <!-- URL Detail Layanan -->
                <div>
                    <InputLabel :for="`url-${index}`" value="URL Detail Layanan" required />
                    <TextInput :id="`url-${index}`" type="url" class="mt-1 block w-full"
                        v-model="form.services[index].url" required />
                    <InputError class="mt-2" :message="form.errors[`services.${index}.url`]" />
                </div>
            </div>

            <!-- Tombol tambah layanan -->
            <div>
                <button type="button" @click="addService" class="text-sm text-blue-600 hover:underline mt-2">+ Tambah
                    Layanan</button>
            </div>

            <!-- Tombol simpan -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Simpan</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Tersimpan.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
