<script setup>
import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import InputLabel from '@/Components/InputLabel.vue';

import SearchBarSideBar from '@/Components/SearchBarSideBar.vue';
import Calendar from '@/Components/Calendar.vue';
import RecentJobs from '@/Components/RecentJobs.vue';
import JobsLastSevenDays from '@/Components/JobsLastSevenDays.vue';
import UpcomingJobs from '@/Components/UpcomingJobs.vue';

import { ref } from "vue";
import moment from "moment";

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
	showeditdelete: String,
	jobownername: String,
});

const liquijobsCreate = '/liquijobs/create';

const liquiassetsurl = "/liquiassets/create?jobid=" + props.liquijobs.id;

const viewallliquiassetsurl = "/liquijobs/" + props.liquijobs.id + '?all=1';

const viewsingleliquiasseturl = "/liquiassets/";

const liquijobsEdit = '/liquijobs/' + props.liquijobs.id + 'edit';

// import { useRoute } from 'vue-router';

// const route = useRoute()
// console.log(route.query)

// const filters = {
//     filter: props.filters.filter,
// }
// const form = useForm(filters);

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

const deleteTrade = (id) => {
	if (confirm("Are you sure you want to move this to trash?")) {
		form.delete(route('liquijobs.destroy', { id: id }), {
			preserveScroll: true,
		});
	}
};

let totalresold = 0;
let totalrecycled = 0;
let totaldisposed = 0;
let totalreturn = 0;


let isOpenForm = ref(false);
const openAssetForm = () => {
	isOpenForm.value = !isOpenForm.value;
	console.log(isOpenForm);
};

const formasset = useForm({
	job_asset: '',
	jobid: props.liquijobs.id,
	asset_category: '',
	asset_quantity: '',
	asset_type: '',
	asset_make: '',
	asset_model: '',
	asset_serial: '',
	asset_weight_each: '',
	asset_description: '',
	asset_status: '',
	asset_disposition: ''
});

const submitaddasset = (e) => {
	formasset.post(route("liquiassets.store"));
};

let isOpenFurniture = ref(false);
let isOpenIt = ref(false);
let isOpenInfrastructure = ref(false);
let isOpenLabel = ref(false);

