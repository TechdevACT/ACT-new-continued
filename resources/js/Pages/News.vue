<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    data: Object
});

</script>

<template>
    <DefaultLayout :title="'News -'">
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <template #fullwidth>
            <section class="animate-fade-up bg-gray-200 dark:bg-zinc-900 transition-all duration-300">
                <div class="hidden sm:flex flex-col h-96 justify-center items-center">
                    <div class="w-2/3 dark:text-white">
                        <h2 class="text-7xl font-bold uppercase">
                            We share BRILLIANT
                        </h2>
                        <div class="flex gap-4 mt-4">
                            <h2 class="text-7xl font-bold uppercase">STORIES.</h2>
                            <div class="flex">
                                <p class="text-3xl">Building a standout portfolio is challenging let’s make it easier...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="sm:hidden flex flex-col h-96 justify-center items-center text-center gap-4 px-4 dark:text-white">
                    <h2 class="text-5xl font-bold uppercase">We share brilliant stories</h2>
                    <p class="text-lg">Building a standout portfolio is challenging let’s make it easier...</p>
                </div>
            </section>
        </template>

        <section class="max-w-7xl px-4 mb-10 pt-10">
            <div class="grid sm:grid-cols-3 gap-10">

                <div v-if="props.data.news_all.data.length > 0" class="col-span-2">

                    <div class="grid sm:grid-cols-2 gap-10 animate-fade-right">
                        <div v-for="p in props.data.news_all.data" :key="p.slug"
                            class="flex flex-col shadow-xl group rounded-2xl overflow-hidden bg-gray-200">
                            <Link :href="`/blog/` + p.slug">
                            <div class="overflow-hidden aspect-video">
                                <img :src="p.news_images[0]?.image || 'https://placehold.co/1600x900'" alt=""
                                    class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110" />
                            </div>

                            <div class="bg-gray-200 dark:bg-zinc-900 dark:text-white p-4">
                                <span class="text-gray-500">
                                    {{ new Date(p.created_at).toLocaleDateString('id-ID', {
                                        day: '2-digit',
                                        month: 'long',
                                        year: 'numeric'
                                    }) }}
                                </span>
                                <h3 class="text-xl font-bold">{{ p.title }}</h3>
                                <p class="text-md dark:text-gray-400">{{ p.excerpt }}</p>
                            </div>
                            </Link>
                        </div>
                    </div>

                    <div class="flex justify-center mt-10">
                        <nav class="flex items-center space-x-2">
                            <template v-for="(link, index) in props.data.news_all.links" :key="index">

                                <!-- Sembunyikan tombol Prev di halaman pertama -->
                                <template
                                    v-if="!(link.label.includes('Previous') && props.data.news_all.current_page === 1)
                                        && !(link.label.includes('Next') && props.data.news_all.current_page === props.data.news_all.last_page)">

                                    <Link v-if="link.url" :href="link.url"
                                        class="px-4 py-2 rounded-xl transition-all duration-300" :class="{
                                            'bg-black dark:bg-white text-white dark:text-black': link.active,
                                            'bg-gray-300 dark:bg-zinc-900 text-gray-600 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-zinc-400': !link.active
                                        }">
                                    <span v-if="link.label.includes('Previous')">Prev</span>
                                    <span v-else-if="link.label.includes('Next')">Next</span>
                                    <span v-else v-html="link.label"></span>
                                    </Link>

                                    <span v-else class="px-4 py-2 rounded-xl text-gray-400">
                                        <span v-if="link.label.includes('Previous')">Prev</span>
                                        <span v-else-if="link.label.includes('Next')">Next</span>
                                        <span v-else v-html="link.label"></span>
                                    </span>
                                </template>

                            </template>
                        </nav>
                    </div>


                </div>

                <div v-else class="col-span-2 text-center text-2xl text-gray-500 dark:text-gray-200">
                    No data available
                </div>

                <div class="flex flex-col gap-4 col-span-2 sm:col-span-1 animate-fade-left dark:text-white">
                    <img src="https://placehold.co/400x200" alt="" class="rounded-2xl">
                    <span class="text-lg mb-10">It’s all about creative design, website,
                        and everything in digital.</span>
                    <h3 class="text-xl sm:text-2xl font-bold">Recent Posts</h3>
                    <div class="flex flex-col">
                        <div v-for="p in props.data.news_all.data" class="flex flex-col">
                            <h3 class="text-lg font-medium mb-4">{{ p.title }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
