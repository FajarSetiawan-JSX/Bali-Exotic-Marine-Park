<script setup>
import { Clock3, Pencil, BriefcaseBusiness, Coffee, Timer, ChevronUp, CalendarPlus2, Plus, Trash2 } from "lucide-vue-next";
import { onMounted, ref } from "vue";
import { eror, succes } from "@/Helper/Toast";
import axios from 'axios';
import Loading from "@/Components/Loading.vue";
import Create from "./Create.vue";
import Delete from "./Delete.vue";
import Update from "./Update.vue";
import Card from "./Card.vue";

const props = defineProps(['worktime']);
const showdropdown = ref(false);
const modalcreate = ref(false);
const modaldelete = ref(false);
const modalupdate = ref(false);
const loading = ref(false);
const times = ref([]);
const time = ref({});
async function get() {
    try{
        loading.value = true;
        const response = await axios.get('/api/priority-first/Fulltime');
        times.value = response?.data?.data;
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
    <template v-if="loading">
        <div class="flex items-center justify-center my-4">
            <div class="font-primary">
                <Loading :size="'lg'" class="mx-auto" />
                <h1 class="mt-2 text-lg">Fetching data</h1>
            </div>
        </div>
    </template>
    <template v-else>
        <template v-if="times.length > 0">
            <Card v-for="time in times" :key="time.id" :time="time" @update="handleopenupdate" />
        </template>
    </template>

    <template v-if="props?.worktime?.division_work?.length > 0">
        <section class="my-5">
            <div class="p-8 bg-gradient-to-br from-emerald-100 to-blue-50 shadow-lg rounded-2xl">
                <div class="w-full flex items-start justify-between font-second font-semibold">
                    <div class="flex items-start justify-start gap-x-2">
                        <Timer size="20" />
                        <div>
                            Full Time
                        </div>
                    </div>
                    <button type="button" @click="showdropdown = !showdropdown">
                        <ChevronUp size="20" :class="showdropdown ? 'rotate-0' : 'rotate-180'" class="transition-all duration-300" />
                    </button>
                </div>
                <div v-if="showdropdown" class="ml-7 my-5 grid grid-cols-1 gap-5">
                    <div v-for="(division, index) in props?.worktime?.division_work" :key="division.id" data-aos="fade-up" :data-aos-delay="index * 200" data-aos-offset="0" class="flex items-center justify-start gap-x-1.5 bg-white rounded-lg shadow-md">
                        <div class="flex items-center justify-between w-full px-3">
                            <div class="flex items-center gap-x-1">
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
            </div>
        </section>
    </template>

    <div class="flex flex-col items-center justify-center rounded-3xl border border-slate-200 bg-white px-6 py-8 shadow-sm my-5">
        <div data-aos="zoom-in" class="mb-2 flex h-20 w-20 items-center justify-center rounded-full bg-sky-100">
            <CalendarPlus2 class="h-10 w-10 text-sky-500" />
        </div>
        <template v-if="props?.worktime?.division_work?.length <= 0" >
            <h2 class="text-xl font-bold text-slate-800">
                No divisions are listed for full-time working hours.
            </h2>
            <p class="mt-2 max-w-md text-center text-sm leading-6 text-slate-500">
                Configure your organization's standard full-time working hours, including
                work duration and break time, to ensure consistent scheduling across all
                divisions.
            </p>
        </template>

        <template v-else>
            <h2 class="text-md font-bold text-slate-700 font-second">Add Full Time working hours</h2>
        </template>
        
        <button type="button" @click="modalcreate = true" class="mt-4 flex items-center gap-2 rounded-xl bg-sky-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-sky-700 active:scale-95">
            <Plus class="h-4 w-4" />
            Add Time
        </button>
    </div>
    
    <Create v-if="modalcreate" :worktime="props?.worktime" @close="modalcreate = false" @success="handlesuccesscreate" />
    <Delete v-if="modaldelete" :division="divisi" @close="handleclosedelete" @success="handlesuccessdelete" />
    <Update v-if="modalupdate" @close="handlecloseupdate" :time="time" @success="handlesuccessupdate" />
</template>

<style scoped>

</style>