<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { CheckCheck, Check, ClipboardList } from 'lucide-vue-next';
import Card from '@/Components/Layout/Admin/Api/Card.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import { onBeforeUnmount } from 'vue';
import Create from '@/Components/Layout/Specific/Notification/Create.vue';
import { formatDate } from '@/Helper/FormatDate';
import Update from '@/Components/Layout/Specific/Notification/Update.vue';
import Delete from '@/Components/Layout/Specific/Notification/Delete.vue';
import Show from '@/Components/Layout/Specific/Notification/Show.vue';
import { useCounter } from '@/Helper/counter';
import Table from '@/Components/Layout/Specific/Diet/Table.vue';

const user = usePage().props?.auth;
const search = ref('');
const notifications = ref([]);
const openMenu = ref(null);
const pagination = ref({});
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);

const from = ref('');
const to = ref('');
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('general.notification.index'), {
            params: {
                page: page,
                search: search.value,
                from: from.value,
                to: to.value
            }
        });
        notifications.value = response.data.data ?? [];
        pagination.value = response.data.meta ?? {};
    }catch(error){
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
function handleopendelete(data){
    record.value = data;
    modaldelete.value = true;
}
function handlclosedelete(){
    modaldelete.value = false;
    record.value = {};
}

function handleopenupdate(data){
    record.value = data;
    modalupdate.value = true;
}
function handlecloseupdate(){
    record.value = {};
    modalupdate.value = false;
}

function handlescloseshow(){
    record.value = {};
    modalshow.value = false;
}

function handlesuccesscreate(data){
    modalcreate.value = false;
    notifications.value.unshift(data);
    succes('Success', 'The new notification was successfully added.')
    get()
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'notification has been successfully updated.')
    record.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'notification has been successfully updated.')
    record.value = {}
    get()
}

</script>

<template>
    <Head title="Diet Plan" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Diet Plan</h1>
        </template>
        <section>
            <div class="rounded-2xl bg-[#082b47] p-6 text-white sm:p-8 lg:p-10">
                <div class="flex flex-col gap-8 lg:flex-row lg:items-stretch lg:justify-between">
                    <div class="flex flex-col justify-center gap-4">
                        <div class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#3ddcb0]"></span>
                            <span class="text-sm font-semibold uppercase tracking-[0.2em] text-[#8fb8da]">
                                Base and Execute diet plan Management
                            </span>
                        </div>
        
                        <h1 class="text-4xl font-bold leading-tight sm:text-5xl">Diet Plan</h1>
        
                        <p class="text-base text-[#7fb2dc] sm:text-lg">
                            Marine mammal nutrition &amp; feeding plans
                        </p>
                    </div>
        
                    <!-- Kanan -->
                    <div class="flex border-t border-white/10 pt-6 lg:border-t-0 lg:pt-0">
        
                        <!-- Total -->
                        <div class="flex flex-1 flex-col gap-2 pr-6 lg:min-w-[190px] lg:border-l lg:border-white/10 lg:px-8 lg:pr-8">
                            <ClipboardList class="h-6 w-6 text-[#38bdf8]" />
                            <p class="mt-2 text-sm text-[#8fb8da]">Total Diet Plan</p>
                            <p class="text-5xl font-bold leading-none sm:text-6xl">00</p>
                            <p class="text-xs text-[#8fb8da]">All diet plans</p>
                        </div>
        
                        <!-- Approved -->
                        <div class="flex flex-1 flex-col gap-2 border-l border-white/10 pl-6 lg:min-w-[190px] lg:px-8">
                            <CheckCheck class="h-6 w-6 text-[#3ddcb0]" />
                            <p class="mt-2 text-sm text-[#8fb8da]">Approved</p>
                            <p class="text-5xl font-bold leading-none text-[#3ddcb0] sm:text-6xl">00</p>
                            <p class="flex items-start gap-1.5 text-xs text-[#3ddcb0]">
                                <Check class="mt-0.5 h-3 w-3 shrink-0" />
                                <span>Approved diet plans</span>
                            </p>
                        </div>
        
                    </div>
                </div>
            </div>
        </section>

        <Table :basic="null" />
        
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
        <Update v-if="modalupdate" @close="handlecloseupdate" :notification="record" @success="handlesuccessupdate" />
        <Show v-if="modalshow" @close="handlescloseshow" :notification="record" />
        <Delete v-if="modaldelete" @close="handlclosedelete" @success="handlesuccessdelete" :data="record" />
    </AuthenticatedLayout>
</template>