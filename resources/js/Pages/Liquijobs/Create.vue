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
import Dropdown from '@/Components/Dropdown.vue';

import SearchBarSideBar from '@/Components/SearchBarSideBar.vue';
import Calendar from '@/Components/Calendar.vue';
import RecentJobs from '@/Components/RecentJobs.vue';
import JobsLastSevenDays from '@/Components/JobsLastSevenDays.vue';
import UpcomingJobs from '@/Components/UpcomingJobs.vue';

const props = defineProps({
    serverdata : Object,
    caddress: String,
    cemail: String,
    cname: String,
    coname: String,
    loaddress: String,
    sdate: String,
});
const form = useForm({
    // so_number: '',
    // building: '',
    // city : '',
    // state : '',
    // status : '',
    // expected_qty : '',
    // serial_number : '',
    // hid_employee_name : '',
    // hid_employee_id : '',
    // liquis_pickup_date : '',
    // liquis_employee_name : '',
    // invoice_number : '',
    // liquis_complete_photo : '',
    // additional_images: '',
    company_name: '',
    corporate_address: '',
    contact_name: '',
    contact_telephone: '',
    contact_email: '',
    location_address: '',
    start_date: '',
    type: ''
});




const liquijobsCreate = '/liquijobs/create';

const submit = () => {
    form.post(route("liquijobs.store"));
};
</script>
<template>
    <AppLayout title="Dashboard">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Job
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
                                    
                                    <div style="display: none;" class="shrink-0 flex items-center"><a href="/liquijobs"><img src="/images/logos/liquis-logo.png" alt="LiquiTraq" class="block h-9 w-auto"></a></div>
                                </div>

                                <!-- AVATAR -->
                                <div class="mx-auto relative flex items-center gap-6 lg:items-end">
                                    <div class="relative flex items-center gap-6 lg:items-end">
                                        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="max-w-2xl max-h-2xl rounded-full cursor-pointer" src="https://www.gravatar.com/avatar/2c7d99fe281ecd3bcd65ab915bac6dd5?s=250" alt="User dropdown">
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
                                <div class="mx-auto relative flex items-center gap-6 lg:items-end">
                                
                                    <!-- <div class="relative flex items-center gap-6 lg:items-end">
                                        <h1>MY ACCOUNT  &dArr;</h1>
                                    </div> -->
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="size-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                            </button>

                                            <span v-else class="inline-flex rounded-md">
                                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.name }}

                                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Account
                                            </div>

                                            <DropdownLink :href="route('profile.show')">
                                                Profile
                                            </DropdownLink>

                                            <!-- <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                                API Tokens
                                            </DropdownLink> -->

                                            <div class="border-t border-gray-200 dark:border-gray-600" />

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button">
                                                    Log Out
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
                                    
                                </div>
                                <!-- END OF: MY ACCOUNT -->

                        
                                <SearchBarSideBar/>

                                <!-- <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="search" name="search" placeholder="Search anything" /> -->


                                 <h2 class="block w-full text-center">FILTER JOBS BY</h2>
                                 <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                     <option value="state">State</option>
                                     <option value="building">Building</option>
                                 </select>
                                 <a href="/liquijobs" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" style="display: inline-block; width: 100% !important; text-align: center;"> GO <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a>

                                 <h2 style="display: none;">QUICK ADD NEW JOB</h2>
                                <div style="visibility: hidden;" class="relative flex items-center gap-6 lg:items-end">
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
                                                
                                            </div>
                                            
                                            <a v-bind:href="liquijobsCreate" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" style="display: inline-block; width: 100% !important; text-align: center;"> ADD NEW JOB <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a>
                                           
                                        </form>
                                    </div>

                                    
                                </div>
                            </div>
                            <!-- RIGHT PART -->
                            <div id="right-side" class="lg:col-span-2 mx-5">
                                <div class="relative flex flex-col mt-5" style="width: 100%; text-align: center;">
                                    <h1 class="text-center font-bold text-xl">ADD JOB</h1>
                                </div>
                            <section>
                                <form @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
                                    
                                    <div>
                                        <InputLabel for="company_name" value="Company Name" />

                                        <TextInput
                                            id="company_name"
                                            type="text"
                                            :placeholder="cname"
                                            class="mt-1 block w-full"
                                            v-model="caddress"
                                            required
                                            autofocus
                                            :value="caddress"
                                        />

                                        <InputError class="mt-2" :message="form.errors.company_name" />
                                    </div>
                                    <div>
                                        <InputLabel for="corporate_address" value="Corporate Address" />

                                        <TextInput
                                            id="corporate_address"
                                            type="text"
                                            placeholder="Corporate Address"
                                            class="mt-1 block w-full"
                                            v-model="form.corporate_address"
                                            required
                                            autofocus
                                            :value="caddress"
                                        />

                                        <InputError class="mt-2" :message="form.errors.corporate_address" />
                                    </div>
                                    <div>
                                        <InputLabel for="contact_name" value="Contact Name" />

                                        <TextInput
                                            id="contact_name"
                                            type="text"
                                            placeholder="Contact Name"
                                            class="mt-1 block w-full"
                                            v-model="form.contact_name"
                                            required
                                            autofocus
                                            :value="coname"
                                        />

                                        <InputError class="mt-2" :message="form.errors.contact_name" />
                                    </div>
                                    <div>
                                        <InputLabel for="contact_telephone" value="Contact Telephone" />

                                        <TextInput
                                            id="contact_telephone"
                                            type="text"
                                            placeholder="+1234567890"
                                            class="mt-1 block w-full"
                                            v-model="form.contact_telephone"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.contact_telephone" />
                                    </div>
                                    <div>
                                        <InputLabel for="contact_email" value="Contact Email" />

                                        <TextInput
                                            id="contact_email"
                                            type="email"
                                            placeholder="email@email.com"
                                            class="mt-1 block w-full"
                                            v-model="form.contact_email"
                                            required
                                            autofocus
                                            :value="cemail"
                                        />

                                        <InputError class="mt-2" :message="form.errors.contact_email" />
                                    </div>
                                    <div>
                                        <InputLabel for="location_address" value="Location Address" />

                                        <TextInput
                                            id="location_address"
                                            type="text"
                                            placeholder="Company Location Address"
                                            class="mt-1 block w-full"
                                            v-model="form.location_address"
                                            required
                                            autofocus
                                            :value="loaddress"
                                        />

                                        <InputError class="mt-2" :message="form.errors.location_address" />
                                    </div>
                                    <div>
                                        <InputLabel for="start_date" value="Start Date" />

                                        <TextInput
                                            id="start_date"
                                            type="date"
                                            placeholder="YYYY-MM-DD"
                                            class="mt-1 block w-full"
                                            v-model="form.start_date"
                                            required
                                            autofocus
                                            :value="sdate"
                                        />

                                        <InputError class="mt-2" :message="form.errors.start_date" />
                                    </div>


                                    <div>
                                        <InputLabel for="type" value="Job Type" />

                                        <!-- <TextInput
                                            id="start_date"
                                            type="text"
                                            placeholder="YYYY-MM-DD"
                                            class="mt-1 block w-full"
                                            v-model="form.type"
                                            required
                                            autofocus
                                        /> -->
                                        <select v-model="form.type" id="type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full form-control" name="type">
                                            <option value="furniture">Furniture</option>
                                            <option value="it">IT</option>
                                            <option value="infrastructure">Infrastructure</option>
                                        </select>

                                        <InputError class="mt-2" :message="form.errors.type" />
                                    </div>

                                    <!-- assets below -->
                                    <!-- <div>
                                        <InputLabel for="category" value="Category" />

                                        <select id="category" class="mt-1 block w-full">
                                            <option value="furniture">Furniture</option>
                                            <option value="it">IT</option>
                                            <option value="infrastructure">Infrastructure</option>
                                        </select>
                                        

                                        <InputError class="mt-2" :message="form.errors.category" />
                                    </div>
                                    <div>
                                        <InputLabel for="type" value="Type" />

                                        <select id="type" class="mt-1 block w-full">
                                            <option value="furniture">Furniture</option>
                                            <option value="it">IT</option>
                                            <option value="infrastructure">Infrastructure</option>
                                        </select>
                                        

                                        <InputError class="mt-2" :message="form.errors.category" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="so_number" value="SO Number" />

                                        <TextInput
                                            id="so_number"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.so_number"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.so_number" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="building" value="Building" />

                                        <TextInput
                                            id="building"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.building"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.building" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="city" value="City" />

                                        <TextInput
                                            id="city"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.city"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.city" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="state" value="State" />

                                        <TextInput
                                            id="state"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.state"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.state" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="status" value="Status" />

                                        <TextInput
                                            id="status"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.status"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.status" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="expected_qty" value="Expected Quantity" />

                                        <TextInput
                                            id="expected_qty"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.expected_qty"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.expected_qty" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="serial_number" value="Serial Number" />

                                        <TextInput
                                            id="serial_number"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.serial_number"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.serial_number" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="hid_employee_name" value="HID Employee Name" />

                                        <TextInput
                                            id="hid_employee_name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.hid_employee_name"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.hid_employee_name" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="hid_employee_id" value="HID Employee ID" />

                                        <TextInput
                                            id="hid_employee_id"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.hid_employee_id"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.hid_employee_id" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="liquis_pickup_date" value="Liquis Pickup Date" />

                                        <TextInput
                                            id="liquis_pickup_date"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.liquis_pickup_date"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.liquis_pickup_date" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="liquis_employee_name" value="Liquis Employee Name" />

                                        <TextInput
                                            id="liquis_employee_name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.liquis_employee_name"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.liquis_employee_name" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="invoice_number" value="Invoice Number" />

                                        <TextInput
                                            id="invoice_number"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.invoice_number"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.invoice_number" />
                                    </div> -->

                                    <!-- <div>
                                        <InputLabel for="liquis_complete_photo" value="Liquis Complete Photo" />

                                        <TextInput
                                            name="liquis_complete_photo"
                                            id="liquis_complete_photo"
                                            type="file"
                                            class="mt-1 block w-full"
                                            v-model="form.liquis_complete_photo"
                                            required
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.liquis_complete_photo" />
                                    </div> -->

                                    <div style="display: none;">
                                        <InputLabel for="additional_images" value="Additional Images" />

                                        <!-- <input type="file" class="form-control" v-on:change="onImageChange"> -->
                                        <TextInput
                                            name="additional_images"
                                            id="additional_images"
                                            type="file"
                                            class="mt-1 block w-full"
                                            v-model="form.additional_images"
                                            autofocus
                                        />

                                        <InputError class="mt-2" :message="form.errors.additional_images" />
                                    </div>

                                    <!-- <div>
                                        <InputLabel for="slug" value="Slug" />

                                        <TextInput
                                            id="slug"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.slug"
                                            required
                                        />

                                        <InputError class="mt-2" :message="form.errors.slug" />
                                    </div>
                                    <div>
                                        <InputLabel for="description" value="Description" />

                                        <TextArea
                                            id="description"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.description"
                                        />

                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div> -->

                                    <div class="flex items-center gap-4">
                                        <PrimaryButton :disabled="form.processing" style="background-color: #292d73; margin-bottom: 1em;">Save</PrimaryButton>

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