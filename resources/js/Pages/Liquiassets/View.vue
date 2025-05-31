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

import moment from "moment";
import { ref } from "vue";

const props = defineProps({
	liquijobs: String,
	job_assets: Object,
	filters: Object,
	message: String,
	currentdatetime: String,
	thisjobcompanyname: String
});

const liquijobsCreate = '/liquijobs/create';

const liquiassetsurl = "/liquiassets/create?jobid=" + props.liquijobs;

const viewallliquiassetsurl = "/liquiassets/view?jobid=" + props.liquijobs;

const parentjoburl = '/liquijobs/';

// import { useRoute } from 'vue-router';

// const route = useRoute()
// console.log(route.query)

// const filters = {
//     filter: props.filters.filter,
// }
// const form = useForm(filters);

const deleteTrade = (id) => {
	if (confirm("Are you sure you want to move this to trash")) {
		form.delete(route('liquijobs.destroy', { id: id }), {
			preserveScroll: true,
		});
	}
};

const logout = () => {
	router.post(route('logout'));
};

let isSoNumberOpen = ref(false);
let isStatusOpen = ref(false);
const handleFilterSelectChange = () => {
	let selectedval = event.target.value;
	console.log('selected' + selectedval);
	if (selectedval === 'sonumber') {
		isSoNumberOpen.value = !isSoNumberOpen.value;

		// close other
		isStatusOpen.value = false;
		document.getElementById('filter_status').removeAttribute('required');
	}



	if (selectedval === 'status') {
		isStatusOpen.value = !isStatusOpen.value;

		// close other
		isSoNumberOpen.value = false;
		document.getElementById('filter_sonumber').removeAttribute('required');
	}

}

let searchkey = ref("");
let filterkey = ref("");
let filterstatuskey = ref("");
let filtersonumberkey = ref("");

const searchanything = () => {
	router.get(route("search.index") + '?key=' + '%' + searchkey.value + '%');
}

const filteranything = () => {
	//alert('here');
	//alert(filterstatuskey.value);
	//router.get( route("search.index") + '?key=' + '%'+filterkey.value+'%'+ '?sonumber=' + '%'+filtersonumberkey.value+'%'+ '?status=' + '%'+filterstatuskey.value+'%'  );
	if (filterstatuskey.value == '' && filtersonumberkey.value) {
		router.get(route("search.index") + '?key=' + '%' + filterkey.value + '%' + '&sonumber=' + filtersonumberkey.value);
	}
	if (filterstatuskey.value && filtersonumberkey.value == '') {
		router.get(route("search.index") + '?key=' + '%' + filterkey.value + '%' + '&status=' + '%' + filterstatuskey.value + '%');
	}


}

let isOpen = ref(false);
const openMenu = () => {
	isOpen.value = !isOpen.value;
	console.log(isOpen);
};
</script>

