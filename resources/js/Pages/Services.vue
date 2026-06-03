<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import SecondLayout from '@/Layouts/SecondLayout.vue';
import { ref } from 'vue';


// No props needed for hardcoded cards

const cards = [
    {
        id: 1,
        no: '01',
        text: 'Creative & Branding',
        description: 'We help brands build strong visual identities and meaningful communication that connect with their audience.',
        servicesList: ['Branding & Visual Identity', 'Graphic Design', 'Campaign Creative Development', 'Marketing Collateral', 'Presentation Design', 'Social Media Creative', 'Content & Visual Production'],
        bg: '/images/services/bg-card-1.png'
    },
    {
        id: 2,
        no: '02',
        text: 'Digital & Technology',
        description: 'We develop digital solutions that combine functionality, usability, and modern technology to support business growth.',
        servicesList: ['Website Development', 'Web Application Development', 'Mobile Application Development', 'UI/UX Design', 'Startup Prototyping', 'Interactive Multimedia', 'System & Software Integration', 'Digital Platform Development', 'Content & Multimedia'],
        bg: '/images/services/bg-card-2.png'
    },
    {
        id: 3,
        no: '03',
        text: 'Content & Multimedia',
        description: 'We create engaging multimedia experiences that help brands communicate more effectively across digital platforms.',
        servicesList: ['Photography', 'Videography', 'Motion Graphics', 'Animation', 'Video Editing', 'Interactive Content', 'Product & Commercial Visual Production'],
        bg: '/images/services/bg-card-3.png'
    },
    {
        id: 4,
        no: '04',
        text: 'Marketing & Activation',
        description: 'We support brands through integrated marketing activities designed to increase engagement, visibility, and audience interaction.',
        servicesList: ['Digital Campaign Strategy', 'Brand Activation', 'Social Media Campaign', 'Digital Advertising Support', 'Event Creative Support', 'Community & Engagement Campaign'],
        bg: '/images/services/bg-card-4.png'
    },
    {
        id: 5,
        no: '05',
        text: 'e-Commerce & Digital Commerce',
        description: 'With hands-on experience in marketplace and digital commerce ecosystems, we help brands better understand and optimize their digital selling journey.',
        servicesList: ['Marketplace Optimization', 'Product Content Development', 'E-Commerce Creative Assets', 'Marketplace Branding', 'Digital Commerce Strategy', 'Campaign & Promotion Support', 'Consumer Experience Optimization'],
        bg: '/images/services/bg-card-1.png'
    },
    {
        id: 6,
        no: '06',
        text: 'Future-Driven Solutions',
        description: 'As technology and Artificial Intelligence continue to evolve, act! also explores more adaptive and efficient creative systems to help brands work smarter and scale faster.',
        servicesList: ['We continuously develop workflows and solutions that integrate creativity, technology, automation, and AI to support more effective digital experiences and business growth.'],
        bg: '/images/services/bg-card-2.png'
    }
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

const maxSubChars = 120;
const expanded = ref({});
const toggleExpand = (id) => {
    expanded.value[id] = !expanded.value[id];
}

// No need for displaySubText anymore since we use conditional rendering

</script>

<template>
    <!-- <SecondLayout title="Services -"> -->
    <DefaultLayout title="Services -">

        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <section class="animate-fade-up">
            <div class="flex flex-col gap-2 py-8 sm:py-16 mx-4 sm:mx-0 dark:text-white">
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

                                <div class="flex flex-col gap-2 sm:w-3/4">
                                    <h3 class="text-white text-4xl sm:text-6xl font-semibold mb-2">
                                        {{ card.text }}
                                    </h3>
                                    <p class="text-white text-base sm:text-lg font-normal mb-2 leading-relaxed">
                                        {{ card.description }}
                                    </p>
                                    
                                    <!-- Services List (Toggled by Show More) -->
                                    <div v-if="expanded[card.id] && card.servicesList && card.servicesList.length > 0" class="animate-fade-up">
                                        <p v-if="card.id !== 6" class="text-white font-medium mb-2 mt-2">Services include:</p>
                                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1 text-white text-sm sm:text-base font-light">
                                            <li v-for="item in card.servicesList" :key="item" class="flex items-start gap-2">
                                                <span v-if="card.id !== 6" class="text-yellow-400 mt-1">&bull;</span>
                                                <span class="leading-relaxed">{{ item }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <button @click="toggleExpand(card.id)"
                                        class="group w-max mt-4 relative inline-flex items-center justify-center overflow-hidden rounded-full px-6 py-2 text-sm font-medium text-black transition-all duration-500 border border-yellow-400 hover:text-white">
                                        
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
            <div class="flex flex-col gap-2 py-8 sm:py-16 mx-4 sm:mx-0 dark:text-white">
                <h1 class="text-5xl sm:text-7xl font-bold">Why Us?</h1>
                <h2 class="text-lg sm:text-xl sm:w-3/4 font-medium">
                    Because great ideas need more than 
                    <br>
                    creativity — they need strategy, adaptability, and real execution.
                    <br>
                    <br>
                    At act! digital agency, we combine creative thinking, technology, 
                    <br>
                    and real industry experience to create solutions that are not only visually 
                    <br>
                    engaging, but also functional, relevant, and impactful. From branding and 
                    <br>
                    digital development to e-Commerce insights and AI-driven innovation, 
                    <br>
                    we help brands navigate change, connect with audiences, and grow with 
                    <br>
                    confidence in an ever-evolving digital world.
                </h2>
            </div>

            <div class="grid sm:grid-cols-3 gap-28 mb-16 mx-4 sm:mx-0">
                <div v-for="wu in whyUs" :key="wu.id" class="flex flex-col gap-2 text-center">
                    <img :src="wu.image" alt="">
                    <h2 class="text-xl font-bold dark:text-gray-300">{{ wu.title }}</h2>
                    <h3 class="text-md dark:text-gray-300 mx-4">{{ wu.text }}</h3>
                </div>
            </div>
        </template>

    <!-- </SecondLayout> -->
    </DefaultLayout>


</template>
