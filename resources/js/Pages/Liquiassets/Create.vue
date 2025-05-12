<script setup>
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
//import { Link, useForm, usePage } from '@inertiajs/vue3';

import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue';
//import TextInput from '@/Components/TextInput.vue';

import SearchBarSideBar from '@/Components/SearchBarSideBar.vue';
import Calendar from '@/Components/Calendar.vue';
import RecentJobs from '@/Components/RecentJobs.vue';
import JobsLastSevenDays from '@/Components/JobsLastSevenDays.vue';
import UpcomingJobs from '@/Components/UpcomingJobs.vue';


const props = defineProps({
    jobid : Object
});

const liquijobsCreate = '/liquijobs/create';


const form = useForm({
    job_asset: '',
    jobid: props.jobid
});

const onImageChange = (e) => {
    const file = e.target.files[0];
    //this.url = URL.createObjectURL(file);
    form.job_asset = URL.createObjectURL(file);

    form.job_asset = e.target.files[0];
}


const submit = (e) => {
    form.post(route("liquiassets.store"));
};
</script>
<template>
    <AppLayout title="Dashboard">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Asset
        </h2>
    </template>

    
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div>

                    <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-1 lg:gap-8">


                        <!-- LEFT PART -->
                            <!-- Container for Left Sidebar (search and quick add job) -->
                            <div id="left-side" class="mx-auto flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                
                                <div class="mx-auto relative flex items-center gap-6 lg:items-end sm:hidden hidden lg:block">
                                    
                                    <div style="display: none;" class="shrink-0 flex items-center"><a href="http://127.0.0.1:8000/liquijobs"><img src="/images/logos/liquis-logo.png" alt="LiquiTraq" class="block h-9 w-auto"></a></div>
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

                                <!-- <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="search" name="search" placeholder="Search anything" /> -->
                                <br/>


                                 <h2 class="block w-full text-center">FILTER JOBS BY</h2>
                                 <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                     <option value="state">State</option>
                                     <option value="building">Building</option>
                                 </select>
                                 <a href="/liquijobs" style="display: inline-block; width: 100% !important; text-align: center;" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> GO <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a>

                                 <h2 style="visibility: hidden;">QUICK ADD NEW JOB</h2>
                                <div class="relative flex items-center gap-6 lg:items-end" style="visibility: hidden;">
                                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                        <form class="w-full">
                                             <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full py-1 px-3">
                                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                    Company Name
                                                    </label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Company Name">
                                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                                </div>
                                                <div class="w-full py-1 px-3">
                                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                    Corporate Address
                                                    </label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Corporate Address">
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
                                                    Contact Email
                                                    </label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Contact Email">
                                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                                </div>
                                                <div class="w-full py-1 px-3">
                                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                    Contact Telephone
                                                    </label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Contact Telephone">
                                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
                                                </div>
                                                <div class="w-full py-1 px-3">
                                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                    Location Address
                                                    </label>
                                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Location Address">
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
                                            
                                            <a v-bind:href="liquijobsCreate" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> ADD ASSETS <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a>
                                           
                                        </form>
                                    </div>

                                    
                                </div>
                            </div>
                            <!-- RIGHT PART -->
                            <div id="right-side" class="lg:col-span-2 mx-5">
                                <div class="mt-6 float-right">
                                    <a href="/liquijobs" class="w-half bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" style="float: right;">Back to Jobs</a>
                                </div>
                                <div class="relative flex flex-col mt-5" style="width: 100%; text-align: center;">
                                    <h1 class="text-center font-bold text-xl">ADD ASSET FOR JOB: # {{ props.jobid }}</h1>
                                </div>
                            <section>
                                <form @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
                                    
                                    <div>
                                        <InputLabel for="job_asset" value="Job Asset" />

                                        <!-- <input type="file" @input="form.avatar = $event.target.files[0]" name="job_asset" class="mt-1 block w-full" v-on:change="onImageChange" > -->
                                            <input type="file" @input="form.job_asset = $event.target.files[0]" name="job_asset" class="mt-1 block w-full">
                                        <input type="hidden" name="job_id" v-model="form.jobid" >
                                        <InputError class="mt-2" :message="form.errors.job_asset" />
                                    </div>
                                    

                                    <!-- <div style="display: none;">
                                        <InputLabel for="additional_images" value="Additional Images" />

                                        <input type="file" class="form-control" v-on:change="onImageChange"> -->
                                        <!-- <TextInput
                                            name="additional_images"
                                            id="additional_images"
                                            type="file"
                                            class="mt-1 block w-full"
                                            v-model="form.additional_images"
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.additional_images" />
                                    </div> -->

                                    

                                    <div class="flex items-center gap-4">
                                        <PrimaryButton :disabled="form.processing" style="background-color: #292d73;">Save</PrimaryButton>

                                        <Transition
                                            enter-active-class="transition ease-in-out"
                                            enter-from-class="opacity-0"
                                            leave-active-class="transition ease-in-out"
                                            leave-to-class="opacity-0"
                                        >
                                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                        </Transition>
                                    </div>
                                </form>
                            </section>
                            </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    </AppLayout>
</template>