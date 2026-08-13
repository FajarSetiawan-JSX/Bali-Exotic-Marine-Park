<script setup>
import { Timer, ChevronUp, Clock7, Clock3, Clock11, Plus, CalendarPlus2 } from 'lucide-vue-next'
import { onMounted, ref } from 'vue';
import Card from './Card.vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import Loading from '@/Components/Loading.vue';
import Create from './Create.vue';
import Delete from './Delete.vue';
import Update from './Update.vue';

const showdropdown = ref(false);
const props = defineProps(['worktime']);
const modalcreate = ref(false);
const modaldelete = ref(false);
const modalupdate = ref(false);
const loading = ref(false);
const times = ref([]);
const time = ref({});

async function get() {
    try{
        loading.value = true;
        const response = await axios.get('/api/priority-first/Shifting');
        times.value = response?.data?.data;
        console.log(response.data);
    }catch(error){
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
function handleopendelete(data){
    time.value = data;
    modaldelete.value = true;
}
function handleclosedelete(){
    time.value = {};
    modaldelete.value = false;
}
function handlesuccesscreate(){
    modalcreate.value = false;
    succes('Success', 'Successfully added a time slot to the full-time work schedule.');
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'Successfully delete the time slot from full-time work schedule.')
    time.value = {};
    get()
}
function handleopenupdate(data){
    time.value = data;
    modalupdate.value = true;
}
function handlecloseupdate(){
    time.value = {};
    modalupdate.value = false;
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'Successfully changed the full-time work duration')
    //time.value = {};
    get()
}
onMounted(()=>{
    get()
})
</script>

<template>
    <section class="overflow-hidden my-5 rounded-3xl bg-gradient-to-r from-[#132445] via-[#12304d] to-[#103854] p-6 shadow-xl md:p-8">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-sm">
                <span class="inline-flex items-center rounded-full bg-cyan-400/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-widest text-cyan-300 ring-1 ring-cyan-300/20">
                    Shifting Management
                </span>
                <h2 class="mt-5 text-3xl font-bold leading-tight text-white md:text-4xl">
                    Shifting
                    <br />
                    Schedule
                </h2>

                <p class="mt-3 text-sm leading-6 text-slate-300">
                    Configure shift rotations, timing,
                    and personnel distribution across
                    active divisions.
                </p>
            </div>

            <div class="flex flex-col gap-6 lg:flex-row lg:items-center">
                <div class="grid grid-cols-3 gap-4 rounded-2xl bg-white/5 p-4 backdrop-blur-sm lg:flex lg:gap-0 lg:bg-transparent lg:p-0">
                    <div class="px-2 text-center lg:min-w-[90px] lg:border-r lg:border-white/10">
                        <h3 class="text-2xl font-bold text-white">
                            24/7
                        </h3>

                        <p class="mt-1 text-xs text-slate-400">
                            Coverage
                        </p>
                    </div>

                    <div class="px-2 text-center lg:min-w-[90px] lg:border-r lg:border-white/10">
                        <h3 class="text-2xl font-bold text-white">
                            3
                        </h3>

                        <p class="mt-1 text-xs text-slate-400">
                            Total Shifts
                        </p>
                    </div>

                    <div class="px-2 text-center lg:min-w-[90px]">
                        <h3 class="text-2xl font-bold text-white">
                            12
                        </h3>

                        <p class="mt-1 text-xs text-slate-400">
                            Divisions
                        </p>
                    </div>
                </div>
                <button type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 rounded-xl bg-cyan-400 px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-cyan-300 active:scale-95">
                    <Plus />
                    Add Shifting
                </button>
            </div>
        </div>
    </section>

    <template v-if="!loading">
        <template v-if="times.length > 0">
            <section class="my-5 grid grid-cols-1 gap-3 md:gap-4 xl:grid-cols-3 md:grid-cols-2">
                <Card v-for="(time, index) in times" :key="time?.id" :time="time" @update="handleopenupdate" @delete="handleopendelete" :bg="index == 0 ? 'bg-emerald-200' : index == 1 ? 'bg-yellow-200' : 'bg-red-200'" :icon="index == 0 ? 'text-emerald-500' : index == 1 ? 'text-yellow-500' : 'text-red-500'" :border="index == 0 ? 'border-emerald-500' : index == 1 ? 'border-yellow-500' : 'border-red-500'" />
            </section>
        </template>
    </template>
    <template v-else>
        <div class="flex items-center justify-center my-4">
            <div class="font-primary">
                <Loading :size="'lg'" class="mx-auto" />
                <h1 class="mt-2 text-lg">Fetching data</h1>
            </div>
        </div>
    </template>

    <section class="my-5">
        <template v-if="props?.worktime?.division_work?.length > 0">
            <div class="p-8 bg-gradient-to-br from-white to-blue-50 shadow-lg rounded-2xl">
                <div class="w-full flex items-start justify-between font-second font-semibold">
                    <div class="flex items-start justify-start gap-x-2">
                        <Timer size="20" />
                        <div>
                            Group Division Shifting
                        </div>
                    </div>
                    <button type="button" @click="showdropdown = !showdropdown">
                        <ChevronUp size="20" :class="showdropdown ? 'rotate-0' : 'rotate-180'" class="transition-all duration-300" />
                    </button>
                </div>
                <div v-if="showdropdown" class="ml-7 my-5 grid grid-cols-1 gap-5">
                    <div v-for="(division, index) in props?.worktime?.division_work" :key="division?.id" class="flex items-center justify-start gap-x-1.5 bg-white rounded-lg shadow-md">
                        <div class="flex items-center">
                            <div class="p-3 border-r-2 border-indigo-600">
                                {{ index + 1 }}
                            </div>
                            <div class="p-5">
                                {{ division?.division }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </section>

    <div class="flex flex-col items-center justify-center rounded-3xl border border-slate-200 bg-white px-6 py-16 shadow-sm">
        <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-sky-100">
            <CalendarPlus2 class="h-10 w-10 text-sky-500" />
        </div>
        <template v-if="props?.worktime?.division_work?.length < 0">
            <p class="mt-2 max-w-md text-center text-sm leading-6 text-slate-500">
                There are no shift schedules yet. Create your first shift schedule to
                organize employee working hours and improve operational efficiency.
            </p>
        </template>
        
        <button type="button" @click="modalcreate = true" class="mt-8 flex items-center gap-2 rounded-xl bg-sky-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-sky-700 active:scale-95">
            <Plus class="h-4 w-4" />
            Add Shifting Schedule
        </button>
    </div>

    <Create v-if="modalcreate" :worktime="props?.worktime" @close="modalcreate = false" @success="handlesuccesscreate" />
    <Delete v-if="modaldelete" :division="divisi" @close="handleclosedelete" @success="handlesuccessdelete" />
    <Update v-if="modalupdate" @close="handlecloseupdate" :time="time" @success="handlesuccessupdate" />
</template>