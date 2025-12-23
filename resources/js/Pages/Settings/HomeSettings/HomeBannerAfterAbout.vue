<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    bannerImage: {
        type: Object,
    }
})

const form = useForm({
    image: props.bannerImage?.path || null,
});

const fileInput = ref(null);
const imagePreview = ref(props.bannerImage?.path || null);

function handleImageUpload(event) {
    const file = event.target.files[0];

    if (!file) return;

    form.image = file;
    imagePreview.value = URL.createObjectURL(file);
    fileInput.value.value = '';
}

function removeImage() {
    form.image = null;
    imagePreview.value = null;
}

function submit() {
    form.post(route('settings.bannerHomeUpdate'), {
        _method: 'patch',
        onError: (errors) => {
            console.log(errors);
        },
    });
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Banner Home
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Perbarui gambar banner di halaman utama (1080x500px recommended).
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
            <div>
                <input
                    id="banner_image"
                    ref="fileInput"
                    type="file"
                    class="hidden"
                    accept="image/*"
                    @change="handleImageUpload"
                />

                <InputError class="mt-2" :message="form.errors.image" />

                <div v-if="imagePreview" class="mb-4">
                    <div class="relative group max-w-2xl">
                        <img
                            :src="imagePreview"
                            class="w-full rounded-lg shadow-md"
                            alt="Banner preview"
                        />
                        <button
                            @click.prevent="removeImage"
                            class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"
                            aria-label="Hapus gambar">
                            <span class="font-bold text-xl leading-none">&times;</span>
                        </button>
                    </div>
                </div>

                <InputLabel for="banner_image" value="Gambar Banner Home" />

                <SecondaryButton @click.prevent="fileInput.click()" class="mt-1">
                    {{ imagePreview ? 'Ganti Gambar' : 'Pilih Gambar' }}
                </SecondaryButton>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Simpan</PrimaryButton>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                        Tersimpan.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
