<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { ref, computed } from 'vue';

const activeTab = ref('additional');
const quantity = ref(1);
const selectedColor = ref('');
const selectedSize = ref('');

// Mock product data - in real app, fetch from API based on route.params.id
const product = ref({
    id: 2,
    name: 'Core Vibe',
    price: 139.00,
    sku: '106',
    stock: 0,
    image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Orange-Hoodie.jpg',
    description: 'Keep it simple with Core Vibe, a high-quality, everyday hoodie that fits seamlessly into any wardrobe. Designed for versatility, it pairs well with anything and is built to last with premium organic cotton.',
    categories: ['Classic', 'Oversized'],
    colors: ['Orange', 'Black', 'Gray', 'Navy'],
    sizes: ['XS', 'S', 'M', 'L', 'XL'],
    additionalInfo: {
        material: '100% Organic Cotton',
        design: 'Timeless, minimalist',
        color: 'White, Sand, Light Gray',
        size: 'XS, S, M, L, XL',
        fit: 'Regular',
        features: 'Durable construction, eco-friendly fabric'
    }
});

const relatedProducts = ref([
    {
        id: 10,
        name: 'FrostFlex',
        price: 189.00,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Orange-Hoodie.jpg',
        tags: ['Classic', 'Tech']
    },
    {
        id: 11,
        name: 'Shadow Fit',
        price: 235.00,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Beige-Hoodie.jpg',
        tags: ['Oversized', 'Tech']
    },
    {
        id: 1,
        name: 'Bold Layer',
        price: 149.00,
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Young-Man-in-Red-Hoodie-2.jpg',
        tags: ['Oversized', 'Tech']
    }
]);

const incrementQuantity = () => {
    quantity.value++;
};

const decrementQuantity = () => {
    if (quantity.value > 1) {
        quantity.value--;
    }
};

const addToCart = () => {
    if (product.value.stock === 0) {
        alert('Product is out of stock');
        return;
    }
    if (!selectedColor.value || !selectedSize.value) {
        alert('Please select color and size');
        return;
    }
    alert(`Added ${quantity.value} x ${product.value.name} to cart`);
};

const selectOptions = (prod) => {
    alert(`Opening options for ${prod.name}`);
};
</script>

