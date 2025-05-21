<script setup>
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
//import { Link, useForm, usePage } from '@inertiajs/vue3';

import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue';
//import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

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

    <div class="max-w-7xl mx-auto p-5">
        <div class="dark:bg-gray-800 overflow-hidden sm:rounded-lg">
            <div>
                <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-5 lg:gap-8">
                    <!-- LEFT PART -->
                        <!-- Container for Left Sidebar (search and quick add job) -->
                    <div id="left-side" class="w-full mx-auto flex flex-col items-start overflow-hidden pb-6 pt-6 rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:col-span-1 md:col-span-2">
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
								<div class="w-full text-center relative pt-6 pb-6">
									<Dropdown align="center">
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
											<div class="block pl-4 pr-6 py-2 text-base primary-dark-blue font-rethinksansmedium">
												Manage Account
											</div>
											
											<DropdownLink class="block w-full" :href="route('profile.show')">
												Profile
											</DropdownLink>

											<!-- <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
												API Tokens
											</DropdownLink> -->

											<div class="border-t border-gray-200 dark:border-gray-600" />

											<!-- Authentication -->
												
											<form @submit.prevent="logout">
												<DropdownLink class="block w-full" as="button">
													Log Out
												</DropdownLink>
											</form>
										</template>
									</Dropdown>
								</div>
								<!-- END OF: MY ACCOUNT -->
							</div>
							
							<!-- Search Anything -->
							<div class="w-full pr-6 pl-6 pb-6 mt-6 border-divider">
								<!-- <SearchBarSideBar/> -->
								<form @submit.prevent="searchanything" class="relative">
									<!-- <h1>{{ searchkey }}</h1> -->
									<input type="hidden" name="key" v-model="searchkey" />
									<input v-model="searchkey" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#e9ebef] bg-white rounded-lg focus:outline-none" type="search" name="search" placeholder="Search anything..." />
									<!-- <button type="submit"><svg class="size-6 shrink-0 stroke-[#8c8c97] absolute inset-y-4 right-0 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></button> -->
								</form>
							</div>
							<!-- END OF: Search Anything -->

							<div class="w-full pr-6 pl-6 pb-6 mt-6">
								<h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Filter Jobs By</h2>
								<select class="appearance-none block w-full p-4 mt-3 text-base primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none">
									<option class="text-base primary-dark-blue" value="state">State</option>
									<option class="text-base primary-dark-blue" value="building">Building</option>
								</select>
								<a href="/liquijobs" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Go <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></a>
							</div>
                            
                            <div style="display: none;" class="w-full pr-6 pl-6 pb-6 mt-6">
								<h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Quick Add New Job</h2>
								<div class="mt-3 relative flex items-center lg:items-end">
									<div id="docs-card-content" class="flex items-start lg:flex-col">
										<form class="w-full" action="/liquijobs/create">
											<div class="flex flex-wrap -mx-3">
												<div class="w-full py-1 px-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Company Name
													</label>
													<input name="cname" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Company Name">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full py-1 px-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Corporate Address
													</label>
													<input name="caddress" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Corporate Address">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full py-1 px-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Contact Name
													</label>
													<input name="coname" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Contact Name">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full py-1 px-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Contact Email
													</label>
													<input name="cemail" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Contact Email">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full py-1 px-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Contact Telephone
													</label>
													<input name="cname"cotel class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Contact Telephone">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full py-1 px-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Location Address
													</label>
													<input name="loaddress" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Location Address">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full py-1 px-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Start Date
													</label>
													<input name="sdate" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Start Date">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
											</div>
											
											<!-- <a v-bind:href="liquijobsCreate" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" style="display: inline-block; width: 100% !important; text-align: center;"> ADD NEW JOB <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a> -->
											<button id="send" type="submit" class="w-full text-white font-bold p-4 rounded-full bg-gradient-blue uppercase inline-block text-center mt-3">Add New</button>
										
										</form>
									</div>
								</div>
							</div>
                        </div>
                        <!-- RIGHT PART -->
                        <div id="right-side" class="lg:col-span-2 md:col-span-3">
                            <div class="grid items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:pb-10">
                                <div class="sm:text-right text-center">
                                    <a href="/liquijobs" class="text-white py-2 px-4 rounded-full bg-gradient-blue inline-block text-center text-sm font-rethinksansbold hover:opacity-90">Back to Jobs</a>
                                </div>
                                <div class="relative flex flex-col mt-5 w-full text-center">
                                    <h1 class="block text-center text-2xl primary-light-blue font-rethinksansextrabold uppercase">Add Job</h1>
                                </div>
                                <section>
                                    <form @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
                                        
                                        <div>
                                            <InputLabel for="company_name" value="Job Co Name" />

                                            <TextInput
                                                id="company_name"
                                                type="text"
                                                placeholder="Job Co Name"
                                                v-model="form.company_name"
                                                required
                                            />

                                            <InputError class="mt-2" :message="form.errors.company_name" />
                                        </div>
                                        <div>
                                            <InputLabel for="corporate_address" value="Address" />

                                            <TextInput
                                                id="corporate_address"
                                                type="text"
                                                placeholder="Address"
                                                v-model="form.corporate_address"
                                                required
                                            />

                                            <InputError class="mt-2" :message="form.errors.corporate_address" />
                                        </div>
                                        <div>
                                            <InputLabel for="contact_name" value="Contact Name" />

                                            <TextInput
                                                id="contact_name"
                                                type="text"
                                                placeholder="Contact Name"
                                                v-model="form.contact_name"
                                                required
                                            />

                                            <InputError class="mt-2" :message="form.errors.contact_name" />
                                        </div>
                                        <div>
                                            <InputLabel for="contact_telephone" value="Phone" />

                                            <TextInput
                                                id="contact_telephone"
                                                type="text"
                                                placeholder="+1234567890"
                                                v-model="form.contact_telephone"
                                                required
                                            />

                                            <InputError class="mt-2" :message="form.errors.contact_telephone" />
                                        </div>
                                        <div>
                                            <InputLabel for="contact_email" value="Email" />

                                            <TextInput
                                                id="contact_email"
                                                type="email"
                                                placeholder="email@email.com"
                                                v-model="form.contact_email"
                                                required
                                            />

                                            <InputError class="mt-2" :message="form.errors.contact_email" />
                                        </div>
                                        <div>
                                            <InputLabel for="location_address" value="Location Address" />

                                            <TextInput
                                                id="location_address"
                                                type="text"
                                                placeholder="Location Address"
                                                v-model="form.location_address"
                                                required
                                            />

                                            <InputError class="mt-2" :message="form.errors.location_address" />
                                        </div>
                                        <div>
                                            <InputLabel for="start_date" value="Start Date" />

                                            <TextInput
                                                id="start_date"
                                                type="date"
                                                placeholder="YYYY-MM-DD"
                                                v-model="form.start_date"
                                            />

                                            <InputError class="mt-2" :message="form.errors.start_date" />
                                        </div>


                                        <div>
                                            <InputLabel for="type" value="Job Type"/>

                                            <select v-model="form.type" id="type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="type">
                                                <option value="facilitydecomissioning">Facility Decomissioning</option>
                                                <option value="datacenterdecommissioning">Data Center Decommissioning</option>
                                                <option value="officefurniture">Office Furniture</option>
                                                <option value="datadestruction">Data Destruction</option>
                                                <option value="assetrecovery">Asset Recovery</option>
                                                <option value="assetmanagement">Asset Management</option>
                                                <option value="recycling">Recycling</option>
                                                <option value="generatorremoval">Generator Removal</option>
                                                <option value="industrialremoval">Industrial Removal</option>
                                            </select>

                                            <InputError class="mt-2" :message="form.errors.type" />
                                        </div>

                                        <!-- assets below -->
                                        

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

                                        

                                        <div class="flex items-center gap-4">
                                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

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