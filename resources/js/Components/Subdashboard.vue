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

        <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-1 lg:gap-8">
            
            <!-- LEFT PART -->
            <!-- Container for Left Sidebar (search and quick add job) -->
            <div id="left-side" class="mx-auto flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                
                <div class="mx-auto relative flex items-center gap-6 lg:items-end sm:hidden hidden lg:block">
                    
                    <div class="shrink-0 flex items-center"><a href="http://127.0.0.1:8000/dashboard"><img src="/images/logos/liquis-logo.png" alt="LiquiTraq" class="block h-9 w-auto"></a></div>
                </div>

                <div class="mx-auto relative flex items-center gap-6 lg:items-end">
                    <div class="relative flex items-center gap-6 lg:items-end">
                        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="max-w-2xl max-h-2xl rounded-full cursor-pointer" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="User dropdown">
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

                <!-- <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                    <input type="search" name="search" placeholder="Search anything" />
                </div> -->

                <SearchBarSideBar/>

                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="search" name="search" placeholder="Search anything" />
                <br/>


                 <h2 class="block w-full text-center">FILTER JOBS BY</h2>
                 <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                     <option value="state">State</option>
                     <option value="building">Building</option>
                 </select>
                 <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> GO <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </button>

                 <h2>QUICK ADD NEW JOB</h2>
                <div class="relative flex items-center gap-6 lg:items-end">
                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                        <form class="w-full">
                             <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full py-1 px-3">
                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Job Co Name
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Job Co Name">
                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                </div>
                                <div class="w-full py-1 px-3">
                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Address
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Address">
                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                </div>
                                <div class="w-full py-1 px-3">
                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Contact Name
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Contact Name">
                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                </div>
                                <div class="w-full py-1 px-3">
                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Email
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Email">
                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                </div>
                                <div class="w-full py-1 px-3">
                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Phone
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Phone">
                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                </div>
                                <div class="w-full py-1 px-3">
                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Start Date
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Start Date">
                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                </div>
                            </div>
                            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> ADD ASSETS <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </button>
                        </form>
                    </div>

                    
                </div>
            </div>

            <!-- RIGHT PART -->
            <div id="right-side" class="lg:col-span-2">
                
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
            </div>

            

        </div>


        <!-- CALENDAR -->
        <div class="grid gap-6 lg:grid-cols-1 lg:gap-8" style="margin-top: 2em;">
            <!-- Container for CALENDAR -->
            <div id="calendar-container" class="flex flex-col items-start gap-12 overflow-hidden rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-12 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                <Calendar />
            </div>
        </div>
        
    </div>
</template>
