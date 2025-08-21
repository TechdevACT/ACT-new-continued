<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ThemeSwitcher from './ThemeSwitcher.vue';

const page = usePage()

const menu = [
    {
        name: 'Home',
        link: '/',
        submenu: [
            { name: 'About', link: '/about' },
        ]
    },
    // {
    //     name: 'Projects',
    //     link: '#',
    //     submenu: [
    //         { name: 'Project 1', link: '#' },
    //         { name: 'Project 2', link: '#' },
    //     ]
    // },
    {
        name: 'Services',
        link: '/services',
    },
    {
        name: 'News',
        link: '/news',
    },
    {
        name: 'Contact',
        link: '/contact',
    },
];

const isActive = (link) => {
    return page.url === link || page.url.startsWith(link + '/')
}

const isScrolled = ref(false);
const isMenuOpen = ref(false);
const isMobile = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 10;
};

const checkScreenSize = () => {
    isMobile.value = window.innerWidth < 768;
};

const showCompactMenu = computed(() => isMobile.value || isScrolled.value);

onMounted(() => {
    checkScreenSize();
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('resize', checkScreenSize);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    window.removeEventListener('resize', checkScreenSize);
});
</script>

<template>
    <header
        class="sticky top-0 left-0 right-0 z-50 flex items-center justify-between px-4 sm:px-16 transition-[padding,background-color] duration-300 ease-in-out"
        :class="isScrolled ? 'py-3 bg-white/80 dark:bg-black/70 backdrop-blur-sm shadow-lg' : 'py-6 bg-transparent'">

        <div class="text-2xl font-bold text-black dark:text-white z-10">
            <Link href="/">
                <img src="/images/logo.png" alt="">
            </Link>
        </div>

        <div class="flex justify-end items-start gap-4">
            <transition enter-active-class="transition-opacity duration-300 ease-out"
                leave-active-class="transition-opacity duration-200 ease-in" enter-from-class="opacity-0"
                leave-to-class="opacity-0">
                <nav v-if="!showCompactMenu" class="hidden md:block">
                    <ul class="flex items-center justify-end gap-4">
                        <li v-for="m in menu" :key="m.name" class="relative group">
                            <div class="relative inline-block overflow-hidden cursor-pointer text-base font-medium"
                                :class="isActive(m.link) ? 'text-[#573280] dark:text-yellow-400' : 'text-gray-700 dark:text-gray-300'">
                                <span
                                    class="inline-block text-lg transition-transform duration-500 ease-in-out group-hover:-translate-y-full py-2 px-3">
                                    {{ m.name }}
                                </span>
                                <span v-if="m.submenu"
                                    class="absolute text-lg left-0 top-0 inline-block w-full transform transition-transform duration-300 ease-in-out translate-y-full group-hover:translate-y-0 py-2 px-3 text-black dark:text-white">
                                    {{ m.name }}
                                </span>
                                <Link :href="m.link"
                                    class="absolute text-lg left-0 top-0 inline-block w-full transform transition-transform duration-300 ease-in-out translate-y-full group-hover:translate-y-0 py-2 px-3"
                                    :class="isActive(m.link) ? 'text-[#573280] dark:text-yellow-400' : 'text-black dark:text-white'">
                                {{ m.name }}
                                </Link>
                            </div>
                            <div v-if="m.submenu"
                                class="absolute left-1/2 -translate-x-1/2 top-full w-40 rounded-xl bg-zinc-800 dark:bg-gray-800 dark:border dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out z-10 shadow-xl">
                                <div class="flex flex-col">
                                    <Link v-for="sm in m.submenu" :key="sm.name" :href="sm.link"
                                        :class="isActive(sm.link) ? 'text-yellow-400' : 'text-white hover:text-yellow-500'"
                                        class="px-4 py-2 transition-colors duration-200">
                                    {{ sm.name }}
                                    </Link>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </transition>

            <!-- ThemeSwitcher -->
            <transition enter-active-class="transition-all duration-300 ease-out"
                leave-active-class="transition-all duration-200 ease-in" enter-from-class="opacity-0 scale-90"
                leave-to-class="opacity-0 scale-90" mode="out-in">
                <div v-if="!showCompactMenu">
                    <ThemeSwitcher />
                </div>

                <!-- Compact version tetap di sini -->
                <div v-else
                    class="flex items-center gap-x-1 p-1.5 rounded-full bg-zinc-200/60 dark:bg-zinc-800/60 backdrop-blur-md border border-zinc-300/80 dark:border-zinc-700/80 shadow-lg">
                    <ThemeSwitcher />
                    <div class="h-6 w-px bg-zinc-300 dark:bg-zinc-600 mx-1"></div>
                    <div class="relative">
                        <button @click="isMenuOpen = !isMenuOpen"
                            class="flex items-center gap-x-2 pl-4 pr-3 py-2 rounded-full bg-white dark:bg-black text-black dark:text-white font-semibold shadow-inner dark:shadow-none transition-transform duration-200 ease-in-out active:scale-95">
                            <span>Menu</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                        <transition enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <div v-if="isMenuOpen"
                                class="absolute right-0 mt-3 w-56 origin-top-right rounded-xl bg-zinc-800 dark:bg-gray-800 shadow-xl dark:border dark:border-gray-700 z-20">
                                <div class="py-1">
                                    <template v-for="item in menu" :key="item.name">
                                        <Link v-if="!item.submenu" :href="item.link" @click="isMenuOpen = false"
                                            class="block px-4 py-2 text-base text-white hover:text-yellow-500 transition-colors duration-200">
                                        {{ item.name }}
                                        </Link>
                                        <div v-else>
                                            <h3
                                                class="px-4 pt-2 pb-1 text-sm font-semibold text-gray-400 uppercase tracking-wider">
                                                {{ item.name }}</h3>
                                            <Link v-for="subItem in item.submenu" :key="subItem.name"
                                                :href="subItem.link" @click="isMenuOpen = false"
                                                class="block pl-6 pr-4 py-2 text-base text-white hover:text-yellow-500 transition-colors duration-200">
                                            {{ subItem.name }}
                                            </Link>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </transition>
        </div>
    </header>
</template>
