<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
    data_fe: {
        type: Object
    },
})

const form = useForm({
    titleAbout: props.data_fe.about_title || '',
    descriptionAbout: props.data_fe.about_description || '',
});

function submit() {
    form.post(route('settings.aboutUpdate'), {
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
                Bagian About
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Perbarui informasi about pada halaman utama.
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="titleAbout" value="Judul" required />

                <TextInput id="titleAbout" type="text" class="mt-1 block w-full" v-model="form.titleAbout" required />

                <InputError class="mt-2" :message="form.errors.titleAbout" />
            </div>

            <div>
                <InputLabel for="descriptionAbout" value="Deskripsi" required />

                <TextInput id="descriptionAbout" type="text" class="mt-1 block w-full" v-model="form.descriptionAbout"
                    required />

                <InputError class="mt-2" :message="form.errors.descriptionAbout" />
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
