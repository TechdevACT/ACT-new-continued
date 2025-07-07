<script setup>
import { ref, computed } from 'vue';

const testimonials = ref([
    {
        name: 'Olivia Brown',
        title: 'Designer',
        avatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        quote: 'Working with the Osty team has been an outstanding experience for us at Nova. They adapted effortlessly to our workflow, functioning as a true extension of our internal team.'
    },
    {
        name: 'William Taylor',
        title: 'Project Manager',
        avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        quote: 'At Ember, working with Osty has been nothing short of exceptional. Their deep understanding of product design, combined with their ability to execute both large-scale and granular design tasks.'
    },
    {
        name: 'Emily Johnson',
        title: 'Graphic Designer',
        avatar: 'https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        quote: 'Osty has been a game-changer for our brand at Vireo. Their team quickly understood our vision and executed it flawlessly across various platforms.'
    },
    {
        name: 'Michael Chen',
        title: 'Lead Developer',
        avatar: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        quote: 'The technical proficiency and collaborative spirit of the Osty team are top-notch. They delivered a robust and scalable solution ahead of schedule. Highly recommended.'
    },
]);

const isDesktop = typeof window !== 'undefined' && window.innerWidth >= 1024;
const slidesToShow = isDesktop ? 3 : 1;
const cloneCount = slidesToShow;

const currentIndex = ref(cloneCount);
const isTransitioning = ref(true);
const originalSlidesCount = computed(() => testimonials.value.length);

const extendedTestimonials = computed(() => {
    const startClones = testimonials.value.slice(-cloneCount);
    const endClones = testimonials.value.slice(0, cloneCount);
    return [...startClones, ...testimonials.value, ...endClones];
});

const activeDotIndex = computed(() => {
    return (currentIndex.value - cloneCount + originalSlidesCount.value) % originalSlidesCount.value;
});

const sliderStyle = computed(() => {
    const slideWidthPercentage = 100 / slidesToShow;
    return {
        transform: `translateX(-${currentIndex.value * slideWidthPercentage}%)`,
        transition: isTransitioning.value ? 'transform 0.5s ease-in-out' : 'none',
    };
});

const navigate = (direction) => {
    if (!isTransitioning.value) return;
    isTransitioning.value = true;
    currentIndex.value += direction;
};

const next = () => navigate(1);
const prev = () => navigate(-1);

const goToSlide = (index) => {
    if (!isTransitioning.value) return;
    isTransitioning.value = true;
    currentIndex.value = index + cloneCount;
}

const handleTransitionEnd = () => {

    if (currentIndex.value >= originalSlidesCount.value + cloneCount) {
        isTransitioning.value = false;
        currentIndex.value = cloneCount;
    }

    else if (currentIndex.value < cloneCount) {
        isTransitioning.value = false;
        currentIndex.value = originalSlidesCount.value + cloneCount - 1;
    }

    setTimeout(() => {
        isTransitioning.value = true;
    });
};
</script>


<template>
    <div class="bg-[url('/images/about/bg-about.png')] py-16 sm:py-24 antialiased">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="relative overflow-hidden">
                <div class="flex" :style="sliderStyle" @transitionend="handleTransitionEnd">

                    <div v-for="(testimonial, index) in extendedTestimonials" :key="index"
                        class="w-full flex-shrink-0 lg:w-1/3 lg:pr-8">
                        <div class="flex h-full flex-col rounded-2xl bg-black p-8">
                            <div class="flex-grow">
                                <header class="mb-6 flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-white">/ Review</h3>
                                    <div class="flex items-center">
                                        <svg v-for="i in 5" :key="i" class="h-5 w-5 text-yellow-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </header>
                                <blockquote class="text-gray-300">
                                    <p>{{ testimonial.quote }}</p>
                                </blockquote>
                            </div>
                            <footer class="mt-8 flex items-center gap-4">
                                <img :src="testimonial.avatar" alt="" class="h-12 w-12 rounded-full object-cover">
                                <div>
                                    <div class="font-semibold text-white">{{ testimonial.name }}</div>
                                    <div class="text-sm text-gray-400">{{ testimonial.title }}</div>
                                </div>
                            </footer>
                        </div>
                    </div>

                </div>
            </div>

            <nav class="mt-10 flex items-center justify-center gap-4 ">
                <div class="bg-zinc-700 flex gap-6 rounded-2xl">
                    <button @click="prev"
                        class="flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-white">
                        <span class="sr-only">Previous slide</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <div class="flex items-center justify-center gap-3">
                        <button v-for="(slide, index) in testimonials" :key="index" @click="goToSlide(index)"
                            class="h-2.5 w-2.5 rounded-full transition-colors duration-300"
                            :class="activeDotIndex === index ? 'bg-white' : 'bg-gray-500 hover:bg-gray-400'"></button>
                    </div>

                    <button @click="next"
                        class="flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-white">
                        <span class="sr-only">Next slide</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </nav>

        </div>
    </div>
</template>
