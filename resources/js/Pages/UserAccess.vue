<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { Plus, Boxes } from 'lucide-vue-next'
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';
import { Globe, MoreVertical, LockKeyhole, ShieldCheck } from 'lucide-vue-next'

const loading = ref(false);
const props = defineProps(['user']);
const user = ref({});
async function get(id, page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(route('user.show', id));
        user.value = response?.data?.data;
        console.log(response.data);
    }catch(error){
        console.log(error?.response);
        eror(error.response.status, error?.response?.data?.message);
    }finally{
        loading.value = false
    }
}

onMounted(()=>{
    //get(props?.user?.id);
})
</script>

<template>
    <Head title="User Detail" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">User Access</h1>
        </template>
        <div class="rounded-xl bg-gradient-to-br from-sky-950 via-sky-900 to-sky-700 p-5 sm:p-6 lg:p-7 text-white shadow-sm">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0">
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold tracking-tight">
                        Pages & API Endpoints
                    </h1>

                    <p class="mt-2 max-w-xl text-xs sm:text-sm leading-relaxed text-sky-200">
                        Kelola dan pantau semua akses endpoint API untuk integrasi
                        sistem Bali Exotic Marine Park secara terpusat.
                    </p>
                    <div class="mt-4 inline-flex items-center gap-2 rounded-md bg-sky-950/60 px-3 py-1.5 text-xs font-medium text-sky-100">
                        <Boxes class="h-3.5 w-3.5 text-sky-300" />
                        <span>Total Endpoints :<span class="font-bold">25</span>
                        </span>
                    </div>
                </div>
                <button type="button" class="inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2 rounded-lg bg-sky-500 px-4 py-2.5 text-xs font-medium text-white shadow-sm transition hover:bg-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:ring-offset-2 focus:ring-offset-sky-900">
                    <Plus class="h-4 w-4" />
                    <span>Add Access</span>
                </button>
            </div>
        </div>

        <section class="my-5">
            <div class="flex items-center justify-between p-3 bg-white shadow-sm">

            </div>
        </section>

        <div class="group rounded-xl border border-gray-200 bg-white p-4 sm:p-5 transition duration-200 hover:border-gray-300 hover:shadow-sm">
            <div class="flex items-start justify-between gap-3 font-second">
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
                            <Globe class="h-4 w-4" />
                        </div>
                        <h3 class="truncate text-sm sm:text-base font-semibold text-gray-800">
                            Acces user
                        </h3>
                    </div>
                    <div class="mt-2 inline-block max-w-full truncate rounded bg-gray-100 px-2 py-1 font-mono text-[10px] sm:text-xs text-gray-500">
                        user.access
                    </div>
                </div>
                <button type="button" class="shrink-0 rounded-md p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700">
                    <MoreVertical class="h-4 w-4" />
                </button>
            </div>
            <p class="mt-4 text-xs sm:text-sm leading-relaxed text-gray-500 line-clamp-2">
                cek
            </p>
            <div class="mt-4 flex flex-wrap items-center gap-1.5">
                <span class="inline-flex items-center rounded px-2 py-1 text-[9px] sm:text-[10px] font-semibold uppercase">
                    POST
                </span>
                <span class="inline-flex items-center gap-1 rounded bg-indigo-50 px-2 py-1 text-[9px] sm:text-[10px] font-semibold uppercase text-indigo-600">
                    <LockKeyhole class="h-3 w-3" />
                    Scope: General
                </span>
                <span class="inline-flex items-center gap-1 rounded bg-gray-100 px-2 py-1 text-[9px] sm:text-[10px] font-semibold uppercase text-gray-500">
                    <ShieldCheck class="h-3 w-3" />
                    Type: API
                </span>

            </div>
        </div>

        <div class="w-full mx-auto space-y-4">
            <template v-if="!loading">
            </template>
            <template v-else>
            </template>
        </div>
    </AuthenticatedLayout>
</template>