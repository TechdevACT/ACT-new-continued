<script setup>
import ProjectComponent from '@/Components/ProjectComponent.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { faArrowDownLong } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { ref } from 'vue';

const data = defineProps({
    data: Array
})

const categoryTest = ref([
    'All',
    ...data.data.allCategory.map(item => item.name)
]);

</script>

<template>
    <DefaultLayout title="Our Projects -">
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <template #fullwidth>
            <section class="sm:py-16 mt-10 sm:mt-0 animate-fade transition-all duration-500">
                <div class="relative flex overflow-hidden group pb-10 text-black dark:text-white">
                    <div class="flex whitespace-nowrap group-hover:paused animate-scroll" aria-hidden="true">
                        <h3 class="text-6xl sm:text-9xl font-bold ml-4 uppercase">Discover our work
                            <FontAwesomeIcon :icon="faArrowDownLong" class="text-yellow-500" />
                        </h3>

                        <h3 class="text-6xl sm:text-9xl font-bold ml-4 uppercase">Discover our work
                            <FontAwesomeIcon :icon="faArrowDownLong" class="text-yellow-500" />
                        </h3>

                        <h3 class="text-6xl sm:text-9xl font-bold ml-4 uppercase">Discover our work
                            <FontAwesomeIcon :icon="faArrowDownLong" class="text-yellow-500" />
                        </h3>

                        <h3 class="text-6xl sm:text-9xl font-bold ml-4 uppercase">Discover our work
                            <FontAwesomeIcon :icon="faArrowDownLong" class="text-yellow-500" />
                        </h3>

                        <h3 class="text-6xl sm:text-9xl font-bold ml-4 uppercase">Discover our work
                            <FontAwesomeIcon :icon="faStarOfLife" class="text-yellow-500" />
                        </h3>
                    </div>
                </div>

            </section>
        </template>

        <section class="flex flex-col gap-4 py-16 animate-fade-right transition-all duration-500">
            <h1 class="text-4xl sm:text-6xl font-bold uppercase dark:text-white">Featured Work</h1>
            <p class="sm:w-3/5 text-xl sm:text-2xl dark:text-white">Beautiful designs. Eye-catching interactions. Memorable experiences.
                Development that delivers. Let the work do the talking.</p>
        </section>

        <ProjectComponent :projects="data.data.allProjects" :categories="categoryTest" />
    </DefaultLayout>
</template>
