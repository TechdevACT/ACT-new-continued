<script setup>
import { onMounted, watch } from 'vue';
import { gsap } from 'gsap';

const props = defineProps({
    customClass: {
        type: String,
        default: '',
    },
    images: {
        type: Array,
        default: () => [
            "https://picsum.photos/400/400?grayscale",
            "https://picsum.photos/500/500?grayscale",
            "https://picsum.photos/600/600?grayscale",
            "https://picsum.photos/700/700?grayscale",
            "https://picsum.photos/300/300?grayscale"
        ],
    },
    containerWidth: {
        type: Number,
        default: 400,
    },
    containerHeight: {
        type: Number,
        default: 400,
    },
    animationDelay: {
        type: Number,
        default: 0.5,
    },
    animationStagger: {
        type: Number,
        default: 0.06,
    },
    easeType: {
        type: String,
        default: 'elastic.out(1, 0.8)',
    },
    transformStyles: {
        type: Array,
        default: () => [
            'rotate(10deg) translate(-170px)',
            'rotate(5deg) translate(-85px)',
            'rotate(-3deg)',
            'rotate(-10deg) translate(85px)',
            'rotate(2deg) translate(170px)',
        ],
    },
    enableHover: {
        type: Boolean,
        default: false,
    },
    cardSize: {
        type: Number,
        default: 200,
    },
    hoverOffset: { // Prop baru untuk offset
        type: Number,
        default: 160,
    },
});


const getNoRotationTransform = (transformStr) => {
    const hasRotate = /rotate\([\s\S]*?\)/.test(transformStr);
    if (hasRotate) {
        return transformStr.replace(/rotate\([\s\S]*?\)/, 'rotate(0deg)');
    } else if (transformStr === 'none') {
        return 'rotate(0deg)';
    } else {
        return `${transformStr} rotate(0deg)`;
    }
};

const getPushedTransform = (baseTransform, offsetX) => {
    const translateRegex = /translate\(([-0-9.]+)px\)/;
    const match = baseTransform.match(translateRegex);
    if (match) {
        const currentX = parseFloat(match[1]);
        const newX = currentX + offsetX;
        return baseTransform.replace(translateRegex, `translate(${newX}px)`);
    } else {
        return baseTransform === 'none'
            ? `translate(${offsetX}px)`
            : `${baseTransform} translate(${offsetX}px)`;
    }
};


const pushSiblings = (hoveredIdx) => {
    if (!props.enableHover) return;

    props.images.forEach((_, i) => {
        const selector = `.card-${i}`;
        gsap.killTweensOf(selector);

        const baseTransform = props.transformStyles[i] || 'none';

        if (i === hoveredIdx) {
            const noRotation = getNoRotationTransform(baseTransform);
            gsap.to(selector, {
                transform: noRotation,
                duration: 0.4,
                ease: 'back.out(1.4)',
                overwrite: 'auto',
            });
        } else {
            const offsetX = i < hoveredIdx ? -props.hoverOffset : props.hoverOffset;
            const pushedTransform = getPushedTransform(baseTransform, offsetX);
            const distance = Math.abs(hoveredIdx - i);
            const delay = distance * 0.05;

            gsap.to(selector, {
                transform: pushedTransform,
                duration: 0.4,
                ease: 'back.out(1.4)',
                delay,
                overwrite: 'auto',
            });
        }
    });
};

const resetSiblings = () => {
    if (!props.enableHover) return;

    props.images.forEach((_, i) => {
        const selector = `.card-${i}`;
        gsap.killTweensOf(selector);

        const baseTransform = props.transformStyles[i] || 'none';
        gsap.to(selector, {
            transform: baseTransform,
            duration: 0.4,
            ease: 'back.out(1.4)',
            overwrite: 'auto',
        });
    });
};


const playInitialAnimation = () => {
    gsap.fromTo(
        '.card',
        { scale: 0 },
        {
            scale: 1,
            stagger: props.animationStagger,
            ease: props.easeType,
            delay: props.animationDelay,
        }
    );
};

onMounted(() => {
    playInitialAnimation();
});

watch(
    () => [props.animationDelay, props.animationStagger, props.easeType],
    () => {
        playInitialAnimation();
    }
);
</script>

<template>
    <div :class="['bounce-cards-container', customClass]" :style="{
        width: `${containerWidth}px`,
        height: `${containerHeight}px`,
    }">
        <div v-for="(src, idx) in images" :key="idx" :class="['card', `card-${idx}`]" :style="{
            transform: transformStyles[idx] || 'none',
            width: `${cardSize}px`
        }" @mouseenter="pushSiblings(idx)" @mouseleave="resetSiblings" @touchstart.prevent="pushSiblings(idx)"
            @touchend="resetSiblings" @touchcancel="resetSiblings">
            <img :src="src" :alt="`card-${idx}`" />
        </div>
    </div>
</template>

<style scoped>
.bounce-cards-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    position: absolute;
    aspect-ratio: 1 / 1;
    /* border: 5px solid white; */
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    will-change: transform;
}

.card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
