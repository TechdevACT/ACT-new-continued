<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
  industries: {
    type: Array,
    required: true,
  },
  text: {
    type: Array,
  }
})

const displayedIndustries = ref([])

const loadMoreIndustries = () => {
  displayedIndustries.value = props.industries
}

watch(
  () => props.industries,
  (newVal) => {
    if (newVal && newVal.length > 0) {
      displayedIndustries.value = newVal.slice(0, 3)
    }
  },
  { immediate: true }
)

</script>

<template>
    <div class="mx-auto max-w-7xl flex-grow transition-colors duration-500 w-full">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 ">
            <h3 class="text-md sm:text-2xl text-white">/ {{ text[0] }}</h3>
            <div class="sm:col-span-2 flex flex-col gap-4 sm:items-end sm:text-end text-white">
                <h3 class="sm:w-3/4 text-4xl sm:text-6xl font-bold">{{ text[1] }}</h3>
                <h4 class="sm:w-3/4 text-lg sm:text-xl">{{ text[2] }}</h4>
            </div>
        </div>

        <div class="flex flex-col justify-center">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 my-10">
                <div v-for="(industry, index) in displayedIndustries" :key="index" class="rounded-2xl">
                    <img :src="industry" class="w-full rounded-2xl animate-fade-up">
                </div>
            </div>

            <div class="flex w-full justify-center" v-if="displayedIndustries.length < industries.length">
                <button @click="loadMoreIndustries"
                    class="group relative inline-flex items-center justify-center overflow-hidden rounded-full bg-yellow-400 px-8 py-3 font-medium text-black transition-all duration-500 hover:text-white dark:text-black">
                    <div
                        class="absolute inset-0 h-full w-0 bg-black transition-all duration-500 ease-out group-hover:w-full dark:bg-white">
                    </div>
                    <span class="relative flex items-center">
                        Load More
                        <span class="ml-3 flex items-center gap-1">
                            <span
                                class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400 dark:bg-black group-hover:dark:bg-black"></span>
                            <span
                                class="h-2 w-2 rounded-full bg-black transition-colors duration-500 group-hover:bg-yellow-400 dark:bg-black group-hover:dark:bg-black"></span>
                        </span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</template>
