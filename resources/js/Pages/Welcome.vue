<script setup>
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import InteractiveCards from '@/Components/InteractiveCards.vue';
import Industries from '@/Components/Industries.vue';

const props = defineProps({
    data_fe: Object,
})

const cards = [
    {
        id: 1,
        no: '01',
        text: 'Photography',
        subText: 'We offer professional photography services for products, events, and corporate needs. Our photographers capture high-quality images that tell your story and highlight the unique aspects of your brand.',
        bg: '/images/services/bg-card-1.png'
    },
    {
        id: 2,
        no: '02',
        text: 'Photography',
        subText: 'We offer professional photography services for products, events, and corporate needs. Our photographers capture high-quality images that tell your story and highlight the unique aspects of your brand.',
        bg: '/images/services/bg-card-2.png'
    },
    {
        id: 3,
        no: '03',
        text: 'Photography',
        subText: 'We offer professional photography services for products, events, and corporate needs. Our photographers capture high-quality images that tell your story and highlight the unique aspects of your brand.',
        bg: '/images/services/bg-card-3.png'
    },
    {
        id: 4,
        no: '04',
        text: 'Photography',
        subText: 'We offer professional photography services for products, events, and corporate needs. Our photographers capture high-quality images that tell your story and highlight the unique aspects of your brand.',
        bg: '/images/services/bg-card-4.png'
    },
];

const clientsImage = props.data_fe.clients_image.map(item => item.path) ;

const images = props.data_fe.hero_image.map(item => item.path) ;

const industries = props.data_fe.industry_image.map(item => item.path) ;

const industries_text = [
    props.data_fe.data_fe[0].industry_title,
    props.data_fe.data_fe[0].industry_heading,
    props.data_fe.data_fe[0].industry_description
]

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

const last3blog = [
    {
        date: "April 03, 2025",
        title: "Optimizing the Use of TopAds: Strategies for Maximizing Ad Credits.",
        image: "https://placehold.co/400x200",
    },
    {
        date: "May 20, 2025",
        title: "How Content Marketing Plays a Role in Business Success",
        image: "https://placehold.co/400x200",
    },
    {
        date: "June 11, 2025",
        title: "Understanding Email Marketing to achieve digital marketing success",
        image: "https://placehold.co/400x200",
    },
]
</script>

