<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { ArrowLeft, Plus } from 'lucide-vue-next'
import PaginationNumber from '@/Components/PaginationNumber.vue';
import Card from '@/Components/Layout/Admin/Question/Card.vue';
import Empty from '@/Components/Empty.vue';
import LoadingCard from '@/Components/LoadingCard.vue';
import Create from '@/Components/Layout/Admin/Question/Create.vue';
import Update from '@/Components/Layout/Admin/Question/Update.vue';
import Delete from '@/Components/Layout/Admin/Question/Delete.vue';
import { useCounter } from '@/Helper/counter';

const user = usePage().props?.auth;
const props = defineProps(['total', 'normal', 'incident', 'divisions', 'sections']);
const counttotal = useCounter();
const countnormal = useCounter();
const countincident = useCounter();
const search = ref('');
const option = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const questions = ref([]);
const record = ref({});
const pagination = ref({});
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.question.index'), {
            params: {
                page: page,
                search: search.value,
                option: option.value
            }
        });
        questions.value = response.data.data ?? [];
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
watch(()=>search.value, ($newsearch)=>{
    if($newsearch){
        setTimeout(() => {
            get()
        }, 1000);
    }
},{ immediate: true });
watch(()=>option.value, ($newop)=>{
    if($newop){
        setTimeout(() => {
            get()
        }, 1000);
    }
},{ immediate: true });
function handlesuccesscreate(data){
    modalcreate.value = false;
    questions.value.unshift(data);
    succes('Success', 'Success created new question');
}
function handleopenupdate(data){
    modalupdate.value = true;
    record.value = data;
}
function handlesuccessupdate(){
    modalupdate.value = false;
    record.value = {};
    succes('Success', 'Success update question');
    get();
}

function handlecloseupdate(){
    modalupdate.value = false;
    record.value = {};
}
function handleopendelete(data){
    modaldelete.value = true;
    record.value = data;
}
function handlesuccessdelete(){
    modaldelete.value = false;
    record.value = {};
    succes('Success', 'Success deleted question');
    get();
}
function handleclosedelete(){
    modaldelete.value = false;
    record.value = {};
}
onMounted(()=>{
    get()
    counttotal.start(props?.total);
    countnormal.start(props?.normal);
    countincident.start(props?.incident);
})
</script>

<template>
    <Head title="Question" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Question</h1>
        </template>

        <section>
            <div class="relative overflow-hidden rounded-2xl p-6 font-second" style="background:linear-gradient(135deg,#0C0C2B 0%,#1E1B4B 50%,#0A2540 100%)">
                <div class="absolute -right-16 -top-16 h-72 w-72 rounded-full border border-white/10"/>
                <div class="absolute right-10 -top-5 h-40 w-40 rounded-full border border-violet-500/20"/>
                <div class="absolute right-24 -bottom-10 h-52 w-52 rounded-full" style="background:radial-gradient(circle,rgba(99,102,241,.12),transparent 70%)"/>
                <div class="relative flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center gap-2 rounded-full bg-indigo-500/10 px-3 py-1 text-xs font-semibold text-indigo-300">
                            <span class="size-1.5 rounded-full bg-indigo-400"></span>MANAGEMENT QUESTION
                        </span>
                        <h2 class="mt-3 text-md font-bold text-white sm:text-lg md:text-2xl lg:text-3xl">Bank Question</h2>
                        <p class="mt-1 max-w-xl text-xs text-slate-400 sm:text-sm md:text-md">Manage the master question repository, categorization of the mammal attraction division, testing specifications, and curation of standard operational evaluations for BEMP.</p>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" @click="modalcreate = true" class="flex items-center gap-2 rounded-lg bg-sky-900 px-4 py-2 text-xs font-medium text-white hover:bg-sky-950 sm:text-sm transition-all duration-300 active:scale-95">
                            <Plus class="size-4" />
                            Add New Question
                        </button>
                    </div>
                </div>

                <div class="relative mt-6 border-t border-white/10 pt-5">
                    <div class="grid grid-cols-2 gap-y-5 sm:grid-cols-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-2xl font-semibold text-white">{{ counttotal.count }}</span>
                            </div>
                            <p class="mt-1 text-xs text-indigo-300">Total Question</p>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-2xl font-bold text-white">{{ countnormal.count }}</span>
                                <span class="rounded bg-sky-500/15 px-1.5 py-0.5 text-xs font-medium text-sky-400">/ {{ props?.total }}</span>
                            </div>
                            <p class="mt-1 text-xs text-indigo-300">Checklist Question</p>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-2xl font-semibold text-white">{{ countincident.count }}</span>
                                <span class="rounded bg-emerald-500/15 px-1.5 py-0.5 text-xs font-medium text-emerald-400">/ {{ props?.total }}</span>
                            </div>
                            <p class="mt-1 text-xs text-indigo-300">Text Question</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2 bg-white p-3 my-5 border-1 border-slate-200">
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
                <div class="flex gap-x-2 items-center justify-end">
                    <select name="" id="" v-model="option" class="gap-x-1.5 rounded-lg border-slate-300">
                        <option disabled selected value="">Filter Option</option>
                        <option value="Normal">Normal</option>
                        <option value="Incident">Incident</option>
                    </select>
                </div>
            </div>
        </section>

        <section class="my-5 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
            <template v-if="loading">
                <LoadingCard />
                <LoadingCard />
                <LoadingCard />
            </template>
            <template v-else>
                <template v-if="questions.length > 0">
                    <Card v-for="(question, index) in questions" :key="question?.id" :question="question" :number="((pagination.current_page - 1) * pagination.per_page) + index + 1" @edit="handleopenupdate" @hapus="handleopendelete" />
                </template>
                <template v-else>
                    <div class="md:col-span-2 xl:col-span-3">
                        <Empty title="No Question Yet" description="You haven't created any questions yet." sub-description="Get started by creating your first question." primary-text="Create Question" @primary="modalcreate = true"/>
                    </div>
                </template>
            </template>
        </section>

        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Questions'" @next="next" @page="page" @prev="prev" />
        </section>

        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" :divisions="props?.divisions" :sections="props?.sections" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :question="record" :divisions="props?.divisions" :sections="props?.sections" />
        <Delete v-if="modaldelete" @close="handleclosedelete" @success="handlesuccessdelete" :question="record" />
    </AuthenticatedLayout>
</template>