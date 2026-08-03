<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
    class: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        :class="class"
    >
        <slot />
    </Link>
</template>
