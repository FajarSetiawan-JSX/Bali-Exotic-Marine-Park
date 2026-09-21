<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { ArrowLeft, Plus, UserRound, Info } from 'lucide-vue-next';
import { eror } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import Card from '@/Components/Layout/Admin/Web/Card.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import Header from '@/Components/Layout/Admin/Web/Header.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';

const user = usePage().props?.auth;
const props = defineProps(['pages']);
const search = ref('');
const scope = ref('');
const pages = ref([]);
const pagination = ref({});
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.web.index'), {
            params: {
                page: page,
                search: search.value,
                scope: scope.value
            }
        });
        pages.value = response.data.data ?? [];
        pagination.value = response.data.meta;
        console.log(response?.data);
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
            <h1 class="font-semibold">Access Web</h1>
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
        <section class="font-second">
            <Header :total="props?.pages" />
        </section>

        <section class="space-y-4 my-5">
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
            <template v-if="pages.length > 0">
                <section class="space-y-2">
                    <Card v-for="page in pages" :key="page.id" :page="page" />
                </section>
            </template>
            <template v-else>
                <div class="my-6">
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed text-center">
                        No pages found.
                    </p>
                </div>
            </template>
        </template>
        <template v-else>
            <div class="my-6">
                <LoadingPrimary />
            </div>
        </template>
        <section class="my-4">
            <PaginationNumber :pagination="pagination" :name="'Pages'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>