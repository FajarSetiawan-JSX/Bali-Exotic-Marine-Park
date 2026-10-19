<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { ArrowLeft } from "lucide-vue-next";
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';

const user = usePage().props?.auth;
const props = defineProps(['total']);
const search = ref('');
const openMenu = ref(null);
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const bookings = ref([]);
const record = ref({});
const pagination = ref({});
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('specific.booking.index'), {
            params: {
                page: page,
                search: search.value
            }
        });
        bookings.value = response.data.data ?? [];
        pagination.value = response.data.meta ?? {};
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
watch(()=>search.value, ($newsearch)=>{
    if($newsearch){
        setTimeout(() => {
            get()
        }, 1000);
    }
},{ immediate: true });

onMounted(()=>{
    //get();
})
</script>

<template>
    <Head title="Incident" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Incident</h1>
        </template>

        

        <section>
            <div class="flex items-center justify-between flex-wrap bg-white p-3 rounded-t-lg my-5 shadow-md">
                <div class="flex items-center justify-start gap-x-3">
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
                <div>
                    
                </div>
            </div>
        </section>

        

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Incidents'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>