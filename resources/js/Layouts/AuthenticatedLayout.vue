<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const navClasses = (active) =>
  active
    ? 'inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-[#99ca3d] rounded-lg shadow-sm'
    : 'inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 hover:text-[#99ca3d] hover:bg-[#99ca3d]/10 rounded-lg transition-colors';
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">

    <div class="fixed inset-0 -z-10 overflow-hidden">
      <div class="absolute -top-40 -right-40 h-80 w-80 rounded-full bg-[#99ca3d]/20 blur-3xl"></div>
      <div class="absolute -bottom-40 -left-40 h-96 w-96 rounded-full bg-[#99ca3d]/20 blur-3xl"></div>
    </div>

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200 shadow-sm">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

          <div class="flex items-center gap-8">
            <Link :href="route('dashboard')" class="flex items-center gap-2">
              <ApplicationLogo class="h-9 w-auto fill-current text-[#99ca3d]" />
              <span class="hidden lg:block text-lg font-bold text-slate-900">ActNew!</span>
            </Link>

            <div class="hidden lg:flex items-center gap-1">
              <Link :href="route('dashboard')" :class="navClasses(route().current('dashboard'))">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
              </Link>

              <Link :href="route('projectsSetting.index')" :class="navClasses(route().current('projectsSetting.index'))">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Projects
              </Link>

              <Link :href="route('blog.index')" :class="navClasses(route().current('blog.index'))">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Blog
              </Link>

              <Link :href="route('settings.index')" :class="navClasses(route().current('settings.index') || route().current('settings.edit'))">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Settings
              </Link>
            </div>
          </div>

          <div class="hidden lg:block">
            <Dropdown align="right" width="48">
              <template #trigger>
                <button class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-1.5 hover:border-[#99ca3d] hover:shadow-md transition-all">
                  <img v-if="$page.props.auth.user.avatar"
                    class="h-8 w-8 rounded-lg object-cover"
                    :src="$page.props.auth.user.avatar"
                    :alt="$page.props.auth.user.name">
                  <div v-else class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#99ca3d] text-sm font-bold text-white">
                    {{ $page.props.auth.user.name.charAt(0) }}
                  </div>
                  <span class="hidden xl:block text-sm font-medium text-slate-700">{{ $page.props.auth.user.name }}</span>
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
              </template>

              <template #content>
                <div class="px-4 py-3 border-b border-slate-100">
                  <p class="text-sm font-medium text-slate-900">{{ $page.props.auth.user.name }}</p>
                  <p class="text-xs text-slate-500 truncate">{{ $page.props.auth.user.email }}</p>
                </div>

                <DropdownLink :href="route('profile.edit')" class="flex items-center gap-2 px-4 py-2 text-sm">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  Profile
                </DropdownLink>

                <DropdownLink :href="route('logout')" method="post" as="button" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                  </svg>
                  Sign Out
                </DropdownLink>
              </template>
            </Dropdown>
          </div>

          <button @click="showingNavigationDropdown = !showingNavigationDropdown"
            class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="lg:hidden border-t border-slate-200 bg-white">
        <div class="space-y-1 px-4 py-3">
          <Link :href="route('dashboard')"
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-base font-medium"
            :class="route().current('dashboard') ? 'bg-[#99ca3d]/10 text-[#99ca3d]' : 'text-slate-600 hover:bg-slate-50'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
          </Link>

          <Link :href="route('projectsSetting.index')"
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-base font-medium"
            :class="route().current('projectsSetting.index') ? 'bg-[#99ca3d]/10 text-[#99ca3d]' : 'text-slate-600 hover:bg-slate-50'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            Projects
          </Link>

          <Link :href="route('blog.index')"
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-base font-medium"
            :class="route().current('blog.index') ? 'bg-[#99ca3d]/10 text-[#99ca3d]' : 'text-slate-600 hover:bg-slate-50'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Blog
          </Link>

          <Link :href="route('settings.index')"
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-base font-medium"
            :class="(route().current('settings.index') || route().current('settings.edit')) ? 'bg-[#99ca3d]/10 text-[#99ca3d]' : 'text-slate-600 hover:bg-slate-50'">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Settings
          </Link>
        </div>

        <div class="border-t border-slate-200 bg-slate-50 p-4">
          <div class="flex items-center gap-3 mb-3">
            <img v-if="$page.props.auth.user.avatar"
              class="h-10 w-10 rounded-lg object-cover"
              :src="$page.props.auth.user.avatar"
              alt="">
            <div v-else class="h-10 w-10 rounded-lg bg-[#99ca3d] flex items-center justify-center text-white font-bold">
              {{ $page.props.auth.user.name.charAt(0) }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-semibold text-slate-900 truncate">{{ $page.props.auth.user.name }}</p>
              <p class="text-xs text-slate-500 truncate">{{ $page.props.auth.user.email }}</p>
            </div>
          </div>

          <div class="space-y-1">
            <Link :href="route('profile.edit')"
              class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-white">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Profile
            </Link>
            <Link :href="route('logout')" method="post" as="button"
              class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              Sign Out
            </Link>
          </div>
        </div>
      </div>
    </nav>

    <header v-if="$slots.header" class="bg-transparent">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-slate-900">
          <slot name="header" />
        </h1>
      </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-12">
      <slot />
    </main>
  </div>
</template>

<style scoped>
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
  background: #94a3b8;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #64748b;
}
</style>
