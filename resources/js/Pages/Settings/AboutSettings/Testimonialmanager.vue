<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    testimonials: Array
});

const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
    name: '',
    title: '',
    quote: '',
    avatar: null,
});

const submit = () => {
    if (isEditing.value) {
        form.post(route('testimonials.update', editingId.value), {
            onSuccess: () => resetForm(),
            forceFormData: true, // Penting untuk upload file saat update (method spoofing handled by Laravel/Inertia)
        });
    } else {
        form.post(route('testimonials.store'), {
            onSuccess: () => resetForm(),
        });
    }
};

const editTestimonial = (item) => {
    isEditing.value = true;
    editingId.value = item.id;
    form.name = item.name;
    form.title = item.title;
    form.quote = item.quote;
    form.avatar = null; // Reset file input
    // Kita tambahkan _method PUT manual jika menggunakan post untuk file upload di Laravel
    form.transform((data) => ({
        ...data,
        _method: 'PUT',
    }));
};

const deleteTestimonial = (id) => {
    if (confirm('Are you sure you want to delete this testimonial?')) {
        form.delete(route('testimonials.destroy', id));
    }
};

const resetForm = () => {
    isEditing.value = false;
    editingId.value = null;
    form.reset();
    form.clearErrors();
};
</script>

<template>
    <div class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Testimonials Manager</h2>
            <p class="mt-1 text-sm text-gray-600">Add or edit client testimonials.</p>
        </header>

        <form @submit.prevent="submit" class="space-y-4 border-b pb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <InputLabel value="Client Name" />
                    <TextInput v-model="form.name" type="text" class="mt-1 block w-full" required />
                </div>
                <div>
                    <InputLabel value="Title / Position" />
                    <TextInput v-model="form.title" type="text" class="mt-1 block w-full" required />
                </div>
            </div>

            <div>
                <InputLabel value="Quote / Review" />
                <textarea v-model="form.quote" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required></textarea>
            </div>

            <div>
                <InputLabel value="Avatar Image" />
                <input type="file" @input="form.avatar = $event.target.files[0]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" :required="!isEditing" />
            </div>

            <div class="flex gap-2">
                <PrimaryButton :disabled="form.processing">{{ isEditing ? 'Update' : 'Add' }} Testimonial</PrimaryButton>
                <SecondaryButton v-if="isEditing" @click="resetForm">Cancel</SecondaryButton>
            </div>
        </form>

        <div class="grid grid-cols-1 gap-4">
            <div v-for="item in testimonials" :key="item.id" class="flex items-center justify-between bg-gray-50 p-4 rounded-lg shadow-sm border">
                <div class="flex items-center gap-4">
                    <img :src="item.avatar" alt="" class="h-12 w-12 rounded-full object-cover bg-gray-200">
                    <div>
                        <h4 class="font-bold text-gray-800">{{ item.name }}</h4>
                        <p class="text-sm text-gray-600">{{ item.title }}</p>
                        <p class="text-xs text-gray-500 italic mt-1 line-clamp-1">"{{ item.quote }}"</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <SecondaryButton @click="editTestimonial(item)">Edit</SecondaryButton>
                    <DangerButton @click="deleteTestimonial(item.id)">Delete</DangerButton>
                </div>
            </div>
        </div>
    </div>
</template>
