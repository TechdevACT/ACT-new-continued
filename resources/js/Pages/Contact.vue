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
                <div class="sm:w-1/3 h-96 animate-fade-right transition-all duration-500">
                    <img :src="images[0]" alt="" class="w-full h-full object-cover rounded-3xl shadow-xl">
                </div>
                <div class="sm:w-2/3 h-96 animate-fade-left transition-all duration-500">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d319.00214362690235!2d106.70355953597587!3d-6.148004831408336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f80daf1bb089%3A0x76961fa10e5e159e!2sKOMPLEKS%20RUKO%20KALIDERES%20MEGAH!5e0!3m2!1sen!2sid!4v1780470520479!5m2!1sen!2sid" class="w-full h-full rounded-3xl shadow-xl" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="grid sm:flex gap-4">
                <div class="sm:w-1/3 animate-fade-right transition-all duration-500">
                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">ADDRESS:</h2>
                        <!-- <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300 font-medium">1234 Creative Street, Suite 567,
                            New
                            York, NY</h3> -->
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300 font-medium">
                            Komp. Ruko Kalideres Megah A/36 Jl. Peta Selatan No.20, RT.10/RW.14, Kalideres, Kec. Kalideres, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11840

                        </h3>
                    </div>

                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">PHONE:</h2>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300 font-medium">(+62-21) 5437 7940</h3>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300 font-medium">(+62-21) 5439 3331</h3>
                    </div>

                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">EMAIL:</h2>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300 font-medium">info@actdisain.com</h3>
                    </div>

                    <div class="grid mb-10">
                        <h2 class="text-lg sm:text-2xl dark:text-white font-bold">BUSSINESS:</h2>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300 font-medium">Mon – Fri: 8Am – 5PM (GMT +7)
                        </h3>
                        <h3 class="text-md sm:text-xl text-gray-600 dark:text-gray-300 font-medium">Sat, Sun, and Public Holiday - Closed
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
                <div class="sm:w-2/3 animate-fade-left transition-all duration-500">
                    <h2 class="text-3xl sm:text-6xl dark:text-white font-bold mb-4">GET IN TOUCH WITH US</h2>
                    <p class="text-xl text-justify font-medium dark:text-gray-300 mb-10">We’d love to hear from you! Whether you have a project
                        in mind,
                        need a quote, or just want to say hello, feel free to reach out. Fill out the form below or use
                        our
                        contact details to connect with us.
                    </p>

                    <form action="">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" class="rounded-xl py-2 px-4 bg-white border border-white shadow-xl"
                                placeholder="Name" disabled>
                            <input type="email" class="rounded-xl py-2 px-4 bg-white border border-white shadow-xl"
                                placeholder="Email" disabled>
                            <input type="text"
                                class="col-span-2 rounded-xl py-2 px-4 bg-white border border-white shadow-xl"
                                placeholder="Title" disabled>
                            <textarea
                                class="col-span-2 h-40 rounded-xl py-2 px-4 bg-white border border-white shadow-xl"
                                placeholder="Message" disabled></textarea>
                            <button
                                class="col-span-2 rounded-xl py-2 px-4 bg-black dark:bg-amber-400 text-white dark:text-black hover:bg-amber-200 dark:hover:bg-amber-500 hover:text-black transition-all duration-500">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
