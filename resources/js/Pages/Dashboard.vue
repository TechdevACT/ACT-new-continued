<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// Simulasi Data (Nanti bisa diganti dengan props dari Controller)
const stats = [
    { name: 'Total Projects', value: '12', icon: 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', color: 'text-blue-600', bg: 'bg-blue-50' },
    { name: 'Published News', value: '24', icon: 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', color: 'text-purple-600', bg: 'bg-purple-50' },
    { name: 'Testimonials', value: '8', icon: 'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z', color: 'text-orange-600', bg: 'bg-orange-50' },
    { name: 'Services Active', value: '4', icon: 'M13 10V3L4 14h7v7l9-11h-7z', color: 'text-emerald-600', bg: 'bg-emerald-50' },
];

const recentProjects = [
    { id: 1, title: 'Redesign Company Profile', category: 'Web Development', status: 'Completed', date: '2 days ago' },
    { id: 2, title: 'Mobile App UI/UX', category: 'Design', status: 'In Progress', date: '1 week ago' },
    { id: 3, title: 'E-Commerce Integration', category: 'Web Development', status: 'Pending', date: '2 weeks ago' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        Dashboard Overview
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Welcome back, here's what's happening today.</p>
                </div>

                <Link :href="route('projectsSetting.index')"
                    class="inline-flex items-center justify-center px-4 py-2 bg-[#99ca3d] hover:bg-[#86b333] text-white text-sm font-medium rounded-lg transition-colors shadow-sm gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Project
                </Link>
            </div>
        </template>

        <div class="py-6">
            <div class="space-y-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div v-for="stat in stats" :key="stat.name" class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 transition-all hover:shadow-md">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div :class="[stat.bg, 'rounded-lg p-3']">
                                        <svg class="h-6 w-6" :class="stat.color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="stat.icon" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="truncate text-sm font-medium text-gray-500">{{ stat.name }}</dt>
                                        <dd>
                                            <div class="text-lg font-bold text-gray-900">{{ stat.value }}</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-[#99ca3d] hover:text-[#86b333]">View all</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                    <div class="lg:col-span-2">
                        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5">
                            <div class="border-b border-gray-100 px-6 py-5 flex justify-between items-center">
                                <h3 class="text-base font-semibold text-gray-900">Recent Projects</h3>
                                <Link :href="route('projectsSetting.index')" class="text-sm font-medium text-[#99ca3d] hover:text-[#86b333]">View All</Link>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm text-gray-600">
                                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                                        <tr>
                                            <th class="px-6 py-3 font-medium">Project Name</th>
                                            <th class="px-6 py-3 font-medium">Category</th>
                                            <th class="px-6 py-3 font-medium">Status</th>
                                            <th class="px-6 py-3 font-medium text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <tr v-for="project in recentProjects" :key="project.id" class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 font-medium text-gray-900">{{ project.title }}</td>
                                            <td class="px-6 py-4">{{ project.category }}</td>
                                            <td class="px-6 py-4">
                                                <span :class="{
                                                    'bg-green-100 text-green-700': project.status === 'Completed',
                                                    'bg-blue-100 text-blue-700': project.status === 'In Progress',
                                                    'bg-gray-100 text-gray-700': project.status === 'Pending'
                                                }" class="inline-flex rounded-full px-2 py-1 text-xs font-medium">
                                                    {{ project.status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button class="font-medium text-gray-400 hover:text-[#99ca3d]">Edit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-900/5">
                            <h3 class="text-base font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <Link :href="route('blog.index')" class="flex w-full items-center justify-between rounded-lg border border-gray-200 p-3 hover:border-[#99ca3d] hover:bg-[#99ca3d]/5 transition-all group">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 text-purple-600 group-hover:bg-[#99ca3d] group-hover:text-white transition-colors">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </div>
                                        <span class="font-medium text-gray-700 group-hover:text-[#99ca3d]">Write New Article</span>
                                    </div>
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </Link>

                                <Link :href="route('settings.index')" class="flex w-full items-center justify-between rounded-lg border border-gray-200 p-3 hover:border-[#99ca3d] hover:bg-[#99ca3d]/5 transition-all group">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-600 group-hover:bg-[#99ca3d] group-hover:text-white transition-colors">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        </div>
                                        <span class="font-medium text-gray-700 group-hover:text-[#99ca3d]">Site Settings</span>
                                    </div>
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </Link>
                            </div>
                        </div>

                         <div class="rounded-xl bg-gradient-to-br from-gray-900 to-gray-800 p-6 text-white shadow-md">
                            <h3 class="font-semibold text-lg mb-2">System Health</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-xs mb-1 text-gray-400">
                                        <span>Storage</span>
                                        <span>45%</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-1.5">
                                        <div class="bg-[#99ca3d] h-1.5 rounded-full" style="width: 45%"></div>
                                    </div>
                                </div>
                                 <div class="pt-2">
                                     <p class="text-xs text-gray-400">Last Database Backup: <span class="text-gray-200">2 hours ago</span></p>
                                 </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
