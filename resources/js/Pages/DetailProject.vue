<script setup>
import Lightbox from '@/Components/Lightbox.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { onMounted, onUnmounted } from 'vue';

const data = defineProps({
    data: Object
})

const image_gallery = data.data.project.project_galleries.map(item => item.image);

onMounted(() => {
    const parallax = document.getElementById("parallax");

    const handleScroll = () => {
        let offset = window.scrollY * 0.1 - (window.innerHeight / 2);
        parallax.style.backgroundPositionY = offset + "px";
    };

    window.addEventListener("scroll", handleScroll);

    onUnmounted(() => {
        window.removeEventListener("scroll", handleScroll);
    });
});

</script>

<template>
    <DefaultLayout :title="data.data.project.title + `-`">
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>


        <section class="flex flex-col gap-4 py-16">
            <h1
                class="text-4xl sm:text-6xl font-bold uppercase dark:text-white pb-7 border-b-2 animate-fade-right transition-all duration-500">
                {{ data.data.project.title }}
            </h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-7 animate-fade-left transition-all duration-500">
                <div>
                    <span class="text-lg sm:text-xl text-gray-500 dark:text-gray-200">( Description )</span>
                </div>
                <div>
                    <p class="text-lg sm:text-xl text-justify font-medium dark:text-white">{{
                        data.data.project.description }}
                    </p>
                </div>
            </div>
        </section>

        <template #fullwidth2>
            <section id="parallax" class="relative h-[20rem] sm:h-[50rem] bg-center bg-cover bg-no-repeat"
                :style="`background-image: url('/storage/` + data.data.project.background + `'); background-position: center`">
            </section>
        </template>

        <template #afterFullwidth2>
            <section class="py-16">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <h1 class="text-4xl sm:text-6xl mb-6 sm:mb-0 font-bold uppercase dark:text-white">
                        Challenges & Objectives
                    </h1>

                    <div class="flex flex-col gap-8 dark:text-white">
                        <div class="flex flex-col gap-4">
                            <h2 class="text-2xl font-semibold">/ Project Overview</h2>
                            <p class="text-xl text-medium">{{ data.data.project.project_overview }}</p>
                        </div>
                        <div class="flex flex-col gap-4">
                            <h2 class="text-2xl font-semibold">/ Challanges</h2>
                            <p class="text-xl text-medium">{{ data.data.project.project_challenges }}</p>
                        </div>
                        <div class="flex flex-col gap-4">
                            <h2 class="text-2xl font-semibold">/ Objectives</h2>
                            <p class="text-xl text-medium">{{ data.data.project.project_objectives }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-16">

                <Lightbox :images="image_gallery"/>

            </section>

            <section class="flex justify-center items-center py-16 dark:text-white">
                <div class="flex flex-col sm:w-1/2 justify-center items-center gap-4">
                    <h2 class="text-2xl font-semibold">/ Final Outcome</h2>
                    <p class="text-xl text-medium text-center">{{ data.data.project.project_final_outcome }}</p>
                </div>
            </section>

        </template>
    </DefaultLayout>
</template>
