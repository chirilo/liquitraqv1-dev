<script setup>
import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

import PrimaryButton from '@/Components/PrimaryButton.vue';

import SearchBarSideBar from '@/Components/SearchBarSideBar.vue';
import Calendar from '@/Components/Calendar.vue';
import RecentJobs from '@/Components/RecentJobs.vue';
import JobsLastSevenDays from '@/Components/JobsLastSevenDays.vue';
import UpcomingJobs from '@/Components/UpcomingJobs.vue';

import { ref } from "vue";

let jobconame = ref("");

const props = defineProps({
    liquijobs : Object,
    job_assets: Object,
    jobassetscount: String,
    itjobassets: String,
    infrastructurejobassets: String,
    furniturejobassets: String,
    filters : Object,
    message : String
});

const liquijobsCreate = '/liquijobs/create';

const liquiassetsurl = "/liquiassets/create?jobid=" + props.liquijobs.id;

const viewallliquiassetsurl = "/liquijobs/" + props.liquijobs.id + '?all=1';

const viewsingleliquiasseturl = "/liquiassets/";

// import { useRoute } from 'vue-router';

// const route = useRoute()
// console.log(route.query)

// const filters = {
//     filter: props.filters.filter,
// }
// const form = useForm(filters);

const form = useForm({
    company_name: props.liquijobs.company_name ? props.liquijobs.company_name : '' ,
    corporate_address: props.liquijobs.corporate_address ? props.liquijobs.corporate_address : '' ,
    contact_name: props.liquijobs.contact_name ? props.liquijobs.contact_name : '' ,
    contact_telephone: props.liquijobs.contact_telephone ? props.liquijobs.contact_telephone : '' ,
    contact_email: props.liquijobs.contact_email ? props.liquijobs.contact_email : '' ,
    location_address: props.liquijobs.location_address ? props.liquijobs.location_address : '' ,
    start_date: props.liquijobs.start_date ? props.liquijobs.start_date : '' ,
    type: props.liquijobs.type ? props.liquijobs.type : '' 
});
// from Create.vue
const submitaddjob = () => {
    form.post(route("liquijobs.store"));
};

const deleteTrade = (id) => {
    if (confirm("Are you sure you want to move this to trash")) {
	   form.delete(route('liquijobs.destroy',{id:id}), {
		  preserveScroll: true,
	   });
    }
};

