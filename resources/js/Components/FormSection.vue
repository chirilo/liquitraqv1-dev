<script setup>
import { computed, useSlots } from 'vue';
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2 rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)]">
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="p-6"
                    :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                >
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form" />
                    </div>
                </div>

                <div v-if="hasActions" class="flex items-center justify-end px-6 py-3 bg-gray-50 text-end rounded-bl-lg rounded-br-lg">
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>
