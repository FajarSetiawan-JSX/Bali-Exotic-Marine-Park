<script setup>
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import LoadingPrimary from '../../LoadingPrimary.vue';
import { eror } from '@/Helper/Toast';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const download = (type) => {
    if (!type) return

    if (type === 'pdf') {
        pdf();
    }

    if (type === 'xlsx') {
        xlsx();
    }
}
const loading = ref(false);

async function pdf() {
    try{
        loading.value = true;
        const response = await axios.get(route('user.all.download.pdf'), {
            responseType: 'blob'
        });
        console.log('Content-Type:', response.headers['content-type']);
        console.log('Size:', response.data.size);
        const url = URL.createObjectURL(response.data);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'alluser.pdf';
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(url);
    }catch(error){
        const data = JSON.parse(await error.response.data.text());
        eror(error?.response?.status, data?.message);
    }finally{
        loading.value = false;
    }
}
async function xlsx() {
    loading.value = true;
    setTimeout(() => {
        loading.value = false;
    }, 2000);
    // try{
    //     loading.value = true;
    // }catch(error){

    // }finally{
    //     loading.value = false;
    // }
}
onMounted(()=>{
    
})
</script>

<template>
    <select @change="download($event.target.value)" name="" id="" class="flex rounded-lg border-2 border-slate-300 focus:border-sky-500 focus:ring-1 focus: ring-sky-300">
        <option disabled selected value="">Download</option>
        <option value="pdf">All Data PDF</option>
        <option value="xlsx">All Data .xlsx</option>
    </select>

    <FullScreenLoading v-if="loading">
        <LoadingPrimary />
    </FullScreenLoading>
</template>