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
import InputLabel from '@/Components/InputLabel.vue';

import { ref } from "vue";

import moment from "moment";

let jobconame = ref("");

const props = defineProps({
    liquijobs: Object,
    job_assets: Object,
    jobassetscount: String,
    itjobassets: String,
    infrastructurejobassets: String,
    furniturejobassets: String,
    filters: Object,
    message: String,
    currentdatetime: String,
    jobownername: String,
    jobownerid: String,
    liquisemployees: Object,
    userrole: String,
});

const liquijobsCreate = '/liquijobs/create';

const liquiassetsurl = "/liquiassets/create?jobid=" + props.liquijobs.id;

const viewallliquiassetsurl = "/liquijobs/" + props.liquijobs.id + '?all=1';

const backtoprevjob = "/liquijobs/" + props.liquijobs.id;

const viewsingleliquiasseturl = "/liquiassets/";

// import { useRoute } from 'vue-router';

// const route = useRoute()
// console.log(route.query)

// const filters = {
//     filter: props.filters.filter,
// }
// const form = useForm(filters);

const form = useForm({
    id: props.liquijobs.id ? '13401002' + props.liquijobs.id : '13401002',
    company_name: props.liquijobs.company_name ? props.liquijobs.company_name : '',
    corporate_address: props.liquijobs.corporate_address ? props.liquijobs.corporate_address : '',
    contact_name: props.liquijobs.contact_name ? props.liquijobs.contact_name : '',
    contact_telephone: props.liquijobs.contact_telephone ? props.liquijobs.contact_telephone : '',
    contact_email: props.liquijobs.contact_email ? props.liquijobs.contact_email : '',
    location_address: props.liquijobs.location_address ? props.liquijobs.location_address : '',
    start_date: props.liquijobs.start_date ? props.liquijobs.start_date : '',
    type: props.liquijobs.type ? props.liquijobs.type : '',
    status: props.liquijobs.status ? props.liquijobs.status : 'New',
    liquis_employee: props.jobownerid ? props.jobownerid : '',
});
// from Create.vue
const submitaddjob = () => {
    form.post(route("liquijobs.store"));
};

const deleteTrade = (id) => {
    if (confirm("Are you sure you want to move this to trash?")) {
        form.delete(route('liquijobs.destroy', { id: id }), {
            preserveScroll: true,
        });
    }
};

