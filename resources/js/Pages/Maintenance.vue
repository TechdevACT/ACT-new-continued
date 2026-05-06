<script setup>
import { Head, router } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';

const showPasswordModal = ref(false);
const password = ref('');
const error = ref('');
const isLoading = ref(false);
const clickCount = ref(0);
let clickTimer = null;

// Triple-click logo to reveal password modal
const handleLogoClick = () => {
    clickCount.value++;
    clearTimeout(clickTimer);
    clickTimer = setTimeout(() => {
        clickCount.value = 0;
    }, 600);

    if (clickCount.value >= 3) {
        clickCount.value = 0;
        showPasswordModal.value = true;
    }
};

const submitPassword = () => {
    if (!password.value.trim()) return;
    isLoading.value = true;
    error.value = '';

    router.post('/maintenance-bypass', {
        password: password.value
    }, {
        onSuccess: () => {
            // Redirect handled by server
        },
        onError: (errors) => {
            error.value = errors.password || 'Incorrect password';
            isLoading.value = false;
        },
        onFinish: () => {
            isLoading.value = false;
        }
    });
};

const closeModal = () => {
    showPasswordModal.value = false;
    password.value = '';
    error.value = '';
};

// Keyboard shortcut: Ctrl+Shift+M to open modal
const handleKeydown = (e) => {
    if (e.ctrlKey && e.shiftKey && e.key === 'M') {
        e.preventDefault();
        showPasswordModal.value = true;
    }
    if (e.key === 'Escape') {
        closeModal();
    }
};

// Floating particles animation
const particles = ref([]);
const generateParticles = () => {
    const arr = [];
    for (let i = 0; i < 50; i++) {
        arr.push({
            id: i,
            x: Math.random() * 100,
            y: Math.random() * 100,
            size: Math.random() * 4 + 1,
            duration: Math.random() * 20 + 10,
            delay: Math.random() * 10,
            opacity: Math.random() * 0.5 + 0.1,
        });
    }
    particles.value = arr;
};

onMounted(() => {
    generateParticles();
    document.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
    document.removeEventListener('keydown', handleKeydown);
});
</script>

<template>
    <Head>
        <title>Under Maintenance — act! digital agency</title>
        <meta name="description" content="We're currently performing scheduled maintenance. We'll be right back!" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </Head>

    <div class="maintenance-page">
        <!-- Animated Background -->
        <div class="background-layer">
            <div class="gradient-orb orb-1"></div>
            <div class="gradient-orb orb-2"></div>
            <div class="gradient-orb orb-3"></div>
        </div>

        <!-- Floating Particles -->
        <div class="particles-container">
            <div
                v-for="p in particles"
                :key="p.id"
                class="particle"
                :style="{
                    left: p.x + '%',
                    top: p.y + '%',
                    width: p.size + 'px',
                    height: p.size + 'px',
                    opacity: p.opacity,
                    animationDuration: p.duration + 's',
                    animationDelay: p.delay + 's',
                }"
            />
        </div>

        <!-- Grid Overlay -->
        <div class="grid-overlay"></div>

        <!-- Main Content -->
        <div class="content-wrapper">
            <!-- Logo -->
            <div class="logo-container" @click="handleLogoClick">
                <div class="logo-glow"></div>
                <img src="/images/logo.png" alt="ACT Digital" class="logo-img" />
            </div>

            <!-- Badge -->
            <div class="status-badge">
                <span class="pulse-dot"></span>
                <span class="badge-text">Under Maintenance</span>
            </div>

            <!-- Main Heading -->
            <h1 class="main-heading">
                <span class="heading-line line-1">We'll be</span>
                <span class="heading-line line-2">right back<span class="accent-dot">.</span></span>
            </h1>

            <!-- Description -->
            <p class="description">
                We're working hard to improve your experience. Our site is currently
                undergoing scheduled maintenance. Thank you for your patience.
            </p>

            <!-- Animated Divider -->
            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                    </svg>
                </div>
                <div class="divider-line"></div>
            </div>

            <!-- Countdown / Info Boxes -->
            <div class="info-boxes">
                <div class="info-box">
                    <div class="info-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="info-text">
                        <span class="info-label">Estimated Downtime</span>
                        <span class="info-value">A few days</span>
                    </div>
                </div>
                <div class="info-box">
                    <div class="info-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="info-text">
                        <span class="info-label">Contact Us</span>
                        <span class="info-value">info@actdisain.com</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="maintenance-footer">
                <p>© {{ new Date().getFullYear() }} act! digital agency. All rights reserved.</p>
            </div>
        </div>

        <!-- Password Modal -->
        <Teleport to="body">
            <Transition name="modal">
                <div v-if="showPasswordModal" class="modal-overlay" @click.self="closeModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                            <h2>Access Required</h2>
                            <p>Enter the maintenance bypass password</p>
                        </div>

                        <form @submit.prevent="submitPassword" class="modal-form">
                            <div class="input-group" :class="{ 'has-error': error }">
                                <input
                                    v-model="password"
                                    type="password"
                                    placeholder="Enter password..."
                                    class="password-input"
                                    autofocus
                                />
                                <Transition name="error-slide">
                                    <span v-if="error" class="error-message">{{ error }}</span>
                                </Transition>
                            </div>

                            <div class="modal-actions">
                                <button type="button" class="btn-cancel" @click="closeModal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn-submit" :disabled="isLoading || !password.trim()">
                                    <span v-if="isLoading" class="spinner"></span>
                                    <span v-else>Unlock</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </Transition>
        </Teleport>
    </div>
