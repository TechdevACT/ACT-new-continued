<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const dotEl  = ref(null);
const ringEl = ref(null);

// Mouse positions
let mx = 0, my = 0;

// Ring positions (lerped — slower, creates lag)
let rx = 0, ry = 0;
let prevRX = 0, prevRY = 0;

// Dot positions (lerped — faster)
let dx = 0, dy = 0;

let raf     = null;
let enabled = false;

// ── Lerp helper ───────────────────────────────────────────────────────────────
const lerp = (a, b, t) => a + (b - a) * t;

function onMouseMove(e) {
    mx = e.clientX;
    my = e.clientY;
}

function loop() {
    // Dot follows faster (lerp 0.2)
    dx = lerp(dx, mx, 0.2);
    dy = lerp(dy, my, 0.2);

    // Ring follows slower (lerp 0.1) — creates the lag/magnetic feel
    prevRX = rx;
    prevRY = ry;
    rx = lerp(rx, mx, 0.1);
    ry = lerp(ry, my, 0.1);

    // ── Squash & Stretch for ring ─────────────────────────────────────────────
    const vx       = rx - prevRX;           // velocity vector
    const vy       = ry - prevRY;
    const speed    = Math.hypot(vx, vy);    // total speed
    const angle    = Math.atan2(vy, vx);    // direction of movement (radians)

    // Stretch along movement direction, squash perpendicular
    const maxStretch = 1.6;
    const scaleX = Math.min(maxStretch, 1 + speed * 0.06);
    const scaleY = Math.max(1 / maxStretch, 1 - speed * 0.03);

    if (dotEl.value) {
        dotEl.value.style.left = dx + 'px';
        dotEl.value.style.top  = dy + 'px';
    }

    if (ringEl.value) {
        ringEl.value.style.left = rx + 'px';
        ringEl.value.style.top  = ry + 'px';
        // Apply squash+stretch + rotation toward movement direction
        ringEl.value.style.transform =
            `translate(-50%, -50%) rotate(${angle}rad) scale(${scaleX}, ${scaleY})`;
    }

    raf = requestAnimationFrame(loop);
}

// ── Hover states ─────────────────────────────────────────────────────────────
function onMouseOver(e) {
    if (e.target.closest('a, button, input, select, label, [data-hover]')) {
        ringEl.value?.classList.add('is-hover');
        dotEl.value?.classList.add('is-hover');
    }
}

function onMouseOut(e) {
    if (e.target.closest('a, button, input, select, label, [data-hover]')) {
        ringEl.value?.classList.remove('is-hover');
        dotEl.value?.classList.remove('is-hover');
    }
}

onMounted(() => {
    if (window.matchMedia('(pointer: coarse)').matches) return;
    enabled = true;
    document.documentElement.classList.add('custom-cursor');
    window.addEventListener('mousemove', onMouseMove);
    document.body.addEventListener('mouseover', onMouseOver);
    document.body.addEventListener('mouseout',  onMouseOut);
    raf = requestAnimationFrame(loop);
});

onBeforeUnmount(() => {
    if (!enabled) return;
    document.documentElement.classList.remove('custom-cursor');
    window.removeEventListener('mousemove', onMouseMove);
    document.body.removeEventListener('mouseover', onMouseOver);
    document.body.removeEventListener('mouseout',  onMouseOut);
    if (raf) cancelAnimationFrame(raf);
});
</script>

<template>
    <Teleport to="body">
        <!-- Dot: follows fast -->
        <div ref="dotEl" class="c-dot" />
        <!-- Ring: follows slow + squash/stretch -->
        <div ref="ringEl" class="c-ring" />
    </Teleport>
</template>

<!-- Global: hide default cursor on pointer-fine devices -->
<style>
html.custom-cursor,
html.custom-cursor * {
    cursor: none !important;
}
</style>

<style scoped>
.c-dot,
.c-ring {
    pointer-events: none;
    position: fixed;
    top: 0;
    left: 0;
    border-radius: 50%;
    z-index: 99999;
}

/* ── Dot ─────────────────────────────────────────────────────────────────── */
.c-dot {
    width:  7px;
    height: 7px;
    background: #f59e0b;
    /* Center on cursor */
    transform: translate(-50%, -50%);
    transition: width 180ms ease, height 180ms ease, background 180ms ease;
}

/* ── Ring (squash+stretch handled in JS) ─────────────────────────────────── */
.c-ring {
    width:  36px;
    height: 36px;
    border: 1.5px solid rgba(245, 158, 11, 0.85);
    background: transparent;
    /* transform is fully controlled by JS for squash+stretch */
    transform: translate(-50%, -50%);
    transition: width 200ms ease, height 200ms ease, background 200ms ease, border-color 200ms ease;
}

/* ── Hover state ─────────────────────────────────────────────────────────── */
.c-ring.is-hover {
    width:  52px;
    height: 52px;
    border-color: #f59e0b;
    background: rgba(245, 158, 11, 0.08);
}

.c-dot.is-hover {
    width:  5px;
    height: 5px;
    background: #ffffff;
}

/* Hide on touch devices */
@media (pointer: coarse) {
    .c-dot, .c-ring { display: none; }
}
</style>