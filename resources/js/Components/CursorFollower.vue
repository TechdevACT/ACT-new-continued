<script setup>
import { onMounted, ref } from 'vue'
import gsap from 'gsap'

const cursor = ref(null)
const mouse = { x: 0, y: 0 }
const pos = { x: 0, y: 0 }

onMounted(() => {
    window.addEventListener('mousemove', (e) => {
        mouse.x = e.clientX
        mouse.y = e.clientY
    })

    gsap.ticker.add(() => {
        pos.x += (mouse.x - pos.x) * 0.15
        pos.y += (mouse.y - pos.y) * 0.15
        gsap.set(cursor.value, { x: pos.x, y: pos.y })
    })

    document.addEventListener('mouseover', (e) => {
        if (e.target.closest('.cursor-pointer')) {
            gsap.to(cursor.value, {
                scale: 1.3,
                backgroundColor: '#f7c133',
                opacity: 0.9,
                duration: 0.2,
                ease: 'power3.out',
            })
        }
    })

    document.addEventListener('mouseout', (e) => {
        if (e.target.closest('.cursor-pointer')) {
            gsap.to(cursor.value, {
                scale: 1,
                backgroundColor: '#f7d033',
                opacity: 0.7,
                duration: 0.2,
                ease: 'power3.out',
            })
        }
    })
})
</script>

<template>
    <div ref="cursor" class="fixed top-0 left-0 w-8 h-8 bg-[#f7d033]/70 rounded-full pointer-events-none z-[9999]"></div>
</template>

