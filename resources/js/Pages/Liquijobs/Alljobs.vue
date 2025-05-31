<script setup>
import { Head, Link, useForm, usePage, router} from '@inertiajs/vue3';
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

import { ref } from "vue";
import moment from "moment";


// const liquijobsCreate = function(event) {
// 	window.open("/liquijobs/create");
// }

const liquijobsCreate = '/liquijobs/create';

const props = defineProps({
    liquijobs : Object,
    filters : Object,
    message : String,
    showeditdelete: String,
    currentdatetime: String,
});

const filters = {
    filter: props.filters.filter,
}
//const form = useForm(filters);

const deleteTrade = (id) => {
    if (confirm("Are you sure you want to move this to trash?")) {
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

let isSoNumberOpen = ref(false);
let isStatusOpen = ref(false);
const handleFilterSelectChange = () => {
	let selectedval = event.target.value;
	console.log('selected'+selectedval);
	if( selectedval === 'sonumber' ){
		isSoNumberOpen.value = !isSoNumberOpen.value;

		// close other
		isStatusOpen.value = false;
		document.getElementById('filter_status').removeAttribute('required');
	}
	


	if( selectedval === 'status' ){
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
	router.get( route("search.index") + '?key=' + '%'+searchkey.value+'%' );
}

const filteranything = () => {
	//alert('here');
	//alert(filterstatuskey.value);
	//router.get( route("search.index") + '?key=' + '%'+filterkey.value+'%'+ '?sonumber=' + '%'+filtersonumberkey.value+'%'+ '?status=' + '%'+filterstatuskey.value+'%'  );
	if ( filterstatuskey.value == '' && filtersonumberkey.value ){
		router.get( route("search.index") + '?key=' + '%'+filterkey.value+'%'+ '&sonumber=' + filtersonumberkey.value  );
	}
	if (filterstatuskey.value && filtersonumberkey.value == ''){
		router.get( route("search.index") + '?key=' + '%'+filterkey.value+'%'+ '&status=' + '%'+filterstatuskey.value+'%'  );
	}
	
	
}

let isOpen = ref(false);
const openMenu = (e) => {
	let thisid = e.target.id;
	//alert(e.target.id)
	console.log('target'+ e.target.nextSibling);
	let nextsibling = e.target.nextSibling;
	let nextsiblingid = nextsibling.id;
	//alert(nextsiblingid)
	let hiddenclasscontain = document.getElementById(nextsiblingid).classList.contains('hidden');
	let blockclasscontain = document.getElementById(nextsiblingid).classList.contains('block');
	//alert(classcontain);
	if( hiddenclasscontain == true ){
		//alert(classcontain);
		document.getElementById(nextsiblingid).classList.remove('hidden');
		document.getElementById(nextsiblingid).classList.add('block');
	}
	else if( blockclasscontain == true ){
		document.getElementById(nextsiblingid).classList.remove('block');
		document.getElementById(nextsiblingid).classList.add('hidden');
	}
	
	// console.log(nextsiblingid);
	// isOpen.value = !isOpen.value;
	// console.log(isOpen);
};


const browsertimezone  = Intl.DateTimeFormat().resolvedOptions().timeZone;
console.log('browsertimezone' + browsertimezone);
const today = new Date();
const monthName = today.toLocaleString('default', { month: 'long' });
const dayNumber = today.getDate();
const year = today.getFullYear();

const date = new Date();
const formatter = new Intl.DateTimeFormat('en-US', {
    timeZone: browsertimezone,
    hour: 'numeric',
    minute: 'numeric',
    //second: 'numeric',
});

const fulldatebasedonbrowser = monthName + " " + dayNumber + ", " + year + " - " + formatter.format(date);
// console.log(monthName + dayNumber + formatter.format(date));
// console.log(fulldatebasedonbrowser);
</script>

<template>
    <AppLayout title="Job Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Job Dashboard
            </h2>
        </template>

		<div class="max-w-7xl mx-auto p-5">
			<!-- Toast message -->
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
						<div id="left-side" class="w-full mx-auto flex flex-col items-start overflow-hidden pb-6 pt-6 rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:col-span-1 md:col-span-2">
							<div class="relative w-full flex items-center pb-6 border-divider">
								<div class="mx-auto">
									<div class="flex items-center"><a href="/liquijobs"><img src="/images/logos/liquis-logo.png" alt="LiquiTraq" class="block md:w-40 sm:w-20"></a></div>
								</div>
							</div>
							<div class="relative w-full border-divider pt-3">
								<!-- AVATAR -->
								<div class="relative flex flex-col items-center lg:items-end">
									<div class="w-full text-center primary-gray font-rethinksansmedium text-sm">{{
										fulldatebasedonbrowser }}</div>
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
									<input v-model="searchkey" required class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#e9ebef] bg-white rounded-lg focus:outline-none" type="search" name="search" placeholder="Search anything..." />
									<button type="submit" class="bg-white absolute inset-y-5 right-5 w-12 z-9 px-0 w-auto"><svg class="size-5 shrink-0 stroke-[#8c8c97]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19.9 19.7" stroke-width="2"><path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4"/><circle cx="8" cy="8" r="7"/></svg></button>
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
							<!-- Quick Add New Job -->
							<div class="w-full pr-6 pl-6 pb-6 mt-6">
								<h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Quick Add New Job</h2>
								<div class="mt-3 relative flex items-center lg:items-end">
									<div id="docs-card-content" class="flex items-start lg:flex-col">
										<form @submit.prevent="submitaddjob" class="w-full">
											<div class="flex flex-wrap">
												<div class="w-full">
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
												<div class="w-full mt-3">
													<InputLabel for="corporate_address" value="Corporate Address" />
													<TextInput
		                                                id="corporate_address"
		                                                type="text"
		                                                placeholder="Corporate Address"
		                                                v-model="form.corporate_address"
		                                                required
		                                            />
		                                            <InputError class="mt-2" :message="form.errors.corporate_address" />
												</div>
												<div class="w-full mt-3">
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
												<div class="w-full mt-3">
													<InputLabel for="contact_email" value="Email" />
													<TextInput
		                                                id="contact_email"
		                                                type="email"
		                                                placeholder="Email"
		                                                v-model="form.contact_email"
		                                                required
		                                            />
		                                            <InputError class="mt-2" :message="form.errors.contact_email" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="contact_telephone" value="Phone" />
													<TextInput id="contact_telephone" min="1" type="number" placeholder="Phone"
														v-model="form.contact_telephone" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" required @keydown="(e: KeyboardEvent) => { if (e.key === '-') e.preventDefault()}" />
													<InputError class="mt-2" :message="form.errors.contact_telephone" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="location_address" value="Location Name" />
													<TextInput
		                                                id="location_address"
		                                                type="text"
		                                                placeholder="Location Name"
		                                                v-model="form.location_address"
		                                                required
		                                            />
		                                            <InputError class="mt-2" :message="form.errors.location_address" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="start_date" value="Start Date" />
		                                            <TextInput
		                                                id="start_date"
		                                                type="date"
		                                                placeholder="YYYY-MM-DD"
		                                                v-model="form.start_date"
		                                                required
		                                            />
		                                            <InputError class="mt-2" :message="form.errors.start_date" />
												</div>
												<div class="w-full mt-3">
		                                            <InputLabel for="type" value="Job Type"/>
		                                            <select v-model="form.type" id="type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="type">
		                                            	<option value="" selected disabled hidden>Job Type</option>
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
											<button id="send" type="submit" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Add New <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></button>
										</form>
									</div>
								</div>
							</div>
							<!-- END OF: Quick Add New Job -->
						</div>
						<!-- RIGHT PART -->
						<div id="right-side" class="lg:col-span-2 md:col-span-3">
							
							<div class="grid items-start rounded-lg bg-white p-6 mb-6">
								<!-- recent jobs -->
								<div id="recent-jobs">
									<div class="relative flex justify-between items-end">
										<h3 class="w-[60%] block text-2xl primary-light-blue font-rethinksansextrabold uppercase">All Jobs</h3>
										<!-- LINK TO JOBS archive page -->
                                    	<!-- <a href="/liquijobs?&alljobs=1" class="text-white py-2 px-4 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
											View All
										</a> -->
										<a href="/liquijobs" class="text-white py-2 px-4 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
											<img class="w-4 mr-2" src="/images/logos/back.png"> Back
										</a>
									</div>
									<div v-if="props.liquijobs" class="w-full relative flex flex-col">
										<ul class="p-0">
											<li class="mb-6 last:mb-0" v-for="entry in props.liquijobs" :key="entry.id">
												<div class="w-full relative flex flex-col bg-white border border-[#e9ebef] rounded-lg">      
													<div class="p-3 sm:pr-4 pr-2">
														<button :id="entry.id" @click="openMenu" type="button"
															class="float-right text-xl font-bold color-[#98a2b3] ml-1 px-3 rounded-full hover:color-[#323581] hover:bg-[#f2f4f7]">
															&#8942;
														</button>
														<div :id="'actionbuttons'+entry.id" :class="isOpen ? 'block' : 'hidden'">
															<PrimaryLink v-if="entry.deleted_at == null"
																:href="route('liquijobs.show', { 'id': entry.id })"
																class="max-w-xl ml-1 float-right mb-3">View
															</PrimaryLink>
															<!-- {{ props.showeditdelete }} -->
															<div v-if="props.showeditdelete == 'admin'">
																<PrimaryLink v-if="entry.deleted_at == null"
																	:href="route('liquijobs.edit', { 'id': entry.id })"
																	class="max-w-xl ml-1 float-right mb-3">Edit
																</PrimaryLink>
																<DangerButton class="ml-3 float-right mb-3"
																	@click="deleteTrade(entry.id)"
																	v-if="entry.deleted_at == null">
																	Trash
																</DangerButton>
															</div>
															<div v-else>
																<PrimaryLink v-if="entry.deleted_at == null"
																	:href="route('liquijobs.edit', { 'id': entry.id })"
																	class="max-w-xl ml-1 float-right mb-3">Edit
																</PrimaryLink>
															</div>
														</div>
														<h5 class="mb-2 primary-dark-blue font-rethinksansbold text-base">
															<a :href="route('liquijobs.show', {'id': entry.id})" class="hover:opacity-80">Building: {{ entry.corporate_address }}</a>
														</h5>
														<p class="primary-dark-blue font-rethinksansmedium text-base">
															City: {{ entry.location_address }}
														</p>
													</div>
													<div class="flex justify-between bg-[#f2f4f7] px-4 py-2  flex-col sm:flex-row">
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
														Start Date: {{ moment(entry.start_date).format("MMMM D, YYYY")  }} 
														</span>
													</div>
												</div>
											</li>
											
										</ul>
									</div> 
									<div v-else class="w-full relative flex flex-col">
										<h1 style="text-align: center;font-size: 1.5em; margin-top: 2em;">No Jobs Recorded</h1>
									</div>
								</div>
								<!-- recent jobs -->
								
							 </div>
							<!-- CALENDAR -->
							<div style="display: none;" id="calendar-container" class="mt-6 grid items-start rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
								<Calendar />
							</div>
						</div>
					</div>
				</div> <!-- end of unlabeled div -->
			</div>
		</div>
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
				    <!-- <tr v-if="props.liquijobs.length === 0">
					 <td class="px-6 py-4 border-t" colspan="4">No posts found.</td>
				    </tr> -->
				  </tbody>
				</table>
			</div>
			   <!-- <pagination class="mt-6" :links="props.liquijobs.links" /> -->
			</div>
		</div>
        <!-- -->
    </AppLayout>
    	
</template>