<template>
	<AppLayout title="View Asset">
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				View Asset
			</h2>
		</template>

		<div class="max-w-7xl mx-auto p-5">
			<div class="dark:bg-gray-800 overflow-hidden sm:rounded-lg">
				<div>
					<div class="grid gap-6 lg:grid-cols-3 md:grid-cols-5 lg:gap-8">
						<!-- LEFT PART -->
						<!-- Container for Left Sidebar (search and quick add job) -->
						<div id="left-side"
							class="w-full mx-auto flex flex-col items-start overflow-hidden pb-6 pt-6 rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:col-span-1 md:col-span-2">
							<div class="relative w-full flex items-center pb-6 border-divider">
								<div class="mx-auto">
									<div class="flex items-center"><a href="/liquijobs"><img
												src="/images/logos/liquis-logo.png" alt="LiquiTraq"
												class="block md:w-40 sm:w-20"></a></div>
								</div>
							</div>
							<div class="relative w-full border-divider pt-3">
								<!-- AVATAR -->
								<div class="relative flex flex-col items-center lg:items-end">
									<div class="w-full text-center primary-gray font-rethinksansmedium text-sm">{{
										props.currentdatetime }}</div>
									<div class="pt-3 mx-auto relative flex items-center lg:items-end" v-if="$page.props.jetstream.managesProfilePhotos">
										<img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
											data-dropdown-placement="bottom-start"
											class="w-full rounded-full cursor-pointer border-1 border-black shadow-xl"
											:src="$page.props.auth.user.profile_photo_url.replace('https://phplaravel-728976-5430189.cloudwaysapps.com/liquijobs', '')" alt="User dropdown">
									</div>
									<div v-else class="pt-3 mx-auto relative flex items-center lg:items-end">
										<img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
											data-dropdown-placement="bottom-start"
											class="w-full rounded-full cursor-pointer border-1 border-black shadow-xl"
											src="/images/logos/avatar.jpg" alt="User dropdown">
									</div>
								</div>
								<!-- END OF AVATAR -->
								<!-- MY ACCOUNT -->
								<div class="w-full text-center relative py-3">
									<Dropdown align="center">
										<template #trigger>
											<div v-if="$page.props.jetstream.managesProfilePhotos">
												<button 
													class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
													<!-- {{ $page.props.auth.user.profile_photo_url }}
													<img class="rounded-full object-cover"
														:src="$page.props.auth.user.profile_photo_url"
														:alt="$page.props.auth.user.name"> -->
												</button>
												<span class="inline-flex rounded-md">
													<button type="button"
														class="inline-flex items-center border border-transparent text-base text-base primary-light-blue font-rethinksansextrabold uppercase dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
														{{ $page.props.auth.user.name }}

														<svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg"
															fill="none" viewBox="0 0 24 24" stroke-width="1.5"
															stroke="currentColor">
															<path stroke-linecap="round" stroke-linejoin="round"
																d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
														</svg>
													</button>
												</span>
											</div>
											<span v-else class="inline-flex rounded-md">
												<button type="button"
													class="inline-flex items-center border border-transparent text-base text-base primary-light-blue font-rethinksansextrabold uppercase dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
													{{ $page.props.auth.user.name }}

													<svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg"
														fill="none" viewBox="0 0 24 24" stroke-width="1.5"
														stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round"
															d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
													</svg>
												</button>
											</span>
										</template>
										<template #content>
											<!-- Account Management -->
											<div
												class="block pl-4 pr-6 py-2 text-base primary-dark-blue font-rethinksansmedium">
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
									<input v-model="searchkey" required
										class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#e9ebef] bg-white rounded-lg focus:outline-none"
										type="search" name="search" placeholder="Search anything..." />
									<button type="submit"
										class="bg-white absolute inset-y-5 right-5 w-12 z-9 px-0 w-auto"><svg
											class="size-5 shrink-0 stroke-[#8c8c97]" xmlns="http://www.w3.org/2000/svg"
											fill="none" viewBox="0 0 19.9 19.7" stroke-width="2">
											<path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4" />
											<circle cx="8" cy="8" r="7" />
										</svg></button>
								</form>
							</div>
							<!-- END OF: Search Anything -->
							<div class="w-full pr-6 pl-6 pb-6 mt-6 border-divider">
								<form @submit.prevent="filteranything">
									<h2
										class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">
										Filter Jobs By</h2>
									<select @change="handleFilterSelectChange" v-model="filterkey"
										class="appearance-none block w-full p-4 mt-3 text-base primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none">
										<input type="hidden" name="key" v-model="filterkey">
										<option class="text-base primary-dark-blue" selected disabled hidden value="">
											Select
											filter</option>
										<option class="text-base primary-dark-blue" value="status">Status</option>
										<option class="text-base primary-dark-blue" value="sonumber">SO Number</option>
									</select>
									<input
										class="mt-2 appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg"
										:class="isSoNumberOpen ? 'block' : 'hidden'" id="filter_sonumber" type="number"
										v-model="filtersonumberkey" placeholder="ex. 134010022" name="filter_sonumber"
										required />
									<!-- <input
										class="mt-2 appearance-none block w-full p-4 primary-gray placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg"
										:class="isStatusOpen ? 'block' : 'hidden'" id="filter_status" type="text"
										v-model="filterstatuskey" placeholder="ex. Work in Progress"
										name="filter_status" required /> -->
									<select :class="isStatusOpen ? 'block' : 'hidden'" v-model="filterstatuskey"
										class="appearance-none block w-full p-4 mt-3 text-base primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none">
										<option class="text-base primary-dark-blue" selected disabled hidden value="">
											Select
											status</option>
										<option class="text-base primary-dark-blue" value="New">New</option>
										<option class="text-base primary-dark-blue" value="Work In Progress">Work In Progress</option>
										<option class="text-base primary-dark-blue" value="Completed">Completed</option>
									</select>
									<button type="submit"
										class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Go
										<svg style="display: inline; float: inline-end;"
											class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg"
											fill="none" viewBox="0 0 24 24" stroke-width="1.5">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
										</svg></button>
								</form>
							</div>

							<!-- ADD JOB -->
							<div class="w-full pr-6 pl-6 pb-6 mt-6 hidden">
								<h2
									class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">
									Quick Add New Job</h2>
								<div class="mt-3 relative flex items-center lg:items-end">
									<div id="docs-card-content" class="flex items-start lg:flex-col">
										<form class="w-full" action="/liquijobs/create">
											<div class="flex flex-wrap">
												<div class="w-full">
													<label class="hidden block tracking-wide mb-2"
														for="grid-first-name">
														Company Name
													</label>
													<input name="cname"
														class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" placeholder="Company Name">
													<p class="hidden text-red-500 text-xs italic">Please fill out this
														field.
													</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2"
														for="grid-first-name">
														Corporate Address
													</label>
													<input name="caddress"
														class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" placeholder="Corporate Address">
													<p class="hidden text-red-500 text-xs italic">Please fill out this
														field.
													</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2"
														for="grid-first-name">
														Contact Name
													</label>
													<input name="coname"
														class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" placeholder="Contact Name">
													<p class="hidden text-red-500 text-xs italic">Please fill out this
														field.
													</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2"
														for="grid-first-name">
														Contact Email
													</label>
													<input name="cemail"
														class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" placeholder="Contact Email">
													<p class="hidden text-red-500 text-xs italic">Please fill out this
														field.
													</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2"
														for="grid-first-name">
														Contact Telephone
													</label>
													<input name="cname" cotel
														class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" placeholder="Contact Telephone">
													<p class="hidden text-red-500 text-xs italic">Please fill out this
														field.
													</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2"
														for="grid-first-name">
														Location Name
													</label>
													<input name="loaddress"
														class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" placeholder="Location Name">
													<p class="hidden text-red-500 text-xs italic">Please fill out this
														field.
													</p>
												</div>
												<div class="w-full mt-3">
													<label class="hidden block tracking-wide mb-2"
														for="grid-first-name">
														Start Date
													</label>
													<input name="sdate"
														class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" placeholder="Start Date">
													<p class="hidden text-red-500 text-xs italic">Please fill out this
														field.
													</p>
												</div>
											</div><button id="send" type="submit"
												class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Add
												New <svg style="display: inline; float: inline-end;"
													class="size-6 shrink-0 stroke-[#FFFFFF]"
													xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
													stroke-width="1.5">
													<path stroke-linecap="round" stroke-linejoin="round"
														d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
											</svg></button>
										</form>
										<!-- <form @submit.prevent="submitaddjob" class="w-full">
											<div class="flex flex-wrap">
												<div class="w-full">
													<InputLabel for="company_name" value="Job Co Name" />
													<TextInput id="company_name" type="text" placeholder="Job Co Name"
														v-model="form.company_name" required />
													<InputError class="mt-2" :message="form.errors.company_name" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="corporate_address" value="Corporate Address" />
													<TextInput id="corporate_address" type="text" placeholder="Corporate Address"
														v-model="form.corporate_address" required />
													<InputError class="mt-2" :message="form.errors.corporate_address" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="contact_name" value="Contact Name" />
													<TextInput id="contact_name" type="text" placeholder="Contact Name"
														v-model="form.contact_name" required />
													<InputError class="mt-2" :message="form.errors.contact_name" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="contact_email" value="Email" />
													<TextInput id="contact_email" type="email" placeholder="Email"
														v-model="form.contact_email" required />
													<InputError class="mt-2" :message="form.errors.contact_email" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="contact_telephone" value="Phone" />
													<TextInput id="contact_telephone" type="tel" placeholder="Phone"
														v-model="form.contact_telephone" required />
													<InputError class="mt-2" :message="form.errors.contact_telephone" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="location_address" value="Location Name" />
													<TextInput id="location_address" type="text"
														placeholder="Location Name" v-model="form.location_address"
														required />
													<InputError class="mt-2" :message="form.errors.location_address" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="start_date" value="Start Date" />
													<TextInput id="start_date" type="date" placeholder="YYYY-MM-DD"
														v-model="form.start_date" required />
													<InputError class="mt-2" :message="form.errors.start_date" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="type" value="Job Type" />
													<select v-model="form.type" id="type"
														class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														name="type">
														<option value="" selected disabled hidden>Job Type</option>
														<option value="facilitydecomissioning">Facility Decomissioning
														</option>
														<option value="datacenterdecommissioning">Data Center
															Decommissioning
														</option>
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
											<button id="send" type="submit"
												class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Add
												New <svg style="display: inline; float: inline-end;"
													class="size-6 shrink-0 stroke-[#FFFFFF]"
													xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
													stroke-width="1.5">
													<path stroke-linecap="round" stroke-linejoin="round"
														d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
												</svg></button>
										</form> -->
									</div>
								</div>
							</div>
						</div>
						<!-- RIGHT PART -->
						<div id="right-side" class="lg:col-span-2 md:col-span-3">
							<!-- current job selected /recent jobs -->
							<div class="rounded-lg bg-white p-6">
								<div id="recent-jobs">
									<ul class="p-0">
										<li class="m-0" v-for="item in job_assets" :key="id" :value="id">
											<div class="relative flex justify-between items-start sm:flex-row flex-col-reverse">
												<h1 class="w-full sm:w-[60%] block text-2xl primary-light-blue font-rethinksansextrabold uppercase mt-6 sm:mt-0 text-center sm:text-left ">
													Job: <span>{{ props.thisjobcompanyname }}</span>
												</h1>
												<div class="flex justify-center sm:justify-end sm:w-auto w-full">
													<a v-bind:href="parentjoburl + item.job_id"
														class="text-white py-2 px-4 rounded-full bg-gradient-blue text-center text-sm font-rethinksansbold hover:opacity-90 flex">
														<img class="w-4 mr-2" src="/images/logos/back.png"> Back
													</a>
													<a href="/liquijobs" class="text-white ml-1 py-2 px-2 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
														<img class="w-5" src="/images/logos/home.png">
													</a>
												</div>
											</div>
											<h5
												class="hidden w-full mt-6 block text-xl primary-dark-blue font-rethinksansextrabold uppercase">
												Asset #: {{ item.id }}
											</h5>
											<div class="w-full relative flex flex-col">
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">
														Category: </div>
													<!-- <div class="font-rethinksanssemibold primary-gray width-40">{{ item.asset_category }}</div> -->
													<div
														class="font-rethinksanssemibold primary-gray lg:w-[40%] md:w-[60%]">
														<span v-if="item.asset_category == 'furniture'">
															Furniture
														</span>
														<span v-if="item.asset_category == 'infrastructure'">
															Infrastructure
														</span>
														<span v-if="item.asset_category == 'it'">
															IT
														</span>
													</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">
														Quantity: </div>
													<div class="font-rethinksanssemibold primary-gray width-40">{{
														item.asset_quantity }}</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">Type:
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">
														<!-- {{item.asset_type }} -->
														<!-- Furniture -->
														<span v-if="item.asset_type == 'furniture-cubicle'">
															Cubicle
														</span>
														<span v-if="item.asset_type == 'furniture-casegood'">
															Case Good
														</span>
														<span v-if="item.asset_type == 'furniture-chair'">
															Chair
														</span>
														<span v-if="item.asset_type == 'furniture-wallhanging'">
															Wall Hanging
														</span>
														<span v-if="item.asset_type == 'furniture-appliance'">
															Appliance
														</span>
														<span v-if="item.asset_type == 'furniture-others'">
															Others
														</span>
														<!-- End Furniture -->
														<!-- IT -->
														<span v-if="item.asset_type == 'it-networkgear'">
															Network Gear
														</span>
														<span v-if="item.asset_type == 'it-servers'">
															Servers
														</span>
														<span v-if="item.asset_type == 'it-pcs'">
															PCs
														</span>
														<span v-if="item.asset_type == 'it-laptops'">
															Laptops
														</span>
														<span v-if="item.asset_type == 'it-rack'">
															Rack
														</span>
														<span v-if="item.asset_type == 'it-telecom'">
															Telecom
														</span>
														<span v-if="item.asset_type == 'it-monitors'">
															Monitors
														</span>
														<span v-if="item.asset_type == 'it-camera'">
															Camera
														</span>
														<span v-if="item.asset_type == 'it-printers'">
															Printers
														</span>
														<span v-if="item.asset_type == 'furniture-others'">
															Others
														</span>
														<!-- End IT -->
														<!-- Infrastructure -->
														<span v-if="item.asset_type == 'infrastructure-generator'">
															Generator
														</span>
														<span v-if="item.asset_type == 'infrastructure-cracunit'">
															CRAC Unit
														</span>
														<span v-if="item.asset_type == 'infrastructure-ups'">
															UPS
														</span>
														<span v-if="item.asset_type == 'infrastructure-ats'">
															ATS
														</span>
														<span v-if="item.asset_type == 'infrastructure-bypass'">
															Bypass
														</span>
														<span v-if="item.asset_type == 'infrastructure-switchgear'">
															Switchgear
														</span>
														<span v-if="item.asset_type == 'infrastructure-batteries'">
															Batteries
														</span>
														<span
															v-if="item.asset_type == 'infrastructure-wiringlowvoltage'">
															Wiring, Low-Voltage
														</span>
														<span
															v-if="item.asset_type == 'infrastructure-wiringhighvoltage'">
															Wiring, High-Voltage
														</span>
														<span
															v-if="item.asset_type == 'infrastructure-firesuppressant'">
															Fire Suppressant
														</span>
														<span v-if="item.asset_type == 'infrastructure-raisedflooring'">
															Raised Flooring
														</span>
														<span v-if="item.asset_type == 'infrastructure-paintchemical'">
															Paint/Chemical
														</span>
														<span v-if="item.asset_type == 'infrastructure-others'">
															Others
														</span>
														<!-- End Infrastructure -->
													</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">Make:
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">{{
														item.asset_make }}</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">Model:
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">{{
														item.asset_model }}</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">Serial:
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">{{
														item.asset_serial }}</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">Weight
														Each:
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">{{
														item.asset_weight_each }}</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">
														Description:
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">{{
														item.asset_description }}</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">Status:
													</div>
													<!-- <div class="font-rethinksanssemibold primary-gray width-40 uppercase">{{ item.asset_status }}</div> -->
													<div
														class="font-rethinksanssemibold primary-gray lg:w-[40%] md:w-[60%]">
														<span v-if="item.asset_status == 'workinprogress'">
															Work In Progress
														</span>
														<span v-if="item.asset_status == 'completed'">
															Completed
														</span>
														<span v-if="item.asset_status == 'originalstate'">
															Original State
														</span>
													</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">
														Asset Disposition:
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40"><!-- {{
														item.asset_disposition }} -->
														<span v-if="item.asset_disposition == 'resold'">
															Resold
														</span>
														<span v-if="item.asset_disposition == 'recycled'">
															Recycled
														</span>
														<span v-if="item.asset_disposition == 'disposed'">
															Disposed
														</span>
														<span v-if="item.asset_disposition == 'returned'">
															Returned
														</span>
													</div>
												</div>
												<div class="pt-3 pb-1 m-0 last:mb-2 border-b border-[#e9ebef] flex">
													<div class="font-rethinksansbold primary-dark-blue w-[60%]">
														Asset Disposition Information:
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">
														<span>
															Date: {{ item.assetdisdate }}
														</span>
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">
														<span>
															Who: {{ item.assetdiswho }}
														</span>
													</div>
													<div class="font-rethinksanssemibold primary-gray width-40">
														<span>
															Ticket / Shipping Info: {{ item.assetdisticketshippinginfo }}
														</span>
														
													</div>
												</div>
											</div>
											<ul class="mt-6 p-0 flex justify-between">
												<li class="m-0 p-0 w-[45%]" v-for="item in job_assets" :key="id"
													:value="id">
													<img class="h-auto w-full"
														style="background-image: url('https://lh3.googleusercontent.com/pw/AP1GczMGQYta83vV-qTtHVNR0Fz97llzvKe2OoGu6_OD-j6HSGe-eaTa7rcoshYfAUz4g75XPtnrA5aVzi2CC8MOHREyrIYJPYe0CzZy9D5AC0P_ffazpNPHRihvaGzKJ7IFkGwVroZM1-fqnmNZH1gIgHVabw=w1966-h1474-s-no-gm?authuser=0');"
														:src="item.job_asset" />
												</li>
											</ul>
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
						<div id="calendar-container"
							class="flex flex-col items-start gap-12 overflow-hidden rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-12 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
							<Calendar />
						</div>
					</div>

				</div> <!-- end of unlabeled div -->
			</div>
		</div>
		<!-- -->

	</AppLayout>

</template>