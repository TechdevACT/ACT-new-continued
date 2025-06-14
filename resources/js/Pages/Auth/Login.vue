<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 justify-center sm:pt-0 p-4">
        <div>
            <Link href="/">
            <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md rounded-xl">

            <Head title="Log in" />

            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="current-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4 block">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <div class="mt-4 flex justify-between items-center">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Lupa password?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Masuk
                    </PrimaryButton>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <span class="text-sm text-gray-600">Atau masuk dengan</span>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <a href="/auth/google/redirect"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" focusable="false" data-prefix="fab"
                            data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                            <path fill="currentColor"
                                d="M488 261.8C488 403.3 381.5 512 244 512 109.8 512 0 402.2 0 261.8S109.8 11.8 244 11.8C381.5 11.8 488 120.5 488 261.8zm-252.3-66.3c-39.2 0-70.8 31.7-70.8 70.8s31.7 70.8 70.8 70.8c39.2 0 70.8-31.7 70.8-70.8s-31.7-70.8-70.8-70.8zm132.3 0c-39.2 0-70.8 31.7-70.8 70.8s31.7 70.8 70.8 70.8c39.2 0 70.8-31.7 70.8-70.8s-31.6-70.8-70.8-70.8zM244 434.3c-62.3 0-113.8-50.5-113.8-113.8S181.7 206.7 244 206.7s113.8 50.5 113.8 113.8-51.5 113.8-113.8 113.8z">
                            </path>
                        </svg>
                        Google
                    </a>
                </div>
            </form>
        </div>
    </div>

</template>
