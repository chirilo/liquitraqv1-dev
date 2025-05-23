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

import { ref } from 'vue';

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
	   form.delete(route('liquijobs.destroy',{id:id}), {
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
    jobid: props.jobid,
    asset_category: '',
    asset_quantity: '',
    asset_type: '',
    asset_make: '',
    asset_model: '',
    asset_serial: '',
    asset_weight_each: '',
    asset_description: '',
    asset_status: ''
});

const submitaddasset = (e) => {
    form.post(route("liquiassets.store"));
};

let isOpenFurniture = ref(false);
let isOpenIt = ref(false);
let isOpenInfrastructure = ref(false);

const openMenuSelect = (event) => {
	const it_asset_type = document.getElementById('asset_type');
	const furniture_asset_type = document.getElementById('furniture_asset_type');
	const infrastructure_asset_type = document.getElementById('infrastructure_asset_type');
	// Access the selected value using event.target.value
	console.log('Selected option:', event.target.value);
	// Perform actions based on the selected option
	if (event.target.value === 'it') {
		// Do something
		//alert('it here');
		isOpenIt.value = !isOpenIt.value;
		isOpenFurniture.value = isOpenFurniture.value;
		isOpenInfrastructure.value = isOpenInfrastructure.value;
		furniture_asset_type.removeAttribute('required');
		infrastructure_asset_type.removeAttribute('required');
		console.log(isOpenIt);
	} else if (event.target.value === 'furniture') {
		// Do something else
		//alert('furniture ');
		isOpenFurniture.value = !isOpenFurniture.value;
		isOpenIt.value = isOpenIt.value;
		isOpenInfrastructure.value = isOpenInfrastructure.value;
		it_asset_type.removeAttribute('required');
		infrastructure_asset_type.removeAttribute('required');
	} else if (event.target.value === 'infrastructure') {
		// Do something else
		//alert('infrastructure ');
		isOpenInfrastructure.value = !isOpenInfrastructure.value;
		isOpenIt.value = isOpenIt.value;
		isOpenFurniture.value = isOpenFurniture.value;
		it_asset_type.removeAttribute('required');
		furniture_asset_type.removeAttribute('required');
	}
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                View Job
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
													<InputLabel for="corporate_address" value="Address" />
													<TextInput
		                                                id="corporate_address"
		                                                type="text"
		                                                placeholder="Address"
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
													<TextInput
		                                                id="contact_telephone"
		                                                type="text"
		                                                placeholder="Phone"
		                                                v-model="form.contact_telephone"
		                                                required
		                                            />
		                                            <InputError class="mt-2" :message="form.errors.contact_telephone" />
												</div>
												<div class="w-full mt-3">
													<InputLabel for="location_address" value="Location Address" />
													<TextInput
		                                                id="location_address"
		                                                type="text"
		                                                placeholder="Location Address"
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
							<div class="rounded-lg bg-white p-6">
								<div id="recent-jobs">
									<div class="flex sm:justify-end">
										<a href="/liquijobs" class="text-white py-2 px-4 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
											<img class="w-4 mr-2" src="/images/logos/back.png"> Go Back
										</a>
									</div>
									<div class="relative flex flex-col w-full mt-3">
										<h1 class="block text-center text-2xl primary-light-blue font-rethinksansextrabold uppercase">{{props.liquijobs.building}}</h1>
									</div>
									<ul class="p-0">
										<li>
											<div class="w-full relative flex flex-col">
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Corporate Address: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.corporate_address}}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Contact Name: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.contact_name}}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Phone: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.contact_telephone}}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Email: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.contact_email}}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
													<p>
														<span class="font-rethinksansbold primary-dark-blue">Location Name: </span><span class="font-rethinksanssemibold primary-gray">{{props.liquijobs.location_address}}</span>
													</p>
												</div>
												<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
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
													<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Assets: </span><span class="font-rethinksanssemibold primary-gray">{{ props.jobassetscount }}</span>
													</div>
													<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Furniture: </span><span class="font-rethinksanssemibold primary-gray">{{ props.furniturejobassets }}</span>
													</div>
													<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">IT: </span><span class="font-rethinksanssemibold primary-gray">{{ props.itjobassets }}</span>
													</div>
													<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Infrastructure: </span><span class="font-rethinksanssemibold primary-gray">{{ props.infrastructurejobassets }}</span>
													</div>
												</div>
												<div class="w-full">
													<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Resold: </span><span class="font-rethinksanssemibold primary-gray">{{ totalresold }}</span>
													</div>
													<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Recycled: </span><span class="font-rethinksanssemibold primary-gray">{{ totalrecycled }}</span>
													</div>
													<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Disposed: </span><span class="font-rethinksanssemibold primary-gray">{{  totaldisposed }}</span>
													</div>
													<div class="py-3 last:mb-2 border-b border-[#e9ebef] last:border-none">
														<span class="font-rethinksansbold primary-dark-blue">Total Return: </span><span class="font-rethinksanssemibold primary-gray">{{ totalreturn }}</span>
													</div>
												</div>
											</div>
										</li>
										<li class="text-center">
											<!-- <button class="w-half bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> VIEW ASSETS <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </button> -->
											<a v-bind:href="viewallliquiassetsurl" class="text-white py-3 px-4 rounded-full bg-gradient-blue block sm:inline-block text-center font-rethinksansbold hover:opacity-90"> All Assets <svg class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" style="display: inline; float: inline-end; margin-left: 5px;"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path></svg></a>
										</li>
									</ul>
								</div> 
							</div>
							<div class="rounded-lg bg-white p-6 mt-6">
								<div id="recent-assets">
									<!-- images -->
									<ul class="m-0 p-0 flex justify-start mb-3">
											<li class="m-0 p-0 w-40 pr-3" v-for="item in job_assets">
											<!-- <img :src="'/uploads/images/' + item.job_asset" style="margin: 0 1em 0 1em;" width="300" height="300" onerror="https://lh3.googleusercontent.com/pw/AP1GczMGQYta83vV-qTtHVNR0Fz97llzvKe2OoGu6_OD-j6HSGe-eaTa7rcoshYfAUz4g75XPtnrA5aVzi2CC8MOHREyrIYJPYe0CzZy9D5AC0P_ffazpNPHRihvaGzKJ7IFkGwVroZM1-fqnmNZH1gIgHVabw=w1966-h1474-s-no-gm?authuser=0" /> -->
											<!-- <img class="aspect-square object-cover h-auto " style="background-image: url('https://lh3.googleusercontent.com/pw/AP1GczMGQYta83vV-qTtHVNR0Fz97llzvKe2OoGu6_OD-j6HSGe-eaTa7rcoshYfAUz4g75XPtnrA5aVzi2CC8MOHREyrIYJPYe0CzZy9D5AC0P_ffazpNPHRihvaGzKJ7IFkGwVroZM1-fqnmNZH1gIgHVabw=w1966-h1474-s-no-gm?authuser=0');" :src="'/storage/job_assets/'+item.job_asset" /> -->
											<a v-bind:href="viewsingleliquiasseturl+item.id">
												<img class="aspect-square object-cover h-auto " style="background-image: url('https://lh3.googleusercontent.com/pw/AP1GczMGQYta83vV-qTtHVNR0Fz97llzvKe2OoGu6_OD-j6HSGe-eaTa7rcoshYfAUz4g75XPtnrA5aVzi2CC8MOHREyrIYJPYe0CzZy9D5AC0P_ffazpNPHRihvaGzKJ7IFkGwVroZM1-fqnmNZH1gIgHVabw=w1966-h1474-s-no-gm?authuser=0');" :src="item.job_asset" />
											</a>
										</li>
									</ul>
								</div>
								<div class="text-center">
									<!-- <a v-bind:href="liquiassetsurl" class="text-white py-3 px-4 rounded-full bg-gradient-blue block sm:inline-block text-center font-rethinksansbold hover:opacity-90">Add Asset</a>  -->
									<a @click="openAssetForm" class="text-white py-3 px-4 rounded-full bg-gradient-blue block sm:inline-block text-center font-rethinksansbold hover:opacity-90">Add Asset</a> 
								</div>
								<!-- add asset form from create.vue(asset) -->
								<section :class="isOpenForm ? 'block' : 'hidden' ">
                                    <form @submit.prevent="submitaddasset" class="mt-6 space-y-6" enctype="multipart/form-data">
                                        
                                        <div>
                                            <InputLabel for="job_asset" value="Job Asset" />

                                            <!-- <input type="file" @input="form.avatar = $event.target.files[0]" name="job_asset" class="mt-1 block w-full" v-on:change="onImageChange" > -->
                                                <input required type="file" @input="formasset.job_asset = $event.target.files[0]" name="job_asset" class="mt-1 block w-full">
                                            <input type="hidden" name="job_id" v-model="formasset.jobid" >
                                            <InputError class="mt-2" :message="formasset.errors.job_asset" />
                                        </div>
                                        
                                        <!-- Asset Details Form Fields -->
                                        <div>
                                            <InputLabel for="asset_category" value="Category" />

                                            <select v-model="formasset.asset_category" id="type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_category" required @change="openMenuSelect">
                                            	<option value="">Select Category</option>
                                                <option value="it">IT</option>
                                                <option value="infrastructure">Infrastructure</option>
                                                <option value="furniture">Furniture</option>
                                            </select>

                                            <InputError class="mt-2" :message="formasset.errors.asset_category" />
                                        </div>
                                        <div>
                                            <InputLabel for="asset_type" value="Type" />

                                            <!-- <TextInput
                                                id="asset_type"
                                                type="text"
                                                placeholder="ex. Chair, Tables, PCs , etc."
                                                v-model="form.asset_type"
                                                required
                                                autofocus
                                            /> -->
                                            <select v-model="formasset.asset_type" id="furniture_asset_type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_type" required  :class="isOpenFurniture ? 'block' : 'hidden' ">
                                            	<optgroup label="Furniture">
                                            		<option value="">Select Type</option>
	                                                <option value="furniture-cubicle">Cubicle</option>
	                                                <option value="furniture-casegood">Case Good</option>
	                                                <option value="furniture-chair">Chair</option>
	                                                <option value="furniture-wallhanging">Wall Hanging</option>
	                                                <option value="furniture-appliance">Appliance</option>
	                                                <option value="furniture-others">Others</option>
                                            	</optgroup>
                                            </select>
                                            <select v-model="formasset.asset_type" id="it_asset_type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_type" required  :class="isOpenIt ? 'block' : 'hidden' ">
                                            	<optgroup label="IT">
                                            		<option value="">Select Type</option>
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
                                            <select v-model="formasset.asset_type" id="infrastructure_asset_type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_type" required  :class="isOpenInfrastructure ? 'block' : 'hidden' ">
                                            	<optgroup label="Infrastructure">
                                            		<option value="">Select Type</option>
	                                                <option value="infrastructure-generator">Generator</option>
	                                                <option value="infrastructure-cracunit">CRAC Unit</option>
	                                                <option value="infrastructure-ups">UPS</option>
	                                                <option value="infrastructure-ats">ATS</option>
	                                                <option value="infrastructure-bypass">Bypass</option>
	                                                <option value="infrastructure-switchgear">Switchgear</option>
	                                                <option value="infrastructure-batteries">Batteries</option>
	                                                <option value="infrastructure-wiringlowvoltage">Wiring, Low-Voltage</option>
	                                                <option value="infrastructure-wiringhighvoltage">Wiring, High-Voltage</option>
	                                                <option value="infrastructure-firesuppressant">Fire Suppressant</option>
	                                                <option value="infrastructure-raisedflooring">Raised Flooring</option>
	                                                <option value="infrastructure-paintchemical">Paint/Chemical</option>
	                                                <option value="infrastructure-others">Others</option>
                                            	</optgroup>
                                            </select>

                                            <InputError class="mt-2" :message="formasset.errors.asset_type" />
                                        </div>
                                        <div>
                                            <InputLabel for="asset_quantity" value="Quantity" />

                                            <TextInput
                                                id="asset_quantity"
                                                type="number"
                                                placeholder="Quantity"
                                                v-model="formasset.asset_quantity"
                                                required
                                                
                                            />

                                            <InputError class="mt-2" :message="formasset.errors.asset_quantity" />
                                        </div>
                                        
                                        <div>
                                            <InputLabel for="asset_make" value="Make" />

                                            <TextInput
                                                id="asset_make"
                                                type="text"
                                                placeholder="ex. Simmons, Philips, Toshiba.."
                                                v-model="formasset.asset_make"
                                                required
                                                
                                            />

                                            <InputError class="mt-2" :message="formasset.errors.asset_make" />
                                        </div>
                                        <div>
                                            <InputLabel for="asset_model" value=" Model" />

                                            <TextInput
                                                id="asset_model"
                                                type="text"
                                                placeholder="ex. SQ-12.."
                                                v-model="formasset.asset_model"
                                                required
                                                
                                            />

                                            <InputError class="mt-2" :message="formasset.errors.asset_model" />
                                        </div>
                                        <div>
                                            <InputLabel for="asset_serial" value=" Serial" />

                                            <TextInput
                                                id="asset_serial"
                                                type="text"
                                                placeholder="ex. HFIOE18DHIN23-23"
                                                v-model="formasset.asset_serial"
                                                required
                                                
                                            />

                                            <InputError class="mt-2" :message="formasset.errors.asset_serial" />
                                        </div>
                                        <div>
                                            <InputLabel for="asset_weight_each" value="Weight Each" />

                                            <TextInput
                                                id="asset_weight_each"
                                                type="text"
                                                placeholder="ex. 12 lbs"
                                                v-model="formasset.asset_weight_each"
                                                required
                                                
                                            />

                                            <InputError class="mt-2" :message="formasset.errors.asset_weight_each" />
                                        </div>
                                        
                                        <div>
                                            <InputLabel for="asset_description" value="Description" />

                                            <TextInput
                                                id="asset_description"
                                                type="text"
                                                placeholder="Description"
                                                v-model="formasset.asset_description"
                                                required
                                                
                                            />

                                            <InputError class="mt-2" :message="formasset.errors.asset_description" />
                                        </div>
                                        <div>
                                        <InputLabel for="asset_status" value="Status"/>

                                            <select v-model="formasset.asset_status" id="asset_status" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_status" required>
                                            	<option value="">Select Status</option>
                                                <option value="originalstate">Original State</option>
                                                <option value="workinprogress">Work In Progress</option>
                                                <option value="completed">Completed</option>
                                            </select>

                                            <InputError class="mt-2" :message="formasset.errors.asset_status" />
                                        </div>
                                        <!-- END OF : Asset Details Form Fields -->

                                        

                                        <div class="flex items-center gap-4">
                                            <PrimaryButton :disabled="form.processing" style="background-color: #292d73;">Save</PrimaryButton>

                                            <Transition
                                                enter-active-class="transition ease-in-out"
                                                enter-from-class="opacity-0"
                                                leave-active-class="transition ease-in-out"
                                                leave-to-class="opacity-0"
                                            >
                                                <p v-if="formasset.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                            </Transition>
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
						<div id="calendar-container" class="flex flex-col items-start gap-12 overflow-hidden rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-12 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
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
                <h1 class="text-2xl">{{props.liquijobs.so_number}}</h1>
                <div>
                    {{props.liquijobs.so_number}}
                </div>
            </div>
        </div>
        <!-- -->
    </AppLayout>
    	
</template>