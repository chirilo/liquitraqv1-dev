<script setup>
defineProps({
    type: {
        type: String,
        default: 'Submit',
    },
});
</script>

<template>
    <button :type="type" class="text-white py-2 px-4 rounded-full bg-gradient-blue inline-block text-center text-sm font-rethinksansbold hover:opacity-90">
        <slot />
    </button>
</template>
