<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ArrowLeft, Box, SquarePen, Trash, Plus, Waves } from "lucide-vue-next";
import { onBeforeUnmount, ref, watch } from 'vue';
import { onMounted } from 'vue';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import PaginationNumber from '@/Components/PaginationNumber.vue';
import Card from '@/Components/Layout/Admin/Mamal/Card.vue';
import Create from '@/Components/Layout/Admin/Mamal/Create.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import LoadingCard from '@/Components/LoadingCard.vue';
import Update from '@/Components/Layout/Admin/Mamal/Update.vue';
import Delete from '@/Components/Layout/Admin/Mamal/Delete.vue';

const search = ref('');
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const openMenu = ref(null);
const mamals = ref([]);
const pagination = ref({});
const record = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('super.admin.mamal.index'), {
            params: {
                page: page,
                search: search.value
            }
        })
        pagination.value = response?.data?.meta ?? {};
        mamals.value = response?.data?.data ?? [];
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

function handlesuccesscreate(data){
    modalcreate.value = false;
    mamals.value.unshift(data);
    succes('Success', 'The new mamal was successfully added.')
}
function handlesuccessupdate(){
    modalupdate.value = false;
    succes('Success', 'mamal has been successfully updated.')
    record.value = {}
    get()
}
function handlesuccessdelete(){
    modaldelete.value = false;
    succes('Success', 'mamal has been successfully deleted.')
    record.value = {}
    get()
}
watch(search, (val) => {
    setTimeout(()=>{
        get();
    },1000)
},{ immediate: true });
function toggleMenu(id) {
    openMenu.value = openMenu.value === id ? null : id;
}
function closeMenu() {
    openMenu.value = null;
}
const handleClickOutside = () => {
    closeMenu()
}
onMounted(()=>{
    get();
    document.addEventListener('click', handleClickOutside);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
})
</script>

<template>
    <Head title="Mamals" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Mamals</h1>
        </template>

        <section class="relative w-full overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-cyan-950 p-6 md:p-8 shadow-xl font-second">
            <div class="pointer-events-none absolute inset-0 opacity-[0.15]" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 18px 18px;"/>
            <div class="relative flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <span data-aos="flip-up" class="inline-flex items-center gap-2 rounded-full bg-cyan-400/10 px-3 py-1 text-[11px] font-semibold tracking-wide text-cyan-300">
                            <span class="h-1.5 w-1.5 rounded-full bg-cyan-400"></span>
                            MANAGEMENT MAMMAL
                        </span>
                        <div class="flex items-start gap-3 my-3">
                            <div data-aos="flip-up" class="mt-1 shrink-0 h-9 w-9 rounded-lg bg-cyan-400/10 flex items-center justify-center">
                                <Box class="h-5 w-5 text-cyan-300" />
                            </div>
                            <div>
                                <h1 data-aos="flip-up" class="text-2xl sm:text-3xl font-bold text-white">MAMMAL COLLECTIONS</h1>
                                <p class="mt-2 max-w-md text-sm sm:text-md text-slate-400 leading-relaxed">
                                    This page lists all booking methode available in the system and manages access based on user scope to ensure security and navigation relevance.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="text-white flex items-center justify-center">
                        <div>
                            <h1 class="text-5xl font-semibold text-center">22</h1>
                            <p class="text-sm text-center">Total Mammals</p>
                            <button type="button" @click="modalcreate = true" class="my-5 bg-sky-500 px-7 py-2 rounded-lg text-black hover:bg-sky-400 active:scale-95 transition-all duration-300 text-sm">Add New Mammal</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flex items-center justify-between font-second my-5">
            <h3 class="text-lg font-semibold">Our Mamals</h3>
            <h4 class="text-sm text-slate-500">2 mamals in collection</h4>
        </section>

        <section>
            <template v-if="loading">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    <LoadingCard />
                    <LoadingCard />
                    <LoadingCard />
                </div>
            </template>
            <template v-else>
                <template v-if="mamals.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        <Card v-for="mamal in mamals" :mamal="mamal" @update="handleopenupdate" @delete="handleopendelete" />
                    </div>
                </template>
                <template>
                    <p class="text-center font-primary tex-md text-red-500">No mammal available</p>
                </template>
            </template>
        </section>
        
        <section class="mt-6">
            <PaginationNumber :pagination="pagination" :name="'Mamals'" @next="next" @page="page" @prev="prev" />
        </section>

        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccesscreate" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccessupdate" :mamal="record" />
        <Delete v-if="modaldelete" @close="handlclosedelete" @success="handlesuccessdelete" :mamal="record" />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>