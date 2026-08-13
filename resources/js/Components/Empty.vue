<script setup>
import { Folder, FolderCode } from 'lucide-vue-next'

defineProps({
    title: {
        type: String,
        default: 'No Projects Yet'
    },

    description: {
        type: String,
        default: "You haven't created any projects yet."
    },

    subDescription: {
        type: String,
        default: 'Get started by creating your first project.'
    },

    primaryText: {
        type: String,
        default: 'Create Project'
    },

    secondaryText: {
        type: String,
        default: 'Import Project'
    },

    showPrimary: {
        type: Boolean,
        default: true
    },

    showSecondary: {
        type: Boolean,
        default: true
    }
})

const emit = defineEmits([
    'primary',
])
</script>

<template>
    <div class="flex flex-col items-center justify-center text-center">
        <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gray-100 text-gray-700 mb-6">
            <FolderCode :size="30" :stroke-width="1.8"/>
        </div>
        <h2 class="text-xl font-semibold text-gray-900">
            {{ title }}
        </h2>
        <p class="mt-3 text-gray-600">
            {{ description }}
        </p>
        <p class="text-gray-600">
            {{ subDescription }}
        </p>
        <div v-if="showPrimary || showSecondary" class="flex flex-col sm:flex-row items-center gap-3 mt-8">
            <button v-if="showPrimary" type="button" @click="emit('primary')" class="px-5 py-3 rounded-xl bg-gray-900 text-white font-medium transition hover:bg-gray-800 active:scale-[0.98]">
                {{ primaryText }}
            </button>
        </div>
    </div>
</template>