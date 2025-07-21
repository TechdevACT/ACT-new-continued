<script setup>
// ... (script setup tidak berubah)
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import InteractiveCards from '@/Components/InteractiveCards.vue';
import ProjectComponent from '@/Components/ProjectComponent.vue';

const projects = [
    {
        title: "the dark side",
        type: "Creative",
        image: "https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/Colorful-Assortment-of-Macarons-and-Packaging.webp"
    },
    {
        title: "Justice robot",
        type: "Design",
        image: "https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/nkLC12rAR56ibf4tRP0JYBiA.webp"
    },
    {
        title: "color current",
        type: "Photo",
        image: "https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/SPOA-Vintage-Camera-with-Dual-Viewfinders.webp"
    },
    {
        title: "the dark side 2",
        type: "Design",
        image: "https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/Colorful-Assortment-of-Macarons-and-Packaging.webp"
    },
    {
        title: "Justice robot 2",
        type: "Creative",
        image: "https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/nkLC12rAR56ibf4tRP0JYBiA.webp"
    },
    {
        title: "color current 2",
        type: "Photo",
        image: "https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/SPOA-Vintage-Camera-with-Dual-Viewfinders.webp"
    },
];

const projectCategories = ['All', ...new Set(projects.map(project => project.type))];

const images = [
    "https://theme.madsparrow.me/osty/wp-content/uploads/2025/01/Person-with-VR-Headset-m_f.png",
    "https://theme.madsparrow.me/osty/wp-content/uploads/2025/01/Minimalist-Stone-Composition-m_f.png",
    "https://theme.madsparrow.me/osty/wp-content/uploads/2025/01/Whimsical-Character-in-a-Jar-m_f.png",
    "https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Three-Scoops-of-Ice-Cream-on-Spoons.webp",
    "https://theme.madsparrow.me/osty/wp-content/uploads/2025/01/Green-Character-in-Yellow-Hoodie-m_f.png"
];

const transformStyles = [
    "rotate(5deg) translate(-300px)",
    "rotate(0deg) translate(-150px)",
    "rotate(-5deg)",
    "rotate(5deg) translate(150px)",
    "rotate(-5deg) translate(300px)"
];

const mobileTransformStyles = [
    "rotate(5deg) translate(-120px)",
    "rotate(0deg) translate(-60px)",
    "rotate(-5deg)",
    "rotate(5deg) translate(60px)",
    "rotate(-5deg) translate(120px)"
];
</script>

<template>
    <DefaultLayout>
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <section class="flex flex-col pt-16 sm:pt-24 sm:pb-16 justify-center items-center animate-fade-up">
            <div class="px-4 flex justify-center">
                <h1 class="text-4xl sm:text-7xl text-center font-bold text-[#A8A9A9] dark:text-[#A8A9A9]"><span class="text-[5rem] text-[#99CA3D]"><strong>act!</strong></span> digital agency
                </h1>
            </div>

            <div class="hidden lg:flex lg:mt-20">
                <InteractiveCards custom-class="custom-bounceCards" :card-size="300" :hover-offset="200"
                    :images="images" :container-width="500" :container-height="250" :animation-delay="1"
                    :animation-stagger="0.08" ease-type="elastic.out(1, 0.5)" :transform-styles="transformStyles"
                    :enable-hover="true" />
            </div>
            <div class="flex lg:hidden">
                <InteractiveCards custom-class="custom-bounceCards" :card-size="150" :hover-offset="100"
                    :images="images" :container-height="250" :animation-delay="1" :animation-stagger="0.08"
                    ease-type="elastic.out(1, 0.5)" :transform-styles="mobileTransformStyles" :enable-hover="true" />
            </div>
        </section>

        <section class="flex flex-col justify-center items-center pb-16 sm:pb-0 sm:py-16 animate-fade-up px-4">
            <div class="w-full flex justify-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-center text-gray-800 dark:text-gray-300">it’s all about
                    creativity, technology and everything in digital
                </h2>
            </div>
            <div class="flex flex-row gap-4 sm:gap-8">
                <Link href="#"
                    class="bg-black hover:bg-amber-200 text-white hover:text-black text-lg sm:text-xl rounded-xl px-4 py-2 transition-all duration-500 dark:bg-yellow-400 dark:text-black dark:hover:bg-white text-center">
                Contact Me
                </Link>
                <Link href="#"
                    class="bg-gray-200 hover:bg-amber-200 text-black text-lg sm:text-xl rounded-xl px-4 py-2 transition-all duration-500 dark:bg-gray-300 dark:hover:bg-yellow-400 text-center">
                Discover Our Work
                </Link>
            </div>
        </section>

        <section class="sm:py-16 mx-4">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <div class="col-span-3 animate-fade-up transition-all duration-500">
                    <h2 class="text-2xl">/ About</h2>
                </div>

                <div class="col-span-2 animate-fade-up transition-all duration-500">
                    <h3 class="text-xl dark:text-white">
                        We are an Indonesian full-service agency that
                        helps businesses to execute the idea from strategy, implementation, measurement, and
                        optimization.
                    </h3>
                </div>
            </div>
        </section>

        <section class="flex flex-col sm:py-16 mx-4 animate-fade-up transition-all duration-500">
            <div>
                <img src="https://placehold.co/1080x500" class="w-full rounded-3xl">
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            </div>

        </section>

        <section>
            <ProjectComponent :projects="projects" :categories="projectCategories" />
        </section>
    </DefaultLayout>
</template>
