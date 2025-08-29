<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

// Posisi target mouse (posisi asli kursor)
const targetX = ref(0);
const targetY = ref(0);

// Posisi follower saat ini (akan bergerak secara bertahap ke target)
const followerX = ref(0);
const followerY = ref(0);

const dampingFactor = 0.1; // Seberapa cepat follower mengejar kursor (0.01 - 1.0)

// Fungsi untuk memperbarui posisi target saat mouse bergerak.
const updateMousePosition = (event) => {
    targetX.value = event.clientX;
    targetY.value = event.clientY;
};

// Fungsi untuk "lerping" follower ke posisi target
const animateFollower = () => {
    // Lerp followerX ke targetX
    followerX.value += (targetX.value - followerX.value) * dampingFactor;
    // Lerp followerY ke targetY
    followerY.value += (targetY.value - followerY.value) * dampingFactor;

    // Lakukan requestAnimationFrame lagi untuk frame berikutnya
    requestAnimationFrame(animateFollower);
};

onMounted(() => {
    window.addEventListener('mousemove', updateMousePosition);
    // Mulai animasi saat komponen di-mount
    requestAnimationFrame(animateFollower);
});

onUnmounted(() => {
    window.removeEventListener('mousemove', updateMousePosition);
});
</script>

<template>
    <div :style="{ transform: `translate(${followerX}px, ${followerY}px)` }"
        class="fixed w-8 h-8 bg-yellow-400/30 rounded-full pointer-events-none -translate-x-1/2 -translate-y-1/2 z-50 hidden md:block">
    </div>
</template>