const openMenuSelect = (event) => {
	isOpenLabel.value = !isOpenLabel.value;
	const it_asset_type = document.getElementById('it_asset_type');
	const furniture_asset_type = document.getElementById('furniture_asset_type');
	const infrastructure_asset_type = document.getElementById('infrastructure_asset_type');
	// Access the selected value using event.target.value
	console.log('Selected option:', event.target.value);
	// Perform actions based on the selected option
	if (event.target.value === 'it') {
		// Do something
		//alert('it here');
		isOpenIt.value = !isOpenIt.value;
		isOpenFurniture.value = false;
		isOpenInfrastructure.value = false;
		furniture_asset_type.removeAttribute('required');
		infrastructure_asset_type.removeAttribute('required');
	} else if (event.target.value === 'furniture') {
		// Do something else
		//alert('furniture ');
		isOpenFurniture.value = !isOpenFurniture.value;
		isOpenIt.value = false;
		isOpenInfrastructure.value = false;
		it_asset_type.removeAttribute('required');
		infrastructure_asset_type.removeAttribute('required');
	} else if (event.target.value === 'infrastructure') {
		// Do something else
		//alert('infrastructure ');
		isOpenInfrastructure.value = !isOpenInfrastructure.value;
		isOpenIt.value = false;
		isOpenFurniture.value = false;
		it_asset_type.removeAttribute('required');
		furniture_asset_type.removeAttribute('required');
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

const browsertimezone  = Intl.DateTimeFormat().resolvedOptions().timeZone;
//console.log('browsertimezone' + browsertimezone);
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
	<AppLayout title="View Job">
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				View Job
			</h2>
		</template>
		<div class="max-w-7xl mx-auto p-5">
			<!-- Toast message -->
			<div v-if="props.message"
				class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
				role="alert">
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
						<div id="left-side"
							class="mx-auto flex flex-col items-start overflow-hidden pb-6 pt-6 rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] lg:col-span-1 md:col-span-2">
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
							<!-- Quick Add New Job -->
							<div class="w-full pr-6 pl-6 pb-6 mt-6">
								<h2
									class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">
									Quick Add New Job</h2>
								<div class="mt-3 relative flex items-center lg:items-end">
									<div id="docs-card-content" class="flex items-start lg:flex-col">
										<form @submit.prevent="submitaddjob" class="w-full">
											<div class="flex flex-wrap">
												<div class="w-full">
													<!-- <InputLabel for="company_name" value="Job Co Name" /> -->
													<TextInput id="company_name" type="text" placeholder="Job Co Name"
														v-model="form.company_name" required />
													<InputError class="mt-2" :message="form.errors.company_name" />
												</div>
												<div class="w-full mt-3">
													<!-- <InputLabel for="corporate_address" value="Corporate Address" /> -->
													<TextInput id="corporate_address" type="text" placeholder="Corporate Address"
														v-model="form.corporate_address" required />
													<InputError class="mt-2" :message="form.errors.corporate_address" />
												</div>
												<div class="w-full mt-3">
													<!-- <InputLabel for="contact_name" value="Contact Name" /> -->
													<TextInput id="contact_name" type="text" placeholder="Contact Name"
														v-model="form.contact_name" required />
													<InputError class="mt-2" :message="form.errors.contact_name" />
												</div>
												<div class="w-full mt-3">
													<!-- <InputLabel for="contact_email" value="Email" /> -->
													<TextInput id="contact_email" type="email" placeholder="Email"
														v-model="form.contact_email" required />
													<InputError class="mt-2" :message="form.errors.contact_email" />
												</div>
												<div class="w-full mt-3">
													<!-- <InputLabel for="contact_telephone" value="Phone" /> -->
													<TextInput id="contact_telephone" min="1" type="number" placeholder="Phone"
														v-model="form.contact_telephone" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" required @keydown="(e: KeyboardEvent) => { if (e.key === '-') e.preventDefault()}" />
													<InputError class="mt-2" :message="form.errors.contact_telephone" />
												</div>
												<div class="w-full mt-3">
													<!-- <InputLabel for="location_address" value="Location Name" /> -->
													<TextInput id="location_address" type="text"
														placeholder="Location Name" v-model="form.location_address"
														required />
													<InputError class="mt-2" :message="form.errors.location_address" />
												</div>
												<div class="w-full mt-3">
													<!-- <InputLabel for="start_date" value="Start Date" /> -->
													<TextInput id="start_date" type="date" placeholder="YYYY-MM-DD"
														v-model="form.start_date" required />
													<InputError class="mt-2" :message="form.errors.start_date" />
												</div>
												<div class="w-full mt-3">
													<!-- <InputLabel for="type" value="Job Type" /> -->
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
										</form>
									</div>
								</div>
							</div>
							<!-- END OF: Quick Add New Job -->
						</div>
						<!-- RIGHT PART -->
						<div id="right-side" class="lg:col-span-2 md:col-span-3">
							<!-- current job selected /recent jobs -->
							<div class="rounded-lg bg-white p-6">
								<div id="recent-jobs">
									<div class="relative flex justify-between items-start sm:flex-row flex-col-reverse">
										<h1
											class="w-full sm:w-[60%] block text-2xl primary-light-blue font-rethinksansextrabold uppercase mt-6 sm:mt-0 text-center sm:text-left">
											Job:
											<span>{{ props.liquijobs.company_name }}</span>
										</h1>
										<div class="flex justify-center sm:justify-end sm:w-auto w-full">
											<a href="/liquijobs"
												class="text-white py-2 px-4 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
												<img class="w-4 mr-2" src="/images/logos/back.png"> Back
											</a>
											<div class="ml-1 flex" v-if="props.showeditdelete == 'admin'">
												<a v-if="props.liquijobs.deleted_at == null"
													:href="route('liquijobs.edit', { 'id': props.liquijobs.id })"
													class="text-white py-2 px-2 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
													<img class="w-5" src="/images/logos/editing.png">
												</a>
												<a @click="deleteTrade(props.liquijobs.id)"
													v-if="props.liquijobs.deleted_at == null"
													class="cursor-pointer ml-1 text-white py-2 px-2 rounded-full bg-red-600 inline-block text-center text-sm font-rethinksansbold hover:opacity-90 flex">
													<img class="w-5" src="/images/logos/trash-can.png">
												</a>
											</div>
										</div>
									</div>
									<ul class="p-0">
										<li>
											<div class="w-full relative flex flex-col">
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">SO Number:
														</span><span class="font-rethinksanssemibold primary-gray">{{ '13401002' + props.liquijobs.id }}</span>
													</p>
												</div>

												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Liquis Employee Name:
														</span><span class="font-rethinksanssemibold primary-gray">{{ props.jobownername }}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Corporate
															Address:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.liquijobs.corporate_address }}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Contact
															Name:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.liquijobs.contact_name }}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Phone:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.liquijobs.contact_telephone }}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Email:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.liquijobs.contact_email }}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Location
															Name:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.liquijobs.location_address }}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">
															Start Date:
														</span>
														<span class="font-rethinksanssemibold primary-gray">
															{{ moment(props.liquijobs.start_date).format("MMMM D, YYYY")
															}}
														</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">
															Status:
														</span>
														<span class="font-rethinksanssemibold primary-gray">
															{{ props.liquijobs.status
															}}
														</span>
													</p>
												</div>
											</div>
										</li>
										<!-- Additional Data for Job and Assets -->
										<li>
											<div class="w-full relative flex sm:flex-row flex-col">
												<div class="w-full pr-0 sm:pr-6 pb-6 sm:pb-0">
													<div
														class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total
															Assets:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.jobassetscount }}</span>
													</div>
													<div
														class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Furniture:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.furniturejobassets }}</span>
													</div>
													<div
														class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">IT:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.itjobassets
														}}</span>
													</div>
													<div
														class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span
															class="font-rethinksansbold primary-dark-blue">Infrastructure:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															props.infrastructurejobassets }}</span>
													</div>
												</div>
												<div class="w-full">
													<div
														class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total
															Resold:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															totalresold }}</span>
													</div>
													<div
														class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total
															Recycled:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															totalrecycled }}</span>
													</div>
													<div
														class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total
															Disposed:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															totaldisposed }}</span>
													</div>
													<div
														class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total
															Return:
														</span><span class="font-rethinksanssemibold primary-gray">{{
															totalreturn }}</span>
													</div>
												</div>
											</div>
										</li>
										<li class="text-center m-0">
											<!-- <button class="w-half bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> VIEW ASSETS <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </button> -->
											<a v-bind:href="viewallliquiassetsurl"
												class="text-white py-3 px-4 rounded-full bg-gradient-blue block sm:inline-block text-center font-rethinksansbold hover:opacity-90">
												All Assets <svg class="size-6 shrink-0 stroke-[#FFFFFF]"
													xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
													stroke-width="1.5"
													style="display: inline; float: inline-end; margin-left: 5px;">
													<path stroke-linecap="round" stroke-linejoin="round"
														d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
												</svg></a>
										</li>
									</ul>
								</div>
							</div>
							<div class="rounded-lg bg-white p-6 mt-6" id="add-asset">
								<div class="text-center">
									<h2
										class="block sm:text-2xl text-xl primary-light-blue font-rethinksansextrabold uppercase">
										Add New Asset
									</h2>
									<!-- <a v-bind:href="liquiassetsurl" class="text-white py-3 px-4 rounded-full bg-gradient-blue block sm:inline-block text-center font-rethinksansbold hover:opacity-90">Add Asset</a>  -->
									<!-- <a @click="openAssetForm" class="text-white py-3 px-4 rounded-full bg-gradient-blue block sm:inline-block text-center font-rethinksansbold hover:opacity-90">Add Asset</a>  -->
								</div>
								<!-- add asset form from create.vue(asset) -->
								<!-- <section :class="isOpenForm ? 'block' : 'hidden' "> -->
								<section>
									<form @submit.prevent="submitaddasset" class="mt-6 space-y-2"
										enctype="multipart/form-data">
										<!-- Asset Details Form Fields -->
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_category" value="Category"
												class="w-full lg:w-[60%]" />
											<select v-model="formasset.asset_category" id="type"
												class="w-full lg:w-[40%] sm:mt-0 mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_category" required @change="openMenuSelect">
												<option value="" disabled hidden>Select Category</option>
												<option value="it">IT</option>
												<option value="infrastructure">Infrastructure</option>
												<option value="furniture">Furniture</option>
											</select>
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_category" />
										</div>
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap" :class="isOpenLabel ? 'block' : 'hidden'">
											<InputLabel for="asset_type" value="Type" class="w-full lg:w-[60%]" :class="isOpenLabel ? 'block' : 'hidden'" />
											<select v-model="formasset.asset_type" id="furniture_asset_type"
												class="w-full lg:w-[40%] sm:mt-0 mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_type" 
												:class="isOpenFurniture ? 'block' : 'hidden'">
												<optgroup label="Furniture">
													<option value="" selected disabled hidden>Select Furniture Type
													</option>
													<option value="furniture-cubicle">Cubicle</option>
													<option value="furniture-casegood">Case Good</option>
													<option value="furniture-chair">Chair</option>
													<option value="furniture-wallhanging">Wall Hanging</option>
													<option value="furniture-appliance">Appliance</option>
													<option value="furniture-others">Others</option>
												</optgroup>
											</select>
											<select v-model="formasset.asset_type" id="it_asset_type"
												class="w-full lg:w-[40%] sm:mt-0 mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_type" 
												:class="isOpenIt ? 'block' : 'hidden'">
												<optgroup label="IT">
													<option value="" selected disabled hidden>Select IT Type</option>
													<option value="it-networkgear">Network Gear</option>
													<option value="it-servers">Servers</option>
													<option value="it-pcs">PCs</option>
													<option value="it-laptops">Laptops</option>
													<option value="it-rack">Rack</option>
													<option value="it-telecom">Telecom</option>
													<option value="it-monitors">Monitors</option>
													<option value="it-camera">Camera</option>
													<option value="it-printers">Printers</option>
													<option value="it-others">Others</option>
												</optgroup>
											</select>
											<select v-model="formasset.asset_type" id="infrastructure_asset_type"
												class="w-full lg:w-[40%] sm:mt-0 mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_type" 
												:class="isOpenInfrastructure ? 'block' : 'hidden'">
												<optgroup label="Infrastructure">
													<option value="" selected disabled hidden>Select Infrastructure Type
													</option>
													<option value="infrastructure-generator">Generator</option>
													<option value="infrastructure-cracunit">CRAC Unit</option>
													<option value="infrastructure-ups">UPS</option>
													<option value="infrastructure-ats">ATS</option>
													<option value="infrastructure-bypass">Bypass</option>
													<option value="infrastructure-switchgear">Switchgear</option>
													<option value="infrastructure-batteries">Batteries</option>
													<option value="infrastructure-wiringlowvoltage">Wiring, Low-Voltage
													</option>
													<option value="infrastructure-wiringhighvoltage">Wiring,
														High-Voltage
													</option>
													<option value="infrastructure-firesuppressant">Fire Suppressant
													</option>
													<option value="infrastructure-raisedflooring">Raised Flooring
													</option>
													<option value="infrastructure-paintchemical">Paint/Chemical</option>
													<option value="infrastructure-others">Others</option>
												</optgroup>
											</select>
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_type" />
											<div class="w-[40%]"></div>
										</div>
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_quantity" value="Quantity"
												class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_quantity"
												type="number" placeholder="Quantity" v-model="formasset.asset_quantity"
												required />
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_quantity" />
										</div>
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_make" value="Make" class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_make" type="text"
												placeholder="ex. Simmons, Philips, Toshiba.."
												v-model="formasset.asset_make" required />
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_make" />
										</div>
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_model" value=" Model" class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_model" type="text"
												placeholder="ex. SQ-12.." v-model="formasset.asset_model" required />
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_model" />
										</div>
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_serial" value=" Serial" class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_serial" type="text"
												placeholder="ex. HFIOE18DHIN23-23" v-model="formasset.asset_serial"
												required />
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_serial" />
										</div>
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_weight_each" value="Weight Each"
												class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_weight_each"
												type="text" placeholder="ex. 12 lbs"
												v-model="formasset.asset_weight_each" required />
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_weight_each" />
										</div>
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_description" value="Description"
												class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_description"
												type="text" placeholder="Description"
												v-model="formasset.asset_description" required />
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_description" />
										</div>
										<div
											class="flex border-divider pb-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_status" value="Status" class="w-full lg:w-[60%]" />
											<select v-model="formasset.asset_status" id="asset_status"
												class="w-full lg:w-[40%] px-4 py-2 sm:mt-0 mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_status" required @change="openStatusMenuSelect">
												<option value="" selected disabled hidden>Select Status</option>
												<option value="originalstate">Original State</option>
												<option value="workinprogress">Work In Progress</option>
												<option value="completed">Completed</option>
											</select>

											<!-- <InputLabel for="asset_status" value="Asset Disposition" class="w-full lg:w-[60%]" /> -->
											<!-- <select v-model="formasset.asset_disposition" id="asset_status"
												class="w-full lg:w-[40%] px-4 py-2 sm:mt-0 mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_status" @change="openAssetStatusMiniForm">
												<option value="" selected disabled hidden>Select Disposition</option>
												<option value="resold">Resold</option>
												<option value="recycled">Recycled</option>
												<option value="disposed">Disposed</option>
												<option value="returne">Returned</option>
											</select>
											<div>
												<input type="text" name="date" placeholder="Date" />
												<input type="text" name="who" placeholder="Who" />
												<input type="text" name="shippingticketinfo" placeholder="Shipping/Ticket Info" />
											</div> -->
											<InputError class="mt-2 w-full lg:w-[40%]"
												:message="formasset.errors.asset_status" />
										</div>
										<!-- END OF : Asset Details Form Fields -->
										<div
											class="flex items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<div class="mt-6 sm:w-[60%] w-full flex flex-col">
												<InputLabel for="job_asset" value="Job Asset"
													class="w-full lg:w-[60%]" />
												<!-- <input type="file" @input="form.avatar = $event.target.files[0]" name="job_asset" class="mt-1 block w-full" v-on:change="onImageChange" > -->
												<input required type="file"
													@input="formasset.job_asset = $event.target.files[0]"
													name="job_asset" class="mt-1 block w-full">
												<input type="hidden" name="job_id" v-model="formasset.jobid">
												<InputError class="mt-2 w-full lg:w-[40%]"
													:message="formasset.errors.job_asset" />
											</div>
											<div
												class="sm:w-[40%] w-full flex sm:justify-end justify-start sm:mt-0 mt-6">
												<PrimaryButton :disabled="form.processing"
													class="py-3 px-4 sm:w-auto w-full">
													<span class="text-base">Go</span> <svg
														class="size-6 shrink-0 stroke-[#FFFFFF]"
														xmlns="http://www.w3.org/2000/svg" fill="none"
														viewBox="0 0 24 24" stroke-width="1.5"
														style="display: inline; float: inline-end; margin-left: 5px;">
														<path stroke-linecap="round" stroke-linejoin="round"
															d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
													</svg>
												</PrimaryButton>
												<Transition enter-active-class="transition ease-in-out"
													enter-from-class="opacity-0"
													leave-active-class="transition ease-in-out"
													leave-to-class="opacity-0">
													<p v-if="formasset.recentlySuccessful"
														class="text-sm text-gray-600">Saved.
													</p>
												</Transition>
											</div>
										</div>
									</form>
								</section>
								<!-- end of add assset -->
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
				</div><!-- end of unlabeled div -->
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