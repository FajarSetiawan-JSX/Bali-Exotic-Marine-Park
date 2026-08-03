<script setup>
import FooterTable from '@/Components/FooterTable.vue';
import Header from '@/Components/Header.vue';
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'
import { onMounted, ref, computed, watch, onUnmounted } from 'vue';
import { clearfloor } from '@/Helper/ClearComa';
import Search from '@/Components/Search.vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import axios from 'axios';
import NoData from '@/Components/NoData.vue';
import { eror } from '@/Helper/Toast';
import DeleteData from '@/Components/DeleteData.vue';
import Create from '@/Components/Layout/Admin/Users/Create.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import { User, ArrowLeft } from 'lucide-vue-next'
import CardUser from '@/Components/CardUser.vue';
import PaginationNumber from '@/Components/PaginationNumber.vue';

const props = defineProps(['divisions', 'users', 'online']);
const filterdivision = ref('');
const search = ref('');
const datas = ref({});
const loading = ref(false);
const pagination = ref({});
const users = ref(0);
const result = ref(0);
const modalcreate = ref(false);
const persen = computed(()=>{
    let persen = (props.online/props.users) * 100;
    return clearfloor(persen);
});
const online = ref(0);

//id untuk view, delete dan update
const id = ref(null);

//variabel reactive dropdown / box
const action = ref('');
const modaldelete = ref('');
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement,);