</template>

<style scoped>
/* ========================================
   BASE STYLES
   ======================================== */
.maintenance-page {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    background: #0a0a0f;
    color: #ffffff;
}

/* ========================================
   ANIMATED BACKGROUND
   ======================================== */
.background-layer {
    position: absolute;
    inset: 0;
    overflow: hidden;
    z-index: 0;
}

.gradient-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.3;
}

.orb-1 {
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, #99CA3D 0%, transparent 70%);
    top: -200px;
    right: -100px;
    animation: orbFloat1 15s ease-in-out infinite;
}

.orb-2 {
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, #6366f1 0%, transparent 70%);
    bottom: -100px;
    left: -100px;
    animation: orbFloat2 20s ease-in-out infinite;
}

.orb-3 {
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, #99CA3D 0%, transparent 70%);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: orbFloat3 18s ease-in-out infinite;
}

@keyframes orbFloat1 {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(-80px, 60px) scale(1.1); }
    66% { transform: translate(40px, -40px) scale(0.9); }
}

@keyframes orbFloat2 {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(60px, -80px) scale(1.15); }
    66% { transform: translate(-40px, 30px) scale(0.85); }
}

@keyframes orbFloat3 {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.2; }
    50% { transform: translate(-50%, -50%) scale(1.3); opacity: 0.4; }
}

/* ========================================
   PARTICLES
   ======================================== */
.particles-container {
    position: absolute;
    inset: 0;
    z-index: 1;
    pointer-events: none;
}

.particle {
    position: absolute;
    background: #99CA3D;
    border-radius: 50%;
    animation: particleFloat linear infinite;
}

@keyframes particleFloat {
    0% { transform: translateY(0) translateX(0); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-100vh) translateX(20px); opacity: 0; }
}

/* ========================================
   GRID OVERLAY
   ======================================== */
.grid-overlay {
    position: absolute;
    inset: 0;
    z-index: 1;
    background-image:
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
}

/* ========================================
   CONTENT
   ======================================== */
.content-wrapper {
    position: relative;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 2rem;
    max-width: 720px;
    animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ========================================
   LOGO
   ======================================== */
.logo-container {
    position: relative;
    margin-bottom: 2.5rem;
    cursor: pointer;
    user-select: none;
    -webkit-user-select: none;
}

.logo-glow {
    position: absolute;
    inset: -20px;
    background: radial-gradient(circle, rgba(153, 202, 61, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    animation: logoGlow 3s ease-in-out infinite;
}

@keyframes logoGlow {
    0%, 100% { opacity: 0.5; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.2); }
}

.logo-img {
    width: 80px;
    height: 80px;
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 0 20px rgba(153, 202, 61, 0.4));
    transition: transform 0.3s ease;
}

.logo-container:hover .logo-img {
    transform: scale(1.1);
}

/* ========================================
   STATUS BADGE
   ======================================== */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    background: rgba(153, 202, 61, 0.1);
    border: 1px solid rgba(153, 202, 61, 0.25);
    border-radius: 100px;
    margin-bottom: 2rem;
    animation: fadeInUp 1s ease-out 0.2s both;
}

.pulse-dot {
    width: 8px;
    height: 8px;
    background: #99CA3D;
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(153, 202, 61, 0.6); }
    50% { opacity: 0.8; box-shadow: 0 0 0 8px rgba(153, 202, 61, 0); }
}

