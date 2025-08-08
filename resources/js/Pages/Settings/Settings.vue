<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import HomeHero from './HomeSettings/HomeHero.vue';
import { Head } from '@inertiajs/vue3';
import HomeAbout from './HomeSettings/HomeAbout.vue';
import HomeImageClient from './HomeSettings/HomeImageClient.vue';
import HomeExpertise from './HomeSettings/HomeExpertise.vue';
import { ref } from 'vue';
import HomeServices from './HomeSettings/HomeServices.vue';
import HomeIndustry from './HomeSettings/HomeIndustry.vue';
import HomeBlog from './HomeSettings/HomeBlog.vue';
import AboutHeading from './AboutSettings/AboutHeading.vue';

const activeTab = ref('home');

const props = defineProps({
    data_fe: Object
})
</script>

<template>

    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-lg text-center sm:text-left sm:text-xl font-semibold leading-tight text-gray-800">
                Page Settings
            </h2>
        </template>

        <div class="py-4 mx-4">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <!-- This component to navigate setting -->
                <div class="flex gap-4">
                    <button
                        :class="['py-1 px-4 rounded-xl', activeTab === 'home' ? 'bg-gray-900 text-white' : 'bg-gray-300']"
                        @click="activeTab = 'home'">
                        Home
                    </button>
                    <button
                        :class="['py-1 px-4 rounded-xl', activeTab === 'about' ? 'bg-gray-900 text-white' : 'bg-gray-300']"
                        @click="activeTab = 'about'">
                        About
                    </button>
                </div>

                <!-- Home Setting Components -->
                <template v-if="activeTab === 'home'">
                    <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                        <HomeHero :data_fe="data_fe.data_fe[0]" :images="data_fe.hero_image" />
                    </div>
                    <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                        <HomeAbout :data_fe="data_fe.data_fe[0]" />
                    </div>
                    <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                        <HomeImageClient :banner="data_fe.banner_image" :images="data_fe.clients_image"/>
                    </div>
                    <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                        <HomeExpertise :data_fe="data_fe.data_fe[0]" />
                    </div>
                    <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                        <HomeServices />
                    </div>
                    <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                        <HomeIndustry :data_fe="data_fe.data_fe[0]" :images="data_fe.industry_image"/>
                    </div>
                    <div class="bg-white p-4 shadow rounded-lg sm:p-8">
                        <HomeBlog :data_fe="data_fe.data_fe[0]" />
                    </div>
                </template>

                <!-- About Setting Components -->
                <template v-if="activeTab === 'about'">
                    <AboutHeading :data_about="data_fe.data_about[0]"/>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
