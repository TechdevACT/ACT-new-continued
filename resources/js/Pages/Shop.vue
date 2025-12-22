<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { ref, computed } from 'vue';

const sortOrder = ref('default');
const selectedCategory = ref('all');

const categories = ref([
    { id: 'all', name: 'All', image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Red-Hoodie-2.jpg' },
    { id: 'classic', name: 'Classic', image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Green-Hoodie.jpg' },
    { id: 'oversized', name: 'Oversized', image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Casual-Attire.jpg' },
    { id: 'streetwear', name: 'Streetwear', image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Beige-Hoodie.jpg' },
    { id: 'tech', name: 'Tech', image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Casual-Attire.jpg' }
]);

const products = ref([
    {
        id: 1,
        name: 'Bold Layer',
        price: 499.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Red-Hoodie-2.jpg',
        tags: ['Oversized', 'Tech'],
        category: 'oversized'
    },
    {
        id: 2,
        name: 'Core Vibe',
        price: 299.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Orange-Hoodie.jpg',
        tags: ['Classic', 'Oversized'],
        category: 'classic'
    },
    {
        id: 3,
        name: 'Cozy Flow',
        price: 599.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Green-Hoodie.jpg',
        tags: ['Classic', 'Oversized'],
        category: 'classic'
    },
    {
        id: 4,
        name: 'Urban Edge',
        price: 599.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Navy-and-Orange-Hoodie.jpg',
        tags: ['Streetwear', 'Tech'],
        category: 'streetwear'
    },
    {
        id: 5,
        name: 'Street Essential',
        price: 599.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Casual-Attire.jpg',
        tags: ['Streetwear'],
        category: 'streetwear'
    },
    {
        id: 6,
        name: 'Tech Comfort',
        price: 599.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Casual-Fashion.jpg',
        tags: ['Tech', 'Oversized'],
        category: 'tech'
    },
    {
        id: 7,
        name: 'Minimal Touch',
        price: 399.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Beige-Hoodie-1.jpg',
        tags: ['Classic'],
        category: 'classic'
    },
    {
        id: 8,
        name: 'Power Move',
        price: 399.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Bold-Attire.jpg',
        tags: ['Oversized', 'Streetwear'],
        category: 'oversized'
    },
    {
        id: 9,
        name: 'Future Ready',
        price: 299.000,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Beige-Hoodie.jpg',
        tags: ['Tech'],
        category: 'tech'
    }
]);

const filteredProducts = computed(() => {
    let filtered = products.value;

    if (selectedCategory.value !== 'all') {
        filtered = filtered.filter(p => p.category === selectedCategory.value);
    }

    switch (sortOrder.value) {
        case 'price-low':
            return [...filtered].sort((a, b) => a.price - b.price);
        case 'price-high':
            return [...filtered].sort((a, b) => b.price - a.price);
        case 'name':
            return [...filtered].sort((a, b) => a.name.localeCompare(b.name));
        default:
            return filtered;
    }
});

const selectOptions = (product) => {
    alert(`Opening options for ${product.name}`);
};
</script>

<template>
    <DefaultLayout :title="'Shop -'">
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <section class="animate-fade-up">
            <div class="flex flex-col gap-2 py-8 sm:py-16 mx-4 sm:mx-0 dark:text-white">
                <h1 class="text-5xl sm:text-7xl font-bold">SHOP</h1>
                <nav class="flex text-sm text-gray-600">
                    <a href="/" class="hover:text-black transition dark:text-white">Home</a>
                    <span class="mx-2 dark:text-white">›</span>
                    <span class="text-gray-900 dark:text-gray-400">Shop</span>
                </nav>
            </div>
        </section>

        <template #fullwidth2>
            <div class="mx-auto w-11/12 mb-10 sm:w-10/12">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <p class="text-gray-400">
                        {{ selectedCategory === 'all'
                            ? `Showing all ${products.length} results`
                            : `Showing ${filteredProducts.length} of ${products.length} results`
                        }}
                    </p>
                    <select v-model="sortOrder"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 bg-white min-w-[200px]">
                        <option value="default">Default sorting</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="name">Name: A to Z</option>
                    </select>
                </div>

                <div class="flex flex-wrap gap-3 mb-8">
                    <button v-for="category in categories" :key="category.id" @click="selectedCategory = category.id"
                        :class="[
                            'relative group flex items-center gap-3 px-5 py-2.5 rounded-2xl transition-all duration-300 overflow-hidden focus:outline-none focus:ring-0',
                            selectedCategory === category.id
                                ? 'bg-yellow-400 text-black shadow-md'
                                : 'bg-white dark:bg-zinc-900 text-black dark:text-white border border-gray-200 dark:border-zinc-700 hover:border-gray-300 dark:hover:border-zinc-900 hover:shadow-sm'
                        ]">
                        <div v-if="selectedCategory === category.id" class="absolute inset-0 bg-yellow-400 z-0">
                        </div>

                        <div
                            class="absolute inset-0 h-full w-0 bg-yellow-400 dark:bg-yellow-400 transition-all duration-500 ease-out group-hover:w-full z-10">
                        </div>

                        <img :src="category.image" :alt="category.name"
                            class="w-10 h-10 rounded-xl object-cover relative z-20" />
                        <span :class="[
                            'font-medium relative z-20 transition-colors duration-500',
                            selectedCategory === category.id
                                ? 'text-black'
                                : 'group-hover:text-black dark:group-hover:text-black'
                        ]">
                            {{ category.name }}
                        </span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="product in filteredProducts" :key="product.id" class="flex flex-col gap-4">
                        <div
                            class="relative overflow-hidden bg-gray-100 aspect-square rounded-3xl shadow-sm hover:shadow-lg transition-shadow duration-300">
                            <img :src="product.image" :alt="product.name"
                                class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110" />
                        </div>

                        <div class="bg-white rounded-3xl p-6 shadow-sm dark:bg-zinc-900">
                            <div class="mb-4">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2 dark:text-white">{{ product.name }}
                                </h3>

                                <div class="flex flex-wrap gap-1">
                                    <span v-for="(tag, index) in product.tags" :key="tag" class="text-sm text-gray-400">
                                        {{ tag }}<span v-if="index < product.tags.length - 1">, </span>
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between gap-4 flex-nowrap">
                                <span class="text-xl font-bold text-gray-900 dark:text-white min-w-0 truncate">
                                    Rp. {{ product.price.toFixed(3) }}
                                </span>

                                <button @click="selectOptions(product)" :class="[
                                    'group relative inline-flex items-center gap-2 justify-center overflow-hidden rounded-full font-semibold transition-all duration-500 focus:outline-none shrink-0 px-4 py-2 sm:px-6 sm:py-3',
                                    product.buttonStyle === 'dark' ? 'bg-gray-900 text-white' : 'bg-yellow-400 text-black'
                                ]">
                                    <div
                                        class="absolute inset-0 h-full w-0 bg-black transition-all duration-500 ease-out group-hover:w-full dark:bg-white z-10">
                                    </div>

                                    <span :class="[
                                        'relative z-20 flex items-center gap-2 transition-colors duration-500',
                                        product.buttonStyle === 'dark' ? 'group-hover:text-black' : 'group-hover:text-white'
                                    ]">
                                        View
                                        <span class="ml-3 flex items-center gap-1">
                                            <span :class="[
                                                'h-2 w-2 rounded-full transition-colors duration-500',
                                                product.buttonStyle === 'dark' ? 'bg-white group-hover:bg-gray-900' : 'bg-black group-hover:bg-yellow-400'
                                            ]"></span>
                                            <span :class="[
                                                'h-2 w-2 rounded-full transition-colors duration-500',
                                                product.buttonStyle === 'dark' ? 'bg-white group-hover:bg-gray-900' : 'bg-black group-hover:bg-yellow-400'
                                            ]"></span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DefaultLayout>
</template>
