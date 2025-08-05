<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    heading: '',
    description: '',
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Bagian Blog
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Perbarui informasi Blog pada halaman utama.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="title" value="Judul" required />

                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <InputLabel for="subtitle" value="Heading" required />

                <TextInput id="subtitle" type="text" class="mt-1 block w-full" v-model="form.heading" required />

                <InputError class="mt-2" :message="form.errors.subtitle" />
            </div>

            <div>
                <InputLabel for="description" value="Deskripsi" required />

                <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"
                    required />

                <InputError class="mt-2" :message="form.errors.description" />
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
