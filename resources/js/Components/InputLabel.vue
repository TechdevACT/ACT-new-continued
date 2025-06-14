<script setup>
import { InformationCircleIcon } from '@heroicons/vue/24/solid';

defineProps({
    value: String,
    required: { type: Boolean, default: false },
    infoField: { type: String, default: '' },
});
</script>

<template>
    <label class="block text-sm font-medium text-gray-700">
        <div class="flex justify-between items-center gap-1">
            <div>
                <span v-if="value">{{ value }}</span>
                <span v-else>
                    <slot />
                </span>

                <span v-if="required" class="text-red-500">*</span>
            </div>

            <span v-if="infoField" class="group relative cursor-pointer">
                <InformationCircleIcon class="w-4 h-4" />
                <span
                    class="absolute right-full top-1/2 -translate-y-1/2 ms-2 w-max max-w-xs bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                    {{ infoField }}
                </span>
            </span>
        </div>
    </label>
</template>