const chartData = ref({
  labels: [],
  datasets: [{
    label: 'Total',
    data: [],
    backgroundColor: [
        '#ff6384',
        '#36a2eb',
        '#ffcd56'
    ]
  }]
})
const chartOption = {
    responsive: true,
    maintainAspectRatio: false, 
    animation: {
        duration: 2000
    },
    plugins: {
        legend: {
            display: true,
            position: 'right'
        }
    }
}
async function getusers(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/priority-first/users`,{
            params: {
                page: page,
                search: search.value,
                filter: filterdivision.value
            }
        });
        datas.value = response?.data?.data;
        pagination.value = response?.data?.meta
        //console.log(response?.data);
    }catch(error){
        //console.log(error?.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
//function handle komponen
function handlepagination(value){
    if(value){
        getusers(value);
    }
}
function handlesearching(value){
    search.value = value;
    getusers();
}
function handledelete(){

}

watch(() => filterdivision.value, (newfilter) => {
    if(newfilter != ''){
        return getusers();
    };
    return getusers();
});

//function close dropdown
function closedropdown() {
    action.value = '';
}
function handleclosedelete(){
    modaldelete.value = '';
}

onMounted(async () => {
    document.addEventListener('click', closedropdown);
    getusers();
    setTimeout(() => {
    chartData.value = {
      labels: props.divisions.map((division) => division.nama),
      datasets: [{
        ...chartData.value.datasets[0],
        data: props.divisions.map((division) => division.user),
        backgroundColor: props.divisions.map((division) => division.color)
      }]
    }
  }, 0)
    let i = 0
    let a = 0;
    let o = 0;
    const target = props.users
    const online_user = props.online
    const interval = setInterval(() => {
        if (i >= target) return clearInterval(interval)
        users.value++
        i++
    }, 100);
    const online_time = setInterval(() => {
        if(o >= online_user) return clearInterval(online_time)
        online.value++
        o++
    }, 100);
    const presentase = setInterval(()=>{
        if(a >= persen.value) return clearInterval(presentase)
        result.value++
        a++
    }, 20)
})
onUnmounted(()=>{
    document.removeEventListener('click', closedropdown);
    document.removeEventListener('click', handleclosedelete);
})
</script>

<template>
    <Head title="User" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Users</h1>
        </template>
        <template #search>
            <SearchAnimation placeholder="Search name">
                <template #search>
                    <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 17L22 22M19.5 10.75C19.5 15.5825 15.5825 19.5 10.75 19.5C5.91751 19.5 2 15.5825 2 10.75C2 5.91751 5.91751 2 10.75 2C15.5825 2 19.5 5.91751 19.5 10.75Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </template>

                <template #back>
                    <ArrowLeft :size="18"/>
                </template>
            </SearchAnimation>
        </template>
        <header class="flex justify-between lg:mx-12">
            <div class="max-w-max">
                <h3 class="text-slate-400 text-sm font-second">Master <span class="text-thrid-admin">> Management User</span></h3>
                <h4 class="text-black font-semibold font-second my-1.5 text-xl">Directory overview</h4>
                <h5 class="text-slate-700 text-sm font-second">Manage organization structure and individual access levels.</h5>
            </div>
            <div class="max-w-max">
                <button type="button" @click="modalcreate = true" class="flex items-center justify-center text-white bg-thrid-admin hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 gap-x-1.5">
                        <svg class="fill-current" width="15px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <g id="style=stroke">
                            <g id="profile">
                                <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M12 2.75C9.92893 2.75 8.25 4.42893 8.25 6.5C8.25 8.57107 9.92893 10.25 12 10.25C14.0711 10.25 15.75 8.57107 15.75 6.5C15.75 4.42893 14.0711 2.75 12 2.75ZM6.75 6.5C6.75 3.6005 9.1005 1.25 12 1.25C14.8995 1.25 17.25 3.6005 17.25 6.5C17.25 9.3995 14.8995 11.75 12 11.75C9.1005 11.75 6.75 9.3995 6.75 6.5Z"/>
                                <path id="rec (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M4.25 18.5714C4.25 15.6325 6.63249 13.25 9.57143 13.25H14.4286C17.3675 13.25 19.75 15.6325 19.75 18.5714C19.75 20.8792 17.8792 22.75 15.5714 22.75H8.42857C6.12081 22.75 4.25 20.8792 4.25 18.5714ZM9.57143 14.75C7.46091 14.75 5.75 16.4609 5.75 18.5714C5.75 20.0508 6.94924 21.25 8.42857 21.25H15.5714C17.0508 21.25 18.25 20.0508 18.25 18.5714C18.25 16.4609 16.5391 14.75 14.4286 14.75H9.57143Z"/>
                            </g>
                        </g>
                    </svg>
                    <p>
                        Add new user
                    </p>
                </button>
            </div>
        </header>

        <main class="lg:mx-12 flex flex-col md:flex-row py-2.5 gap-3.5">
            <div class="bg-white flex inset-0 content-center rounded-lg shadow-lg p-5 w-full md:w-1/2 lg:w-2/3">
                <Doughnut :data="chartData" :options="chartOption" />
            </div>
            <div class="flex w-full md:w-1/2 lg:w-1/3 justify-end">
                <div class="w-full rounded-lg shadow-lg bg-white p-5 md:max-h-max xl:max-w-1/2">
                    <div class="text-slate-600 flex items-center gap-x-2.5">
                        <svg class="fill-current" width="20px" height="20px" viewBox="0 0 64 64" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"><defs></defs><title/><path class="cls-1" d="M43.62,35H37.16a2,2,0,0,1,0-4h1.63l-14-14a2,2,0,0,1,2.82-2.83L45,31.56A2,2,0,0,1,43.62,35Z"/><path class="cls-1" d="M43.62,35a2,2,0,0,1-2-2V26.3a2,2,0,0,1,4,0V33A2,2,0,0,1,43.62,35Z"/><path class="cls-1" d="M37.84,50.49a2,2,0,0,1-1.41-.59L19,32.44A2,2,0,0,1,20.38,29h6.46a2,2,0,1,1,0,4H25.21l14,14a2,2,0,0,1-1.41,3.42Z"/><path class="cls-1" d="M20.38,39.7a2,2,0,0,1-2-2V31a2,2,0,0,1,4,0V37.7A2,2,0,0,1,20.38,39.7Z"/><path class="cls-2" d="M32,60.21A28.21,28.21,0,1,1,60.21,32a2,2,0,0,1-4,0,24.2,24.2,0,1,0-1.83,9.24,2,2,0,0,1,3.69,1.53A28.12,28.12,0,0,1,32,60.21Z"/></svg>
                        <p class="font-second">Active users</p>
                    </div>
                    <div class="py-3">
                        <h1 class="text-2xl font-bold font-second">{{ online }} <span class="font-normal">/ {{ users }}</span></h1>
                        <div class="w-full bg-fifth-admin rounded-lg overflow-hidden">
                            <div class="h-2 bg-thrid-admin" :style="{width: result + '%'}" />
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <Search :placeholder="'Search name'" @searching="handlesearching">
            <vSelect v-model="filterdivision" :options="props.divisions" label="nama" class="division-select" placeholder="All Division" />
        </Search>

        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white relative overflow-x-auto shadow-md sm:rounded-lg outline-1 outline-slate-200">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-primary-admin">
                        <tr>
                            <th scope="col" class="px-4 py-4" colspan="2">User profile</th>
                            <th scope="col" class="px-4 py-3">Division</th>
                            <th scope="col" class="px-4 py-3">Priority</th>
                            <th scope="col" class="px-4 py-3">Date of join</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody v-if="!loading">
                        <template v-if="datas.length > 0">
                            <tr v-for="(data, index) in datas" :key="index" class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><img :src="data.pict ? `` : `https://ui-avatars.com/api/?name=${data?.name}&background=7DD3FC&color=fff`" :alt="data.name" class="w-16 h-16 rounded-full ring-1 ring-gray-200"></th>
                                <td class="px-4 py-3">{{ data.name }}</td>
                                <td class="px-4 py-3">{{ data.division }}</td>
                                <td class="px-4 py-3 font-second font-bold" :class="data.level == 1 ? 'text-red-500' : data.level == 2 ? 'text-green-500' : 'text-blue-500'">{{ data.level }}</td>
                                <td class="px-4 py-3 max-w-[12rem] truncate">What is a product description? A product description describes a product.</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-x-2.5">
                                        <div class="w-3 h-3 rounded-full" :class="data.status ? 'bg-thrid-admin' : 'bg-second-admin'" />
                                        <span>{{ data.status ? 'Active' : 'Offline' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <div class="relative flex justify-end">
                                        <button @click.stop="action = index" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="action === index" class="absolute top-10 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li>
                                                    <button type="button" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700">
                                                        <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                        </svg>
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700">
                                                        <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                        Preview
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-red-500">
                                                        <svg class="w-4 h-4 mr-4" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                        </svg>
                                                        <span>
                                                            Delete
                                                        </span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <NoData :span="7">
                                No available data users yet
                            </NoData>
                        </template>
                    </tbody>
                    <tbody v-else>
                        <tr v-for="n in 5" :key="n" class="border-b animate-pulse">
                            <td class="px-4 py-3">
                                <div class="w-16 h-16 rounded-full bg-slate-200"></div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="h-4 w-32 bg-slate-200 rounded"></div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="h-4 w-24 bg-slate-200 rounded"></div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="h-4 w-20 bg-slate-200 rounded"></div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="h-4 w-28 bg-slate-200 rounded"></div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="h-6 w-16 bg-slate-200 rounded-full"></div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="ml-auto h-8 w-8 bg-slate-200 rounded-lg"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <FooterTable :bg="'primary-admin'" :pagination="pagination" @change="handlepagination" />
            </div>
        </div>
        <Create v-if="modalcreate" :divisions="props.divisions" @close="modalcreate = false" />

        <div class="hidden overflow-y-auto bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Product</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-target="createProductModal" data-modal-toggle="createProductModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="#">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                            </div>
                            <div>
                                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                <input type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product brand" required="">
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                            </div>
                            <div><label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label><select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"><option selected="">Select category</option><option value="TV">TV/Monitors</option><option value="PC">PC</option><option value="GA">Gaming/Console</option><option value="PH">Phones</option></select></div>
                            <div class="sm:col-span-2"><label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label><textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea></div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add new product
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Product</h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProductModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="#">
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name" value="iPad Air Gen 5th Wi-Fi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Apple iMac 27&ldquo;">
                            </div>
                            <div>
                                <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                <input type="text" name="brand" id="brand" value="Google" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex. Apple">
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="number" value="399" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$299">
                            </div>
                            <div><label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label><select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"><option selected="">Electronics</option><option value="TV">TV/Monitors</option><option value="PC">PC</option><option value="GA">Gaming/Console</option><option value="PH">Phones</option></select></div>
                            <div class="sm:col-span-2"><label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label><textarea id="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a description...">Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US</textarea></div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Update product</button>
                            <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                        <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                            <h3 class="font-semibold ">Apple iMac 27”</h3>
                            <p class="font-bold">$2999</p>
                        </div>
                        <div>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="readProductModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    </div>
                    <dl><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt><dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Standard glass ,3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US.</dd><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Category</dt><dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">Electronics/PC</dd></dl>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <button type="button" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                                Edit
                            </button>
                            <button type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Preview</button>
                        </div>
                        <button type="button" class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <CardUser />
        <PaginationNumber />
    </AuthenticatedLayout>
</template>

<style scoped>
/* Container utama */
:deep(.division-select) {
    width: auto;
    min-width: 180px;
}

/* Tombol select */
:deep(.division-select .vs__dropdown-toggle) {
    background-color: var(--color-primary-admin, #f8fafc);
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    min-height: 42px;

    display: flex;
    align-items: center;

    padding: 0.5rem 1rem;
}

/* Input search */
:deep(.division-select .vs__search) {
    margin: 0;
    padding: 0;
}

/* Hilangkan aneh-aneh */
:deep(.division-select .vs__selected-options) {
    padding: 0;
}

/* Panah */
:deep(.division-select .vs__actions) {
    padding-left: 8px;
}

:deep(.division-select .vs__open-indicator) {
    fill: #6b7280;
}

/* Dropdown */
:deep(.division-select .vs__dropdown-menu) {
    width: 100% !important;
    min-width: 100% !important;

    left: 0;
    margin-top: 6px;

    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 10px 15px rgb(0 0 0 / 0.1);
}

/* Item */
:deep(.division-select .vs__dropdown-option) {
    padding: 10px 16px;
}

:deep(.division-select .vs__dropdown-option--highlight) {
    background: #f3f4f6;
    color: #111827;
}
</style>