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
import Card from '@/Components/Layout/Specific/Booking/Card.vue';
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
    get();
})
</script>

<template>
    <Head title="Booking" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Booking</h1>
        </template>

        <section>
            <div class="w-full rounded-2xl bg-[#0b1120] p-5 sm:p-6 lg:p-8 font-second">
                <span class="inline-flex items-center gap-2 rounded-full bg-cyan-400/10 px-3 py-1 text-xs font-semibold tracking-wide text-cyan-300">
                    <span class="h-1.5 w-1.5 rounded-full bg-cyan-400"/>
                    Divisi Reservation & Ticketing
                </span>

                <div class="mt-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                    <div>
                        <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-white">
                            Manajemen Booking & Reservasi
                        </h1>
                        <p class="mt-2 max-w-md text-sm sm:text-md text-slate-400 leading-relaxed">
                            Kelola dan pantau seluruh jadwal kunjungan tamu, aktivitas dolphin interaction, kuota sesi, dan status transaksi secara tersentralisasi.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-white/5 px-4 py-2 text-center min-w-24">
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wide">Total Booking</p>
                            <h2 class="text-lg sm:text-xl font-bold text-white mt-1">128</h2>
                        </div>
                        <div class="rounded-xl bg-white/5 px-4 py-2 text-center min-w-24">
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wide">Hari Ini</p>
                            <h2 class="text-lg sm:text-xl font-bold text-cyan-400 mt-1">42</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

        <section>
            <template v-if="!loading">
                <template v-if="bookings?.length > 0">
                    <div class="space-y-4">
                        <Card v-for="booking in bookings" :key="booking.id" :booking="booking" />
                    </div>
                </template>
                <template>
                    <h1 class="text-md text-slate-500 flex items-center justify-center gap-x-2">No bookings available</h1>
                </template>
            </template>
            <template v-else>
                <LoadingPrimary />
            </template>
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Bookings'" @next="next" @page="page" @prev="prev" />
        </section>
    </AuthenticatedLayout>
</template>