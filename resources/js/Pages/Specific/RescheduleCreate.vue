<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { Calendar, Users, MessageSquareText, Send, X, ArrowLeftRight } from 'lucide-vue-next'
import { eror } from '@/Helper/Toast';
import axios from 'axios';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { usePage } from '@inertiajs/vue3';

const user = usePage().props?.auth?.user;
const search = ref('');
const emit = defineEmits(['submit', 'cancel'])
 
// data dummy
const colleagues = ref([
    { id: 1, name: 'Marcus (Tour Guide)' },
    { id: 2, name: 'Sarah Jenkins (Tour Guide)' },
    { id: 3, name: 'Dimas (Head of Security)' },
])
 
const form = ref({
    yourShiftDate: '',
    swapWithId: null,
    replacementDate: '',
    reason: ''
})
 
function handleSubmit() {
    emit('submit', { ...form.value })
}
 
function handleCancel() {
    emit('cancel')
}

onMounted(()=>{
    console.log('user', user);
})
</script>

<template>
    <Head title="Reschedule Form" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Reschedule Form</h1>
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
        <div class="w-full mx-auto grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-4">
            <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
                <div class="flex items-center gap-2 mb-5">
                    <ArrowLeftRight class="h-5 w-5 text-teal-600" />
                    <h2 class="text-base sm:text-lg font-semibold text-gray-800">Shift Swap Details</h2>
                </div>
    
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">
                            Tukar Dengan Siapa? (Swap With)
                        </label>
                        <div class="relative">
                            <Users class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" />
                            <select v-model="form.swapWithId" class="w-full appearance-none rounded-lg border border-gray-300 pl-10 pr-4 py-2.5 text-sm sm:text-base text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400">
                                <option :value="null" disabled>Search colleagues...</option>
                                <option v-for="c in colleagues" :key="c.id" :value="c.id">
                                    {{ c.name }}
                                </option>
                            </select>
                        </div>
                    </div>
    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">
                            Pilih Tanggal Pengganti (Replacement Date)
                        </label>
                        <div class="relative">
                            <Calendar class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-teal-600" />
                            <input type="date" v-model="form.replacementDate" class="w-full rounded-lg border border-gray-300 pl-10 pr-4 py-2.5 text-sm sm:text-base text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400"/>
                        </div>
                    </div>
    
                    <div>
                        <label class="flex items-center gap-1.5 text-sm font-medium text-gray-600 mb-1.5">
                            <MessageSquareText class="h-4 w-4" />
                            Alasan Reschedule (Reason)
                        </label>
                        <textarea v-model="form.reason" rows="3" placeholder="Provide a brief reason for this request..." class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm sm:text-base text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400 resize-none"></textarea>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 sm:p-5">
                    <p class="text-xs font-semibold uppercase text-gray-500 mb-3">Proposed Swap</p>
    
                    <div class="rounded-lg bg-white border border-gray-200 p-3 mb-3">
                        <p class="text-xs font-semibold uppercase text-red-500 mb-1">From You</p>
                        <p class="text-sm text-gray-500">
                            {{ form.yourShiftDate || 'Select a date' }}
                        </p>
                    </div>
    
                    <div class="flex justify-center py-1">
                        <div class="h-8 w-8 rounded-full bg-teal-600 flex items-center justify-center">
                            <ArrowLeftRight class="h-4 w-4 text-white" />
                        </div>
                    </div>
    
                    <div class="rounded-lg bg-white border border-gray-200 p-3 mt-2">
                        <p class="text-xs font-semibold uppercase text-teal-600 mb-1">To Colleague</p>
                        <p class="text-sm text-gray-500">
                            {{ form.replacementDate || 'Select a date' }}
                        </p>
                    </div>
                </div>
    
                <button type="button" class="inline-flex items-center justify-center gap-2 rounded-lg bg-teal-700 px-5 py-2.5 text-sm sm:text-base font-medium text-white hover:bg-teal-800 transition-colors" @click="handleSubmit">
                    <Send class="h-4 w-4" />
                    Kirim Pengajuan
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>