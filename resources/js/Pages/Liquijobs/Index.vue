<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';

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
const form = useForm(filters);

const deleteTrade = (id) => {
    if (confirm("Are you sure you want to move this to trash")) {
	   form.delete(route('liquijobs.destroy',{id:id}), {
		  preserveScroll: true,
	   });
    }
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
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

							<!-- <input class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="search" name="search" placeholder="Search anything" /> -->
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
											<button id="send" type="submit" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Add New <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></button>
										
										</form>
									</div>

									
								</div>
							</div>
						</div>

						<!-- RIGHT PART -->
						<div id="right-side" class="lg:col-span-2 md:col-span-3">
								
							<!-- recent jobs -->
							<div id="recent-jobs" class="grid items-start rounded-lg bg-white p-6 mb-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:pb-10">
								<div class="relative flex flex-col " style="width: 100%; text-align: center;">
									<h3 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Recent Jobs</h3>
								</div>
								<div class="relative flex flex-col rounded-lg bg-white shadow-sm border border-slate-200" style="width: 100%;">
									<ul style="padding: 0 0.5rem 0 0.5rem;">
										<li v-for="entry in props.liquijobs.data" :key="entry.id">
											<div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96" style="width: 100%;">      
												<div class="p-4">
												<PrimaryLink v-if="entry.deleted_at == null" :href="route('liquijobs.show', {'id': entry.id})" class="max-w-xl ml-2 float-right" style="background-color: #292d73;">VIEW</PrimaryLink>
												<h5 class="mb-2 text-slate-800 text-xl font-semibold">
													Building: {{ entry.corporate_address }}
												</h5>
												<p class="text-slate-600 leading-normal font-light">
													City: {{ entry.location_address }}
												</p>
												</div>
												<div class="mx-3 border-t border-slate-200 pb-3 pt-2 px-1">
												
												<span class="text-sm text-slate-600 font-medium" v-if="entry.type === 'it'">
												Type: IT
												</span>
												<span class="text-sm text-slate-600 font-medium" v-if="entry.type === 'furniture'">
												Type: Furniture
												</span>
												<span class="text-sm text-slate-600 font-medium" v-if="entry.type === 'infrastructure'">
												Type: Infrastructure
												</span>
												<span class="text-sm text-slate-600 font-medium" v-if="entry.type === null">
												Type: Unspecified
												</span>
												
												
												<span class="text-sm text-slate-600 font-medium" style="float: inline-end;">
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
							<div id="job-last-7-days" class="grid items-start rounded-lg bg-white p-6 mb-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:pb-10">
								<div class="relative flex flex-col " style="width: 100%;">
									<h3 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Jobs Last 7 Days</h3>
								</div>
								<div class="relative flex flex-col rounded-lg bg-white border-slate-200" style="width: 100%;">
								<ul style="padding: 0;">
									
									<li v-for="entry in props.liquijobs.data" :key="entry.id">
										<div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96" style="width: 100%;">  
											<div style="padding: 0.5em 1em 0em 0em;"><PrimaryLink v-if="entry.deleted_at == null" :href="route('liquijobs.show', {'id': entry.id})" class="max-w-xl ml-2 float-right" style="background-color: #292d73; width: fit-content;">VIEW</PrimaryLink></div>
											<div class="mx-3 border-slate-200 pb-3 pt-2 px-1">
												<span class="text-sm text-slate-600 font-medium">
												Building: {{ entry.corporate_address }}
												</span>
												<span class="text-sm text-slate-600 font-medium" style="float: inline-end;">
													{{ entry.start_date }}
												</span>
											</div>
										</div>
									</li>
								</ul>
								</div> 
							</div>
							<!-- jobs last 7 days -->

							<!-- <UpcomingJobs /> -->
							<!-- upcoming jobs -->
							<div id="upcoming-jobs" class="grid items-start rounded-lg bg-white p-6 mb-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:pb-10">
								<div class="relative flex flex-col " style="width: 100%;">
									<h3 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Upcoming Jobs</h3>
								</div>
								<div class="relative flex flex-col rounded-lg bg-white border-slate-200" style="width: 100%;">
									<ul style="padding: 0;">

										<li v-for="entry in props.liquijobs.data" :key="entry.id">
											<div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96" style="width: 100%;">  

											<div style="padding: 0.5em 1em 0em 0em;"><PrimaryLink v-if="entry.deleted_at == null" :href="route('liquijobs.show', {'id': entry.id})" class="max-w-xl ml-2 float-right" style="background-color: #292d73; width: fit-content;">VIEW</PrimaryLink></div>   
											<div class="mx-3 border-slate-200 pb-3 pt-2 px-1">

												<span class="text-sm text-slate-600 font-medium">
												Building: {{ entry.corporate_address }}
												</span>
												<span class="text-sm text-slate-600 font-medium" style="float: inline-end;">
													{{ entry.start_date }}
												</span>
											</div>
											</div>
										</li>                             
									</ul>
								</div>
							</div>
							<!-- upcoming jobs -->
							<!-- CALENDAR -->
							<div id="calendar-container" class="grid items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
								<Calendar />
							</div>
						</div>
					</div>
				</div> <!-- end of unlabeled div -->
			</div>
		</div>

        <!-- -->
        <h1 style="display: none;">INDEX VUE PAGE</h1>
		<div class="py-12" style="display: none;">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			
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
			
			<div class="bg-white rounded-md shadow overflow-x-auto">
				<table class="w-full whitespace-nowrap">
				  <thead>
				    <tr class="text-left font-bold">
					 <th class="pb-4 pt-6 px-6">Building</th>
					 <th class="pb-4 pt-6 px-6">SO Number</th>
					 <th class="pb-4 pt-6 px-6">Publsihed Date</th>
					 <th class="pb-4 pt-6 px-6">Actions</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr v-for="entry in props.liquijobs.data" :key="entry.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
					 <td class="border-t">
					   <span class="flex items-center px-6 py-4 focus:text-indigo-500">
						{{ entry.building }}
					   </span>
					 </td>
					 <td class="border-t">
					   <span class="flex items-center px-6 py-4 focus:text-indigo-500">
						{{ entry.so_number }}
					   </span>
					 </td>
					 <td class="border-t">
					   <span class="flex items-center px-6 py-4 focus:text-indigo-500">
						{{ entry.created_at }}
					   </span>
					 </td>
					 <td class="border-t" >
					 	<PrimaryLink v-if="entry.deleted_at == null" :href="route('liquijobs.show', {'id': entry.id})" class="max-w-xl ml-2" >VIEW</PrimaryLink>
					   	<PrimaryLink v-if="entry.deleted_at == null" :href="route('liquijobs.edit', {'id': entry.id})" class="max-w-xl ml-2" >EDIT</PrimaryLink>
					   	<DangerButton
						class="ml-3"
						@click="deleteTrade(entry.id)" v-if="entry.deleted_at == null"
						>
						Trash
					   </DangerButton>
					 </td>
				    </tr>
				    <tr v-if="props.liquijobs.data.length === 0">
					 <td class="px-6 py-4 border-t" colspan="4">No posts found.</td>
				    </tr>
				  </tbody>
				</table>
			</div>
			   <pagination class="mt-6" :links="props.liquijobs.links" />
			</div>
		</div>
        <!-- -->
    </AppLayout>
    	
</template>