<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import SecondLayout from '@/Layouts/SecondLayout.vue';
import { ref } from 'vue';


const props = defineProps({
    services: Array
});

const cards = (props.services || []).map((service, index) => ({
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
        title: 'Creative & Branding',
        text: 'We help brands build strong visual identities and meaningful communication that connect with their audience.',
        servicesList: ['Branding & Visual Identity', 'Graphic Design', 'Campaign Creative Development', 'Marketing Collateral', 'Presentation Design', 'Social Media Creative', 'Content & Visual Production'],
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_6_f.svg'
    },
    {
        id: 2,
        title: 'Digital & Technology',
        text: 'We develop digital solutions that combine functionality, usability, and modern technology to support business growth.',
        servicesList: ['Website Development', 'Web Application Development', 'Mobile Application Development', 'UI/UX Design', 'Startup Prototyping', 'Interactive Multimedia', 'System & Software Integration', 'Digital Platform Development', 'Content & Multimedia'],
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_2_f.svg'
    },
    {
        id: 3,
        title: 'Content & Multimedia',
        text: 'We create engaging multimedia experiences that help brands communicate more effectively across digital platforms.',
        servicesList: ['Photography', 'Videography', 'Motion Graphics', 'Animation', 'Video Editing', 'Interactive Content', 'Product & Commercial Visual Production'],
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_5_f.svg'
    },
    {
        id: 4,
        title: 'Marketing & Activation',
        text: 'We support brands through integrated marketing activities designed to increase engagement, visibility, and audience interaction.',
        servicesList: ['Digital Campaign Strategy', 'Brand Activation', 'Social Media Campaign', 'Digital Advertising Support', 'Event Creative Support', 'Community & Engagement Campaign'],
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_3_f.svg'
    },
    {
        id: 5,
        title: 'e-Commerce & Digital Commerce',
        text: 'With hands-on experience in marketplace and digital commerce ecosystems, we help brands better understand and optimize their digital selling journey.',
        servicesList: ['Marketplace Optimization', 'Product Content Development', 'E-Commerce Creative Assets', 'Marketplace Branding', 'Digital Commerce Strategy', 'Campaign & Promotion Support', 'Consumer Experience Optimization'],
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_4_f.svg'
    },
    {
        id: 6,
        title: 'Future-Driven Solutions',
        text: 'As technology and Artificial Intelligence continue to evolve, act! also explores more adaptive and efficient creative systems to help brands work smarter and scale faster.',
        servicesList: ['We continuously develop workflows and solutions that integrate creativity, technology, automation, and AI to support more effective digital experiences and business growth.'],
        image: 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_1_f.svg'
    },
]

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
    <!-- <SecondLayout title="Services -"> -->
    <DefaultLayout title="Services -">

        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <section class="animate-fade-up">
            <div class="flex flex-col gap-2 pt-8 sm:pt-16 pb-0 mx-4 sm:mx-0 dark:text-white">
                <h1 class="text-5xl sm:text-7xl font-bold">Our Services</h1>
                <h2 class="text-lg sm:text-xl sm:w-3/4 font-medium">We provide integrated creative, digital, and technology solutions designed to help brands grow, adapt, and stay relevant in the evolving digital landscape. By combining creativity, strategy, and innovation, we help transform ideas into impactful and future-ready experiences.
</h2>
            </div>
        </section>

        <template #fullwidth2>
            <section>
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
                                        <!-- {{ card.subText }} -->
                                        {{ displaySubText(card)}}
                                    </p>
                                    <button @click="toggleExpand(card.id)"
                                        class="group w-max mt-4 relative inline-flex items-center justify-center overflow-hidden rounded-full px-6 py-2 text-sm font-medium text-black transition-all duration-500 border-2 border-yellow-400 hover:text-white">
                                        
                                        <!-- Default Yellow Background -->
                                        <div class="absolute inset-0 bg-yellow-400 w-full h-full z-0"></div>
                                        
                                        <!-- Sliding Black Background (Side to Side) -->
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
            </section>
        </template>

        <template #afterFullwidth2>
            <div class="flex flex-col gap-6 py-8 sm:py-16 mx-4 sm:mx-0 dark:text-white">
                <h1 class="text-5xl sm:text-7xl font-bold">Why Us?</h1>
                <div class="text-lg sm:text-xl w-full max-w-4xl font-medium flex flex-col gap-6 leading-relaxed">
                    <p>
                        Because great ideas need more than creativity — they need strategy, adaptability, and real execution.
                    </p>
                    <p>
                        At act! digital agency, we combine creative thinking, technology, and real industry experience to create solutions that are not only visually engaging, but also functional, relevant, and impactful. From branding and digital development to e-Commerce insights and AI-driven innovation, we help brands navigate change, connect with audiences, and grow with confidence in an ever-evolving digital world.
                    </p>
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-x-12 gap-y-20 mb-16 mx-4 sm:mx-0">
                <div v-for="wu in whyUs" :key="wu.id" class="flex flex-col gap-3 text-left items-start">
                    <img :src="wu.image" alt="" class="mb-4">
                    <h2 class="text-2xl font-bold dark:text-gray-300">{{ wu.title }}</h2>
                    <h3 class="text-sm dark:text-gray-400 leading-relaxed">{{ wu.text }}</h3>
                    <div class="mt-4 w-full">
                        <p v-if="wu.id !== 6" class="font-bold text-sm mb-4 dark:text-gray-300">Services include:</p>
                        
                        <ul v-if="wu.id !== 6" class="flex flex-col gap-y-3 text-left text-sm dark:text-gray-400 w-full">
                            <li v-for="item in wu.servicesList" :key="item" class="flex items-start gap-3">
                                <span class="w-3 h-0.5 rounded bg-yellow-400 mt-2.5 flex-shrink-0"></span>
                                <span class="leading-relaxed">{{ item }}</span>
                            </li>
                        </ul>

                        <p v-else class="text-sm dark:text-gray-400 leading-relaxed">
                            {{ wu.servicesList ? wu.servicesList[0] : '' }}
                        </p>
                    </div>
                </div>
            </div>
        </template>

    <!-- </SecondLayout> -->
    </DefaultLayout>


</template>
