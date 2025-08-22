<script setup>
import ProjectComponent from '@/Components/ProjectComponent.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { faArrowDownLong } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const categories = ['All', 'Web', 'Mobile', 'Design']

const projects = [
  {
    title: 'Landing Page Startup',
    image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/Colorful-Assortment-of-Macarons-and-Packaging.webp',
    type: 'Web'
  },
  {
    title: 'E-commerce App',
    image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/nkLC12rAR56ibf4tRP0JYBiA.webp',
    type: 'Mobile'
  },
  {
    title: 'Company Profile Website adsf sdf asdfa s adsf asdfa df adf ads a',
    image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/SPOA-Vintage-Camera-with-Dual-Viewfinders.webp',
    type: 'Web'
  },
  {
    title: 'UI Kit Dashboard',
    image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/Colorful-Assortment-of-Macarons-and-Packaging.webp',
    type: 'Design'
  },
  {
    title: 'Mobile Banking App',
    image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/nkLC12rAR56ibf4tRP0JYBiA.webp',
    type: 'Mobile'
  }
]

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

        <ProjectComponent :projects="projects" :categories="categories" />
    </DefaultLayout>
</template>
