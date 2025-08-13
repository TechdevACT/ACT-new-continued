<script setup>
import { nextTick, onMounted, ref } from 'vue'
import gsap from 'gsap'

const cursor = ref(null)
const mouse = { x: 0, y: 0 }
const pos = { x: 0, y: 0 }

onMounted(async () => {
    await nextTick()

    window.addEventListener('mousemove', (e) => {
        mouse.x = e.clientX
        mouse.y = e.clientY
    })

    gsap.ticker.add(() => {
        pos.x += (mouse.x - pos.x) * 0.15
        pos.y += (mouse.y - pos.y) * 0.15
        if (cursor.value) {
            gsap.set(cursor.value, { x: pos.x, y: pos.y })
        }
    })


    document.addEventListener('mouseover', (e) => {
        if (e.target.closest('a, button, .cursor-pointer, .group, input, textarea')) {
            gsap.to(cursor.value, {
                scale: 2,
                backgroundColor: '#f7c133',
                opacity: 0.9,
                duration: 0.2,
                ease: 'power3.out',
            })
        }
    })

    document.addEventListener('mouseout', (e) => {
        if (e.target.closest('a, button, .cursor-pointer, .group, input, textarea')) {
            gsap.to(cursor.value, {
                scale: 1,
                backgroundColor: '#fdce79',
                opacity: 0.7,
                duration: 0.2,
                ease: 'power3.out',
            })
        }
    })
})
</script>

<template>
    <div ref="cursor"
        class="hidden sm:block fixed top-0 left-0 w-4 h-4 bg-[#fdce79]/70 rounded-full outline outline-1 outline-[#f7d033]/70 outline-offset-8 pointer-events-none z-[9999]">
    </div>
</template>