<template>
    <DefaultLayout :title="`${product.name} -`">
        <template #meta>
            <meta name="description" :content="`${product.name} - ${product.description}`" />
        </template>

        <!-- Breadcrumb -->
        <section class="animate-fade-up">
            <div class="flex flex-col gap-2 py-8 mx-4 sm:mx-0 dark:text-white">
                <nav class="flex text-sm text-gray-600">
                    <a href="/" class="hover:text-black transition dark:text-white">Home</a>
                    <span class="mx-2 dark:text-white">›</span>
                    <a href="/shop" class="hover:text-black transition dark:text-white">Shop</a>
                    <span class="mx-2 dark:text-white">›</span>
                    <a href="#" class="hover:text-black transition dark:text-white">{{ product.categories[0] }}</a>
                    <span class="mx-2 dark:text-white">›</span>
                    <span class="text-gray-900 dark:text-gray-400">{{ product.name }}</span>
                </nav>
            </div>
        </section>

        <template #fullwidth2>
            <div class="mx-auto w-11/12 mb-10 sm:w-10/12">
                <!-- Product Detail Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 mb-16">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden bg-teal-500 rounded-3xl shadow-lg" style="height: 600px;">
                        <img :src="product.image" :alt="product.name"
                            class="w-full h-full object-cover object-top" />
                    </div>

                    <!-- Product Info -->
                    <div class="flex flex-col gap-6 py-4">
                        <div>
                            <h1 class="text-4xl sm:text-5xl font-bold mb-4 bg-blue-600 text-black inline-block py-3 rounded-lg">
                                {{ product.name }}
                            </h1>
                            <p class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white my-6">
                                ${{ product.price.toFixed(2) }}
                            </p>

                            <div v-if="product.stock === 0" class="flex items-center gap-2 text-red-500 mb-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="font-medium">Out of stock</span>
                            </div>

                            <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                                {{ product.description }}
                            </p>

                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <span class="font-semibold">SKU:</span> {{ product.sku }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                                <span class="font-semibold">Categories:</span>
                                <a v-for="(cat, index) in product.categories" :key="cat"
                                   href="#" class="hover:text-gray-900 dark:hover:text-white transition">
                                    {{ cat }}<span v-if="index < product.categories.length - 1">, </span>
                                </a>
                            </div>
                        </div>

                        <!-- Options Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Quantity -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Quantity :
                                </label>
                                <div class="flex items-center border border-gray-300 dark:border-zinc-700 rounded-lg overflow-hidden bg-white dark:bg-zinc-900">
                                    <button @click="decrementQuantity"
                                            class="px-4 py-3 hover:bg-gray-100 dark:hover:bg-zinc-800 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <input type="number" v-model="quantity"
                                           class="w-full text-center border-0 focus:ring-0 bg-transparent dark:text-white"
                                           min="1" />
                                    <button @click="incrementQuantity"
                                            class="px-4 py-3 hover:bg-gray-100 dark:hover:bg-zinc-800 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Color -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Color :
                                </label>
                                <select v-model="selectedColor"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 bg-white dark:bg-zinc-900 dark:text-white">
                                    <option value="">Color</option>
                                    <option v-for="color in product.colors" :key="color" :value="color">
                                        {{ color }}
                                    </option>
                                </select>
                            </div>

                            <!-- Size -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Size :
                                </label>
                                <select v-model="selectedSize"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 bg-white dark:bg-zinc-900 dark:text-white">
                                    <option value="">Size</option>
                                    <option v-for="size in product.sizes" :key="size" :value="size">
                                        {{ size }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Add to Cart Button -->
                        <button @click="addToCart"
                            class="group relative inline-flex items-center gap-2 justify-center overflow-hidden rounded-full font-semibold transition-all duration-500 focus:outline-none px-8 py-4 text-lg bg-yellow-400 text-black">
                            <div class="absolute inset-0 h-full w-0 bg-black transition-all duration-500 ease-out group-hover:w-full z-10">
                            </div>
                            <span class="relative z-20 flex items-center gap-2 transition-colors duration-500 group-hover:text-yellow-400">
                                Add to cart
                                <span class="ml-3 flex items-center gap-1">
                                    <span class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400"></span>
                                    <span class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400"></span>
                                </span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Tabs Section -->
                <div class="mb-16">
                    <div class="flex gap-8 border-b border-gray-200 dark:border-zinc-800 mb-8">
                        <button @click="activeTab = 'additional'"
                            :class="[
                                'pb-4 font-semibold transition-colors relative',
                                activeTab === 'additional'
                                    ? 'text-gray-900 dark:text-white'
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'
                            ]">
                            Additional information
                            <div v-if="activeTab === 'additional'"
                                 class="absolute bottom-0 left-0 right-0 h-0.5 bg-yellow-400"></div>
                        </button>
                        <button @click="activeTab = 'reviews'"
                            :class="[
                                'pb-4 font-semibold transition-colors relative',
                                activeTab === 'reviews'
                                    ? 'text-gray-900 dark:text-white'
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'
                            ]">
                            Reviews (0)
                            <div v-if="activeTab === 'reviews'"
                                 class="absolute bottom-0 left-0 right-0 h-0.5 bg-yellow-400"></div>
                        </button>
                    </div>

                    <!-- Tab Content -->
                    <div v-if="activeTab === 'additional'" class="animate-fade-up">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Additional information</h2>
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-zinc-800">
                                <div class="font-semibold text-gray-900 dark:text-white">Material</div>
                                <div class="col-span-2 text-gray-600 dark:text-gray-400">{{ product.additionalInfo.material }}</div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-zinc-800">
                                <div class="font-semibold text-gray-900 dark:text-white">Design</div>
                                <div class="col-span-2 text-gray-600 dark:text-gray-400">{{ product.additionalInfo.design }}</div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-zinc-800">
                                <div class="font-semibold text-gray-900 dark:text-white">Color</div>
                                <div class="col-span-2 text-gray-600 dark:text-gray-400">{{ product.additionalInfo.color }}</div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-zinc-800">
                                <div class="font-semibold text-gray-900 dark:text-white">Size</div>
                                <div class="col-span-2 text-gray-600 dark:text-gray-400">{{ product.additionalInfo.size }}</div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-zinc-800">
                                <div class="font-semibold text-gray-900 dark:text-white">Fit</div>
                                <div class="col-span-2 text-gray-600 dark:text-gray-400">{{ product.additionalInfo.fit }}</div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 py-4">
                                <div class="font-semibold text-gray-900 dark:text-white">Features</div>
                                <div class="col-span-2 text-gray-600 dark:text-gray-400">{{ product.additionalInfo.features }}</div>
                            </div>
                        </div>
                    </div>

                    <div v-if="activeTab === 'reviews'" class="animate-fade-up">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Reviews</h2>
                        <p class="text-gray-600 dark:text-gray-400">There are no reviews yet.</p>
                    </div>
                </div>

                <!-- Related Products -->
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Related products</h2>
                        <button class="p-3 rounded-full bg-yellow-400 hover:bg-yellow-500 transition-colors">
                            <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="item in relatedProducts" :key="item.id" class="flex flex-col gap-4">
                            <div class="relative overflow-hidden bg-gray-100 aspect-square rounded-3xl shadow-sm hover:shadow-lg transition-shadow duration-300">
                                <img :src="item.image" :alt="item.name"
                                    class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110" />
                            </div>

                            <div class="bg-white rounded-3xl p-6 shadow-sm dark:bg-zinc-900">
                                <div class="mb-4">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-2 dark:text-white">{{ item.name }}</h3>
                                    <div class="flex flex-wrap gap-1">
                                        <span v-for="(tag, index) in item.tags" :key="tag" class="text-sm text-gray-400">
                                            {{ tag }}<span v-if="index < item.tags.length - 1">, </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between gap-4 flex-nowrap">
                                    <span class="text-xl font-bold text-gray-900 dark:text-white min-w-0 truncate">
                                        ${{ item.price.toFixed(2) }}
                                    </span>

                                    <button @click="selectOptions(item)"
                                        class="group relative inline-flex items-center gap-2 justify-center overflow-hidden rounded-full font-semibold transition-all duration-500 focus:outline-none shrink-0 px-4 py-2 sm:px-6 sm:py-3 bg-yellow-400 text-black">
                                        <div class="absolute inset-0 h-full w-0 bg-black transition-all duration-500 ease-out group-hover:w-full z-10"></div>
                                        <span class="relative z-20 flex items-center gap-2 transition-colors duration-500 group-hover:text-white">
                                            Select options
                                            <span class="ml-3 flex items-center gap-1">
                                                <span class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400"></span>
                                                <span class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400"></span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DefaultLayout>
</template>

<style scoped>
.animate-fade-up {
    animation: fadeUp 0.5s ease-out;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Remove arrows from number input */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}
</style>
