<script setup>
import { onMounted, ref } from 'vue';
import Card from './Card.vue';
import { eror } from '@/Helper/Toast.js';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import LoadingPrimary from '../../LoadingPrimary.vue';
import { usePage } from '@inertiajs/vue3';
import { Plus } from "lucide-vue-next";

const user = usePage().props?.auth;
const emit = defineEmits(['open']);
const loading = ref(false);
const props = defineProps(['basic']);
const reports = ref([]);
const pagination = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('specific.mammal.report.index'), {
            params: {
                page: page,
                basic: props?.basic?.id
            }
        })
        pagination.value = response?.data?.meta ?? {};
        reports.value = response?.data?.data ?? [];
    }catch(error){
        eror(error?.response?.status, error?.response?.statusText);
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
    <section class="space-y-5">
        <template v-if="loading">
            <LoadingPrimary />
        </template>
        <template v-else>
            <template v-if="reports.length > 0">
                <Card v-for="report in reports" :report="report">
                    <div v-if="user.api.includes('specific.mammal.report.vet.store') && !report.vet" class="p-5 border-t border-slate-200">
                        <button type="button" @click="emit('open', report)" class="px-5 py-1.5 rounded-lg bg-emerald-400 hover:bg-emerald-500 text-white flex items-center justify-start gap-x-2 active:scale-95 transition-all duration-300"><Plus size="15" />Complete report mammal vet</button>
                    </div>
                </Card>
            </template>
            <template v-else>
                <p class="text-center font-primary tex-md text-red-500">No Mammal reports available.</p>
            </template>
        </template>
    </section>

    <section class="mt-6">
        <PaginationNumber :pagination="pagination" :name="'Mammal Reports'" @next="next" @page="page" @prev="prev" />
    </section>
</template>