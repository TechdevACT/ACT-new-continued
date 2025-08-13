<script setup>
import SecondLayout from '@/Layouts/SecondLayout.vue';
import { faFacebookF, faInstagram, faXTwitter } from '@fortawesome/free-brands-svg-icons';
import { faLink } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

</script>

<template>
    <SecondLayout>
        <section>
            <div class="animate-fade-up py-10 px-4">
                <img src="https://placehold.co/1080x500" alt="" class="w-full rounded-3xl">
            </div>

            <div class="flex flex-col gap-4 max-w-3xl mx-auto animate-fade-up pb-10 px-4">
                <h1 class="text-3xl sm:text-4xl font-bold">A Guide to Online Privacy in 2024 (new conditions)</h1>
                <div class="flex gap-2 text-sm">
                    <span>Author: </span>
                    <span class="font-bold">John Doe</span>
                    |
                    <span>Date: </span>
                    <span class="font-bold">12 Aug, 2025</span>
                </div>
                <p class="text-xl text-justify">
                    Online privacy has become a major concern in recent years as more of our personal information is
                    being
                    shared online. It is critical for internet users to take proactive steps to safeguard their digital
                    identities and protect their personal information. This comprehensive guide to online privacy will
                    provide you with essential tips and tricks to keep your information safe while browsing the
                    internet.<br><br>

                    One of the most important things you can do to protect your privacy online is to use strong, unique
                    passwords for all your online accounts. This can help make your accounts more resistant to potential
                    cyber threats. In addition, enabling two-factor authentication wherever possible is another way to
                    add
                    an extra layer of security to your online accounts.
                </p>

                <h2 class="text-3xl text-justify">Culinary Adventures: From Foodie Movements to Global Flavors</h2>

                <p class="text-xl text-justify">
                    Sharing personal information online is a common practice for many internet users. However, it is
                    essential to be mindful of the information you share online, such as your home address or contact
                    information. Social media platforms are also a potential risk to our online privacy. Therefore, it
                    is
                    vital to consider your online activity and be cautious about the information you post on social
                    media
                    platforms as it can easily be accessed by others.
                    <br><br>
                    Lastly, investing in a virtual private network (VPN) is sensible advice to protect your privacy
                    online.
                    A VPN encrypts your internet traffic and hides your IP address, making it more difficult for others
                    to
                    track your online activity. Utilizing a VPN can be a highly beneficial step in safeguarding your
                    online
                    privacy.
                    <br><br>
                    By following these simple tips, you can take the necessary steps to protect your online privacy in
                    an
                    increasingly digital world. So, take action now to secure your digital identity and safeguard your
                    personal information online.
                </p>

                <div class="flex justify-center">
                    <div class="flex gap-4 justify-between sm:w-1/3 bg-black rounded-2xl py-2 px-4 text-3xl text-white">
                        <FontAwesomeIcon :icon="faXTwitter" />
                        <FontAwesomeIcon :icon="faFacebookF" />
                        <FontAwesomeIcon :icon="faInstagram" />
                        <FontAwesomeIcon :icon="faLink" />
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-0 max-w-5xl mx-auto animate-fade-up pb-10 px-4">
                <div class="flex flex-col sm:border-r border-black pr-4">
                    <span class="text-gray-500">Previous News</span>
                    <h4 class="w-2/3 text-xl font-bold">A Step-by-Step Guide to Mastering Technical Design</h4>
                </div>
                <div class="flex flex-col items-end sm:border-l border-black pr-4">
                    <span class="text-gray-500">Next News</span>
                    <h4 class="w-2/3 text-right text-xl font-bold">A Step-by-Step Guide to Mastering Technical Design
                    </h4>
                </div>
            </div>
        </section>

        <template #fullwidth2>
            <section class="bg-gray-200 mx-4 rounded-3xl mb-10">
                <div class="flex flex-col px-4 py-6 mx-auto max-w-3xl flex-grow transition-colors duration-500 w-full">
                    <h2 class="text-2xl font-bold">Read other news</h2>
                    <div class="flex gap-4 mt-6 items-center border-b border-gray-400 pb-6">
                        <img src="https://placehold.co/200x200" alt="" class="h-32 rounded-2xl">
                        <div class="flex flex-col gap-2">
                            <h4 class="text-lg font-bold">A Step-by-Step Guide to Mastering Technical Design</h4>
                            <span class="text-gray-500">12 Aug, 2025</span>
                            <p class="text-md text-gray-600">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, quibusdam?
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-6 items-center border-b border-gray-400 pb-6">
                        <img src="https://placehold.co/200x200" alt="" class="h-32 rounded-2xl">
                        <div class="flex flex-col gap-2">
                            <h4 class="text-lg font-bold">A Step-by-Step Guide to Mastering Technical Design</h4>
                            <span class="text-gray-500">12 Aug, 2025</span>
                            <p class="text-md text-gray-600">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, quibusdam?
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-6 items-center border-b border-gray-400 pb-6">
                        <img src="https://placehold.co/200x200" alt="" class="h-32 rounded-2xl">
                        <div class="flex flex-col gap-2">
                            <h4 class="text-lg font-bold">A Step-by-Step Guide to Mastering Technical Design</h4>
                            <span class="text-gray-500">12 Aug, 2025</span>
                            <p class="text-md text-gray-600">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, quibusdam?
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </SecondLayout>
</template>
