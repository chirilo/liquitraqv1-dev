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

        <div class="py-2">
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

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div>

				        <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-1 lg:gap-8">
				            
				            <!-- LEFT PART -->
				            <!-- Container for Left Sidebar (search and quick add job) -->
				            <div id="left-side" class="mx-auto flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
				                
				                <div class="mx-auto relative flex items-center gap-6 lg:items-end sm:hidden hidden lg:block">
				                    
				                    <div style="display: none;" class="shrink-0 flex items-center"><a href="/liquijobs"><img src="/images/logos/liquis-logo.png" alt="LiquiTraq" class="block h-9 w-auto"></a></div>
				                </div>


				                <!-- AVATAR -->
				                <div class="mx-auto relative flex items-center gap-6 lg:items-end">
				                    <div class="relative flex items-center gap-6 lg:items-end">
				                        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="max-w-2xl max-h-2xl rounded-full cursor-pointer" src="https://www.gravatar.com/avatar/2c7d99fe281ecd3bcd65ab915bac6dd5?s=250" alt="User dropdown">
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
				                <div class="mx-auto relative flex items-center gap-6 lg:items-end">
				                
				                    <!-- <div class="relative flex items-center gap-6 lg:items-end">
				                        <h1>MY ACCOUNT 	&dArr;</h1>
				                    </div> -->
				                    <Dropdown align="right" width="48">
	                                    <template #trigger>
	                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
	                                            <img class="size-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
	                                        </button>

	                                        <span v-else class="inline-flex rounded-md">
	                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
	                                                {{ $page.props.auth.user.name }}

	                                                <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
	                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
	                                                </svg>
	                                            </button>
	                                        </span>
	                                    </template>

	                                    <template #content>
	                                        <!-- Account Management -->
	                                        <div class="block px-4 py-2 text-xs text-gray-400">
	                                            Manage Account
	                                        </div>

	                                        <DropdownLink :href="route('profile.show')">
	                                            Profile
	                                        </DropdownLink>

	                                        <!-- <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
	                                            API Tokens
	                                        </DropdownLink> -->

	                                        <div class="border-t border-gray-200 dark:border-gray-600" />

	                                        <!-- Authentication -->
	                                        <form @submit.prevent="logout">
	                                            <DropdownLink as="button">
	                                                Log Out
	                                            </DropdownLink>
	                                        </form>
	                                    </template>
	                                </Dropdown>
				                    
				                </div>
				                <!-- END OF: MY ACCOUNT -->

				                <!-- <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
				                    <input type="search" name="search" placeholder="Search anything" />
				                </div> -->

				                <SearchBarSideBar/>

				                <!-- <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="search" name="search" placeholder="Search anything" /> -->
				                <br/>

				                 <h2 class="block w-full text-center">FILTER JOBS BY</h2>
				                 <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
				                     <option value="state">State</option>
				                     <option value="building">Building</option>
				                 </select>
				                 <a href="/liquijobs" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" style="display: inline-block; width: 100% !important; text-align: center;"> GO <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a>

				                 <h2>QUICK ADD NEW JOB</h2>
				                <div class="relative flex items-center gap-6 lg:items-end">
				                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
				                        <form class="w-full" action="/liquijobs/create">
				                             <div class="flex flex-wrap -mx-3 mb-6">
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Company Name
				                                    </label>
				                                    <input name="cname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Company Name">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Corporate Address
				                                    </label>
				                                    <input name="caddress" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Corporate Address">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Contact Name
				                                    </label>
				                                    <input name="coname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Contact Name">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Contact Email
				                                    </label>
				                                    <input name="cemail" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Contact Email">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Contact Telephone
				                                    </label>
				                                    <input name="cname"cotel class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Contact Telephone">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Location Address
				                                    </label>
				                                    <input name="loaddress" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Location Address">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Start Date
				                                    </label>
				                                    <input name="sdate" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Start Date">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                            </div>
				                            
				                            <!-- <a v-bind:href="liquijobsCreate" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" style="display: inline-block; width: 100% !important; text-align: center;"> ADD NEW JOB <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </a> -->
				                            <button id="send" type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">ADD NEW JOB</button>
				                           
				                        </form>
				                    </div>

				                    
				                </div>
				            </div>

				            <!-- RIGHT PART -->
				            <div id="right-side" class="lg:col-span-2">
				                 
				                <!-- recent jobs -->
				                <div id="recent-jobs" class="grid mb-2 items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
								    <div class="relative flex flex-col " style="width: 100%; text-align: center;">
								        <h1 class="text-center font-bold text-xl">RECENT JOBS</h1>
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
				                <div id="job-last-7-days" class="grid items-start mb-2 gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
							      <div class="relative flex flex-col " style="width: 100%;">
							          <h1 class="font-bold">JOBS LAST 7 DAYS</h1>
							      </div>
							      <div class="relative flex flex-col rounded-lg bg-white border-slate-200" style="width: 100%;">
									<ul style="padding: 0;">
							            
										<li v-for="entry in props.liquijobs.data" :key="entry.id">
											<div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96" style="width: 100%;">      
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
				                <div id="upcoming-jobs" class="grid items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
      
							      	<div class="relative flex flex-col " style="width: 100%;">
							          <h1 class="font-bold">UPCOMING JOBS</h1>
							      	</div>
							      	<div class="relative flex flex-col rounded-lg bg-white border-slate-200" style="width: 100%;">
							          	<ul style="padding: 0;">

							            	<li v-for="entry in props.liquijobs.data" :key="entry.id">
							                  <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-96" style="width: 100%;">      
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
				            </div>

				            

				        </div>


				        <!-- CALENDAR -->
				        <div class="grid gap-6 lg:grid-cols-1 lg:gap-8" style="margin-top: 2em;">
				            <!-- Container for CALENDAR -->
				            <div id="calendar-container" class="flex flex-col items-start gap-12 overflow-hidden rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-12 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
				                <Calendar />
				            </div>
				        </div>
				        
				    </div> <!-- end of unlabeled div -->
                </div>
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