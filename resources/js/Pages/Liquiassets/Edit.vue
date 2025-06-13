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

import moment from "moment";
import { ref, onMounted } from "vue";

const props = defineProps({
	liquiasset: Object,
	thisjobid: String,
	userrole: String,
	// job_assets: Object,
	// filters: Object,
	// message: String,
	// currentdatetime: String,
	// thisjobcompanyname: String
});

const liquijobsCreate = '/liquijobs/create';

const liquiassetsurl = "/liquiassets/create?jobid=" + props.liquijobs;

const viewallliquiassetsurl = "/liquiassets/view?jobid=" + props.liquijobs;

const backtoprevjob = "/liquijobs/" + props.thisjobid + '?all=1';

const parentjoburl = '/liquijobs/';

// import { useRoute } from 'vue-router';

// const route = useRoute()
// console.log(route.query)

// const filters = {
//     filter: props.filters.filter,
// }
// const form = useForm(filters);

const deleteTradeAsset = (id) => {
	if (confirm("Are you sure you want to move this asset to trash?")) {
		form.delete(route('liquiassets.destroy', { id: id }), {
			preserveScroll: true,
		});
	}
};

const form2 = useForm({
    id: props.liquiasset.id,
    job_asset_url: '',
    asset_category: props.liquiasset.asset_category,
    asset_quantity: props.liquiasset.asset_quantity,
    asset_type: props.liquiasset.asset_type,
    asset_make: props.liquiasset.asset_make,
    asset_model: props.liquiasset.asset_model,
    asset_serial: props.liquiasset.asset_serial,
    asset_weight_each: props.liquiasset.asset_weight_each,
    asset_description: props.liquiasset.asset_description,
    asset_status: props.liquiasset.asset_status,
    asset_disposition: props.liquiasset.asset_disposition,
    assetdisdate: props.liquiasset.assetdisdate,
    assetdiswho: props.liquiasset.assetdiswho,
    assetdisticketshippinginfo: props.liquiasset.assetdisticketshippinginfo,
});

