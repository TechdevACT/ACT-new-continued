<script setup>
import SecondLayout from '@/Layouts/SecondLayout.vue';

const cards = [
    {
        id: 1,
        no: '01',
        text: 'Creative Creation',
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
        text: 'Company Profile',
        subText: 'We offer professional photography services for products, events, and corporate needs. Our photographers capture high-quality images that tell your story and highlight the unique aspects of your brand.',
        bg: '/images/services/bg-card-3.png'
    },
    {
        id: 4,
        no: '04',
        text: 'Packaging',
        subText: 'We offer professional photography services for products, events, and corporate needs. Our photographers capture high-quality images that tell your story and highlight the unique aspects of your brand.',
        bg: '/images/services/bg-card-4.png'
    },
];

const whyUs = [
    {
        id: 1,
        title: 'Portrait Photography',
        text: 'Capturing authentic expressions and emotions, creating timeless portraits that tell your story.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_6_f.svg'
    },
    {
        id: 2,
        title: 'Urban & Street Photography',
        text: 'Showcasing the pulse of city life through dynamic and candid shots filled with character.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_2_f.svg'
    },
    {
        id: 3,
        title: 'Nature & Landscape',
        text: 'Immortalizing breathtaking scenery and the beauty of the natural world in every frame.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_5_f.svg'
    },
    {
        id: 4,
        title: 'Editorial & Commercial',
        text: 'Crafting compelling visuals for brands, magazines, and advertising campaigns.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_3_f.svg'
    },
    {
        id: 5,
        title: 'Cinematic Photography',
        text: 'Creating film-inspired imagery with dramatic lighting and storytelling composition.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_4_f.svg'
    },
    {
        id: 6,
        title: 'Black & White Aesthetics',
        text: 'Stripping away distractions to reveal raw emotion and powerful contrasts.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_1_f.svg'
    },
]
</script>

<template>
    <SecondLayout title="Services -">

        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <section class="animate-fade-up">
            <div class="flex flex-col gap-2 py-8 sm:py-16 mx-4 sm:mx-0 dark:text-white">
                <h1 class="text-5xl sm:text-7xl font-bold">Our Services</h1>
                <h2 class="text-lg sm:text-xl sm:w-3/4 font-medium">Capturing moments that tell a story, I create striking images
                    that leave
                    a
                    lasting
                    impression. <br>From
                    vivid
                    portraits to cinematic landscapes, every shot is crafted with precision, emotion, and a unique
                    artistic
                    vision.</h2>
            </div>
        </section>

        <template #fullwidth2>
            <div class="relative mb-10 animate-fade-up" :style="{ height: `${cards.length * 65}vh` }">
                <div v-for="(card, index) in cards" :key="card.id"
                    class="sticky top-20 h-[65vh] flex items-start justify-center pt-10 transition-all duration-700"
                    :style="{ zIndex: index + 1 }">
                    <div class="relative h-[60vh] mx-2 sm:mx-6 px-6 rounded-3xl dark:border-2 dark:border-gray-600 flex flex-col gap-6 justify-center  w-full overflow-hidden"
                        :style="{
                            backgroundImage: `linear-gradient(to right, rgba(0, 0, 0, 1) 30%, rgba(0, 0, 0, 0.1)), url(${card.bg})`,
                            backgroundSize: 'cover',
                            backgroundPosition: '10% center',
                            backgroundRepeat: 'no-repeat'
                        }">
                        <div class="flex items-center">
                            <div class="w-3 sm:w-5 h-3 sm:h-10 border-l-2 border-white dark:border-white/60">

                            </div>
                            <h3 class="text-white text-2xl sm:text-7xl font-medium">{{ card.no }}</h3>
                        </div>

                        <div class="flex flex-col gap-2 sm:w-1/2">
                            <h3 class="text-white text-5xl sm:text-7xl font-semibold">
                                {{ card.text }}
                            </h3>
                            <p class="text-white text-lg sm:text-2xl">
                                {{ card.subText }}
                            </p>

                            <button
                                class="group w-1/3 mt-4 relative inline-flex items-center justify-center overflow-hidden rounded-full bg-yellow-400 px-8 py-3 font-medium text-black transition-all duration-500 hover:text-white dark:text-black">
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
        </template>

        <template #afterFullwidth2>
            <div class="flex flex-col gap-2 py-8 sm:py-16 mx-4 sm:mx-0 dark:text-white">
                <h1 class="text-5xl sm:text-7xl font-bold">Why Us?</h1>
                <h2 class="text-lg sm:text-xl sm:w-3/4 font-medium">Exceptional photography isn’t just about capturing images—it’s
                    about
                    creating stories that resonate. With a keen eye for detail, a passion for visual storytelling, and a
                    commitment to quality, we deliver powerful imagery that speaks for itself.</h2>
            </div>

            <div class="grid sm:grid-cols-3 gap-28 mb-16 mx-4 sm:mx-0">
                <div v-for="wu in whyUs" :key="wu.id" class="flex flex-col gap-2 text-center">
                    <img :src="wu.image" alt="">
                    <h2 class="text-xl font-bold dark:text-gray-300">{{ wu.title }}</h2>
                    <h3 class="text-md dark:text-gray-300 mx-4">{{ wu.text }}</h3>
                </div>
            </div>
        </template>

    </SecondLayout>


</template>
