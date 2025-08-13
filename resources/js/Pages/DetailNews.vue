<script setup>
import SecondLayout from '@/Layouts/SecondLayout.vue';
import { faFacebookF, faInstagram, faXTwitter } from '@fortawesome/free-brands-svg-icons';
import { faLink } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
    data: Object
});

</script>

<template>
    <SecondLayout>
        <section>
            <div class="animate-fade-up py-10 px-4">
                <img src="https://placehold.co/1080x500" alt="" class="w-full rounded-3xl">
            </div>

            <div class="flex flex-col gap-4 max-w-3xl mx-auto animate-fade-up pb-10 px-4 dark:text-white">
                <h1 class="text-3xl sm:text-4xl font-bold">{{ props.data.blog.title }}</h1>
                <div class="flex gap-2 text-sm ">
                    <span>Author: </span>
                    <span class="font-bold">{{ props.data.blog.user_id }}</span>
                    |
                    <span>Date: </span>
                    <span class="font-bold"><span class="text-gray-500">{{ new
                        Date(props.data.blog.created_at).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric'
                        }) }}</span></span>
                </div>

                <div v-html="props.data.blog.content"></div>

                <div class="flex justify-center mt-10">
                    <div class="flex gap-4 justify-between sm:w-1/3 bg-black rounded-2xl py-2 px-4 text-3xl text-white dark:bg-white dark:text-black">
                        <FontAwesomeIcon :icon="faXTwitter" />
                        <FontAwesomeIcon :icon="faFacebookF" />
                        <FontAwesomeIcon :icon="faInstagram" />
                        <FontAwesomeIcon :icon="faLink" />
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-0 max-w-5xl mx-auto animate-fade-up pb-10 px-4 dark:text-white">
                <div class="flex flex-col sm:border-r border-black pr-4 dark:border-white">
                    <span class="text-gray-500">Previous News</span>
                    <h4 class="w-2/3 text-xl font-bold">A Step-by-Step Guide to Mastering Technical Design</h4>
                </div>
                <div class="flex flex-col items-end sm:border-l border-black pr-4 dark:text-white">
                    <span class="text-gray-500">Next News</span>
                    <h4 class="w-2/3 text-right text-xl font-bold">A Step-by-Step Guide to Mastering Technical Design
                    </h4>
                </div>
            </div>
        </section>

        <template #fullwidth2>
            <section class="bg-gray-200 dark:bg-zinc-900 mx-4 rounded-3xl mb-10">
                <div class="flex flex-col px-4 py-6 mx-auto max-w-3xl flex-grow transition-colors duration-500 w-full dark:text-white">
                    <h2 class="text-2xl font-bold">Read other news</h2>
                    <div class="flex gap-4 mt-6 items-center border-b border-gray-400 pb-6">
                        <img src="https://placehold.co/200x200" alt="" class="h-32 rounded-2xl">
                        <div class="flex flex-col gap-2">
                            <h4 class="text-lg font-bold">A Step-by-Step Guide to Mastering Technical Design</h4>
                            <span class="text-gray-500">12 Aug, 2025</span>
                            <p class="text-md text-gray-600">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, quibusdam?
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-6 items-center border-b border-gray-400 pb-6">
                        <img src="https://placehold.co/200x200" alt="" class="h-32 rounded-2xl">
                        <div class="flex flex-col gap-2">
                            <h4 class="text-lg font-bold">A Step-by-Step Guide to Mastering Technical Design</h4>
                            <span class="text-gray-500">12 Aug, 2025</span>
                            <p class="text-md text-gray-600">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, quibusdam?
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-6 items-center border-b border-gray-400 pb-6">
                        <img src="https://placehold.co/200x200" alt="" class="h-32 rounded-2xl">
                        <div class="flex flex-col gap-2">
                            <h4 class="text-lg font-bold">A Step-by-Step Guide to Mastering Technical Design</h4>
                            <span class="text-gray-500">12 Aug, 2025</span>
                            <p class="text-md text-gray-600">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, quibusdam?
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </SecondLayout>
</template>
