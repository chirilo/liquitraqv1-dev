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

import SearchBarSideBar from '@/Components/SearchBarSideBar.vue';
import Calendar from '@/Components/Calendar.vue';
import RecentJobs from '@/Components/RecentJobs.vue';
import JobsLastSevenDays from '@/Components/JobsLastSevenDays.vue';
import UpcomingJobs from '@/Components/UpcomingJobs.vue';


// const liquijobsCreate = function(event) {
// 	window.open("/liquijobs/create");
// }

const liquijobsCreate = '/liquijobs/create';

const props = defineProps({
    liquijobs : Object,
    filters : Object,
    message : String,
    results: Object
});

// const filters = {
//     filter: props.filters.filter,
// }
//const form = useForm(filters);

const deleteTrade = (id) => {
    if (confirm("Are you sure you want to move this to trash")) {
	   form.delete(route('liquijobs.destroy',{id:id}), {
		  preserveScroll: true,
	   });
    }
};


const form = useForm({
    company_name: '',
    corporate_address: '',
    contact_name: '',
    contact_telephone: '',
    contact_email: '',
    location_address: '',
    start_date: '',
    type: ''
});
// from Create.vue
const submitaddjob = () => {
    form.post(route("liquijobs.store"));
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Search Results
            </h2>
        </template>
        	<!-- message prompt -->
		<div
			v-if="props.message"
			class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
			role="alert"
		>
			<span class="font-medium">
				{{ props.message }}
			</span>
		</div>

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

							<!-- <input class="appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="search" name="search" placeholder="Search anything" /> -->
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
							
							<div class="grid items-start rounded-lg bg-white p-6 mb-6">
								<!-- search results here -->
								
								<div v-if="results">
						          <ul>
						            <li v-for="(val, index) in results" :key="index">
						              <span>{{ val.company_name }}</span>
						            </li>
						          </ul>
        						</div>

        						<div v-else class="text-gray-500">No results were found.</div>
							 </div>
							<!-- CALENDAR -->
							<div id="calendar-container" class="mt-6 grid items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
								<Calendar />
							</div>
						</div>
					</div>
				</div> <!-- end of unlabeled div -->
			</div>
		</div>

        
    </AppLayout>
    	
</template>