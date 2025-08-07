<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    banner: {
        type: Object
    },
    images: {
        type: Object,
    }
})

const form = useForm({
    banner: [...props.banner.map(item => item.path)],
    images: [...props.images.map(item => item.path)],
});

const fileInputBanner = ref(null);
const imagePreviewsBanner = ref([...form.banner]);

const fileInput = ref(null);
const imagePreviews = ref([...form.images]);
const imageLimitExceeded = ref(false);

function handleBannerUpload(event) {
    const files = event.target.files;

    if (!files || files.length === 0) return;

    const file = files[0];

    form.banner = [file];
    imagePreviewsBanner.value = [URL.createObjectURL(file)];

    fileInputBanner.value.value = '';
}


function handleImageUpload(event) {
    imageLimitExceeded.value = false;
    const files = event.target.files;

    if (!files) return;

    if (form.images.length + files.length > 5) {
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

function removeBanner(index) {
    form.banner.splice(index, 1);
    imagePreviewsBanner.value.splice(index, 1);
}

function removeImage(index) {
    form.images.splice(index, 1);
    imagePreviews.value.splice(index, 1);
    imageLimitExceeded.value = false;
}

function submit() {
    form.post(route('settings.bannerClientUpdate'), {
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

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div class="flex flex-col md:flex-row gap-6">

                <div class="w-full md:w-1/2">
                    <input id="banner_image" ref="fileInputBanner" type="file" class="hidden" multiple accept="image/*"
                        @change="handleBannerUpload" />

                    <InputError class="mt-2" :message="form.errors.banner" />

                    <div v-if="imagePreviewsBanner.length" class="mb-2">
                        <div v-for="(preview, index) in imagePreviewsBanner" :key="index" class="relative group">
                            <img :src="preview" class="w-full max-h-36 object-cover rounded-lg shadow-md" alt="Banner preview" />
                            <button @click.prevent="removeBanner(index)"
                                class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"
                                aria-label="Hapus gambar">
                                <span class="font-bold text-lg leading-none">&times;</span>
                            </button>
                        </div>
                    </div>

                    <SecondaryButton @click.prevent="fileInputBanner.click()" class="mt-1">
                        Pilih Banner
                    </SecondaryButton>
                </div>

                <div class="w-full md:w-1/2">
                    <input id="hero_images" ref="fileInput" type="file" class="hidden" multiple accept="image/*"
                        @change="handleImageUpload" />

                    <InputError class="mt-2" :message="form.errors.images" />
                    <p v-if="imageLimitExceeded" class="text-sm text-red-600 mt-2">
                        Anda hanya dapat mengunggah maksimal 5 gambar.
                    </p>

                    <div v-if="imagePreviews.length" class="mb-4 grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div v-for="(preview, index) in imagePreviews" :key="index" class="relative group">
                            <img :src="preview" class="w-full h-16 object-cover rounded-lg shadow-md"
                                alt="Image preview" />
                            <button @click.prevent="removeImage(index)"
                                class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"
                                aria-label="Hapus gambar">
                                <span class="font-bold text-lg leading-none">&times;</span>
                            </button>
                        </div>
                    </div>

                    <InputLabel for="hero_images" value="Gambar Hero (Maks. 6 file)" />

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
