<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

import Subdashboard from '@/Components/Subdashboard.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="max-w-7xl mx-auto p-5">
            <div class="dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                <Subdashboard />
            </div>
        </div>
    </AppLayout>
</template>
