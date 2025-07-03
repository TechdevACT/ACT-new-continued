<script setup>
import InteractiveCards from '@/Components/InteractiveCards.vue';
import NavbarHeader from '@/Components/NavbarHeader.vue';
import ProjectComponent from '@/Components/ProjectComponent.vue';
import Footer from '@/Components/Footer.vue';
import { Head, Link } from '@inertiajs/vue3';

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
        type: "Style",
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

    <Head title="Welcome - " />
    <NavbarHeader />

    <main class="mx-auto max-w-7xl">
        <section class="flex flex-col pb-0 sm:py-16 justify-center items-center animate-fade-up">
            <div class="sm:w-1/2 flex justify-center">
                <h1 class="text-4xl sm:text-7xl text-center font-bold">A place to display your masterpiece</h1>
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

        <section class="flex flex-col justify-center items-center pb-16 sm:pb-0 sm:py-16 animate-fade-up">
            <div class="w-11/12 lg:w-1/2 flex justify-center mb-4">
                <h2 class="text-lg lg:text-2xl text-center">Artists can display their masterpieces, and buyers can
                    discover and
                    purchase works that resonate with them.
                </h2>
            </div>
            <div class="flex gap-8">
                <Link href="#"
                    class="bg-black hover:bg-amber-200 text-white hover:text-black text-xl rounded-xl px-4 py-2 transition-all duration-300">
                Contact Me
                </Link>
                <Link href="#"
                    class="bg-gray-200 hover:bg-amber-200 text-black text-xl rounded-xl px-4 py-2 transition-all duration-300">
                Discover Our Work
                </Link>
            </div>
        </section>

        <section>
            <ProjectComponent :projects="projects" :categories="projectCategories" />
        </section>


    </main>

    <Footer />
</template>