// from Create.vue
const updatejob = (id) => {
	alert('hre');
    form.put( route('liquijobs.update',{id:props.liquijobs.id}) );
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

		<div class="max-w-7xl mx-auto p-5">
			<div class="dark:bg-gray-800 overflow-hidden sm:rounded-lg">
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
								<a href="/liquijobs" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Go <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></a>
							</div>

							<!-- Quick Add New Job -->
							<div class="w-full pr-6 pl-6 pb-6 mt-6">
								<h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Quick Add New Job</h2>
								<div class="mt-3 relative flex items-center lg:items-end">
									<div id="docs-card-content" class="flex items-start lg:flex-col">
										<form @submit.prevent="submitaddjob" class="w-full">
											<!-- <form @submit.prevent="submit"  class="w-full" action="/liquijobs/create"> -->
											<div class="flex flex-wrap">
												<div class="w-full">
													<!-- <label class="hidden block tracking-wide mb-2 " for="grid-first-name">
													Job Co Name
													</label> -->
													<InputLabel for="company_name" value="Job Co Name" />
													<TextInput
		                                                id="company_name"
		                                                type="text"
		                                                placeholder="Job Co Name"
		                                                v-model="form.company_name"
		                                                required
		                                                autofocus
		                                            />

		                                            <InputError class="mt-2" :message="form.errors.company_name" />
												</div>
												<div class="w-full mt-3">
													<!-- <label class="hidden block tracking-wide mb-2" for="grid-first-name">
													 Address
													</label> -->
													<InputLabel for="corporate_address" value="Address" />
													<TextInput
		                                                id="corporate_address"
		                                                type="text"
		                                                placeholder="Address"
		                                                v-model="form.corporate_address"
		                                                required
		                                                autofocus
		                                            />

		                                            <InputError class="mt-2" :message="form.errors.corporate_address" />
												</div>
												<div class="w-full mt-3">
													<!-- <label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Contact Name
													</label> -->
													<InputLabel for="contact_name" value="Contact Name" />
													<TextInput
		                                                id="contact_name"
		                                                type="text"
		                                                placeholder="Contact Name"
		                                                v-model="form.contact_name"
		                                                required
		                                                autofocus
		                                            />

		                                            <InputError class="mt-2" :message="form.errors.contact_name" />
												</div>
												<div class="w-full mt-3">
													<!-- <label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Email
													</label> -->
													<InputLabel for="contact_email" value="Email" />
													<TextInput
		                                                id="contact_email"
		                                                type="text"
		                                                placeholder="Email"
		                                                v-model="form.contact_email"
		                                                required
		                                                autofocus
		                                            />

		                                            <InputError class="mt-2" :message="form.errors.contact_email" />
												</div>
												<div class="w-full mt-3">
													<!-- <label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Phone
													</label> -->
													<InputLabel for="contact_telephone" value="Phone" />
													<TextInput
		                                                id="contact_telephone"
		                                                type="text"
		                                                placeholder="Phone"
		                                                v-model="form.contact_telephone"
		                                                required
		                                                autofocus
		                                            />

		                                            <InputError class="mt-2" :message="form.errors.contact_telephone" />
												</div>
												<div class="w-full mt-3">
													<!-- <label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Location Address
													</label> -->
													<InputLabel for="location_address" value="Location Address" />
													<TextInput
		                                                id="location_address"
		                                                type="text"
		                                                placeholder="Location Address"
		                                                v-model="form.location_address"
		                                                required
		                                                autofocus
		                                            />

		                                            <InputError class="mt-2" :message="form.errors.location_address" />
												</div>
												<div class="w-full mt-3">
													<!-- <label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Start Date
													</label> -->
													<InputLabel for="start_date" value="Start Date" />

		                                            <TextInput
		                                                id="start_date"
		                                                type="date"
		                                                placeholder="YYYY-MM-DD"
		                                                v-model="form.start_date"
		                                                required
		                                                autofocus
		                                            />
		                                            <InputError class="mt-2" :message="form.errors.start_date" />
												</div>
												<div class="w-full mt-3">
		                                            <InputLabel for="type" value="Job Type"/>

		                                            <select v-model="form.type" id="type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="type">
		                                            	<option value="">Job Type</option>
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
											</div>
											
											<!-- <a v-bind:href="liquijobsCreate" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" style="display: inline-block; width: 100% !important; text-align: center;"> ADD NEW JOB <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a> -->
											<button id="send" type="submit" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Add New Job <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></button>
										
										</form>
									</div>

									
								</div>
							</div>
							<!-- END OF: Quick Add New Job -->
						</div>
						<!-- RIGHT PART -->
						<div id="right-side" class="lg:col-span-2 md:col-span-3">
							<!-- current job selected /recent jobs -->
							<form @submit.prevent="updatejob" class="mt-6 space-y-6" enctype="multipart/form-data">
                                        
                                        <div>
                                            <InputLabel for="company_name" value="Job Co Name" />

                                            <TextInput
                                                id="company_name"
                                                type="text"
                                                placeholder="Job Co Name"
                                                v-model="form.company_name"
                                                required
                                                autofocus
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
                                                autofocus
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
                                                autofocus
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
                                                autofocus
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
                                                autofocus
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
                                                autofocus
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
                                                required
                                                autofocus
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
							
						</div>
							<!-- current job selected / recent jobs -->
					</div>
					<!-- CALENDAR -->
					<div class="mt-6 grid gap-6 lg:grid-cols-1 lg:gap-8" style="display: none;">
						<!-- Container for CALENDAR -->
						<div id="calendar-container" class="flex flex-col items-start gap-12 overflow-hidden rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-12 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
							<Calendar />
						</div>
					</div>
				        
				</div> <!-- end of unlabeled div -->
            </div>
        </div>
        <!-- -->
        <!-- <h1>VIEW VUE PAGE</h1> -->
		<div class="py-12" style="display: none;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h1 class="text-2xl">{{props.liquijobs.so_number}}</h1>
                <div>
                    {{props.liquijobs.so_number}}
                </div>
            </div>
        </div>
        <!-- -->
    </AppLayout>
    	
</template>