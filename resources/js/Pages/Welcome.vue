<script setup>
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import InteractiveCards from '@/Components/InteractiveCards.vue';
import Industries from '@/Components/Industries.vue';
import { ref } from 'vue';

const props = defineProps({
    data_fe: Object,
})

const cards = (props.data_fe.services || []).map((service, index) => ({
    id: service.id,
    no: String(index + 1).padStart(2, '0'),
    text: service.name,
    subText: service.description,
    bg: service.image || '/images/services/bg-card-1.png',
    url: service.url
}));

const whyUs = [
    {
        id: 1,
        title: 'Creativity Meets Technology',
        text: 'We combine creative thinking with digital technology to create solutions that are not only visually engaging, but also functional, effective, and impactful.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_6_f.svg'
    },
    {
        id: 2,
        title: 'Adaptive & Future-Ready',
        text: 'The digital landscape evolves rapidly, and so do we. act! continuously adapts to new trends, technologies, and market behaviour to ensure every solution stays relevant and forward-thinking.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_2_f.svg'
    },
    {
        id: 3,
        title: 'End-to-End Solutions',
        text: 'From strategy, branding, design, content, and digital campaigns to website development, multimedia, and technology integration — we provide connected solutions under one ecosystem.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_5_f.svg'
    },
    {
        id: 4,
        title: 'Real Industry Experience',
        text: 'We has also explored the e-Commerce industry directly through marketplace and digital commerce research and operations. This hands-on experience gives us a deeper understanding of digital consumer behaviour, platform trends, and business growth challenges.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_3_f.svg'
    },
    {
        id: 5,
        title: 'Human-Centered Approach',
        text: 'We believe every brand has unique goals and challenges. That’s why we prioritize collaboration, listening, and understanding before creating solutions.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_4_f.svg'
    },
    {
        id: 6,
        title: 'Solution-Oriented Mindset',
        text: 'We focus not only on ideas, but on how those ideas can work effectively in real execution and deliver measurable results.',
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_1_f.svg'
    },
        {
        id: 7,
        title: 'Continuous Innovation',
        text: 'Curiosity and experimentation are part of our culture. We continuously explore new approaches, technologies, and possibilities — including AI-driven systems and automation — to help brands grow smarter and faster.',
        image: '/images/fnk_services_7_f.svg'
    },
        {
        id: 8,
        title: 'Built on Trust',
        text: 'Most of our growth comes through long-term relationships, client loyalty, and referrals. For us, trust is earned through consistency, communication, and quality work over time.',
        image: '/images/fnk_services_8_f.svg'
    }
]

const clientsImage = props.data_fe.clients_image.map(item => item.path);

const images = props.data_fe.hero_image.map(item => item.path);

const industries = props.data_fe.industry_image.map(item => item.path);

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

const maxSubChars = 120;
const expanded = ref({});
const toggleExpand = (id) => {
    expanded.value[id] = !expanded.value[id];
};
const displaySubText = (card) => {
    const full = card.subText;
    if(expanded.value[card.id]) return full;
    return full.length > maxSubChars ? full.slice(0,maxSubChars) + '...' : full;
};

</script>

