<script setup>
</script>

<template>
    <div class="flex flex-col justify-center items-center my-10 sm:my-20 animate-fade-up px-4">
        <div class="flex flex-wrap justify-center gap-2 sm:gap-4 bg-gray-200 rounded-xl font-bold p-2">
            <div
                class="px-4 py-2 sm:px-6 sm:py-3 bg-black rounded-xl text-white transition-all duration-300 cursor-pointer">
                All
            </div>
            <div
                class="px-3 py-2 sm:px-5 sm:py-3 hover:bg-gray-300 rounded-xl text-gray-400 hover:text-gray-600 transition-all duration-300 cursor-pointer">
                Creative
            </div>
            <div
                class="px-3 py-2 sm:px-5 sm:py-3 hover:bg-gray-300 rounded-xl text-gray-400 hover:text-gray-600 transition-all duration-300 cursor-pointer">
                Design
            </div>
            <div
                class="px-3 py-2 sm:px-5 sm:py-3 hover:bg-gray-300 rounded-xl text-gray-400 hover:text-gray-600 transition-all duration-300 cursor-pointer">
                Photo
            </div>
            <div
                class="px-3 py-2 sm:px-5 sm:py-3 hover:bg-gray-300 rounded-xl text-gray-400 hover:text-gray-600 transition-all duration-300 cursor-pointer">
                Style
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-10 justify-center items-center">
        <div class="w-full flex flex-wrap gap-10 justify-center px-4">

            <div class="flex flex-col justify-center items-center">
                <div class="w-96 h-96 overflow-hidden rounded-3xl relative group">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        src="https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/Colorful-Assortment-of-Macarons-and-Packaging.webp"
                        alt="" />
                </div>
                <div class="w-full flex justify-between items-center py-4">
                    <h3 class="text-2xl uppercase font-bold">the dark side</h3>
                    <h4 class="text-lg text-gray-500">Creative</h4>
                </div>
            </div>

            <div class="flex flex-col justify-center items-center">
                <div class="w-96 h-96 overflow-hidden rounded-3xl relative group">
                    <img class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                        src="https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/nkLC12rAR56ibf4tRP0JYBiA.webp"
                        alt="" />
                </div>
                <div class="w-full flex justify-between items-center py-4">
                    <h3 class="text-2xl uppercase font-bold">Justice robot</h3>
                    <h4 class="text-lg text-gray-500">Creative</h4>
                </div>
            </div>

            <div class="flex flex-col justify-center items-center">
                <div class="w-96 h-96 overflow-hidden rounded-3xl relative group">
                    <img class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                        src="https://theme.madsparrow.me/osty/wp-content/uploads/2024/12/SPOA-Vintage-Camera-with-Dual-Viewfinders.webp"
                        alt="" />
                </div>
                <div class="w-full flex justify-between items-center py-4">
                    <h3 class="text-2xl uppercase font-bold">color current</h3>
                    <h4 class="text-lg text-gray-500">Photo</h4>
                </div>
            </div>

        </div>

        <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-2xl hover:bg-gray-300 mb-20">
            Load More >
        </button>
    </div>
</template>