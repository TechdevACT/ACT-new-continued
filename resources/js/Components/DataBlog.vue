<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    news: Object,
});

const emit = defineEmits(['edit']);

const destroyItem = (id) => {
    if (confirm("Yakin hapus data ini?")) {
        router.delete(route('blog.destroy', id), { preserveScroll: true });
    }
};
</script>

<template>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-xl overflow-hidden">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in news.data" :key="item.id" class="border-t">
                    <td class="px-4 py-2">{{ item.title }}</td>
                    <td class="px-4 py-2 capitalize">{{ item.status }}</td>
                    <td class="px-4 py-2">{{ new Date(item.created_at).toLocaleDateString() }}</td>
                    <td class="px-4 py-2 flex gap-2 justify-end">
                        <button type="button" @click="emit('edit', item)"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Edit
                        </button>

                        <button type="button" @click="destroyItem(item.id)"
                            class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
