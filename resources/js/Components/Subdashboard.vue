<script setup>
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';

    import SearchBarSideBar from '@/Components/SearchBarSideBar.vue';

    import Calendar from '@/Components/Calendar.vue';
    //import RecentJobs from '@/Components/RecentJobs.vue';
    //import JobsLastSevenDays from '@/Components/JobsLastSevenDays.vue';
    //import UpcomingJobs from '@/Components/UpcomingJobs.vue';

    import { Modal } from 'flowbite'
</script>

<template>
    <div>
        <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-5 lg:gap-8">
            <!-- LEFT PART -->
            <!-- Container for Left Sidebar (search and quick add job) -->
            <div id="left-side" class="mx-auto flex flex-col items-start overflow-hidden pb-6 pt-6 rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:col-span-1 md:col-span-2">
                <div class="relative w-full flex items-center pb-6 border-divider">
                    <div class="mx-auto">
                        <div class="flex items-center"><a href="/liquijobs"><img src="/images/logos/liquis-logo.png" alt="LiquiTraq" class="block md:w-40 sm:w-20"></a></div>
                    </div>
                </div>

                <div class="relative w-full border-divider pt-6">
                <!-- AVATAR -->
                    <div class="relative flex items-center lg:items-end">
                        <div class="mx-auto relative flex items-center lg:items-end">
                            <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-full rounded-full cursor-pointer border-1 border-black shadow-xl" src="/images/logos/avatar.jpg" alt="User dropdown">
                        </div>

                        <!-- <div class="relative flex items-center gap-6 lg:items-end">
                            <h1>My Account</h1>
                        </div> -->
                        <!-- Dropdown menu -->
                        <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div>Chi Rilo</div>
                            <div class="font-medium truncate">name@flowbite.com</div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                            </li>
                            </ul>
                            <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                            </div>
                        </div>
                    </div>
                    <!-- END OF AVATAR -->
                    <!-- MY ACCOUNT -->
                    <div class="mx-auto relative flex justify-center pt-6 pb-6">
                    
                        <!-- <div class="relative flex items-center gap-6 lg:items-end">
                            <h1>MY ACCOUNT 	&dArr;</h1>
                        </div> -->
                        <Dropdown align="right" width="48" >
                            <template #trigger>
                                <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                </button>

                                <span v-else class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center border border-transparent text-base text-base primary-light-blue font-rethinksansextrabold uppercase dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ $page.props.auth.user.name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-sm text-gray-600">
                                    Manage Account
                                </div>
                                
                                <DropdownLink class="block px-4 py-2 text-sm text-gray-600" :href="route('profile.show')">
                                    Profile
                                </DropdownLink>

                                <!-- <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                    API Tokens
                                </DropdownLink> -->

                                <div class="border-t border-gray-200 dark:border-gray-600" />

                                <!-- Authentication -->
                                    
                                <form @submit.prevent="logout">
                                    <DropdownLink class="block px-4 py-2 text-sm text-gray-600" as="button">
                                        Log Out
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                    <!-- END OF: MY ACCOUNT -->
                </div>

                <!-- <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                    <input type="search" name="search" placeholder="Search anything" />
                </div> -->
                
                <div class="w-full pr-6 pl-6 pb-6 mt-6 border-divider">
                    <SearchBarSideBar/>
                </div>

                <!-- <input class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="search" name="search" placeholder="Search anything" /> -->
                <div class="w-full pr-6 pl-6 pb-6 mt-6 border-divider">
                    <h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Filter Jobs By</h2>
                    <select class="appearance-none block w-full p-4 mt-3 text-base primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none">
                        <option class="text-base primary-dark-blue" value="state">State</option>
                        <option class="text-base primary-dark-blue" value="building">Building</option>
                    </select>
                    <a href="/liquijobs" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Go <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a>
                </div>

                <div class="w-full pr-6 pl-6 pb-6 mt-6">
                    <h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Quick Add New Job</h2>
                    <div class="mt-3 relative flex items-center lg:items-end">
                        <div id="docs-card-content" class="flex items-start lg:flex-col">
                            <form class="w-full" action="/liquijobs/create">
                                <div class="flex flex-wrap">
                                    <div class="w-full">
                                        <label class="hidden block tracking-wide mb-2" for="grid-first-name">
                                        Company Name
                                        </label>
                                        <input name="cname" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Company Name">
                                        <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                    </div>
                                    <div class="w-full mt-3">
                                        <label class="hidden block tracking-wide mb-2" for="grid-first-name">
                                        Corporate Address
                                        </label>
                                        <input name="caddress" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Corporate Address">
                                        <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                    </div>
                                    <div class="w-full mt-3">
                                        <label class="hidden block tracking-wide mb-2" for="grid-first-name">
                                        Contact Name
                                        </label>
                                        <input name="coname" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Contact Name">
                                        <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                    </div>
                                    <div class="w-full mt-3">
                                        <label class="hidden block tracking-wide mb-2" for="grid-first-name">
                                        Contact Email
                                        </label>
                                        <input name="cemail" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Contact Email">
                                        <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                    </div>
                                    <div class="w-full mt-3">
                                        <label class="hidden block tracking-wide mb-2" for="grid-first-name">
                                        Contact Telephone
                                        </label>
                                        <input name="cname"cotel class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Contact Telephone">
                                        <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                    </div>
                                    <div class="w-full mt-3">
                                        <label class="hidden block tracking-wide mb-2" for="grid-first-name">
                                        Location Address
                                        </label>
                                        <input name="loaddress" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Location Address">
                                        <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                    </div>
                                    <div class="w-full mt-3">
                                        <label class="hidden block tracking-wide mb-2" for="grid-first-name">
                                        Start Date
                                        </label>
                                        <input name="sdate" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Start Date">
                                        <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                    </div>
                                </div>
                                
                                <!-- <a v-bind:href="liquijobsCreate" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" style="display: inline-block; width: 100% !important; text-align: center;"> ADD NEW JOB <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a> -->
                                <button id="send" type="submit" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Add New <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></button>
                            
                            </form>
                        </div>

                        
                    </div>
                </div>
            </div>

            <!-- RIGHT PART -->
            <div id="right-side" class="lg:col-span-2 md:col-span-3">
                
                <!-- Container for RECENT JOBS -->
                <!-- <div id="recent-jobs" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"> -->
                
                <RecentJobs/>

                <!-- Container for JOB LAST 7 DAYS -->
                <!-- <div id="job-last-7-days" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"> -->
                
                <JobsLastSevenDays/>

                <!-- Container for UPCOMING JOBS -->
                <!-- <div id="upcoming-jobs" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800"> -->
                

                <UpcomingJobs />


                <!-- Container for UPCOMING JOBS -->
                <div id="upcoming-jobs" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800" style="display: none;">
                    

                    <div class="pt-3 sm:pt-5">
                        <h2 class="text-xl font-semibold text-black dark:text-white">Vibrant Ecosystem</h2>

                        <p class="mt-4 text-sm/relaxed">
                            Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Forge</a>, <a href="https://vapor.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Vapor</a>, <a href="https://nova.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Nova</a>, and <a href="https://envoyer.io" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Echo</a>, <a href="https://laravel.com/docs/horizon" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Telescope</a>, and more.
                        </p>
                    </div>
                </div>
                <!-- CALENDAR -->
                <div id="calendar-container" class="grid items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
                    <Calendar />
                </div>
            </div>
        </div>


        <!-- CALENDAR -->
        <!-- <div id="calendar-container" class="grid items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
            <Calendar />
        </div> -->
        
    </div>
</template>
