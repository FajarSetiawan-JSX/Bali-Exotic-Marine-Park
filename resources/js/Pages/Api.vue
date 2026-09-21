<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { eror } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { Link2, ShieldCheck, Copy, Check, ArrowLeft } from 'lucide-vue-next';
import Card from '@/Components/Layout/Admin/Api/Card.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
 
const baseUrl = 'https://bemp-dev/api'
const copied = ref(false)
 
function copyUrl() {
    navigator.clipboard.writeText(baseUrl)
    copied.value = true
    setTimeout(() => {
        copied.value = false
    }, 1500)
}

const user = usePage().props?.auth;
const search = ref('');
const scope = ref('');
const apies = ref([]);
const pagination = ref({});
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.api.index'), {
            params: {
                page: page,
                search: search.value,
                scope: scope.value
            }
        });
        apies.value = response.data.data ?? [];
        pagination.value = response.data.meta;
        console.log(response?.data)
    }catch(error){
        console.log(error.response);
        eror(error?.response?.status, error?.response?.data?.message);
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
watch(()=>scope.value, ($newscope)=>{
    if($newscope){
        get()
    }
},{ immediate: true });
watch(()=>search.value, ($newsearch)=>{
    if($newsearch){
        setTimeout(() => {
            get()
        }, 1000);
    }
},{ immediate: true });
onMounted(()=>{
    get()
})
</script>

<template>
    <Head title="Supervisor assign" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Access API</h1>
        </template>
        <!-- <template #search>
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
        </template> -->

        <section>
            <div class="w-full rounded-xl border border-gray-200 bg-white p-4 sm:p-6 font-second">
                <h2 data-aos="fade-up" class="text-base sm:text-lg font-semibold text-gray-800 mb-2">
                    Available Endpoints API
                </h2>
                <p data-aos="fade-down" class="text-sm sm:text-base text-gray-500 leading-relaxed mb-5">
                    Explore the available API endpoints, grouped by scope. This reference covers every endpoint you have access to, along with required parameters and response structures, to help you integrate our services into your application.
                </p>
        
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div data-aos="fade-left" class="rounded-lg bg-gray-50 border border-gray-200 p-3 sm:p-4">
                        <div class="flex items-center gap-1.5 mb-2">
                            <Link2 class="h-4 w-4 text-gray-400" />
                            <p class="text-xs font-semibold uppercase text-gray-500">Base URL</p>
                        </div>
                        <div class="flex items-center justify-between gap-2 rounded-md bg-slate-900 px-3 py-2 font-primary">
                            <code class="text-xs sm:text-sm text-emerald-300 truncate">
                                {{ baseUrl }}
                            </code>
                            <button type="button"  class="shrink-0 text-gray-400 hover:text-white transition-colors" @click="copyUrl">
                                <Check v-if="copied" class="h-4 w-4 text-emerald-400" />
                                <Copy v-else class="h-4 w-4" />
                            </button>
                        </div>
                    </div>
        
                    <div data-aos="fade-right" class="rounded-lg bg-sky-50 border border-sky-100 p-3 sm:p-4">
                        <div class="flex items-center gap-1.5 mb-2">
                            <ShieldCheck class="h-4 w-4 text-sky-500" />
                            <p class="text-xs font-semibold uppercase text-sky-600">Authentication</p>
                        </div>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                            Requires a bearer token in the authorization header.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-4 my-10">
            <div class="p-3 shadow-sm border-1 border-slate-50 bg-white flex flex-wrap items-center justify-between">
                <div>
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
                </div>
                <select name="" id="" class="flex gap-x-1.5 rounded-lg" v-model="scope">
                    <option value="" disabled selected>Filter scope</option>
                    <option value="Super Admin">Super Admin</option>
                    <option value="General">General</option>
                    <option value="Specific">Specific</option>
                </select>
            </div>
        </section>

        <template v-if="!loading">
            <template v-if="apies.length > 0">
                <section class="space-y-2">
                    <Card v-for="api in apies" :key="api.id" :api="api" :baseUrl="baseUrl" />
                </section>
            </template>
            <template v-else>
                <div class="my-6">
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed text-center">
                        No endpoints found.
                    </p>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="my-6">
                <LoadingPrimary />
            </div>
        </template>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Pages'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>