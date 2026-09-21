<script setup>
import Card from '@/Components/Layout/Supervisor/Reschedule/Card.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ArrowLeft, Mail, MailOpen } from 'lucide-vue-next'
import { onMounted, ref } from 'vue';
import { eror } from '@/Helper/Toast';
import axios from 'axios';
import LoadingPulse from '@/Components/LoadingPulse.vue';
import Loading from '@/Components/Loading.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';

const loading = ref(false);
const pagination = ref({});
const reschedules = ref([]);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/priority-second/');
    }catch(error){
        eror(error)
    }finally{
        loading.value = false;
    }
}

function next(page){
    if(page){
        get(page)
    }
}
function page(page){
    if(page){
        get(page)
    }
}
function prev(page){
    if(page){
        get(page)
    }
}
onMounted(()=>{
    get()
})
</script>

<template>
    <Head title="Reschedule" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Reschedule</h1>
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
        
        <section>
            <div class="flex items-center justify-between flex-wrap rounded-xl border border-gray-200 bg-white p-5 shadow-sm font-second">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">
                        Total Reschedule Reports
                    </h1>
                    <p class="mt-1 text-xs text-gray-500">
                        Review and manage upcoming shift changes for your division.
                    </p>
                </div>
                <div class="flex items-center justify-end gap-x-5 md:mx-0 mx-auto my-5 md:my-0">
                    <div class="flex items-center gap-3 rounded-lg bg-red-50 px-4 py-2 text-red-400">
                        <Mail size="20" class="text-red-500" />

                        <div>
                            <div class="text-md font-semibold text-center">12</div>
                            <div class="mt-1 text-xs">Unread</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-lg bg-teal-50 px-4 py-2 text-teal-400">
                        <MailOpen size="20" class="text-teal-500" />

                        <div>
                            <div class="text-md font-semibold text-center">9</div>
                            <div class="mt-1 text-xs">Read</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="p-3 bg-white rounded-lg shadow-sm flex items-center justify-between">
                <div>

                </div>
                <div class="flex items-center justify-end gap-x-3">
                    <input type="date" name="" id="" class="rounded-lg border-1 border-slate-300">
                    <select name="" id="" class="rounded-lg border-1 border-slate-300">
                        <option value="">Filter Status</option>
                    </select>
                </div>
            </div>
            <template v-if="loading">
                <div class="my-10">
                    <LoadingPrimary />
                </div>
            </template>
            <template v-else>
                <template v-if="reschedules.length > 0">
                    <div class="my-5 grid grid-cols-1 lg:grid-cols-2">
                        <Card />
                    </div>
                </template>
                <template v-else>

                </template>
            </template>

            <PaginationNumber :pagination="pagination" :name="'Submissions'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>