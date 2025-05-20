<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    as: String,
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" type="submit" class="w-full text-left block px-4 py-2 text-base primary-dark-blue font-rethinksansmedium hover:opacity-80 hover:bg-gray-100">
            <slot />
        </button>

        <a v-else-if="as =='a'" :href="href" class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
            <slot />
        </a>

        <Link v-else :href="href" class="block px-4 py-2 text-base primary-dark-blue font-rethinksansmedium hover:opacity-80 hover:bg-gray-100">
            <slot />
        </Link>
    </div>
</template>
