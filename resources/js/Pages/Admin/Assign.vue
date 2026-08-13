<script setup>
import Header from '@/Components/Header.vue';
import Loading from '@/Components/Loading.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import NoDataSymbol from '@/Components/NoDataSymbol.vue';
import { eror, succes } from '@/Helper/Toast';
import Create from '@/Components/Layout/Admin/Attachment/Create.vue';

const opencreate = ref(false);
const openmodal = ref(null);
const dropdown = ref(null);
const loadingget = ref(false);
const supervisors = ref([]);
const divisionsavailabel = ref({});
async function get() {
    try{
        loadingget.value = true;
        const response = await axios.get('/api/priority-first/supervisor');
        supervisors.value = response?.data?.supervisors;
        divisionsavailabel.value = response?.data?.divisions;
    }catch(error){
        eror(error?.response?.status, error?.response?.statusText);
        console.log(error.response);
    }finally{
        loadingget.value = false;
    }
}
onMounted(()=>{
    get()
})
</script>

<template>
    <Head title="Supervisor Assign" />

    <AuthenticatedLayout>
        <section class="p-5 my-3.5">
            <section class="grid grid-cols-1 gap-3 lg:grid-cols-3">
                <div data-aos="flip-up" class="rounded-2xl lg:col-span-2 bg-gradient-to-br from-indigo-700 to-blue-600 p-8 text-white relative overflow-hidden font-second">
                    <div class="inline-flex items-center rounded-full bg-white/10 px-4 py-1 text-xs font-medium mb-6 backdrop-blur">
                        GOVERNANCE PRIORITY 1
                    </div>

                    <h1 class="text-4xl font-bold mb-4">
                        Attachment Division
                    </h1>

                    <p class="text-white/70 max-w-lg leading-relaxed mb-8">
                        Orchestrating high-security data synchronization across
                        enterprise-wide integration protocols across all global sub
                        divisions.
                    </p>

                    <button type="button" @click="opencreate = true" class="bg-white text-indigo-700 font-medium px-5 py-3 rounded-xl hover:scale-105 active:scale-100 transition-all duration-300">
                        + New Attachment Protocol
                    </button>
                    <div class="absolute right-10 bottom-8 opacity-30">
                        <svg width="140" height="140" viewBox="0 0 140 140" fill="none">
                            <circle cx="70" cy="20" r="12" stroke="white" stroke-width="6" />
                            <circle cx="30" cy="70" r="12" stroke="white" stroke-width="6" />
                            <circle cx="70" cy="70" r="12" stroke="white" stroke-width="6" />
                            <circle cx="110" cy="70" r="12" stroke="white" stroke-width="6" />
                            <circle cx="70" cy="120" r="12" stroke="white" stroke-width="6" />
                            <line x1="70" y1="32" x2="70" y2="58" stroke="white" stroke-width="6" />
                            <line x1="42" y1="70" x2="58" y2="70" stroke="white" stroke-width="6" />
                            <line x1="82" y1="70" x2="98" y2="70" stroke="white" stroke-width="6" />
                            <line x1="70" y1="82" x2="70" y2="108" stroke="white" stroke-width="6" />
                        </svg>
                    </div>
                </div>
                <div data-aos="flip-down" data-aos-delay="300" class="bg-white rounded-2xl p-8 shadow-sm border font-second">
                    <p class="text-xs tracking-widest text-slate-400 uppercase mb-6 font-primary">
                        Division attachment prencentage
                    </p>

                    <h1 class="text-6xl font-bold text-indigo-600">
                        98.2%
                    </h1>

                    <div class="flex items-center gap-2 mt-4 mb-6">
                        <span class="text-green-500 font-semibold">
                            Updated at
                        </span>

                        <span class="text-slate-500 text-sm">
                            Target Met
                        </span>
                    </div>
                    <div class="h-2 rounded-full bg-indigo-500 mb-5" />
                    <p class="text-sm text-slate-400">
                        Calculated across 24 active division
                    </p>
                </div>
            </section>

            <header class="m-5">
                <h4 data-aos="fade-up" class="text-black font-semibold font-second my-1.5 text-2xl">Assigned divisions</h4>
                <h5 data-aos="fade-down" class="text-slate-700 text-sm font-second">Manage organizational units and member distribution.</h5>
            </header>

            <section>
                <template v-if="loadingget">
                    <div class="max-w-max mx-auto">
                        <Loading :class="'w-20 h-20'" />
                        <p class="font-primary text-slate-400 text-sm mt-10 text-center">Loading</p>
                    </div>
                </template>
                <template v-else>
                    <template v-if="supervisors.length > 0">
                        <div class="grid grid-cols-1 gap-4">
                            <div data-aos="fade-up" v-for="(supervisor, index) in supervisors" :key="index" class="p-5 rounded-xl outline-1 outline-slate-200 bg-white">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-slate-400 text-xs font-second capitalize">{{ supervisor.division }}</p>
                                        <h1 class="bg-linear-to-r from-indigo-950 to-black bg-clip-text text-transparent font-bold font-second text-2xl">{{ supervisor.nama }}</h1>
                                        <div class="flex justify-between items-center my-0.5">
                                            <div v-if="supervisor?.position[0]?.assign" class="flex -space-x-2">
                                                <img v-for="(division, index) in supervisor?.position[0]?.assign" :key="team.id"
                                                :src="`https://ui-avatars.com/api/?name=${division.name}&background=7DD3fc&color=#87CEEB`"
                                                title="image"
                                                class="w-8 h-8 rounded-full border-2 border-white hover:-translate-y-1 transition-all duration-300">

                                            </div>
                                            <span class="mx-2 text-slate-600 text-xs">{{ supervisor?.position[0]?.assign.length }} Divisions</span>
                                        </div>
                                    </div>
                                    <button type="submit" @click="dropdown = dropdown === supervisor.id ? null : supervisor.id" class="text-indigo-500">
                                        <svg class="fill-current transition-all duration-300" :class="dropdown === supervisor.id ? 'rotate-180' : 'rotate-0'" width="20px" height="20px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="#FFFFFFF" d="M10.1025513,12.7783485 L16.8106554,6.0794438 C17.0871744,5.80330401 17.5303978,5.80851813 17.8006227,6.09108986 C18.0708475,6.37366159 18.0657451,6.82658676 17.7892261,7.10272655 L10.5858152,14.2962587 C10.3114043,14.5702933 9.87226896,14.5675493 9.60115804,14.2901058 L2.2046872,6.72087106 C1.93149355,6.44129625 1.93181183,5.98834118 2.20539811,5.7091676 C2.47898439,5.42999401 2.92223711,5.43031926 3.19543076,5.70989407 L10.1025513,12.7783485 Z"/>
                                        </svg>
                                    </button>
                                </div>
                                <Transition name="collapse">
                                    <div v-if="dropdown === supervisor.id" class="ml-5 my-5">
                                        <template v-if="supervisor?.position[0]?.assign.length > 0">
                                            <div class="p-3.5 grid grid-cols-1 gap-3">
                                                <div v-for="(division, index) in supervisor?.position[0]?.assign" :key="division.id" class="flex justify-between items-center">
                                                    <div class="flex">
                                                        <div class="font-bold font-second text-3xl px-1 border-r-2 border-indigo-500">
                                                            {{ index + 1 }}
                                                        </div>
                                                        <div class="mx-1.5">
                                                            <h6 class="text-black text-lg font-semibold">{{ division.name }}</h6>
                                                            <span class="text-slate-400 text-xs font-primary">{{ division.name }} users</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" @click="openmodal = false" class="flex justify-center items-center gap-x-1.5 bg-sky-300 px-1.5 py-0.5 rounded-lg text-white hover:bg-sky-500 active:scale-105 transition-all duration-300 focus:ring-1 focus:ring-sky-200">
                                                        <svg class="fill-current" height="15px" width="15px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                                viewBox="0 0 32 32" xml:space="preserve">
                                                            <g>
                                                                <path d="M9.6,18.1c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0-1.4l-4.9-4.9C5.3,11,4.9,10,4.9,8.9s0.4-2.1,1.2-2.8
                                                                    c1.5-1.5,4.1-1.5,5.7,0l4.9,4.9c0.4,0.4,1,0.4,1.4,0s0.4-1,0-1.4l-4.9-4.9C12,3.6,10.5,2.9,8.9,2.9c-1.6,0-3.1,0.6-4.2,1.8
                                                                    C3.6,5.8,2.9,7.3,2.9,8.9s0.6,3.1,1.8,4.2L9.6,18.1z"/>
                                                                <path d="M22.4,13.9c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4l4.9,4.9c0.8,0.8,1.2,1.8,1.2,2.8s-0.4,2.1-1.2,2.8c-1.5,1.5-4.1,1.5-5.7,0
                                                                    L15.3,21c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4l4.9,4.9c1.1,1.1,2.6,1.8,4.2,1.8c1.6,0,3.1-0.6,4.2-1.8c1.1-1.1,1.8-2.6,1.8-4.2
                                                                    s-0.6-3.1-1.8-4.2L22.4,13.9z"/>
                                                                <path d="M11.1,11.1c-0.4,0.4-0.4,1,0,1.4l8.5,8.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0-1.4l-8.5-8.5
                                                                    C12.1,10.7,11.4,10.7,11.1,11.1z"/>
                                                                <path d="M8.6,19.1c-0.2-0.5-0.8-0.8-1.3-0.5l-4.6,1.9c-0.5,0.2-0.8,0.8-0.5,1.3c0.2,0.4,0.5,0.6,0.9,0.6c0.1,0,0.3,0,0.4-0.1
                                                                    l4.6-1.9C8.6,20.2,8.8,19.6,8.6,19.1z"/>
                                                                <path d="M10.3,21.7c-0.4-0.4-1-0.4-1.4,0l-3.5,3.5c-0.4,0.4-0.4,1,0,1.4c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l3.5-3.5
                                                                    C10.7,22.7,10.7,22,10.3,21.7z"/>
                                                                <path d="M12.9,23.4c-0.5-0.2-1.1,0-1.3,0.5l-1.9,4.6c-0.2,0.5,0,1.1,0.5,1.3c0.1,0.1,0.3,0.1,0.4,0.1c0.4,0,0.8-0.2,0.9-0.6
                                                                    l1.9-4.6C13.7,24.2,13.4,23.6,12.9,23.4z"/>
                                                                <path d="M29.9,10.3c-0.2-0.5-0.8-0.8-1.3-0.5l-4.6,1.9c-0.5,0.2-0.8,0.8-0.5,1.3c0.2,0.4,0.5,0.6,0.9,0.6c0.1,0,0.3,0,0.4-0.1
                                                                    l4.6-1.9C29.8,11.4,30.1,10.8,29.9,10.3z"/>
                                                                <path d="M21.7,10.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l3.5-3.5c0.4-0.4,0.4-1,0-1.4s-1-0.4-1.4,0l-3.5,3.5
                                                                    C21.3,9.3,21.3,10,21.7,10.3z"/>
                                                                <path d="M19.1,8.6c0.1,0.1,0.3,0.1,0.4,0.1c0.4,0,0.8-0.2,0.9-0.6l1.9-4.6c0.2-0.5,0-1.1-0.5-1.3c-0.5-0.2-1.1,0-1.3,0.5l-1.9,4.6
                                                                    C18.3,7.8,18.6,8.4,19.1,8.6z"/>
                                                            </g>
                                                        </svg>
                                                        <span>Detach</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <NoDataSymbol :width="'120px'" :height="'90px'">
                                                <p class="text-slate-500">No data attachment</p>
                                            </NoDataSymbol>
                                        </template>
                                    </div>
                                </Transition>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <NoDataSymbol :width="'200px'" :height="'150px'">
                            <p class="text-slate-500">Not available Supervisor Division yet</p>
                        </NoDataSymbol>
                    </template>
                </template>
            </section>
        </section>
        <Create v-if="opencreate" @close="opencreate = false" :divisions="divisionsavailabel" :supervisors="supervisors" />
    </AuthenticatedLayout>
</template>
<style scoped>
.collapse-enter-active,
.collapse-leave-active {
    transition: all 0.35s ease;
    overflow: hidden;
}

.collapse-enter-from,
.collapse-leave-to {
    opacity: 0;
    transform: translateY(-10px);
    max-height: 0;
}

.collapse-enter-to,
.collapse-leave-from {
    opacity: 1;
    transform: translateY(0);
    max-height: 500px;
}
</style>