<template>
    <DefaultLayout>
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <section class="flex flex-col pt-16 sm:pt-24 sm:pb-16 justify-center items-center animate-fade-up">
            <div class="px-4 flex justify-center">
                <h1 class="text-4xl sm:text-7xl text-center font-bold text-[#A8A9A9] dark:text-[#A8A9A9]"><span
                        class="text-5xl sm:text-[5rem] text-[#99CA3D]">{{ data_fe.data_fe[0].hero_title }}</span> {{ data_fe.data_fe[0].hero_title2 }}
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

        <section class="flex flex-col justify-center items-center pb-10 sm:py-10 animate-fade-up px-4">
            <div class="w-full flex justify-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-center text-gray-800 dark:text-gray-300">
                    {{ data_fe.data_fe[0].hero_description }}
                </h2>
            </div>
            <div class="flex flex-row gap-4 sm:gap-8">
                <Link href="#"
                    class="bg-black hover:bg-amber-200 text-white hover:text-black text-lg sm:text-xl rounded-xl px-4 py-2 transition-all duration-500 dark:bg-yellow-400 dark:text-black dark:hover:bg-white text-center">
                Contact Us
                </Link>
                <Link href="#"
                    class="bg-gray-200 hover:bg-amber-200 text-black text-lg sm:text-xl rounded-xl px-4 py-2 transition-all duration-500 dark:bg-gray-300 dark:hover:bg-yellow-400 text-center">
                Discover Our Work
                </Link>
            </div>
        </section>

        <section class="py-5 sm:py-10 mx-4">
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-2 sm:gap-6">
                <div class="col-span-3 animate-fade-up transition-all duration-500">
                    <h3 class="text-md sm:text-2xl">/ {{ data_fe.data_fe[0].about_title }}</h3>
                </div>

                <div class="col-span-2 animate-fade-up transition-all duration-500">
                    <h3 class="text-lg sm:text-xl dark:text-white">
                        {{ data_fe.data_fe[0].about_description }}
                    </h3>
                </div>
            </div>
        </section>

        <section class="flex flex-col py-5 sm:py-10 mx-4 animate-fade-up transition-all duration-500">
            <div class="mb-10">
                <img src="https://placehold.co/1080x500" class="w-full rounded-3xl">
            </div>
            <div class="grid grid-cols-5 gap-6 pt-10">
                <div v-for="clients in clientsImage" class="flex items-center justify-center">
                    <img :src="clients" alt="">
                </div>
            </div>
        </section>

        <template #fullwidth2>
            <section>
                <div class="flex flex-col max-w-7xl mx-auto py-5 sm:py-10 animate-fade-up transition-all duration-500">
                    <div class="flex flex-col gap-2 mx-4 sm:mx-0 dark:text-white">
                        <h3 class="text-md sm:text-2xl">/ {{ data_fe.data_fe[0].expertise_title }}</h3>
                        <h1 class="text-4xl sm:text-7xl font-bold">{{ data_fe.data_fe[0].expertise_heading }}</h1>
                        <h2 class="text-lg sm:text-xl sm:w-1/2">{{ data_fe.data_fe[0].expertise_description }}</h2>
                    </div>
                </div>

                <div class="relative mb-10 animate-fade-up" :style="{ height: `${cards.length * 65}vh` }">
                    <div v-for="(card, index) in cards" :key="card.id"
                        class="sticky top-20 h-[65vh] flex items-start justify-center pt-10 transition-all duration-700"
                        :style="{ zIndex: index + 1 }">
                        <div class="relative h-[60vh] mx-2 sm:mx-6 px-6 rounded-3xl shadow dark:border-2 dark:border-gray-600 flex flex-col gap-6 justify-center  w-full overflow-hidden"
                            :style="{
                                backgroundImage: `linear-gradient(to right, rgba(0, 0, 0, 1) 30%, rgba(0, 0, 0, 0.1)), url(${card.bg})`,

                                backgroundSize: 'cover',
                                backgroundPosition: '10% center',
                                backgroundRepeat: 'no-repeat'
                            }">
                            <div class="flex items-center">
                                <div class="w-3 sm:w-5 h-3 sm:h-10 border-l-2 border-white dark:border-white/60">

                                </div>
                                <h3 class="text-white text-2xl sm:text-7xl font-bold">{{ card.no }}</h3>
                            </div>

                            <div class="flex flex-col gap-2 sm:w-1/2">
                                <h3 class="text-white text-5xl sm:text-7xl font-bold">
                                    {{ card.text }}
                                </h3>
                                <p class="text-white text-lg sm:text-2xl">
                                    {{ card.subText }}
                                </p>

                                <button
                                    class="group w-1/3 relative inline-flex items-center justify-center overflow-hidden rounded-full bg-yellow-400 px-8 py-3 font-medium text-black transition-all duration-500 hover:text-white dark:text-black">
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
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-brand-purple py-10 px-4 sm:px-0">
                <Industries :industries="industries" :text="industries_text"/>
            </section>

        </template>

        <template #afterFullwidth2>
            <section class="py-10 px-4 sm:px-0">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 ">
                    <h3 class="text-md sm:text-2xl text-black dark:text-white">/ {{ data_fe.data_fe[0].blog_title }}</h3>
                    <div class="sm:col-span-2 flex flex-col gap-4 sm:items-end sm:text-end text-black dark:text-white">
                        <h3 class="text-4xl sm:text-6xl font-bold">{{ data_fe.data_fe[0].blog_heading }}</h3>
                        <h4 class="sm:w-3/4 text-lg sm:text-xl">{{ data_fe.data_fe[0].blog_description }}</h4>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-10">
                    <div class="flex flex-col" v-for="blog in last3blog">
                        <div
                            class="flex flex-col bg-gray-200 dark:bg-zinc-900 p-6 rounded-t-3xl transition-all duration-500">
                            <span class="text-sm text-gray-500 dark:text-gray-200">{{ blog.date }}</span>
                            <h3 class="text-md sm:text-xl dark:text-white">{{ blog.title }}</h3>
                        </div>
                        <img :src="blog.image" alt="" class="w-full rounded-b-3xl">
                    </div>
                </div>
            </section>
        </template>
    </DefaultLayout>
</template>
