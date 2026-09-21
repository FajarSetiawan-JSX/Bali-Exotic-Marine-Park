<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { ArrowLeft, User, Save, ChevronDown, CalendarDays } from 'lucide-vue-next';
import { eror, succes } from '@/Helper/Toast';
import axios from 'axios';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { usePage } from '@inertiajs/vue3';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';

const user = usePage().props?.auth?.user;
const users = ref([]);
const props = defineProps(['times', 'users', 'month']);
const loading = ref(false);
const form = ref({
    user: '',
    month: props?.month?.id,
    schedule: props?.month?.date?.map(day => ({ date: day?.id, templete: '', })) ?? []
})
const err = ref({});
async function create() {
    try{
        loading.value = true;
        const response = await axios.post(route('specific.schedule.create'), form?.value);
        console.log(response?.data)
        users.value = users.value.filter(user => user.id !== response?.data?.data?.id);
        form.value.user = '';
        succes('Success', 'Success create monthly schedule');
    }catch(error){
        console.log(error?.response);
        if(error.response.status == 422){
            err.value = error?.response?.data?.errors;
        }
        eror(error?.response?.status, error?.response?.data?.errors?.message);
    }finally{
        loading.value = false;
    }
}

onMounted(()=>{
    users.value = props?.users;
    console.log('month : ', props.users);
})
</script>

<template>
    <Head title="Create Schedule" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Create Monthly Schedule</h1>
        </template>
        
        <section class="w-full overflow-hidden rounded-xl border border-slate-200 bg-gradient-to-r from-sky-900 via-teal-700 to-teal-500 px-5 py-4 shadow-sm sm:px-6 sm:py-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0 font-second">
                    <h2 class="text-lg font-bold tracking-tight text-white sm:text-lg">
                        Schedule Management
                    </h2>
                    <p class="mt-1 max-w-xl text-sm leading-relaxed text-slate-100 sm:text-xs">
                        Quickly generate automated schedules or manually create
                        custom shifts for your workforce to ensure optimal daily
                        coverage.
                    </p>
                </div>
                <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:shrink-0 font-second">

                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="w-full mx-auto space-y-4">
                <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <User class="h-5 w-5 text-gray-700" />
                        <h2 class="text-base sm:text-lg font-semibold text-gray-800">Select division members</h2>
                    </div>

                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Name
                    </label>
                    <div class="relative">
                        <select v-model="form.user" class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-10 text-sm sm:text-base text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400">
                            <option value="" disabled selected>Select user</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                        <ChevronDown class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" />
                    </div>
                </div>

                <!-- Card: Template Jadwal Bulanan -->
                <div class="rounded-xl border border-gray-200 bg-gray-50 overflow-hidden">
                    <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <CalendarDays class="h-5 w-5 text-gray-700" />
                            <h2 class="text-base sm:text-lg font-semibold text-gray-800">Monthly Schedule Templete</h2>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">set daily shifts in <span class="text-slate-900">{{ props?.month?.month }}</span> for selected users.</p>
                    </div>
                    <form action="" @submit.prevent="create">
                        <div class="bg-white divide-y divide-gray-100">
                            <div v-for="(day, index) in props?.month?.date ?? []" :key="day?.id" class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-4 sm:px-6 py-4">
                                <span class="text-sm sm:text-base font-medium text-gray-800">
                                    Date {{ day?.date }}
                                </span>
                                <div v-if="form?.user">
                                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                                        <label v-for="templete in users?.find(item => item?.id == form?.user).templete ?? []" :key="templete.id" class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" :value="templete.id" :name="`time-${day.id}`" v-model="form.schedule[index].templete" class="h-4 w-4 accent-sky-600"/>
                                            <span class="text-sm sm:text-xs">
                                                {{ templete.name }}
                                            </span>
                                        </label>
                                    </div>
                                    <!-- <p v-if="err.schedule.index.templete" class="text-xs font-primary mt-2 text-red-500">{{ schedule.index.templete.[0] }}</p> -->
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end px-4 sm:px-6 py-4 bg-gray-50">
                            <button type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100'" class="inline-flex items-center gap-2 rounded-lg bg-emerald-500 px-5 py-2.5 text-sm sm:text-base font-medium text-white hover:bg-emerald-600 transition-colors">
                                <Save class="h-4 w-4" />
                                Create Schedule
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <FullScreenLoading v-if="loading">
            <LoadingPrimary />
        </FullScreenLoading>
    </AuthenticatedLayout>
</template>