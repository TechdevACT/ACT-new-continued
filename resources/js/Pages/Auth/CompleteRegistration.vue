<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    phone_number: '',
});

const handlePhoneInput = (event) => {
    const numericValue = event.target.value.replace(/[^0-9]/g, '');
    form.phone_number = numericValue;
};

const submit = () => {
    form.post(route('auth.complete-registration'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Lengkapi Pendaftaran" />

        <div class="mb-4 text-sm text-gray-600">
            Satu langkah lagi! Silakan masukkan nomor telepon aktif Anda untuk menyelesaikan pendaftaran.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="phone_number" value="WhatsApp" infoField="Contoh: 6281234567890"/>

                <TextInput id="phone_number" type="tel" class="mt-1 block w-full" v-model="form.phone_number" required
                    autofocus autocomplete="tel" placeholder="6281234567890" @input="handlePhoneInput" />

                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Selesaikan Pendaftaran
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>