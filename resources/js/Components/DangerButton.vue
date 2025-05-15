<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type"  class="text-white py-2 px-4 rounded-full bg-red-600 inline-block text-center text-sm font-rethinksansbold hover:opacity-90">
        <slot />
    </button>
</template>