// from Create.vue
const updatejob = (id) => {
    form.put(route('liquijobs.update', { id: props.liquijobs.id }));
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
	
	//router.get( route("search.index") + '?key=' + '%'+filterkey.value+'%'+ '?sonumber=' + '%'+filtersonumberkey.value+'%'+ '?status=' + '%'+filterstatuskey.value+'%'  );
	if ( filterstatuskey.value == '' && filtersonumberkey.value ){
		router.get( route("search.index") + '?key=' + '%'+filterkey.value+'%'+ '&sonumber=' + filtersonumberkey.value  );
	}
	if (filterstatuskey.value && filtersonumberkey.value == ''){
		router.get( route("search.index") + '?key=' + '%'+filterkey.value+'%'+ '&status=' + '%'+filterstatuskey.value+'%'  );
	}
	
	
}

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
    <AppLayout title="Edit Job">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Job
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
												class="block sm:w-[160px] w-[140px]"></a></div>
								</div>
							</div>
							<div class="relative w-full border-divider pt-3">
								<!-- AVATAR -->
								<div class="relative flex flex-col items-center lg:items-end">
									<div class="w-full text-center primary-gray font-rethinksansmedium text-sm">{{
										fulldatebasedonbrowser }}</div>
									<div class="w-full pt-3 mx-auto relative flex justify-center lg:items-end" v-if="$page.props.jetstream.managesProfilePhotos">
										<img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
											data-dropdown-placement="bottom-start"
											class="sm:w-[160px] w-[140px] rounded-full cursor-pointer border-1 border-black shadow-xl"
											:src="$page.props.auth.user.profile_photo_url.replace('https://phplaravel-728976-5430189.cloudwaysapps.com/liquijobs', '')" alt="Profile Picture">
									</div>
									<div v-else class="pt-3 mx-auto relative flex items-center lg:items-end">
										<img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
											data-dropdown-placement="bottom-start"
											class="sm:w-[160px] w-[140px] w-full rounded-full cursor-pointer border-1 border-black shadow-xl"
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
                            <div class="w-full pr-6 pl-6 mt-6">
								<form @submit.prevent="filteranything">
									<h2
										class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">
										Filter Jobs By</h2>
									<select @change="handleFilterSelectChange" v-model="filterkey"
										class="appearance-none block w-full p-4 mt-3 text-base primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none">
										<input type="hidden" name="key" v-model="filterkey">
										<option class="text-base md:text-xs lg:text-base primary-dark-blue" selected disabled hidden value="">
											Select
											filter</option>
										<option class="text-base md:text-xs lg:text-base primary-dark-blue" value="status">Status</option>
										<option class="text-base md:text-xs lg:text-base primary-dark-blue" value="sonumber">SO Number</option>
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
										<option class="text-base md:text-xs lg:text-base primary-dark-blue" selected disabled hidden value="">
											Select
											status</option>
										<option class="text-base md:text-xs lg:text-base primary-dark-blue" value="New">New</option>
										<option class="text-base md:text-xs lg:text-base primary-dark-blue" value="Work In Progress">Work In Progress</option>
										<option class="text-base md:text-xs lg:text-base primary-dark-blue" value="Completed">Completed</option>
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
                        </div>
                        <!-- RIGHT PART -->
                        <div id="right-side" class="lg:col-span-2 md:col-span-3">
                            <!-- current job selected /recent jobs -->

                            <div class="grid items-start rounded-lg bg-white p-6">
                                <div class="relative flex justify-between items-start">
                                    <h1
                                        class="w-[60%] block sm:text-2xl text-xl primary-light-blue font-rethinksansextrabold uppercase">
                                        Edit Job: <span class="sm:inline block">{{ props.liquijobs.company_name
                                        }}</span>
                                    </h1>
                                    <!-- LINK TO JOBS archive page -->
                                    <a :href="backtoprevjob"
                                        class="text-white py-2 px-4 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
                                        <img class="w-4 mr-2" src="/images/logos/back.png"> Back
                                    </a>
                                </div>
                                <form @submit.prevent="updatejob" class="mt-6" enctype="multipart/form-data">
                                    <div
                                        class="flex border-divider pb-2 items-end justify-between sm:justify-end flex-row">
                                        <InputLabel for="id" value="SO Number" class="w-full lg:w-[60%]" />
                                        <input id="id" type="text" :value="form.id" disabled
                                            class="w-auto lg:w-[40%] appearance-none block w-full px-4 py-0 primary-dark-blue font-rethinksansmedium border-[#fff]" />
                                    </div>
                                    <div
                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
                                        <InputLabel for="company_name" value="Job Co Name" class="w-full lg:w-[60%]" />
                                        <TextInput class="w-full lg:w-[40%] px-4 py-2" id="company_name" type="text"
                                            v-model="form.company_name" required />
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.company_name" /> -->
                                    </div>

                                    <div
                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap" v-if="props.userrole == 'admin'">
                                        <InputLabel for="liquis_employee_name" value="Liquis Employee Name" class="w-full lg:w-[60%]" />
                                        <select v-model="form.liquis_employee" id="liquis_employee"
											class="w-full lg:w-[40%] mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
											name="liquis_employee" required>
											<option class="text-base md:text-xs lg:text-base" value="" disabled hidden>Select Employee</option>
											
											<option class="text-base md:text-xs lg:text-base" v-for="entry in props.liquisemployees"
												:key="entry.id" :value="entry.id" v-if="props.jobownerid != id">
												<span>
													{{ entry.name }}
												</span>
											</option>
										</select>
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.liquis_employee" /> -->
                                    </div>
                                    <div
                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
                                        <InputLabel for="corporate_address" value="Address" class="w-full lg:w-[60%]" />
                                        <TextInput class="w-full lg:w-[40%] px-4 py-2" id="corporate_address"
                                            type="text" placeholder="Corporate Address" v-model="form.corporate_address"
                                            required />
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.corporate_address" /> -->
                                    </div>
                                    <div
                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
                                        <InputLabel for="contact_name" value="Contact Name" class="w-full lg:w-[60%]" />
                                        <TextInput class="w-full lg:w-[40%] px-4 py-2" id="contact_name" type="text"
                                            v-model="form.contact_name" required />
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.contact_name" /> -->
                                    </div>
                                    <div 
                                    	class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
										<InputLabel class="w-full lg:w-[60%]" for="contact_telephone" value="Phone" />
										<TextInput class="w-full lg:w-[40%] px-4 py-2" id="contact_telephone" min="1" type="number" placeholder="Phone"
											v-model="form.contact_telephone" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" required @keydown="(e: KeyboardEvent) => { if (e.key === '-') e.preventDefault()}" />
										<!-- <InputError class="mt-2" :message="form.errors.contact_telephone" /> -->
									</div>
                                    <div
                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
                                        <InputLabel for="contact_email" value="Email" class="w-full lg:w-[60%]" />
                                        <TextInput class="w-full lg:w-[40%] px-4 py-2" id="contact_email" type="email"
                                            v-model="form.contact_email" required />
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.contact_email" /> -->
                                    </div>
                                    <div
                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
                                        <InputLabel for="location_address" value="Location Name"
                                            class="w-full lg:w-[60%]" />
                                        <TextInput class="w-full lg:w-[40%] px-4 py-2" id="location_address" type="text"
                                            v-model="form.location_address" required />
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.location_address" /> -->
                                    </div>
                                    <div
                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
                                        <InputLabel for="start_date" value="Start Date" class="w-full lg:w-[60%]" />
                                        <TextInput class="w-full lg:w-[40%] px-4 py-2" id="start_date" type="date"
                                            v-model="form.start_date" required />
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.start_date" /> -->
                                    </div>
                                    <div
                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
                                        <InputLabel for="type" value="Job Type" class="w-full lg:w-[60%]" />
                                        <select v-model="form.type" id="type"
                                            class="mt-2 w-full lg:w-[40%] appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
                                            name="type">
                                            <option class="text-base md:text-xs lg:text-base" value="" disabled selected hidden>Select Job Type</option>
                                            <option class="text-base md:text-xs lg:text-base" value="facilitydecomissioning">Facility Decomissioning</option>
                                            <option class="text-base md:text-xs lg:text-base" value="datacenterdecommissioning">Data Center Decommissioning</option>
                                            <option class="text-base md:text-xs lg:text-base" value="officefurniture">Office Furniture</option>
                                            <option class="text-base md:text-xs lg:text-base" value="datadestruction">Data Destruction</option>
                                            <option class="text-base md:text-xs lg:text-base" value="assetrecovery">Asset Recovery</option>
                                            <option class="text-base md:text-xs lg:text-base" value="assetmanagement">Asset Management</option>
                                            <option class="text-base md:text-xs lg:text-base" value="recycling">Recycling</option>
                                            <option class="text-base md:text-xs lg:text-base" value="generatorremoval">Generator Removal</option>
                                            <option class="text-base md:text-xs lg:text-base" value="industrialremoval">Industrial Removal</option>
                                        </select>
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.type" /> -->
                                    </div>

                                    <div
                                        class="flex pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
                                        <InputLabel for="status" value="Status" class="w-full lg:w-[60%]" />
                                        <select v-model="form.status" id="status"
                                            class="mt-2 w-full lg:w-[40%] appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
                                            name="status">
                                            <option class="text-base md:text-xs lg:text-base" value="" selected disabled hidden>Select Status</option>
                                            <option class="text-base md:text-xs lg:text-base" value="New">New</option>
                                            <option class="text-base md:text-xs lg:text-base" value="Work in Progress">Work in Progress</option>
                                            <option class="text-base md:text-xs lg:text-base" value="Completed">Completed</option>
                                        </select>
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.status" /> -->
                                    </div>
                                    <!-- assets below -->
                                    <div style="display: none;">
                                        <InputLabel for="additional_images" value="Additional Images" />
                                        <!-- <input type="file" class="form-control" v-on:change="onImageChange"> -->
                                        <TextInput name="additional_images" id="additional_images" type="file"
                                            class="mt-1 block w-full" v-model="form.additional_images" />
                                        <!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form.errors.additional_images" /> -->
                                    </div>
                                    <div class="flex justify-end mt-4">
                                        <DangerButton @click="deleteTrade(props.liquijobs.id)"
                                            v-if="props.liquijobs.deleted_at == null && props.userrole == 'admin'" class="py-3 px-4 mr-2 sm:w-auto w-[40%] flex justify-center items-center">
                                            <img class="w-4 mr-2" src="/images/logos/trash-can.png"> Delete
                                        </DangerButton>
                                        <PrimaryButton :disabled="form.processing" class="py-3 px-4 sm:w-auto w-[40%]">
                                            <span class="text-base">Save</span> <svg
                                                class="size-6 shrink-0 stroke-[#FFFFFF]"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                style="display: inline; float: inline-end; margin-left: 5px;">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                                            </svg></PrimaryButton>
                                        <Transition enter-active-class="transition ease-in-out"
                                            enter-from-class="opacity-0" leave-active-class="transition ease-in-out"
                                            leave-to-class="opacity-0">
                                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                        </Transition>
                                    </div>
                                </form>
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
        <!-- <h1>VIEW VUE PAGE</h1> -->
        <div class="py-12" style="display: none;">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h1 class="text-2xl">{{ props.liquijobs.so_number }}</h1>
                <div>
                    {{ props.liquijobs.so_number }}
                </div>
            </div>
        </div>
        <!-- -->
    </AppLayout>

</template>