<template>
    <DefaultLayout>
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <section class="flex flex-col pt-16 sm:pt-24 sm:pb-16 justify-center items-center animate-fade-up">
            <div class="px-4 flex justify-center mb-6">
                <h1 class="text-4xl sm:text-6xl text-center font-bold text-black dark:text-white">{{
                    data_fe.data_fe[0].hero_title }}
                    <span class="text-[#99CA3D]">
                        {{ data_fe.data_fe[0].hero_title2 }}
                    </span>
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
                <h2 class="text-base sm:text-lg leading-relaxed font-inter font-normal text-center text-[#262626] dark:text-gray-300"
                    v-html="data_fe.data_fe[0].hero_description">
                </h2>
            </div>
            <div class="flex flex-row gap-4 sm:gap-8 font-semibold">
                <Link href="#"
                    class="bg-black hover:bg-amber-200 text-white hover:text-black text-sm sm:text-xl rounded-xl px-4 py-2 transition-all duration-500 dark:bg-yellow-400 dark:text-black dark:hover:bg-white text-center">
                Getting Started
                </Link>
                <Link href="#"
                    class="bg-gray-200 hover:bg-amber-200 text-black text-sm sm:text-xl rounded-xl px-4 py-2 transition-all duration-500 dark:bg-gray-300 dark:hover:bg-yellow-400 text-center">
                Discover Our Work
                </Link>
            </div>
        </section>

        <section class="py-5 sm:py-10 mx-4 sm:mx-0">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-6">
                <div class=" animate-fade-up transition-all duration-500">
                    <h3 class="text-md sm:text-2xl dark:text-white">/ {{ data_fe.data_fe[0].about_title }}</h3>
                </div>

                <div class="animate-fade-up transition-all duration-500">
                    <div class="text-base sm:text-lg leading-relaxed text-[#262626] dark:text-white font-inter font-normal" v-html="data_fe.data_fe[0].about_description"></div>
                </div>
            </div>
        </section>

        <section class="flex flex-col py-5 sm:pt-10 mx-4 sm:mx-0 animate-fade-up transition-all duration-500">
            <div class="mb-10">
                <img src="https://picsum.photos/1080/500" class="w-full rounded-3xl">
            </div>
            <div class="grid grid-cols-5 gap-6 pt-10">
                <div v-for="clients in clientsImage" class="flex items-center justify-center">
                    <img :src="clients" alt="">
                </div>
            </div>
            <div class="flex flex-col mt-16">
                <div class="flex flex-col gap-4 dark:text-white">
                    <h3 class="text-md sm:text-2xl font-medium mt-12">/ {{ data_fe.data_fe[0].expertise_title }}</h3>
                    <h1 class="text-4xl sm:text-7xl font-bold">{{ data_fe.data_fe[0].expertise_heading }}</h1>
                    <h2 class="text-base sm:text-lg leading-relaxed sm:w-2/3 text-[#262626] dark:text-white font-inter font-normal mt-4"  v-html="data_fe.data_fe[0].expertise_description">
                    </h2>
                </div>
            </div>
        </section>

        <template #fullwidth2>
            <!-- card parallax -->
            <!-- <section>
                <div class="mx-auto w-11/12 sm:w-10/12">
                    <div class="relative mb-10 animate-fade-up" :style="{ height: `${cards.length * 70}vh` }">
                        <div v-for="(card, index) in cards" :key="card.id"
                            class="sticky top-20 h-[70vh] flex items-start justify-center pt-10 transition-all duration-700"
                            :style="{ zIndex: index + 1 }">
                            <div class="relative h-[65vh] px-6 rounded-3xl shadow dark:border-2 dark:border-gray-600 flex flex-col gap-6 justify-center  w-full overflow-hidden"
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

                                <div class="flex flex-col gap-2 sm:w-2/3 pl-3 sm:pl-5">
                                    <h3 class="text-white text-5xl sm:text-7xl font-semibold">
                                        {{ card.text }}
                                    </h3>
                                    <p class="text-white text-base sm:text-lg font-inter font-normal whitespace-pre-line leading-relaxed mt-6 sm:mt-10">
                                        {{ displaySubText(card)}}
                                    </p>
                                    <button @click="toggleExpand(card.id)"
                                        class="group w-max mt-4 relative inline-flex items-center justify-center overflow-hidden rounded-full px-6 py-2 text-sm font-medium text-black transition-all duration-500 border-2 border-yellow-400 hover:text-white">
                                        
                                        <div class="absolute inset-0 bg-yellow-400 w-full h-full z-0"></div>
                                        
                                        <div class="absolute left-0 top-0 h-full w-0 bg-black transition-all duration-500 ease-out group-hover:w-full z-10"></div>
                                        
                                        <span class="relative z-20 flex items-center">
                                            {{ expanded[card.id] ? "Show Less" : 'Load More' }}
                                            <span class="ml-3 flex items-center gap-1">
                                                <span class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400"></span>
                                                <span class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400"></span>
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>  -->

            <!-- kolom services -->
            <div class="mx-auto w-11/12 sm:w-10/12">
                <div class="grid sm:grid-cols-4 gap-x-12 gap-y-20 mb-16 mx-4 sm:mx-0">
                    <div v-for="wu in whyUs" :key="wu.id" class="flex flex-col gap-3 text-left items-start">
                        <img :src="wu.image" alt="" class="mb-4">
                        <h2 class="text-2xl font-bold dark:text-gray-300">{{ wu.title }}</h2>
                        <h3 class="text-sm dark:text-gray-400 leading-relaxed">{{ wu.text }}</h3>
                    </div>
                </div>
            </div> 
            <section class="bg-brand-purple py-10 px-4 sm:px-0">
                <Industries :industries="industries" :text="industries_text" />
            </section>

        </template>

        <template #afterFullwidth2>
            <section class="py-10 px-4 sm:px-0">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 ">
                    <h3 class="text-md sm:text-2xl text-black dark:text-white font-medium">/ {{
                        data_fe.data_fe[0].blog_title }}
                    </h3>
                    <div class="sm:col-span-2 flex flex-col gap-4 sm:items-end sm:text-end text-black dark:text-white">
                        <h3 class="text-4xl sm:text-6xl font-bold">{{ data_fe.data_fe[0].blog_heading }}</h3>
                        <h4 class="sm:w-2/3 text-base sm:text-lg leading-relaxed text-[#262626] dark:text-white font-inter font-normal" v-html="data_fe.data_fe[0].blog_description">
                        </h4>
                    </div>
                </div>

                <div class="grid sm:grid-cols-3 gap-10 pt-10 animate-fade-up">
                    <div v-for="blog in data_fe.blog" :key="blog.slug"
                        class="flex flex-col shadow-xl group rounded-2xl overflow-hidden h-full">
                        <Link :href="`/blog/` + blog.slug" class="flex flex-col h-full">
                            <div class="bg-gray-200 dark:bg-zinc-900 dark:text-white p-4">
                                <span class="text-gray-500">
                                    {{ new Date(blog.created_at).toLocaleDateString('id-ID', {
                                        day: '2-digit',
                                        month: 'long',
                                        year: 'numeric'
                                    }) }}
                                </span>
                                <h3 class="text-xl font-bold min-h-[3.5rem] line-clamp-2">{{ blog.title }}</h3>
                                <p class="text-md dark:text-gray-400 line-clamp-3">{{ blog.excerpt }}</p>
                            </div>

                            <div class="flex-1">
                                <img :src="blog.news_images[0]?.image || 'https://placehold.co/400x200'" alt=""
                                    class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
                            </div>
                        </Link>
                    </div>
                </div>
            </section>
        </template>
    </DefaultLayout>
</template>
