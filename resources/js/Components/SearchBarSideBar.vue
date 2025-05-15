<template>
    <form class="w-full max-w-md mx-auto">   
        <label for="default-search" class="mb-2 font-rethinksansmedium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <!-- <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div> -->
            <input type="search" id="default-search" class="block w-full p-4 primary-gray border border-[#e9ebef] rounded-lg focus:outline-none" placeholder="Search anything..." required />
            <button type="submit" class="absolute end-5 bottom-5 font-rethinksansmedium text-base rounded-lg">
                <svg class="w-4 h-4 primary-gray" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg></button>
        </div>
    </form>
</template>