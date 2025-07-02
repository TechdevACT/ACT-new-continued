<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <!-- <Head title="Welcome - " /> -->
    <div class="flex justify-between items-center py-8 px-16">
        <div class="text-2xl font-bold animate-fade-right w-1/3">
            act! Digital Agency
        </div>
        <div class="flex justify-center items-center animate-fade-down w-1/3">
            <!-- Index -->
            <div class="relative group">
                <div class="relative inline-block overflow-hidden cursor-pointer text-base font-medium text-gray-700">
                    <span
                        class="inline-block text-lg transition-transform duration-500 ease-in-out group-hover:-translate-y-full py-2 px-3">
                        Index
                    </span>
                    <span
                        class="absolute text-lg left-0 top-0 inline-block w-full transform transition-transform duration-300 ease-in-out translate-y-full group-hover:translate-y-0 py-2 px-3">
                        Index
                    </span>
                </div>

                <div
                    class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-40 rounded-xl bg-zinc-800 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out z-10 shadow-xl">
                    <div class="flex flex-col" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">About</Link>
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">Team</Link>
                    </div>
                </div>
            </div>

            <!-- News -->
            <div class="relative group">
                <div class="relative inline-block overflow-hidden cursor-pointer text-base font-medium text-gray-700">
                    <span
                        class="inline-block text-lg transition-transform duration-500 ease-in-out group-hover:-translate-y-full py-2 px-3">
                        News
                    </span>
                    <span
                        class="absolute text-lg left-0 top-0 inline-block w-full transform transition-transform duration-300 ease-in-out translate-y-full group-hover:translate-y-0 py-2 px-3">
                        News
                    </span>
                </div>

                <div
                    class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-40 rounded-xl bg-zinc-800 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-300 ease-in-out z-10 shadow-xl">
                    <div class="flex flex-col" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">Blog</Link>
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">Events</Link>
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">Press</Link>
                    </div>
                </div>
            </div>

            <!-- Project -->
            <div class="relative group">
                <div class="relative inline-block overflow-hidden cursor-pointer text-base font-medium text-gray-700">
                    <span
                        class="inline-block text-lg transition-transform duration-500 ease-in-out group-hover:-translate-y-full py-2 px-3">
                        Project
                    </span>
                    <span
                        class="absolute text-lg left-0 top-0 inline-block w-full transform transition-transform duration-300 ease-in-out translate-y-full group-hover:translate-y-0 py-2 px-3">
                        Project
                    </span>
                </div>

                <div
                    class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-40 rounded-xl bg-zinc-800 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-300 ease-in-out z-10 shadow-xl">
                    <div class="flex flex-col" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">Project 1</Link>
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">Project 2</Link>
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">Project 3</Link>
                        <Link href="#" class="px-4 py-2 text-white hover:text-yellow-500 transition-all duration-300 ease-in-out"
                            role="menuitem">Project 4</Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end animate-fade-left w-1/3">
            switcher
        </div>
    </div>
</template>
