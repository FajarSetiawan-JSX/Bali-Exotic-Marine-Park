<script setup>
import LoadingCard from '@/Components/LoadingCard.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ArrowLeft, Split } from "lucide-vue-next";
import { ref, watch } from 'vue';
import { onMounted } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import Empty from '@/Components/Empty.vue';
import CreatePosition from '@/Components/Layout/Admin/Division/CreatePosition.vue';
import CardPosition from '@/Components/Layout/Admin/Division/CardPosition.vue';
import UpdatePosition from '@/Components/Layout/Admin/Division/UpdatePosition.vue';
import DeletePosition from '@/Components/Layout/Admin/Division/DeletePosition.vue';
import SearchLoad from '@/Components/SearchLoad.vue';

const props = defineProps(['division', 'positions']);
const search = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);

const positions = ref([]);
const pagination = ref({});
const position = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/priority-first/positions/${props?.division?.id}`, {
            params: {
                page: page,
                search: search.value
            }
        })
        console.log(response?.data);
        pagination.value = response?.data?.meta;
        positions.value = response?.data?.data;
    }catch(error){
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
function handleopendelete(data){
    position.value = data;
    modaldelete.value = true;
}
function handlclosedelete(){
    modaldelete.value = false;
    position.value = {};
}

function handleopenupdate(data){
    position.value = data;
    modalupdate.value = true;
}
function handlecloseupdate(){
    position.value = {};
    modalupdate.value = false;
}

function handlesuccesscreate(){
    modalcreate.value = false;
    succes('Success', 'The new position was successfully added.')
    get()
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', `The ${position.value.name} division has been successfully updated.`)
    position.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    eror('Maintenance', 'Can not delete position');
    //succes('Success', `The ${division.value.name} division has been successfully updated.`)
    position.value = {}
    //get()
}
watch(search, (val) => {
    setTimeout(()=>{
        get();
    },1000)
},{ immediate: true });

onMounted(()=>{
    get();
})
</script>

<template>
    <Head title="Division" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Division Positions</h1>
        </template>

        <header class="flex justify-between mb-5">
            <div class="max-w-max">
                <h3 class="text-slate-400 text-sm font-second">Division <span class="text-thrid-admin">> {{ props?.division?.name }}</span></h3>
                <h4 class="text-black font-semibold font-second my-1.5 text-xl">Available positions</h4>
                <h5 class="text-slate-500 text-sm font-second">Manage organizational units and member distribution.</h5>
            </div>
            <div class="max-w-max">
                <button type="button" @click="modalcreate = true" class="flex items-center justify-center text-white bg-thrid-admin hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 gap-x-1.5 active:scale-95 transition-all duration-100">
                    <svg width="18px" height="18px" viewBox="0 0 24 24" id="plus" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color fill-current"><path id="primary" d="M12,20a1,1,0,0,1-1-1V13H5a1,1,0,0,1,0-2h6V5a1,1,0,0,1,2,0v6h6a1,1,0,0,1,0,2H13v6A1,1,0,0,1,12,20Z"></path></svg>
                    <p>
                        Add New Position
                    </p>
                </button>
            </div>
        </header>
        
        <section class="my-3.5 md:my-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-1.5 sm:gap-3 md:gap-5">
                
            </div>
        </section>

        <div class="flex items-center justify-end bg-white p-3 my-5 border-1 border-slate-200">
            <SearchLoad v-model="search" />
        </div>
        
        <main class="my-3.5 md:my-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-1.5 sm:gap-3 md:gap-5">
            <template v-if="!loading">
                <template v-if="positions.length > 0">
                    <CardPosition v-for="position in positions" :key="position.id" :position="position" @delete="handleopendelete" @update="handleopenupdate" />
                </template>
                <template v-else>
                    <div class="w-full sm:col-span-2 md:col-span-3 flex justify-center">
                        <Empty title="No Position Yet"
                            description="You haven't created any Positions yet."
                            sub-description="Get started by creating your first position."
                            primary-text="Create Position"
                            @primary="modalcreate = true"
                        />
                    </div>
                </template>
            </template>
            <template v-else>
                <LoadingCard />
                <LoadingCard  />
                <LoadingCard />
            </template>
        </main>
        <PaginationNumber :pagination="pagination" :name="'Positions'" @next="next" @page="page" @prev="prev" />

        <CreatePosition v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" :division="props?.division" :positions="props?.positions" />
        <UpdatePosition v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :data="position" :division="props?.division" :positions="props?.positions" />
        <DeletePosition v-if="modaldelete" :position="position" @close="handlclosedelete" @success="handlesuccessdelete" />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>