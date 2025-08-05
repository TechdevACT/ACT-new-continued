<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    hero: {
        type: Object,
        default: () => ({
            title1: '',
            title2: '',
            description: '',
            images: [
                "https://theme.madsparrow.me/osty/wp-content/uploads/2025/01/Person-with-VR-Headset-m_f.png",
                "https://theme.madsparrow.me/osty/wp-content/uploads/2025/01/Minimalist-Stone-Composition-m_f.png",
                "https://theme.madsparrow.me/osty/wp-content/uploads/2025/01/Whimsical-Character-in-a-Jar-m_f.png",
                "https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Three-Scoops-of-Ice-Cream-on-Spoons.webp",
                "https://theme.madsparrow.me/osty/wp-content/uploads/2025/01/Green-Character-in-Yellow-Hoodie-m_f.png"]
        }),
    }
})

const form = useForm({
    title1: props.hero.title || '',
    title2: props.hero.title2 || '',
    description: props.hero.description || '',
    images: [...props.hero.images],
});

const fileInput = ref(null);
const imagePreviews = ref([...form.images]);
const imageLimitExceeded = ref(false);

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

function removeImage(index) {
    form.images.splice(index, 1);
    imagePreviews.value.splice(index, 1);
    imageLimitExceeded.value = false;
}

function submit() {
    form.post(route('settings.heroUpdate'), {
        _method: 'patch',
        onError: (errors) => {
            console.log(form.value);
        },
        onSuccess: () => {
            // Aksi setelah berhasil, misalnya reset form atau preview
            // imagePreviews.value = [];
            // form.reset('images');
        }
    });
}

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Bagian Hero
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Perbarui informasi hero di halaman utama.
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div class="flex flex-col md:flex-row gap-6">

                <div class="grid w-full md:w-1/2 gap-4 content-start">
                    <div>
                        <InputLabel for="title" value="Judul dengan warna" required />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title1" required />
                        <InputError class="mt-2" :message="form.errors.title1" />
                    </div>
                    <div>
                        <InputLabel for="title2" value="Judul tanpa warna" required />
                        <TextInput id="title2" type="text" class="mt-1 block w-full" v-model="form.title2" required />
                        <InputError class="mt-2" :message="form.errors.title2" />
                    </div>
                    <div>
                        <InputLabel for="description" value="Deskripsi" required />
                        <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"
                            required />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
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
                            <img :src="preview" class="aspect-square w-full object-cover rounded-lg shadow-md"
                                alt="Image preview" />
                            <button @click.prevent="removeImage(index)"
                                class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"
                                aria-label="Hapus gambar">
                                <span class="font-bold text-lg leading-none">&times;</span>
                            </button>
                        </div>
                    </div>

                    <InputLabel for="hero_images" value="Gambar Hero (Maks. 5 file)" />

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
