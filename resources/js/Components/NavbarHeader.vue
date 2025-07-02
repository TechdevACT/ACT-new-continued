<script setup>
import { Link } from '@inertiajs/vue3';

const menu = [
    {
        name: 'Index',
        link: '#',
        submenu: [
            {
                name: 'About',
                link: '#',
            },
            {
                name: 'Services',
                link: '#',
            },
        ]
    },
    {
        name: 'News',
        link: '#',
        submenu: [
            {
                name: 'Blog',
                link: '#',
            },
            {
                name: 'Events',
                link: '#',
            },
            {
                name: 'Press',
                link: '#',
            },
        ]
    },
    {
        name: 'Projects',
        link: '#',
        submenu: [
            {
                name: 'Project 1',
                link: '#',
            },
            {
                name: 'Project 2',
                link: '#',
            },
            {
                name: 'Project 3',
                link: '#',
            },
            {
                name: 'Project 4',
                link: '#',
            },
        ]
    },
    {
        name: 'Contact',
        link: '#',
    },
]
</script>

<template>
    <div class="flex justify-between items-center my-8 mx-16">
        <div class="text-2xl font-bold animate-fade-right w-1/3">
            act! Digital Agency
        </div>
        <div class="flex justify-center items-center animate-fade-down w-1/3">

            <div v-for="m in menu" class="relative group">
                <div class="relative inline-block overflow-hidden cursor-pointer text-base font-medium text-gray-700">
                    <span
                        class="inline-block text-lg transition-transform duration-500 ease-in-out group-hover:-translate-y-full py-2 px-3">
                        {{ m.name }}
                    </span>
                    <span v-if="m.submenu"
                        class="absolute text-lg left-0 top-0 inline-block w-full transform transition-transform duration-300 ease-in-out translate-y-full group-hover:translate-y-0 py-2 px-3">
                        {{ m.name }}
                    </span>
                    <Link v-if="!m.submenu" :href="m.link"
                        class="absolute text-lg left-0 top-0 inline-block w-full transform transition-transform duration-300 ease-in-out translate-y-full group-hover:translate-y-0 py-2 px-3">
                    {{ m.name }}</Link>
                </div>

                <div v-if="m.submenu"
                    class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-40 rounded-xl bg-zinc-800 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out z-10 shadow-xl">
                    <div class="flex flex-col" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <Link v-for="sm in m.submenu" :href="sm.link"
                            class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">{{ sm.name }}</Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end animate-fade-left w-1/3">
            switcher
        </div>
    </div>

</template>
