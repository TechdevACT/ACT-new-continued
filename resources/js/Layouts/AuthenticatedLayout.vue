<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

// Modern navigation styling dengan glassmorphism effect
const navClasses = (active) =>
  active
    ? 'relative inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-300 before:absolute before:inset-0 before:rounded-xl before:bg-gradient-to-r before:from-indigo-500 before:to-purple-500 before:shadow-lg before:shadow-indigo-500/30'
    : 'relative inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-slate-600 transition-all duration-300 hover:text-slate-900 hover:before:absolute hover:before:inset-0 hover:before:rounded-xl hover:before:bg-slate-100';
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100">

    <!-- Animated Background Elements -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
      <div class="absolute -top-40 -right-40 h-80 w-80 rounded-full bg-gradient-to-br from-indigo-200/40 to-purple-200/40 blur-3xl animate-pulse"></div>
      <div class="absolute -bottom-40 -left-40 h-96 w-96 rounded-full bg-gradient-to-tr from-blue-200/30 to-cyan-200/30 blur-3xl animate-pulse delay-1000"></div>
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-96 w-96 rounded-full bg-gradient-to-r from-purple-200/20 to-pink-200/20 blur-3xl animate-pulse delay-500"></div>
    </div>

    <!-- Modern Navbar with Glassmorphism -->
    <nav class="sticky top-0 z-50 border-b border-white/20 bg-white/70 backdrop-blur-2xl shadow-sm transition-all">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

          <!-- Logo & Navigation -->
          <div class="flex items-center gap-12">
            <!-- Logo with Modern Animation -->
            <Link :href="route('dashboard')" class="group flex items-center gap-3 transition-all duration-300">
              <div class="relative">
                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 opacity-0 blur-lg transition-opacity duration-300 group-hover:opacity-50"></div>
                <ApplicationLogo class="relative block h-10 w-auto fill-current text-indigo-600 transition-transform duration-300 group-hover:scale-110" />
              </div>
              <span class="hidden text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent lg:block">
                ActNew!
              </span>
            </Link>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-2">
              <Link :href="route('dashboard')" :class="navClasses(route().current('dashboard'))">
                <span :class="route().current('dashboard') ? 'relative z-10' : ''">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                  </svg>
                </span>
                <span :class="route().current('dashboard') ? 'relative z-10' : ''">Dashboard</span>
              </Link>

              <Link :href="route('projectsSetting.index')" :class="navClasses(route().current('projectsSetting.index'))">
                <span :class="route().current('projectsSetting.index') ? 'relative z-10' : ''">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                  </svg>
                </span>
                <span :class="route().current('projectsSetting.index') ? 'relative z-10' : ''">Projects</span>
              </Link>

              <Link :href="route('blog.index')" :class="navClasses(route().current('blog.index'))">
                <span :class="route().current('blog.index') ? 'relative z-10' : ''">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </span>
                <span :class="route().current('blog.index') ? 'relative z-10' : ''">Blog</span>
              </Link>

              <Link :href="route('settings.index')" :class="navClasses(route().current('settings.index') || route().current('settings.edit'))">
                <span :class="(route().current('settings.index') || route().current('settings.edit')) ? 'relative z-10' : ''">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </span>
                <span :class="(route().current('settings.index') || route().current('settings.edit')) ? 'relative z-10' : ''">Settings</span>
              </Link>
            </div>
          </div>

          <!-- Right Section: Notifications & Profile -->
          <div class="hidden lg:flex items-center gap-4">
            <!-- Profile Dropdown -->
            <div class="relative">
              <Dropdown align="right" width="56">
                <template #trigger>
                  <button type="button" class="group flex items-center gap-3 rounded-2xl border border-slate-200/60 bg-white/80 py-2 pl-2 pr-4 transition-all duration-300 hover:border-indigo-300 hover:shadow-lg hover:shadow-indigo-500/10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">

                    <!-- Avatar with Status Indicator -->
                    <div class="relative">
                      <img v-if="$page.props.auth.user.avatar"
                        class="h-9 w-9 rounded-xl object-cover ring-2 ring-white shadow-sm"
                        :src="$page.props.auth.user.avatar"
                        :alt="$page.props.auth.user.name">
                      <div v-else class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 text-sm font-bold text-white ring-2 ring-white shadow-sm">
                        {{ $page.props.auth.user.name.charAt(0) }}
                      </div>
                      <!-- Online Status -->
                      <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full bg-green-500 ring-2 ring-white"></span>
                    </div>

                    <!-- User Info -->
                    <div class="hidden text-left xl:block">
                      <p class="text-sm font-semibold text-slate-800">{{ $page.props.auth.user.name }}</p>
                      <p class="text-xs text-slate-500">Administrator</p>
                    </div>

                    <!-- Chevron -->
                    <svg class="h-4 w-4 text-slate-400 transition-transform duration-300 group-hover:text-indigo-500 group-hover:translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                </template>

                <template #content>
                  <!-- User Info Header -->
                  <div class="px-4 py-3 bg-gradient-to-br from-indigo-50 to-purple-50 border-b border-slate-100">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Signed in as</p>
                    <p class="text-sm font-bold text-slate-800 truncate mt-0.5">{{ $page.props.auth.user.email }}</p>
                  </div>

                  <!-- Menu Items -->
                  <div class="py-2">
                    <DropdownLink :href="route('profile.edit')" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-slate-50">
                      <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                      Profile Settings
                    </DropdownLink>

                    <div class="my-2 border-t border-slate-100"></div>

                    <DropdownLink :href="route('logout')" method="post" as="button" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 w-full">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                      </svg>
                      Sign Out
                    </DropdownLink>
                  </div>
                </template>
              </Dropdown>
            </div>
          </div>

          <!-- Mobile Menu Button -->
          <button @click="showingNavigationDropdown = !showingNavigationDropdown"
            class="lg:hidden rounded-xl p-2.5 text-slate-600 transition-all duration-300 hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Navigation Menu -->
      <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="lg:hidden border-t border-slate-100 bg-white/95 backdrop-blur-xl">
        <div class="space-y-1 px-4 py-4">
          <Link :href="route('dashboard')" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium transition-all"
            :class="route().current('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
          </Link>

          <Link :href="route('projectsSetting.index')" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium transition-all"
            :class="route().current('projectsSetting.index') ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Projects
          </Link>

          <Link :href="route('blog.index')" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium transition-all"
            :class="route().current('blog.index') ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Blog
          </Link>

          <Link :href="route('settings.index')" class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium transition-all"
            :class="(route().current('settings.index') || route().current('settings.edit')) ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Settings
          </Link>
        </div>

        <!-- Mobile Profile Section -->
        <div class="border-t border-slate-100 bg-gradient-to-br from-slate-50 to-white p-4">
          <div class="flex items-center gap-3 mb-4">
            <div class="relative">
              <img v-if="$page.props.auth.user.avatar" class="h-12 w-12 rounded-xl object-cover ring-2 ring-white shadow-sm" :src="$page.props.auth.user.avatar" alt="">
              <div v-else class="h-12 w-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-lg ring-2 ring-white shadow-sm">
                {{ $page.props.auth.user.name.charAt(0) }}
              </div>
              <span class="absolute -bottom-0.5 -right-0.5 h-3.5 w-3.5 rounded-full bg-green-500 ring-2 ring-white"></span>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-base font-bold text-slate-800 truncate">{{ $page.props.auth.user.name }}</p>
              <p class="text-sm text-slate-500 truncate">{{ $page.props.auth.user.email }}</p>
            </div>
          </div>

          <div class="space-y-2">
            <Link :href="route('profile.edit')" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-white hover:text-slate-900 hover:shadow-sm transition-all">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Profile Settings
            </Link>
            <Link :href="route('logout')" method="post" as="button" class="flex w-full items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 transition-all">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              Sign Out
            </Link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header v-if="$slots.header" class="bg-transparent">
      <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4">
          <div class="h-12 w-1 rounded-full bg-gradient-to-b from-indigo-500 to-purple-500"></div>
          <h1 class="text-3xl font-bold tracking-tight bg-gradient-to-r from-slate-900 to-slate-600 bg-clip-text text-transparent">
            <slot name="header" />
          </h1>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-12">
      <div class="animate-fade-in-up">
        <slot />
      </div>
    </main>
  </div>
</template>

<style scoped>
/* Enhanced Animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* Smooth Transitions */
* {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Custom Scrollbar */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #6366f1, #a855f7);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #4f46e5, #9333ea);
}
</style>
