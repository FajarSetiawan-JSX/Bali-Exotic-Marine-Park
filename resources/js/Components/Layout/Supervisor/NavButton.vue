<script setup>
import { Link } from '@inertiajs/vue3'

defineOptions({
    inheritAttrs: false,
})

defineProps({
    href: {
        type: String,
        required: true,
    },
    method: {
        type: String,
        default: 'get',
    },
    as: {
        type: String,
        default: 'a',
    },
})
</script>

<template>
    <Link
        v-bind="$attrs"
        :href="href"
        :method="method"
        :as="as"
    >
        <slot />
    </Link>
</template>