<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    titleAbout: '',
    descriptionAbout: '',
    banner_image: null,
    client_images: [],
})

// Preview states
const bannerPreview = ref(null)
const clientPreviews = ref([])

function handleBannerImageChange(e) {
    const file = e.target.files[0]
    if (file) {
        form.banner_image = file
        bannerPreview.value = URL.createObjectURL(file)
    } else {
        form.banner_image = null
        bannerPreview.value = null
    }
}

function handleClientImagesChange(e) {
    const files = Array.from(e.target.files).slice(0, 5)
    form.client_images = files
    clientPreviews.value = files.map(file => URL.createObjectURL(file))
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Bagian Banner and Clients
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Perbarui informasi Banner dan Clients pada halaman utama.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Banner Image -->
                <div>
                    <!-- Preview Banner -->
                    <div v-if="bannerPreview" class="my-2">
                        <img :src="bannerPreview" class="w-full h-64 object-cover rounded shadow" />
                    </div>

                    <InputLabel for="bannerImage" value="Banner Image (Max 1 gambar)" />
                    <input id="bannerImage" type="file" accept="image/*" @change="handleBannerImageChange"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    <InputError class="mt-2" :message="form.errors.banner_image" />
                </div>

                <!-- Client Images -->
                <div>
                    <!-- Preview Clients -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-2">
                        <div v-for="(img, index) in clientPreviews" :key="index" class="border rounded shadow">
                            <img :src="img" class="w-64 h-20 object-cover rounded" />
                        </div>
                    </div>

                    <InputLabel for="clientImages" value="Client Images (Max 5 gambar)" />
                    <input id="clientImages" type="file" accept="image/*" multiple @change="handleClientImagesChange"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                    <InputError class="mt-2" :message="form.errors.client_images" />
                </div>
            </div>

            <!-- Submit -->
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