// from Create.vue
const updateasset = (id) => {
	console.log(form2)
	form2.put(route('liquiassets.update', { id: props.liquiasset.id }));
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

let isOpenFurniture = ref(false);
let isOpenIt = ref(false);
let isOpenInfrastructure = ref(false);
let isOpenLabel = ref(false);

const openMenuSelect = (event) => {
	//isOpenLabel.value = !isOpenLabel.value;
	const it_asset_type = document.getElementById('it_asset_type');
	const furniture_asset_type = document.getElementById('furniture_asset_type');
	const infrastructure_asset_type = document.getElementById('infrastructure_asset_type');
	// Access the selected value using event.target.value
	console.log('Selected option:', event.target.value);
	// Perform actions based on the selected option
	if (event.target.value == 'it') {
		// Do something
		//alert('it here');
		// isOpenIt.value = !isOpenIt.value;
		// isOpenLabel.value = !isOpenLabel.value;
		// isOpenFurniture.value = false;
		// isOpenInfrastructure.value = false;
		// furniture_asset_type.removeAttribute('required');
		// infrastructure_asset_type.removeAttribute('required');

		// manually add the hidden class to furniture and infrastructure
		document.getElementById('furniture_asset_type').classList.add('hidden');
		document.getElementById('infrastructure_asset_type').classList.add('hidden');

		document.getElementById('it_asset_type').classList.remove('hidden');
		document.getElementById('it_asset_type').classList.add('block');

		document.getElementById('assettypediv').classList.remove('hidden');
	}
	else if (event.target.value == 'furniture') {
		// Do something else
		//alert('furniture ');
		// isOpenFurniture.value = !isOpenFurniture.value;
		// isOpenLabel.value = !isOpenLabel.value;
		// isOpenIt.value = false;
		// isOpenInfrastructure.value = false;
		// it_asset_type.removeAttribute('required');
		// infrastructure_asset_type.removeAttribute('required');

		// manually add the hidden class to furniture and infrastructure
		document.getElementById('it_asset_type').classList.add('hidden');
		document.getElementById('infrastructure_asset_type').classList.add('hidden');

		document.getElementById('furniture_asset_type').classList.remove('hidden');
		document.getElementById('furniture_asset_type').classList.add('block');

		document.getElementById('assettypediv').classList.remove('hidden');
	}
	else if (event.target.value == 'infrastructure') {
		// Do something else
		//alert('infrastructure ');
		// isOpenInfrastructure.value = !isOpenInfrastructure.value;
		// isOpenLabel.value = !isOpenLabel.value;
		// isOpenIt.value = false;
		// isOpenFurniture.value = false;
		// it_asset_type.removeAttribute('required');
		// furniture_asset_type.removeAttribute('required');

		// manually add the hidden class to furniture and infrastructure
		document.getElementById('furniture_asset_type').classList.add('hidden');
		document.getElementById('it_asset_type').classList.add('hidden');

		document.getElementById('infrastructure_asset_type').classList.remove('hidden');
		document.getElementById('infrastructure_asset_type').classList.add('block');

		document.getElementById('assettypediv').classList.remove('hidden');
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
const openMenu = (e) => {
	let thisid = e.target.id;
	//alert(e.target.id)
	console.log('target' + e.target.nextSibling);
	let nextsibling = e.target.nextSibling;
	let nextsiblingid = nextsibling.id;
	//alert(nextsiblingid)
	let hiddenclasscontain = document.getElementById(nextsiblingid).classList.contains('hidden');
	let blockclasscontain = document.getElementById(nextsiblingid).classList.contains('block');
	//alert(classcontain);
	if (hiddenclasscontain == true) {
		//alert(classcontain);
		document.getElementById(nextsiblingid).classList.remove('hidden');
		document.getElementById(nextsiblingid).classList.add('block');
	}
	else if (blockclasscontain == true) {
		document.getElementById(nextsiblingid).classList.remove('block');
		document.getElementById(nextsiblingid).classList.add('hidden');
	}

	// console.log(nextsiblingid);
	// isOpen.value = !isOpen.value;
	// console.log(isOpen);
};

if (props.message) {
	setTimeout(() => {
		//alert('here');
		document.getElementById('toastmessage').style.display = 'none';
	}, 10000);
}

// const shown = computed(() => {
// 	if (props.message) {
// 	  setTimeout(() => {
// 	  	document.getElementById('toastmessage').style.visibility = "hidden";
// 	  }, 2000);
// 	}
// 	//return props.show.value
// })

// if( $page.props.jetstream.managesProfilePhotos ){
// 	let ppurl = $page.props.auth.user.profile_photo_url;
// 	let newString = ppurl.replace("https://phplaravel-728976-5430189.cloudwaysapps.com/liquijobs", "");
// }

const browsertimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
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

const openStatusMenuSelect = () => {
	let selectedassetstatus = event.target.value;
	console.log('selected' + selectedassetstatus);
	if (selectedassetstatus === 'completed') {
		// isSoNumberOpen.value = !isSoNumberOpen.value;

		// // close other
		// isStatusOpen.value = false;
		// document.getElementById('filter_status').removeAttribute('required');
		//alert('here')
		document.getElementById('assetdispositiondiv').classList.remove('hidden');
	}
	else if (selectedassetstatus === 'originalstate' || selectedassetstatus === 'workinprogress') {
		document.getElementById('assetdispositiondiv').classList.add('hidden');
	}
}

const openAssetStatusMiniForm = () => {
	let selecteddispoval = event.target.value;
	console.log('selecteddispoval' + selecteddispoval);
	if (selecteddispoval == 'resold') {
		document.getElementById('resold').classList.remove('hidden');

		// hide others
		// document.getElementById('recycled').classList.add('hidden');
		// document.getElementById('disposed').classList.add('hidden');
		// document.getElementById('returned').classList.add('hidden');
	}
	else if (selecteddispoval == 'recycled') {
		document.getElementById('resold').classList.remove('hidden');
	}
	else if (selecteddispoval == 'disposed') {
		document.getElementById('resold').classList.remove('hidden');
	}
	else if (selecteddispoval == 'returned') {
		document.getElementById('resold').classList.remove('hidden');
	}
}


onMounted(() => {
	//alert('heresss');
	let assetcategoryfromdb = props.liquiasset.asset_category;
	let assetimagefromdb = props.liquiasset.job_asset;
	//alert(assetimagefromdb);
	if (assetcategoryfromdb == 'furniture') {
		document.getElementById('furniture_asset_type').classList.remove('hidden');
		document.getElementById('furniture_asset_type').classList.add('block');
	}
	else if (assetcategoryfromdb == 'it') {
		document.getElementById('it_asset_type').classList.remove('hidden');
		document.getElementById('it_asset_type').classList.add('block');
	}
	else if (assetcategoryfromdb == 'infrastructure') {
		document.getElementById('infrastructure_asset_type').classList.remove('hidden');
		document.getElementById('infrastructure_asset_type').classList.add('block');
	}
})



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

														<svg class="ms-2 -me-0.5 size-4"
															xmlns="http://www.w3.org/2000/svg" fill="none"
															viewBox="0 0 24 24" stroke-width="1.5"
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
										<option class="text-base md:text-xs lg:text-base primary-dark-blue" value="Work In Progress">Work In
											Progress
										</option>
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
							<!-- Quick Add New Job -->
							<div class="w-full pr-6 pl-6 mt-6">
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
												<div class="w-full mt-1">
													<!-- <InputLabel for="corporate_address" value="Corporate Address" /> -->
													<TextInput id="corporate_address" type="text"
														placeholder="Corporate Address" v-model="form.corporate_address"
														required />
													<InputError class="mt-2" :message="form.errors.corporate_address" />
												</div>
												<div class="w-full mt-1">
													<!-- <InputLabel for="contact_name" value="Contact Name" /> -->
													<TextInput id="contact_name" type="text" placeholder="Contact Name"
														v-model="form.contact_name" required />
													<InputError class="mt-2" :message="form.errors.contact_name" />
												</div>
												<div class="w-full mt-1">
													<!-- <InputLabel for="contact_email" value="Email" /> -->
													<TextInput id="contact_email" type="email" placeholder="Email"
														v-model="form.contact_email" required />
													<InputError class="mt-2" :message="form.errors.contact_email" />
												</div>
												<div class="w-full mt-1">
													<!-- <InputLabel for="contact_telephone" value="Phone" /> -->
													<TextInput id="contact_telephone" min="1" type="number"
														placeholder="Phone" v-model="form.contact_telephone"
														maxlength="10"
														oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)"
														required
														@keydown="(e: KeyboardEvent) => { if (e.key === '-') e.preventDefault() }" />
													<InputError class="mt-2" :message="form.errors.contact_telephone" />
												</div>
												<div class="w-full mt-1">
													<!-- <InputLabel for="location_address" value="Location Name" /> -->
													<TextInput id="location_address" type="text"
														placeholder="Location Name" v-model="form.location_address"
														required />
													<InputError class="mt-2" :message="form.errors.location_address" />
												</div>
												<div class="w-full mt-1">
													<!-- <InputLabel for="start_date" value="Start Date" /> -->
													<TextInput id="start_date" type="date" placeholder="YYYY-MM-DD"
														v-model="form.start_date" required />
													<InputError class="mt-2" :message="form.errors.start_date" />
												</div>
												<div class="w-full mt-1">
													<!-- <InputLabel for="type" value="Job Type" /> -->
													<select v-model="form.type" id="type"
														class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
														name="type">
														<option class="text-base md:text-xs lg:text-base" value="" selected disabled hidden>Job Type</option>
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
								<div id="assets-info">
									<div class="relative flex justify-between items-center lg:flex-row flex-col-reverse">
										<h1
											class="lg:mt-0 mt-6 w-full lg:w-[50%] block text-2xl primary-light-blue font-rethinksansextrabold uppercase">
											Edit Asset: {{ props.thisjobid }}
										</h1>
										<div class="lg:w-auto w-full flex justify-between items-center">
											<a :href="backtoprevjob"
												class="text-white py-2 px-4 rounded-full bg-gradient-blue inline text-center text-xs sm:text-sm font-rethinksansbold hover:opacity-90 flex">
												<img class="w-4 mr-2" src="/images/logos/back.png"> Back
											</a>
											<a href="/liquijobs"
												class="text-white ml-1 py-2 px-4 rounded-full bg-gradient-blue inline text-center text-xs sm:text-sm font-rethinksansbold hover:opacity-90 flex">
												<img class="w-4 sm:w-5 mr-2" src="/images/logos/home.png"> Home
											</a>
										</div>
									</div>
									<form @submit.prevent="updateasset" class="mt-6"
										enctype="multipart/form-data">
										<!-- <div
	                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-between sm:justify-end flex-row">
	                                        <InputLabel for="id" value="SO Number" class="w-full lg:w-[60%]" />
	                                        <input id="id" type="text" :value="form.id" disabled
	                                            class="w-auto lg:w-[40%] appearance-none block w-full px-4 py-0 primary-dark-blue font-rethinksansmedium border-[#fff]" />
	                                    </div> -->
										<div
											class="flex border-divider pb-2 pt-0 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_category" value="Category"
												class="w-full lg:w-[60%]" />
											<select v-model="form2.asset_category" id="type"
												class="w-full lg:w-[40%] mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_category" required @change="openMenuSelect">
												<option class="text-base md:text-xs lg:text-base" value="" disabled hidden>Select Category</option>
												<option class="text-base md:text-xs lg:text-base" value="it">IT</option>
												<option class="text-base md:text-xs lg:text-base" value="infrastructure">Infrastructure</option>
												<option class="text-base md:text-xs lg:text-base" value="furniture">Furniture</option>
											</select>
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_category" /> -->
										</div>
										<div id="assettypediv"
											class="flex border-divider pb-2 sm:pt-0 pt-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_type" value="Type" class="w-full lg:w-[60%]" />
											<select v-model="form2.asset_type" id="furniture_asset_type"
												class="hidden w-full lg:w-[40%] mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_type">
												<optgroup class="text-base md:text-xs lg:text-base" label="Furniture">
													<option class="text-base md:text-xs lg:text-base" value="" selected disabled hidden>Select Furniture Type</option>
													<option class="text-base md:text-xs lg:text-base" value="furniture-cubicle">Cubicle</option>
													<option class="text-base md:text-xs lg:text-base" value="furniture-casegood">Case Good</option>
													<option class="text-base md:text-xs lg:text-base" value="furniture-chair">Chair</option>
													<option class="text-base md:text-xs lg:text-base" value="furniture-wallhanging">Wall Hanging</option>
													<option class="text-base md:text-xs lg:text-base" value="furniture-appliance">Appliance</option>
													<option class="text-base md:text-xs lg:text-base" value="furniture-others">Others</option>
												</optgroup>
											</select>
											<select v-model="form2.asset_type" id="it_asset_type"
												class="hidden w-full lg:w-[40%] mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_type">
												<optgroup class="text-base md:text-xs lg:text-base" label="IT">
													<option class="text-base md:text-xs lg:text-base" value="" selected disabled hidden>Select IT Type</option>
													<option class="text-base md:text-xs lg:text-base" value="it-networkgear">Network Gear</option>
													<option class="text-base md:text-xs lg:text-base" value="it-servers">Servers</option>
													<option class="text-base md:text-xs lg:text-base" value="it-pcs">PCs</option>
													<option class="text-base md:text-xs lg:text-base" value="it-laptops">Laptops</option>
													<option class="text-base md:text-xs lg:text-base" value="it-rack">Rack</option>
													<option class="text-base md:text-xs lg:text-base" value="it-telecom">Telecom</option>
													<option class="text-base md:text-xs lg:text-base" value="it-monitors">Monitors</option>
													<option class="text-base md:text-xs lg:text-base" value="it-camera">Camera</option>
													<option class="text-base md:text-xs lg:text-base" value="it-printers">Printers</option>
													<option class="text-base md:text-xs lg:text-base" value="it-others">Others</option>
												</optgroup>
											</select>
											<select v-model="form2.asset_type" id="infrastructure_asset_type"
												class="hidden w-full lg:w-[40%] mt-2 appearance-none block w-full px-4 py-2 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_type">
												<optgroup class="text-base md:text-xs lg:text-base" label="Infrastructure">
													<option class="text-base md:text-xs lg:text-base" value="" selected disabled hidden>Select Infrastructure Type
													</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-generator">Generator</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-cracunit">CRAC Unit</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-ups">UPS</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-ats">ATS</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-bypass">Bypass</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-switchgear">Switchgear</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-batteries">Batteries</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-wiringlowvoltage">Wiring, Low-Voltage
													</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-wiringhighvoltage">Wiring,
														High-Voltage
													</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-firesuppressant">Fire Suppressant
													</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-raisedflooring">Raised Flooring
													</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-paintchemical">Paint/Chemical</option>
													<option class="text-base md:text-xs lg:text-base" value="infrastructure-others">Others</option>
												</optgroup>
											</select>
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_type" /> -->
										</div>
										<div
											class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_quantity" value="Quantity"
												class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_quantity"
												type="text" v-model="form2.asset_quantity" required />
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_quantity" /> -->
										</div>
										<!-- <div
	                                        class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
	                                        <InputLabel for="asset_type" value="Type" class="w-full lg:w-[60%]" />
	                                        <TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_type" type="text"
	                                            v-model="form2.asset_type" required />
	                                        <InputError class="mt-2 w-full lg:w-[40%]"
	                                            :message="form2.errors.asset_type" />
	                                    </div> -->
										<div
											class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_make" value="Make" class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_make" type="text"
												v-model="form2.asset_make" required />
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_make" /> -->
										</div>
										<div
											class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_model" value="Model" class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_model" type="text"
												v-model="form2.asset_model" required />
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_model" /> -->
										</div>
										<div
											class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_serial" value="Serial" class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_serial" type="text"
												v-model="form2.asset_serial" required />
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_serial" /> -->
										</div>
										<div
											class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_weight_each" value="Weight Each"
												class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_weight_each"
												type="text" v-model="form2.asset_weight_each" required />
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_weight_each" /> -->
										</div>
										<div
											class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_description" value="Description
	                                        " class="w-full lg:w-[60%]" />
											<TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_description"
												type="text" v-model="form2.asset_description" required />
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_description" /> -->
										</div>
										<div
											class="flex border-divider pb-2 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_status" value="Status" class="w-full lg:w-[60%]" />
											<!-- <TextInput class="w-full lg:w-[40%] px-4 py-2" id="asset_status" type="text"
	                                            v-model="form2.asset_status" required /> -->
											<select v-model="form2.asset_status" id="asset_status"
												class="w-full lg:w-[40%] px-4 py-2 mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_status" required @change="openStatusMenuSelect">
												<option class="text-base md:text-xs lg:text-base" value="" selected disabled hidden>Select Status</option>
												<option class="text-base md:text-xs lg:text-base" value="originalstate">Original State</option>
												<option class="text-base md:text-xs lg:text-base" value="workinprogress">Work In Progress</option>
												<option class="text-base md:text-xs lg:text-base" value="completed">Completed</option>
											</select>
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_status" /> -->
										</div>
										<div id="assetdispositiondiv"
											class="flex border-divider pb-3 sm:pt-0 pt-2 items-end justify-start sm:justify-end sm:flex-row flex-col flex-wrap">
											<InputLabel for="asset_disposition" value="Asset Disposition"
												class="w-full lg:w-[60%]" />
											<select v-model="form2.asset_disposition" id="asset_status"
												class="w-full lg:w-[40%] px-4 py-2 mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none"
												name="asset_status" @change="openAssetStatusMiniForm">
												<option class="text-base md:text-xs lg:text-base" value="" selected disabled hidden>Select Disposition</option>
												<option class="text-base md:text-xs lg:text-base" value="resold">Resold</option>
												<option class="text-base md:text-xs lg:text-base" value="recycled">Recycled</option>
												<option class="text-base md:text-xs lg:text-base" value="disposed">Disposed</option>
												<option class="text-base md:text-xs lg:text-base" value="returned">Returned</option>
											</select>
											<div class="w-full lg:w-[70%] float-none md:float-right mt-3">
												<div id="resold" class="flex sm:flex-row flex-col justify-end gap-1">
													<input v-model="form2.assetdisdate"
														class="p-2 w-full lg:w-[25%] md:w-[33.3%] text-sm primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#323581] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="date" name="assetdisdate" placeholder="Date" />
													<input v-model="form2.assetdiswho"
														class="p-2 w-full lg:w-[25%] md:w-[33.3%] text-sm primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#323581] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" name="assetdiswho" placeholder="Who" />
													<input v-model="form2.assetdisticketshippinginfo"
														class="p-2 w-full lg:w-[40%] md:w-[33.3%] text-sm primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#323581] bg-[#f2f4f7] rounded-lg focus:outline-none"
														type="text" name="assetdisticketshippinginfo"
														placeholder="Shipping/Ticket Info" />
												</div>
											</div>
											<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.asset_disposition" /> -->
										</div>

										<!-- <div class="float-right mt-6 sm:w-[60%] w-full flex flex-col">
	                                    	<img :src="form2.job_asset ? form2.job_asset : $event.target.files[0]" alt="Job Asset Preview" />
	                                    	<InputLabel for="job_asset" value="Job Asset Preview" class="w-full lg:w-[60%]" />
	                                    </div> -->
										<div class="flex items-end flex-col lg:flex-row">
											<div class="mt-6 lg:w-[50%] w-full flex flex-col">
												<InputLabel for="job_asset_url" value="Job Asset"
													class="w-full" />
												<!-- <input type="file" @input="form.avatar = $event.target.files[0]" name="job_asset" class="mt-1 block w-full" v-on:change="onImageChange" > -->
												<input type="file" @input="form2.job_asset_url = $event.target.files[0]"
													name="job_asset_url" class="mt-1 block w-full">
												<!-- <input type="hidden" name="job_id" v-model="form2.jobid"> -->
												<!-- <InputError class="mt-2 w-full lg:w-[40%]" :message="form2.errors.job_asset_url" /> -->
											</div>
											<div class="flex justify-end mt-6 lg:mt-4 w-full lg:w-[50%]">
												<DangerButton @click="deleteTradeAsset(item.id)"
													v-if="props.userrole == 'admin'" class="py-3 px-4 mr-2 sm:w-auto w-[40%] flex justify-center items-center">
													<img class="w-4 mr-2" src="/images/logos/trash-can.png"> Delete
												</DangerButton>
												<PrimaryButton :disabled="form.processing"
													class="py-3 px-4 sm:w-auto w-[40%]">
													<span class="text-base">Update</span> <svg
														class="size-6 shrink-0 stroke-[#FFFFFF]"
														xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
														stroke-width="1.5"
														style="display: inline; float: inline-end; margin-left: 5px;">
														<path stroke-linecap="round" stroke-linejoin="round"
															d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
													</svg>
												</PrimaryButton>
												<Transition enter-active-class="transition ease-in-out"
													enter-from-class="opacity-0" leave-active-class="transition ease-in-out"
													leave-to-class="opacity-0">
													<p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.
													</p>
												</Transition>
											</div>
										</div>
									</form>
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