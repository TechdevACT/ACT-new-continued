<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

const props = defineProps({
    images: {
        type: Array,
        required: true
    }
})

const lightboxOpen = ref(false)
const currentIndex = ref(0)

const openLightbox = (index) => {
    currentIndex.value = index
    lightboxOpen.value = true
}

const closeLightbox = () => {
    lightboxOpen.value = false
}

const prevImage = () => {
    currentIndex.value =
        (currentIndex.value - 1 + props.images.length) % props.images.length
}

const nextImage = () => {
    currentIndex.value = (currentIndex.value + 1) % props.images.length
}

const handleKeydown = (e) => {
    if (!lightboxOpen.value) return
    if (e.key === "Escape") closeLightbox()
    if (e.key === "ArrowLeft") prevImage()
    if (e.key === "ArrowRight") nextImage()
}

onMounted(() => {
    window.addEventListener("keydown", handleKeydown)
})

onBeforeUnmount(() => {
    window.removeEventListener("keydown", handleKeydown)
})
</script>

<template>
    <section>
        <div class="grid grid-cols-3 sm:grid-cols-3 gap-10">
            <div v-for="(image, index) in images" :key="index" @click="openLightbox(index)"
                class="cursor-pointer rounded-2xl overflow-hidden hover:scale-105 transition duration-300 ease-in-out flex items-center">
                <img :src="`/storage/` + image" class="mx-auto block max-w-auto shadow-xl h-auto rounded-3xl" alt="project gallery" />
            </div>
        </div>
    </section>

    <!-- LIGHTBOX -->
    <transition name="fade">
        <div v-if="lightboxOpen" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50"
            @click.self="closeLightbox">
            <button @click="closeLightbox" class="absolute top-5 right-5 text-white text-3xl font-bold">
                ✕
            </button>

            <button @click="prevImage"
                class="absolute left-5 text-white text-4xl font-bold px-4 py-2 bg-black/40 rounded-full hover:bg-black/70">
                ‹
            </button>

            <img :src="`/storage/` + images[currentIndex]"
                class="max-h-[90vh] max-w-[90vw] rounded-4xl shadow-2xl transition-all duration-500" />

            <button @click="nextImage"
                class="absolute right-5 text-white text-4xl font-bold px-4 py-2 bg-black/40 rounded-full hover:bg-black/70">
                ›
            </button>
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
