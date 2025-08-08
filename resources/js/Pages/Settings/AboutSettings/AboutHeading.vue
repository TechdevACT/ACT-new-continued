<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
    data_about: {
        type: Object
    },
})

const form = useForm({
    headingbig1: props.data_about.heading_big || '',
    headingbig2: props.data_about.heading_big2 || '',
    heading: props.data_about.heading || '',
    description: props.data_about.description || '',
    approach_title: props.data_about.approach_title || '',
    approach_heading: props.data_about.approach_heading || '',
    approach_description: props.data_about.approach_description || '',
    expertise_title: props.data_about.expertise_title || '',
    emphasis_title: props.data_about.emphasis_title || '',
    emphasis_heading: props.data_about.emphasis_heading || '',
    emphasis_description: props.data_about.emphasis_description || '',
});

function submit() {
    form.post(route('settings.aboutPageUpdate'), {
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
                Sesuaikan halaman About anda
            </h2>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                <h3 class="text-md font-medium text-gray-900">
                    Banner text
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                    <div>
                        <InputLabel for="headingbig1" value="Judul Besar 1" required />

                        <TextInput id="headingbig1" type="text" class="mt-1 block w-full" v-model="form.headingbig1"
                            required />

                        <InputError class="mt-2" :message="form.errors.headingbig1" />
                    </div>

                    <div>
                        <InputLabel for="headingbig2" value="Judul Besar 2" required />

                        <TextInput id="headingbig2" type="text" class="mt-1 block w-full" v-model="form.headingbig2"
                            required />

                        <InputError class="mt-2" :message="form.errors.headingbig2" />
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                <h3 class="text-md font-medium text-gray-900">
                    About
                </h3>
                <div class="grid grid-cols-1 gap-4 mb-10">
                    <div>
                        <InputLabel for="heading" value="Judul" required />

                        <TextInput id="heading" type="text" class="mt-1 block w-full" v-model="form.heading" required />

                        <InputError class="mt-2" :message="form.errors.heading" />
                    </div>

                    <div>
                        <InputLabel for="description" value="Deskripsi" required />

                        <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description"
                            required />

                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                <h3 class="text-md font-medium text-gray-900">
                    Approach
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                    <div>
                        <InputLabel for="approach_title" value="Judul" required />

                        <TextInput id="approach_title" type="text" class="mt-1 block w-full"
                            v-model="form.approach_title" required />

                        <InputError class="mt-2" :message="form.errors.approach_title" />
                    </div>

                    <div>
                        <InputLabel for="approach_heading" value="Heading" required />

                        <TextInput id="approach_heading" type="text" class="mt-1 block w-full"
                            v-model="form.approach_heading" required />

                        <InputError class="mt-2" :message="form.errors.approach_heading" />
                    </div>

                    <div class="sm:col-span-2">
                        <InputLabel for="approach_description" value="Deskripsi" required />

                        <TextInput id="approach_description" type="text" class="mt-1 block w-full"
                            v-model="form.approach_description" required />

                        <InputError class="mt-2" :message="form.errors.approach_description" />
                    </div>
                </div>
            </div>


            <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                <h3 class="text-md font-medium text-gray-900">
                    Expertise
                </h3>
                <div class="grid grid-cols-1 gap-4 mb-10">
                    <div>
                        <InputLabel for="expertise_title" value="Judul" required />

                        <TextInput id="expertise_title" type="text" class="mt-1 block w-full"
                            v-model="form.expertise_title" required />

                        <InputError class="mt-2" :message="form.errors.expertise_title" />
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                <h3 class="text-md font-medium text-gray-900">
                    Emphasis
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                    <div>
                        <InputLabel for="emphasis_title" value="Judul" required />

                        <TextInput id="emphasis_title" type="text" class="mt-1 block w-full"
                            v-model="form.emphasis_title" required />

                        <InputError class="mt-2" :message="form.errors.emphasis_title" />
                    </div>

                    <div>
                        <InputLabel for="emphasis_heading" value="Heading" required />

                        <TextInput id="emphasis_heading" type="text" class="mt-1 block w-full"
                            v-model="form.emphasis_heading" required />

                        <InputError class="mt-2" :message="form.errors.emphasis_heading" />
                    </div>

                    <div class="sm:col-span-2">
                        <InputLabel for="emphasis_description" value="Deskripsi" required />

                        <TextInput id="emphasis_description" type="text" class="mt-1 block w-full"
                            v-model="form.emphasis_description" required />

                        <InputError class="mt-2" :message="form.errors.emphasis_description" />
                    </div>
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
