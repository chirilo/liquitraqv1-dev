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

const viewallliquiassetsurl = "/liquiassets/view?jobid=" + props.liquijobs.id;

const viewsingleliquiasseturl = "/liquiassets/";

// import { useRoute } from 'vue-router';

// const route = useRoute()
// console.log(route.query)

// const filters = {
//     filter: props.filters.filter,
// }
// const form = useForm(filters);

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
                ALL ASSETS
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
											<button id="send" type="submit" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Add New Job <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></button>
										
										</form>
									</div>

									
								</div>
							</div>
						</div>
						<!-- RIGHT PART -->
						<div id="right-side" class="lg:col-span-2 md:col-span-3">
							<!-- current job selected /recent jobs -->
							<div class="rounded-lg bg-white p-6">
								<div id="recent-jobs">
									<div class="relative flex justify-between items-start">
										<h1 class="width-60 block sm:text-2xl text-xl primary-light-blue font-rethinksansextrabold uppercase">
											All Asset for Job: 
											<span class="sm:inline block">{{props.liquijobs.company_name}}</span>
										</h1>
										<a href="/liquijobs" class="text-white py-2 px-4 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
											<img class="w-4 mr-2" src="/images/logos/back.png"> Back
										</a>
									</div>
									<ul class="p-0">
										<li>
											<!-- <h5 class="mb-2 text-slate-800 text-xl font-semibold">
													Building: {{props.liquijobs.so_number}}
												</h5> -->
											<div class="w-full relative flex flex-col" style="display: none;">
												<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Corporate Address: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.corporate_address}}</span>
													</p>
												</div>
												<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Contact Name: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.contact_name}}</span>
													</p>
												</div>
												<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Phone: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.contact_telephone}}</span>
													</p>
												</div>
												<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Email: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.contact_email}}</span>
													</p>
												</div>
												<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Location Name: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.location_address}}</span>
													</p>
												</div>
												<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Start Date: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.start_date}}</span>
													</p>
												</div>
											</div>
										</li>
										<!-- Additional Data for Job and Assets -->
										<li>
											<div class="w-full relative flex sm:flex-row flex-col">
												<div class="w-full pr-0 sm:pr-6 pb-6 sm:pb-0">
													<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
															<span class="font-rethinksansbold primary-dark-blue">Total Assets: </span><span class="font-rethinksanssemibold primary-gray">{{ props.jobassetscount }}</span>
													</div>
													<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
															<span class="font-rethinksansbold primary-dark-blue">Furniture: </span><span class="font-rethinksanssemibold primary-gray">{{props.furniturejobassets}}</span>
													</div>
													<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
															<span class="font-rethinksansbold primary-dark-blue">IT: </span><span class="font-rethinksanssemibold primary-gray">{{props.itjobassets}}</span>
													</div>
													<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
															<span class="font-rethinksansbold primary-dark-blue">Infrastructure: </span><span class="font-rethinksanssemibold primary-gray">{{props.infrastructurejobassets}}</span>
													</div>
												</div>
												<div class="w-full">
													<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Resold: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.count}}</span>
													</div>
													<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Recycled </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.count}}</span>
													</div>
													<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Disposed </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.count}}</span>
													</div>
													<div class="py-3 m-0 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Return </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.count}}</span>
													</div>
												</div>
											</div>
										</li>
										<li class="text-center">
											<!-- <button class="w-half bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> VIEW ASSETS <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </button> -->
											<!-- <a v-bind:href="liquiassetsurl" class="text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90"> Add Assets <svg class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="display: inline; float: inline-end; margin-left: 5px"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path></svg></a>

											<a v-bind:href="viewallliquiassetsurl" class="text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90"> All Assets <svg class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="display: inline; float: inline-end; margin-left: 5px;"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path></svg></a> -->
										</li>
									</ul>
								</div> 
							</div>
							<div class="rounded-lg bg-white p-6 mt-6">
								<div id="recent-assets">
									<!-- images -->
									<ul class="m-0 p-0 flex flex-col justify-start mb-3">
										<li class="m-0 p-0 w-full mb-6" v-for="item in job_assets">
										<!-- <img :src="'/uploads/images/' + item.job_asset" style="margin: 0 1em 0 1em;" width="300" height="300" onerror="https://lh3.googleusercontent.com/pw/AP1GczMGQYta83vV-qTtHVNR0Fz97llzvKe2OoGu6_OD-j6HSGe-eaTa7rcoshYfAUz4g75XPtnrA5aVzi2CC8MOHREyrIYJPYe0CzZy9D5AC0P_ffazpNPHRihvaGzKJ7IFkGwVroZM1-fqnmNZH1gIgHVabw=w1966-h1474-s-no-gm?authuser=0" /> -->
										<!-- <img class="aspect-square object-cover h-auto " style="background-image: url('https://lh3.googleusercontent.com/pw/AP1GczMGQYta83vV-qTtHVNR0Fz97llzvKe2OoGu6_OD-j6HSGe-eaTa7rcoshYfAUz4g75XPtnrA5aVzi2CC8MOHREyrIYJPYe0CzZy9D5AC0P_ffazpNPHRihvaGzKJ7IFkGwVroZM1-fqnmNZH1gIgHVabw=w1966-h1474-s-no-gm?authuser=0');" :src="'/storage/job_assets/'+item.job_asset" /> -->
											<div class="flex sm:flex-row flex-col">
												<div class="w-48 sm:mr-6">
													<a v-bind:href="viewsingleliquiasseturl+item.id">
														<img class="aspect-square object-cover h-auto " style="background-image: url('https://lh3.googleusercontent.com/pw/AP1GczMGQYta83vV-qTtHVNR0Fz97llzvKe2OoGu6_OD-j6HSGe-eaTa7rcoshYfAUz4g75XPtnrA5aVzi2CC8MOHREyrIYJPYe0CzZy9D5AC0P_ffazpNPHRihvaGzKJ7IFkGwVroZM1-fqnmNZH1gIgHVabw=w1966-h1474-s-no-gm?authuser=0');" :src="item.job_asset" />
													</a>
												</div>
												<div class="w-full relative flex flex-col">
													<h5 class="text-lg primary-light-blue font-rethinksansextrabold uppercase">
														Asset #: {{ item.id }}
													</h5>
													<div class="pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
														<div class="font-rethinksansbold primary-dark-blue width-60">Category: </div>
														<div class="font-rethinksanssemibold primary-gray width-40 uppercase">{{ item.asset_category }}</div>
													</div>
													<div class="pt-3 pb-1 m-0 border-b border-[#e9ebef] flex">
														<div class="font-rethinksansbold primary-dark-blue width-60">Status: </div>
														<div class="font-rethinksanssemibold primary-gray width-40">{{ item.asset_status }}</div>
													</div>
													<div class="mt-3">
														<a v-bind:href="viewsingleliquiasseturl+item.id" class="text-white py-2 px-4 rounded-full bg-gradient-blue text-center text-sm font-rethinksansbold hover:opacity-90">View</a>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
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