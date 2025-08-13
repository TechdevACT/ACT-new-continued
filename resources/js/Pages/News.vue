<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Link } from '@inertiajs/vue3';

const post = [
    {
        title: "The Power of a Great Portfolio",
        date: "April 03, 2025",
        image: "https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Modern-Collaborative-Workspace.webp",
        shortDescription: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, quaerat.",
    },
    {
        title: "The Power of a Great Portfolio",
        date: "April 03, 2025",
        image: "https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Modern-Collaborative-Workspace.webp",
        shortDescription: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, quaerat.",
    }
]

</script>

<template>
    <DefaultLayout :title="'News -'">
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <template #fullwidth>
            <section class="animate-fade-up bg-gray-200">
                <div class="hidden sm:flex flex-col h-96 justify-center items-center">
                    <div class="w-2/3">
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

                <div class="sm:hidden flex flex-col h-96 justify-center items-center text-center gap-4 px-4">
                    <h2 class="text-5xl font-bold uppercase">We share brilliant stories</h2>
                    <p class="text-lg">Building a standout portfolio is challenging let’s make it easier...</p>
                </div>
            </section>
        </template>

        <section class="max-w-7xl px-4 mb-10 pt-10">
            <div class="grid sm:grid-cols-3 gap-10">
                <div class="col-span-2">
                    <div class="grid sm:grid-cols-2 gap-10 animate-fade-up">
                        <div v-for="p in post" class="flex flex-col shadow-xl group">
                            <Link :href="`/news/detail`">
                                <div class="flex flex-col bg-gray-200 rounded-t-2xl p-4">
                                    <span class="text-gray-500">{{ p.date }}</span>
                                    <h3 class="text-xl font-bold">{{ p.title }}</h3>
                                    <p class="text-md">{{ p.shortDescription }}</p>
                                </div>
                                <div class="rounded-b-2xl overflow-hidden">
                                    <img :src="p.image" alt=""
                                        class="h-56 w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-4 col-span-2 sm:col-span-1 animate-fade-left">
                    <img src="https://placehold.co/400x200" alt="" class="rounded-2xl">
                    <span class="text-lg mb-10">It’s all about creative design, website,
                        and everything in digital.</span>
                    <h3 class="text-xl sm:text-2xl font-bold">Recent Posts</h3>
                    <div class="flex flex-col">
                        <div v-for="p in post" class="flex flex-col">
                            <h3 class="text-lg font-bold">{{ p.title }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
