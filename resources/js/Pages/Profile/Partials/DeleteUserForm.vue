<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

// Dapatkan data user dari page props
const user = usePage().props.auth.user;
const hasPassword = ref(user.has_password);

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    if (hasPassword.value) {
        nextTick(() => passwordInput.value.focus());
    }
};

// Fungsi untuk user dengan password
const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Hapus Akun</h2>
            <p class="mt-1 text-sm text-gray-600">
                Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus
                akun Anda, pastikan anda sudah yakin dengan apa yang anda lakukan.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Hapus Akun</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Apakah Anda yakin ingin menghapus akun Anda?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.
                </p>

                <div v-if="hasPassword" class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />
                    <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                        class="mt-1 block w-3/4" placeholder="Password" @keyup.enter="deleteUser" />
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>
                <p v-else class="mt-6 text-sm text-gray-600">
                    Untuk mengonfirmasi tindakan ini, Anda akan dialihkan ke penyedia login sosial Anda untuk melakukan
                    autentikasi ulang.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Batal </SecondaryButton>

                    <DangerButton v-if="hasPassword" class="ms-3" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing" @click="deleteUser">
                        Hapus Akun
                    </DangerButton>
                    <a v-else :href="route('auth.delete.redirect', { provider: user.provider_name })"
                        class="ms-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Hapus Dengan {{ user.provider_name }}
                    </a>
                </div>
            </div>
        </Modal>
    </section>
</template>