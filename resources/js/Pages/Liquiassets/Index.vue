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
    message : String
});

const filters = {
    filter: props.filters.filter,
}
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
const submit = () => {
    form.post(route("liquijobs.store"));
};
</script>

<template>
    <AppLayout title="Assets Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Assets Dashboard
            </h2>
        </template>
        	

		<div class="max-w-7xl mx-auto p-5">
			<!-- Toast Message -->
			<div
				v-if="props.message"
				class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
				role="alert"
			>
				<span class="font-medium">
					{{ props.message }}
				</span>
			</div>
			<!-- END OF Toast message -->
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

							<div class="w-full pr-6 pl-6 pb-6 mt-6 border-divider">
								<h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Filter Jobs By</h2>
								<select class="appearance-none block w-full p-4 mt-3 text-base primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none">
									<option class="text-base primary-dark-blue" value="state">State</option>
									<option class="text-base primary-dark-blue" value="building">Building</option>
								</select>
								<a href="/liquijobs" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Go <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></a>
							</div>

							<div class="w-full pr-6 pl-6 pb-6 mt-6">
								<h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Quick Add New Job</h2>
								<div class="mt-3 relative flex items-center lg:items-end">
									<div id="docs-card-content" class="flex items-start lg:flex-col">
										<form class="w-full" action="/liquijobs/create">
											<!-- <form @submit.prevent="submit"  class="w-full"> -->
											<div class="flex flex-wrap">
												<div class="w-full">
													<label class="hidden block tracking-wide mb-2 " for="grid-first-name">
													Job Co Name
													</label>
													<input name="cname" class="appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Job Co Name">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													 Address
													</label>
													<input name="caddress" class="appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Address">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Contact Name
													</label>
													<input name="coname" class="appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Contact Name">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Email
													</label>
													<input name="cemail" class="appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Email">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Phone
													</label>
													<input name="cname" cotel class="appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Phone">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full mt-3" style="display: none;">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Location Address
													</label>
													<input name="loaddress" class="appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Location Address" value="Location Address">
													<p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2" for="grid-first-name">
													Start Date
													</label>
													<input name="sdate" class="appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="date" placeholder="Start Date">
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
							
							<div class="grid items-start rounded-lg bg-white p-6 mb-6">
								<!-- recent jobs -->
								<div id="recent-jobs">
									<div class="relative flex flex-col">
										<h3 class="block text-center text-2xl primary-light-blue font-rethinksansextrabold uppercase">Recent Jobs</h3>
									</div>
									<div class="w-full relative flex flex-col">
										<ul class="p-0">
											<li class="mb-6 last:mb-0" v-for="entry in props.liquijobs" :key="entry.id">
												<div class="w-full relative flex flex-col bg-white border border-[#e9ebef] rounded-lg">      
													<div class="p-4">
														<PrimaryLink v-if="entry.deleted_at == null" :href="route('liquijobs.show', {'id': entry.id})" class="float-right">View</PrimaryLink>
														<h5 class="mb-2 primary-dark-blue font-rethinksansbold text-base">
															Building: {{ entry.corporate_address }}
														</h5>
														<p class="primary-dark-blue font-rethinksansmedium text-base">
															City: {{ entry.location_address }}
														</p>
													</div>
													<div id="recent-jobs-info" class="flex justify-between bg-[#f2f4f7] px-4 py-2">
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'facilitydecomissioning'">
														Type: Facility Decomissioning
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'datacenterdecommissioning'">
														Type: Data Center Decommissioning
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'officefurniture'">
														Type: Office Furniture
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'datadestruction'">
														Type: Data Destruction
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'assetrecovery'">
														Type: Asset Recovery
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'assetmanagement'">
														Type: Asset Management
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'recycling'">
														Type: Recycling
														</span>
														
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'generatorremoval'">
														Type: Generator Removal
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'industrialremoval'">
														Type: Industrial Removal
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'it'">
														Type: IT
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'infrastructure'">
														Type: Infrastructure
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === 'furniture'">
														Type: Furniture
														</span>
														<span class="primary-dark-blue font-rethinksansmedium text-base" v-if="entry.type === null">
														Type: Unspecified
														</span>
														<span class="text-nowrap w-auto primary-dark-blue font-rethinksansmedium text-base">
														Start Date: {{ entry.start_date }}
														</span>
													</div>
												</div>
											</li>
											
										</ul>
									</div> 
								</div>
								<!-- recent jobs -->

								<!-- jobs last 7 days -->
								<div id="job-last-7-days" class="mt-6 w-full relative flex flex-col bg-white border border-[#e9ebef] rounded-lg">
									<div class="relative flex flex-col pt-4 pb-2 px-4">
										<h3 class="block w-full text-lg primary-light-blue font-rethinksansextrabold uppercase">Jobs Last 7 Days</h3>
									</div>
									<ul class="p-0">
										<li class="px-4 py-2 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none" v-for="entry in props.liquijobs" :key="entry.id">
											<div >
												<!-- <PrimaryLink v-if="entry.deleted_at == null" :href="route('liquijobs.show', {'id': entry.id})" class="float-right">View</PrimaryLink> -->
												<a :href="route('liquijobs.show', {'id': entry.id})" class="primary-dark-blue font-rethinksansbold text-base hover:opacity-80">
												Building: {{ entry.corporate_address }}
												</a>
												<!-- <span class="primary-dark-blue font-rethinksansmedium text-base" style="float: inline-end;">
													{{ entry.start_date }}
												</span> -->
											</div>
										</li>
									</ul>
								</div>
								<!-- jobs last 7 days -->

								<!-- <UpcomingJobs /> -->
								<!-- upcoming jobs -->
								<div id="upcoming-jobs" class="mt-6 w-full relative flex flex-col bg-white border border-[#e9ebef] rounded-lg">
									<div class="relative flex flex-col pt-4 pb-2 px-4">
										<h3 class="block w-full text-lg primary-light-blue font-rethinksansextrabold uppercase">Upcoming Jobs</h3>
									</div>
									<ul class="p-0">
										<li class="px-4 py-2 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none"  v-for="entry in props.liquijobs.items" :key="entry.id">
											<!-- <PrimaryLink v-if="entry.deleted_at == null" :href="route('liquijobs.show', {'id': entry.id})" class="float-right">View</PrimaryLink> -->
											<div>
												<a :href="route('liquijobs.show', {'id': entry.id})" class="primary-dark-blue font-rethinksansbold text-base hover:opacity-80">
												Building: {{ entry.corporate_address }}
												</a>
												<span class="primary-dark-blue font-rethinksansmedium text-base" style="float: inline-end;">
													{{ entry.start_date }}
												</span>
											</div>
										</li>                        
									</ul>
								</div>
								<!-- upcoming jobs -->
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