<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { ArrowLeft } from 'lucide-vue-next'

const search = ref('')
</script>

<template>
    <Head title="Supervisor assign" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Schedule</h1>
        </template>
        <template #search>
            <SearchAnimation placeholder="Search name" v-model="search">
                <template #search>
                    <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 17L22 22M19.5 10.75C19.5 15.5825 15.5825 19.5 10.75 19.5C5.91751 19.5 2 15.5825 2 10.75C2 5.91751 5.91751 2 10.75 2C15.5825 2 19.5 5.91751 19.5 10.75Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </template>

                <template #back>
                    <ArrowLeft :size="18"/>
                </template>
            </SearchAnimation>
        </template>
    </AuthenticatedLayout>
</template>