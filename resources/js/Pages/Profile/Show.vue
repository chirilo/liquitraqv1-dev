<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex" style="padding-right: 15%; margin: 5px 0px 5px 0px;">
                    <!-- Logo -->
                    <div class="m-auto">
                        <div class="flex items-center"><a href="/liquijobs"><img src="/images/logos/liquis-logo.png" alt="LiquiTraq" class="block w-28 lg:w-32"></a></div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="sm:ml-10 ml-2 flex">
                        <!-- <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Job Dashboard
                        </NavLink> -->
                        <a href="/liquijobs" class="my-auto primary-dark-blue font-rethinksansbold text-base hover:opacity-80">Dashboard</a>
                    </div>
                </div>
                <div class="inline relative">
                    <Dropdown align="right" class="h-[100%]">
                        <template #trigger>
                            <button v-if="$page.props.jetstream.managesProfilePhotos" class="h-[100%] flex items-center ">
                                <img class="w-12 rounded-full object-cover shadow-md" :src="$page.props.auth.user.profile_photo_url.replace('https://phplaravel-728976-5430189.cloudwaysapps.com/liquijobs', '')" :alt="$page.props.auth.user.name">
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
            </div>
        </div>
    </nav>

    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-6 sm:py-10 px-6">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm :user="$page.props.auth.user" />

                    <SectionBorder />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                    <TwoFactorAuthenticationForm
                        :requires-confirmation="confirmsTwoFactorAuthentication"
                        class="mt-10 sm:mt-0"
                    />

                    <SectionBorder />
                </div>

                <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <SectionBorder />

                    <DeleteUserForm class="mt-10 sm:mt-0" />
                </template>
            </div>
        </div>
    </AppLayout>
</template>
