<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block text-base font-rethinksansmedium primary-dark-blue">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
