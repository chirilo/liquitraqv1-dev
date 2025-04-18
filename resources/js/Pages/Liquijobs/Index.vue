<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
//import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';

import SearchBarSideBar from '@/Components/SearchBarSideBar.vue';
import Calendar from '@/Components/Calendar.vue';
import RecentJobs from '@/Components/RecentJobs.vue';
import JobsLastSevenDays from '@/Components/JobsLastSevenDays.vue';
import UpcomingJobs from '@/Components/UpcomingJobs.vue';

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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div>

				        <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-1 lg:gap-8">
				            
				            <!-- LEFT PART -->
				            <!-- Container for Left Sidebar (search and quick add job) -->
				            <div id="left-side" class="mx-auto flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
				                
				                <div class="mx-auto relative flex items-center gap-6 lg:items-end sm:hidden hidden lg:block">
				                    
				                    <div class="shrink-0 flex items-center"><a href="http://127.0.0.1:8000/dashboard"><img src="/images/logos/liquis-logo.png" alt="LiquiTraq" class="block h-9 w-auto"></a></div>
				                </div>

				                <div class="mx-auto relative flex items-center gap-6 lg:items-end">
				                    <div class="relative flex items-center gap-6 lg:items-end">
				                        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="max-w-2xl max-h-2xl rounded-full cursor-pointer" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="User dropdown">
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

				                <!-- <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
				                    <input type="search" name="search" placeholder="Search anything" />
				                </div> -->

				                <SearchBarSideBar/>

				                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="search" name="search" placeholder="Search anything" />
				                <br/>


				                 <h2 class="block w-full text-center">FILTER JOBS BY</h2>
				                 <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
				                     <option value="state">State</option>
				                     <option value="building">Building</option>
				                 </select>
				                 <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> GO <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </button>

				                 <h2>QUICK ADD NEW JOB</h2>
				                <div class="relative flex items-center gap-6 lg:items-end">
				                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
				                        <form class="w-full">
				                             <div class="flex flex-wrap -mx-3 mb-6">
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Job Co Name
				                                    </label>
				                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Job Co Name">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Address
				                                    </label>
				                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Address">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Contact Name
				                                    </label>
				                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Contact Name">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Email
				                                    </label>
				                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Email">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Phone
				                                    </label>
				                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Phone">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                                <div class="w-full py-1 px-3">
				                                    <label class="hidden block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
				                                    Start Date
				                                    </label>
				                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Start Date">
				                                    <p class="hidden text-red-500 text-xs italic">Please fill out this field.</p>
				                                </div>
				                            </div>
				                            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"> ADD ASSETS <svg style="display: inline; float: inline-end;" class="size-6 shrink-0 stroke-[#FFFFFF]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg> </button>
				                        </form>
				                    </div>

				                    
				                </div>
				            </div>

				            <!-- RIGHT PART -->
				            <div id="right-side" class="lg:col-span-2">
				                 
				                <RecentJobs/>
    
				                <JobsLastSevenDays/>

				                <UpcomingJobs />
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
        <h1>INDEX VUE PAGE</h1>
		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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