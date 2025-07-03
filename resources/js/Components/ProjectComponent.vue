<script setup>
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
    <div class="flex flex-col justify-center items-center my-10 sm:my-20 animate-fade-up px-4">
        <div class="flex flex-wrap justify-center gap-2 sm:gap-4 bg-gray-200 rounded-xl font-bold">
            <div v-for="category in props.categories" :key="category" @click="setFilter(category)" :class="[
                'px-4 py-2 sm:px-6 sm:py-3 rounded-xl transition-all ease-in-out duration-300 cursor-pointer',
                {
                    'bg-black text-white': activeFilter === category,
                    'hover:bg-gray-300 text-gray-400 hover:text-gray-600': activeFilter !== category
                }
            ]">
                {{ category }}
            </div>
        </div>
    </div>

    <div class="flex flex-col justify-center items-center mb-10">
        <TransitionGroup tag="div" name="project" class="w-full flex flex-wrap gap-10 justify-center px-4 mb-10">
            <div v-for="project in displayedProjects" :key="project.title"
                class="flex flex-col justify-center items-center">
                <div class="w-96 h-96 overflow-hidden rounded-3xl relative group">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        :src="project.image" :alt="project.title" />
                </div>
                <div class="w-full flex justify-between items-center py-4">
                    <h3 class="text-2xl uppercase font-bold">{{ project.title }}</h3>
                    <h4 class="text-lg text-gray-500">{{ project.type }}</h4>
                </div>
            </div>
        </TransitionGroup>

        <button v-if="filteredProjects.length > 0 && visibleProjectsCount < filteredProjects.length" @click="loadMore"
            class="group relative inline-flex items-center justify-center overflow-hidden rounded-full bg-yellow-400 px-8 py-3 font-medium text-black transition-all duration-300 hover:text-white">
            <div class="absolute inset-0 h-full w-0  bg-black transition-all duration-300 ease-out group-hover:w-full ">
            </div>
            <span class="relative flex items-center">
                Load More
                <span class="ml-3 flex items-center gap-1">
                    <span
                        class="h-2 w-2 rounded-full bg-black transition-colors duration-300 group-hover:bg-yellow-400"></span>
                    <span
                        class="h-2 w-2 rounded-full bg-black transition-colors duration-300 group-hover:bg-yellow-400"></span>
                </span>
            </span>
        </button>
    </div>
</template>
