<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center text-sm border border-gray-400 py-2 px-4 rounded-full text-center font-rethinksansbold hover:bg-white">
        <slot />
    </button>
</template>