<script setup>
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
//import { Link, useForm, usePage } from '@inertiajs/vue3';

import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue';
//import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

import SearchBarSideBar from '@/Components/SearchBarSideBar.vue';
import Calendar from '@/Components/Calendar.vue';
import RecentJobs from '@/Components/RecentJobs.vue';
import JobsLastSevenDays from '@/Components/JobsLastSevenDays.vue';
import UpcomingJobs from '@/Components/UpcomingJobs.vue';

import { ref } from 'vue';


const props = defineProps({
    jobid : Object
});

const liquijobsCreate = '/liquijobs/create';


const form = useForm({
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

const onImageChange = (e) => {
    const file = e.target.files[0];
    //this.url = URL.createObjectURL(file);
    form.job_asset = URL.createObjectURL(file);

    form.job_asset = e.target.files[0];
}


const submit = (e) => {
    form.post(route("liquiassets.store"));
};

let isOpenFurniture = ref(false);
let isOpenIt = ref(false);
let isOpenInfrastructure = ref(false);

const openMenuSelect = (event) => {
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
		isOpenFurniture.value = isOpenFurniture.value;
		isOpenInfrastructure.value = isOpenInfrastructure.value;
		// furniture_asset_type.removeAttribute('required');
		// infrastructure_asset_type.removeAttribute('required');
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

const logout = () => {
    router.post(route('logout'));
};
</script>
<template>
    <AppLayout title="Add Asset">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Asset
        </h2>
    </template>
		<div class="max-w-7xl mx-auto p-5">
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

							<div class="relative w-full border-divider pt-6">
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
									<input v-model="searchkey" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#8c8c97] font-rethinksansmedium border-[#e9ebef] bg-white rounded-lg focus:outline-none" type="search" name="search" placeholder="Search anything..." />
									<!-- <button type="submit"><svg class="size-6 shrink-0 stroke-[#8c8c97] absolute inset-y-4 right-0 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></button> -->
								</form>
							</div>
							<!-- END OF: Search Anything -->

							<div class="w-full pr-6 pl-6 pb-6 mt-6">
								<h2 class="block w-full text-center text-base primary-light-blue font-rethinksansextrabold uppercase">Filter Jobs By</h2>
								<select class="appearance-none block w-full p-4 mt-3 text-base primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none">
									<option class="text-base primary-dark-blue" value="state">State</option>
									<option class="text-base primary-dark-blue" value="building">Building</option>
								</select>
								<a href="/liquijobs" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Go <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></a>
							</div>

							<div class="w-full pr-6 pl-6 pb-6 mt-6"  style="display: none;">
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
													<input name="loaddress" class="appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" type="text" placeholder="Location Name">
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
											<button id="send" type="submit" class="mt-3 w-full text-white py-3 px-4 rounded-full bg-gradient-blue inline-block text-center font-rethinksansbold hover:opacity-90">Add New <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg></button>
										
										</form>
									</div>

									
								</div>
							</div>
						</div>
                            <!-- RIGHT PART -->
                        <div id="right-side" class="lg:col-span-2 md:col-span-3">
							<div class="rounded-lg bg-white p-6">
								<div id="recent-jobs">
									<div class="flex sm:justify-end">
										<a href="/liquijobs" class="text-white py-2 px-4 rounded-full bg-gradient-blue inline text-center text-sm font-rethinksansbold hover:opacity-90 flex">
											<img class="w-4 mr-2" src="/images/logos/back.png"> Back
										</a>
									</div>
                                    <div class="relative flex flex-col mt-5 w-full text-center">
                                        <h1 class="block text-center text-2xl primary-light-blue font-rethinksansextrabold uppercase">Add Asset for Job: # {{ props.jobid }}</h1>
                                    </div>
                                    <section>
                                        <form @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
                                            
                                            <div>
                                                <InputLabel for="job_asset" value="Job Asset" />

                                                <!-- <input type="file" @input="form.avatar = $event.target.files[0]" name="job_asset" class="mt-1 block w-full" v-on:change="onImageChange" > -->
                                                    <input required type="file" @input="form.job_asset = $event.target.files[0]" name="job_asset" class="mt-1 block w-full">
                                                <input type="hidden" name="job_id" v-model="form.jobid" >
                                                <InputError class="mt-2" :message="form.errors.job_asset" />
                                            </div>
                                            
                                            <!-- Asset Details Form Fields -->
                                            <div>
                                                <InputLabel for="asset_category" value="Category" />

	                                            <select v-model="form.asset_category" id="type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_category" required @change="openMenuSelect">
	                                            	<option value="">Select Category</option>
	                                                <option value="it">IT</option>
	                                                <option value="infrastructure">Infrastructure</option>
	                                                <option value="furniture">Furniture</option>
	                                            </select>

                                                <InputError class="mt-2" :message="form.errors.asset_category" />
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
                                                <select v-model="form.asset_type" id="furniture_asset_type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_type"  :class="isOpenFurniture ? 'block' : 'hidden' ">
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
                                                <select v-model="form.asset_type" id="it_asset_type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_type"  :class="isOpenIt ? 'block' : 'hidden' ">
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
                                                <select v-model="form.asset_type" id="infrastructure_asset_type" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_type"  :class="isOpenInfrastructure ? 'block' : 'hidden' ">
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

                                                <InputError class="mt-2" :message="form.errors.asset_type" />
                                            </div>
                                            <div>
                                                <InputLabel for="asset_quantity" value="Quantity" />

                                                <TextInput
                                                    id="asset_quantity"
                                                    type="number"
                                                    placeholder="Quantity"
                                                    v-model="form.asset_quantity"
                                                    required
                                                    
                                                />

                                                <InputError class="mt-2" :message="form.errors.asset_quantity" />
                                            </div>
                                            
                                            <div>
                                                <InputLabel for="asset_make" value="Make" />

                                                <TextInput
                                                    id="asset_make"
                                                    type="text"
                                                    placeholder="ex. Simmons, Philips, Toshiba.."
                                                    v-model="form.asset_make"
                                                    required
                                                    
                                                />

                                                <InputError class="mt-2" :message="form.errors.asset_make" />
                                            </div>
                                            <div>
                                                <InputLabel for="asset_model" value=" Model" />

                                                <TextInput
                                                    id="asset_model"
                                                    type="text"
                                                    placeholder="ex. SQ-12.."
                                                    v-model="form.asset_model"
                                                    required
                                                    
                                                />

                                                <InputError class="mt-2" :message="form.errors.asset_model" />
                                            </div>
                                            <div>
                                                <InputLabel for="asset_serial" value=" Serial" />

                                                <TextInput
                                                    id="asset_serial"
                                                    type="text"
                                                    placeholder="ex. HFIOE18DHIN23-23"
                                                    v-model="form.asset_serial"
                                                    required
                                                    
                                                />

                                                <InputError class="mt-2" :message="form.errors.asset_serial" />
                                            </div>
                                            <div>
                                                <InputLabel for="asset_weight_each" value="Weight Each" />

                                                <TextInput
                                                    id="asset_weight_each"
                                                    type="text"
                                                    placeholder="ex. 12 lbs"
                                                    v-model="form.asset_weight_each"
                                                    required
                                                    
                                                />

                                                <InputError class="mt-2" :message="form.errors.asset_weight_each" />
                                            </div>
                                            
                                            <div>
                                                <InputLabel for="asset_description" value="Description" />

                                                <TextInput
                                                    id="asset_description"
                                                    type="text"
                                                    placeholder="Description"
                                                    v-model="form.asset_description"
                                                    required
                                                    
                                                />

                                                <InputError class="mt-2" :message="form.errors.asset_description" />
                                            </div>
                                            <div>
                                            <InputLabel for="asset_status" value="Status"/>

                                                <select v-model="form.asset_status" id="asset_status" class="mt-2 appearance-none block w-full p-4 primary-dark-blue placeholder-[#323581] font-rethinksansmedium border-[#f2f4f7] bg-[#f2f4f7] rounded-lg focus:outline-none" name="asset_status" required>
                                                	<option value="">Select Status</option>
                                                    <option value="originalstate">Original State</option>
                                                    <option value="workinprogress">Work In Progress</option>
                                                    <option value="completed">Completed</option>
                                                </select>

                                                <InputError class="mt-2" :message="form.errors.asset_status" />
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
                                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                                </Transition>
                                            </div>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>