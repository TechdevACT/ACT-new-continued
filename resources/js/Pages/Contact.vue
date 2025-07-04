<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { faBehance, faDribbble, faFacebookF, faInstagram, faXTwitter } from '@fortawesome/free-brands-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const images = [
    'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/Modern-Collaborative-Workspace.webp'
]

const icons = [
    { icon: faFacebookF, link: 'https://www.facebook.com' },
    { icon: faInstagram, link: 'https://www.instagram.com' },
    { icon: faBehance, link: 'https://www.behance.net' },
    { icon: faXTwitter, link: 'https://twitter.com' },
    { icon: faDribbble, link: 'https://dribbble.com' },
]

</script>

<template>
    <DefaultLayout title="Contact -">
        <template #meta>
            <meta name="description" content="Meta Description Here" />
        </template>

        <section class="px-4 mb-10">
            <div class="grid sm:flex gap-4 mb-10">
                <div class="sm:w-1/3 h-96">
                    <img :src="images[0]" alt="" class="w-full h-full object-cover rounded-3xl shadow-xl">
                </div>
                <div class="sm:w-2/3 h-96">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.362476116002!2d112.63348289999999!3d-7.961441200000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629cfeb241105%3A0xce3fb2bbfc3db8ef!2sAct*21%20Digital%20Agency%20Branch%20Malang!5e0!3m2!1sen!2sid!4v1751596705599!5m2!1sen!2sid"
                        class="w-full h-full rounded-3xl shadow-xl" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="grid sm:flex gap-4">
                <div class="sm:w-1/3">
                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">ADDRESS:</h2>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300">1234 Creative Street, Suite 567,
                            New
                            York, NY</h3>
                    </div>

                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">PHONE:</h2>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300">+1 (123) 456-7890</h3>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300">+1 (123) 456-7291</h3>
                    </div>

                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">EMAIL:</h2>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300">info@actdigital.agency</h3>
                    </div>

                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">BUSSINESS:</h2>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300">Monday – Friday: 9 AM – 6 PM
                        </h3>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300">Saturday – Sunday: Closed
                        </h3>
                    </div>
                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">SOCIALS:</h2>
                        <div class="flex mt-2 -ml-3">
                            <a v-for="(icon, index) in icons" :key="index" :href="icon.link" target="_blank"
                                rel="noopener noreferrer"
                                class="group relative w-10 h-10 flex items-center justify-center text-black dark:text-white hover:text-white dark:hover:text-black overflow-hidden rounded-full">
                                <span
                                    class="absolute inset-0 rounded-full scale-0 bg-black dark:bg-white transition-transform duration-300 ease-out group-hover:scale-100 z-0"></span>
                                <FontAwesomeIcon :icon="icon.icon" size="lg" class="relative z-10" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sm:w-2/3">
                    <h2 class="text-6xl dark:text-white font-bold mb-4">GET IN TOUCH WITH US</h2>
                    <p class="text-lg dark:text-gray-300 mb-10">We’d love to hear from you! Whether you have a project
                        in mind,
                        need a
                        quote, or
                        just
                        want to say
                        hello,
                        feel free to reach out. Fill out the form below or use our contact details to connect with us.
                    </p>

                    <form action="">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" class="rounded-xl py-2 px-4 bg-white border border-white shadow-xl"
                                placeholder="Name">
                            <input type="email" class="rounded-xl py-2 px-4 bg-white border border-white shadow-xl"
                                placeholder="Email">
                            <input type="text"
                                class="col-span-2 rounded-xl py-2 px-4 bg-white border border-white shadow-xl"
                                placeholder="Title">
                            <textarea
                                class="col-span-2 h-40 rounded-xl py-2 px-4 bg-white border border-white shadow-xl"
                                placeholder="Message"></textarea>
                            <button
                                class="col-span-2 rounded-xl py-2 px-4 bg-black dark:bg-amber-200 text-white dark:text-black hover:bg-amber-200 dark:hover:bg-amber-400 hover:text-black transition-all duration-500">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