.badge-text {
    font-size: 0.85rem;
    font-weight: 500;
    color: #99CA3D;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

/* ========================================
   HEADING
   ======================================== */
.main-heading {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    margin-bottom: 1.5rem;
}

.heading-line {
    font-size: clamp(2.5rem, 8vw, 4.5rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.03em;
}

.line-1 {
    color: rgba(255, 255, 255, 0.6);
    animation: fadeInUp 1s ease-out 0.3s both;
}

.line-2 {
    color: #ffffff;
    animation: fadeInUp 1s ease-out 0.4s both;
}

.accent-dot {
    color: #99CA3D;
}

/* ========================================
   DESCRIPTION
   ======================================== */
.description {
    font-size: 1.1rem;
    line-height: 1.7;
    color: rgba(255, 255, 255, 0.5);
    max-width: 520px;
    margin-bottom: 2.5rem;
    animation: fadeInUp 1s ease-out 0.5s both;
}

/* ========================================
   DIVIDER
   ======================================== */
.divider {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2.5rem;
    width: 100%;
    max-width: 400px;
    animation: fadeInUp 1s ease-out 0.6s both;
}

.divider-line {
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(153, 202, 61, 0.3), transparent);
}

.divider-icon {
    color: rgba(153, 202, 61, 0.5);
    animation: spin 8s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* ========================================
   INFO BOXES
   ======================================== */
.info-boxes {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 3rem;
    animation: fadeInUp 1s ease-out 0.7s both;
    flex-wrap: wrap;
    justify-content: center;
}

.info-box {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 24px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.info-box:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(153, 202, 61, 0.2);
    transform: translateY(-2px);
}

.info-icon {
    color: #99CA3D;
    flex-shrink: 0;
}

.info-text {
    display: flex;
    flex-direction: column;
    text-align: left;
}

.info-label {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.4);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.info-value {
    font-size: 0.95rem;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.8);
}

/* ========================================
   FOOTER
   ======================================== */
.maintenance-footer {
    animation: fadeInUp 1s ease-out 0.8s both;
}

.maintenance-footer p {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.25);
}

/* ========================================
   MODAL
   ======================================== */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    padding: 1rem;
}

.modal-content {
    background: #16161e;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 2.5rem;
    width: 100%;
    max-width: 420px;
    box-shadow:
        0 25px 50px rgba(0, 0, 0, 0.5),
        0 0 100px rgba(153, 202, 61, 0.05);
}

.modal-header {
    text-align: center;
    margin-bottom: 2rem;
}

.modal-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    border-radius: 16px;
    background: rgba(153, 202, 61, 0.1);
    color: #99CA3D;
    margin-bottom: 1rem;
}

.modal-header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 0.5rem;
}

.modal-header p {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.4);
}

.modal-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.input-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.password-input {
    width: 100%;
    padding: 14px 18px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 12px;
    color: #ffffff;
    font-size: 1rem;
    font-family: 'Inter', sans-serif;
    outline: none;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.password-input:focus {
    border-color: #99CA3D;
    box-shadow: 0 0 0 3px rgba(153, 202, 61, 0.15);
}

.password-input::placeholder {
    color: rgba(255, 255, 255, 0.25);
}

.has-error .password-input {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
}

.error-message {
    font-size: 0.8rem;
    color: #ef4444;
    padding-left: 4px;
}

.modal-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-cancel,
.btn-submit {
    flex: 1;
    padding: 12px 20px;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 600;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
}

.btn-cancel {
    background: rgba(255, 255, 255, 0.06);
    color: rgba(255, 255, 255, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.btn-cancel:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

.btn-submit {
    background: #99CA3D;
    color: #0a0a0f;
}

.btn-submit:hover:not(:disabled) {
    background: #aad84f;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(153, 202, 61, 0.3);
}

.btn-submit:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.spinner {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: 2px solid rgba(10, 10, 15, 0.3);
    border-top-color: #0a0a0f;
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
}

/* ========================================
   MODAL TRANSITIONS
   ======================================== */
.modal-enter-active {
    transition: opacity 0.3s ease;
}
.modal-enter-active .modal-content {
    transition: transform 0.3s ease, opacity 0.3s ease;
}
.modal-leave-active {
    transition: opacity 0.2s ease;
}
.modal-leave-active .modal-content {
    transition: transform 0.2s ease, opacity 0.2s ease;
}

.modal-enter-from {
    opacity: 0;
}
.modal-enter-from .modal-content {
    transform: scale(0.95) translateY(10px);
    opacity: 0;
}
.modal-leave-to {
    opacity: 0;
}
.modal-leave-to .modal-content {
    transform: scale(0.95) translateY(10px);
    opacity: 0;
}

.error-slide-enter-active {
    transition: all 0.3s ease;
}
.error-slide-leave-active {
    transition: all 0.2s ease;
}
.error-slide-enter-from,
.error-slide-leave-to {
    opacity: 0;
    transform: translateY(-5px);
}

/* ========================================
   RESPONSIVE
   ======================================== */
@media (max-width: 640px) {
    .content-wrapper {
        padding: 1.5rem;
    }

    .logo-img {
        width: 60px;
        height: 60px;
    }

    .info-boxes {
        flex-direction: column;
        width: 100%;
    }

    .info-box {
        width: 100%;
        justify-content: center;
    }

    .modal-content {
        padding: 1.5rem;
        border-radius: 20px;
    }
}
</style>
