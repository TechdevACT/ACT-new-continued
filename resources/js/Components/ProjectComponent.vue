<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    projects: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
});

const activeFilter = ref('All');

const setFilter = (category) => {
    activeFilter.value = category;
    visibleProjectsCount.value = 3;
};

const filteredProjects = computed(() => {
    if (activeFilter.value === 'All') {
        return props.projects;
    }
    return props.projects.filter(project => project.type === activeFilter.value);
});

const visibleProjectsCount = ref(3);

const displayedProjects = computed(() => {
    return filteredProjects.value.slice(0, visibleProjectsCount.value);
});

const loadMore = () => {
    visibleProjectsCount.value = filteredProjects.value.length;
};

</script>

<template>
    <div class="flex flex-col justify-center items-center mb-16 animate-fade-up transition-all duration-500 px-4">
        <div
            class="flex flex-wrap justify-center gap-2 sm:gap-4 bg-gray-200 dark:bg-gray-300 rounded-xl font-bold transition-colors duration-500 p-1.5 sm:p-2">
            <div v-for="category in props.categories" :key="category" @click="setFilter(category)" :class="[
                'px-4 py-2 sm:px-6 sm:py-3 rounded-xl transition-all ease-in-out duration-500 cursor-pointer',
                {
                    'bg-black text-white dark:bg-white dark:text-black': activeFilter === category,
                    'hover:bg-gray-300 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:bg-gray-500 dark:hover:text-white': activeFilter !== category
                }
            ]">
                {{ category }}
            </div>
        </div>
    </div>

    <div class="flex flex-col justify-center items-center mb-10 animate-fade-up transition-all duration-500">

        <TransitionGroup tag="div" name="project"
            class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 px-4 mb-10">
            <div v-for="project in displayedProjects" :key="project.title"
                class="flex flex-col justify-center items-center">
                <Link :href="`/projects/` + project.slug">
                <div class="w-full h-auto aspect-square overflow-hidden rounded-3xl relative group shadow-xl">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        :src="`/storage/` + project.image" :alt="project.title" />
                </div>
                <div class="w-full flex justify-between items-center py-4 transition-colors duration-500">
                    <h3 class="text-2xl uppercase font-bold text-black dark:text-white">
                        {{ project.title.length > 20 ? project.title.substring(0, 15) + ' ...' : project.title }}
                    </h3>
                    <h4 class="text-lg text-gray-500 dark:text-gray-400">{{ project.type }}</h4>
                </div>
                </Link>
            </div>
        </TransitionGroup>


        <button v-if="filteredProjects.length > 0 && visibleProjectsCount < filteredProjects.length" @click="loadMore"
            class="group relative inline-flex items-center justify-center overflow-hidden rounded-full bg-yellow-400 px-8 py-3 font-medium text-black transition-all duration-500 hover:text-white dark:text-black">
            <div
                class="absolute inset-0 h-full w-0 bg-black transition-all duration-500 ease-out group-hover:w-full dark:bg-white">
            </div>
            <span class="relative flex items-center">
                Load More
                <span class="ml-3 flex items-center gap-1">
                    <span
                        class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400 dark:bg-black group-hover:dark:bg-black"></span>
                    <span
                        class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400 dark:bg-black group-hover:dark:bg-black"></span>
                </span>
            </span>
        </button>
    </div>
</template>
