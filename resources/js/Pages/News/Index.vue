<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Create from './Create.vue';
import DataBlog from '@/Components/DataBlog.vue';

// const activeTab = ref('allBlog');

const props = defineProps({
    news: Object,
    categories: Array,
    filters: Object
});

const search = ref(props.filters.search || '');
const categoryFilter = ref(props.filters.category || '');
const showForm = ref(false);
const editItem = ref(null);

const handleSearch = () => {
    router.get(route('blog.index'), { search: search.value, category: categoryFilter.value }, { preserveState: true });
};

const addNew = () => {
    editItem.value = null;
    showForm.value = true;
};

const editData = (item) => {
    editItem.value = { ...item };
    showForm.value = true;
};

</script>

<template>

    <Head title="Blog" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-lg text-center sm:text-left sm:text-xl font-semibold leading-tight text-gray-800">
                    All Blog
                </h2>

                <button class='py-1 px-4 rounded-xl bg-gray-300 right-0' @click="addNew">
                    Add New Blog
                </button>
            </div>
        </template>

        <div class="py-4 mx-4">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <Create v-if="showForm" :key="editItem?.id || 'new'" :form-data="editItem" :categories="categories"
                    @cancel="showForm = false; editItem = null" />

                <!-- Search & Add -->
                <div class="flex justify-between">
                    <input v-model="search" @keyup.enter="handleSearch" type="text" placeholder="Cari..."
                        class="border rounded-lg px-3 py-2 w-1/3" />

                    <select v-model="categoryFilter" @change="handleSearch"
                        class="border rounded-lg px-3 py-2">
                        <option value="">All Categories</option>
                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                            {{ cat.name }}
                        </option>
                    </select>
                </div>

                <!-- Table -->
                <DataBlog :news="news" @edit="editData" />

                <!-- Pagination -->
                <div class="flex justify-center mt-4 space-x-2">
                    <button v-for="page in news.links" :key="page.url" @click="page.url && router.get(page.url)"
                        v-html="page.label"
                        :class="['px-3 py-1 rounded', page.active ? 'bg-indigo-500 text-white' : 'bg-gray-200']" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
