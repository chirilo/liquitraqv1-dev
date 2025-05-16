<script setup>
const props = defineProps(['href']);
</script>

<template>
    <a
        :href="href"
         class="text-white py-2 px-4 rounded-full bg-gradient-blue inline-block text-center text-sm font-rethinksansbold hover:opacity-90"
    >
        <slot />
    </a>
</template>
