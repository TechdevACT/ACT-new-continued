<script setup>
import InteractiveCards from '@/Components/InteractiveCards.vue';
import NavbarHeader from '@/Components/NavbarHeader.vue';
import ProjectComponent from '@/Components/ProjectComponent.vue';
import { Head } from '@inertiajs/vue3';

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

</script>

<template>

    <Head title="Welcome - " />
    <NavbarHeader />

    <div class="flex flex-col py-16 justify-center items-center animate-fade-up">
        <div class="w-1/2 flex justify-center">
            <h1 class="text-7xl text-center font-bold">A place to display your masterpiece</h1>
        </div>

        <div class="hidden lg:flex lg:mt-20">
            <InteractiveCards custom-class="custom-bounceCards" :card-size="300" :hover-offset="200" :images="images"
                :container-width="500" :container-height="250" :animation-delay="1" :animation-stagger="0.08"
                ease-type="elastic.out(1, 0.5)" :transform-styles="transformStyles" :enable-hover="true" />
        </div>
        <div class="flex lg:hidden">
            <InteractiveCards custom-class="custom-bounceCards" :card-size="100" :hover-offset="50" :images="images"
                :container-width="500" :container-height="250" :animation-delay="1" :animation-stagger="0.08"
                ease-type="elastic.out(1, 0.5)" :transform-styles="transformStyles" :enable-hover="true" />
        </div>

    </div>

    <div class="flex flex-col justify-center items-center py-16 animate-fade-up">
        <div class="w-1/2 flex justify-center mb-4">
            <h2 class="text-2xl text-center">Artists can display their masterpieces, and buyers can discover and
                purchase works that resonate with them.
            </h2>
        </div>
        <div class="flex gap-8">
            <button
                class="bg-black hover:bg-amber-200 text-white hover:text-black text-xl rounded-xl px-4 py-2 transition-all duration-300">
                Contact Me
            </button>
            <button
                class="bg-gray-200 hover:bg-amber-200 text-black text-xl rounded-xl px-4 py-2 transition-all duration-300">
                Discover Our Work
            </button>
        </div>
    </div>

    <ProjectComponent />
</template>
