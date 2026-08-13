<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3'
import CircularLoading from '../CircularLoading.vue';
import Swal from 'sweetalert2';
import { succes, eror } from '@/Helper/Toast.js';

const props = defineProps(['user']);
const loading = ref(false);
const progress = ref(0);
const uploadPhoto = async (e) => {
    try{
        loading.value = true;
        const file = e.target.files[0];
        const form = new FormData();
        form.append('profile', file);
        await axios.post(`/api/profile/image`, form, {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
            onUploadProgress: (event) => {
                progress.value = Math.round(
                    (event.loaded * 100) / event.total
                )
            }
        });
        succes('Sucess', 'Success upload!');
        //eror('Error', 'failed upload!');
    }catch(error){
        Swal.fire({
            title: 'Error!',
            text: error?.response?.data?.message,
            icon: 'error',
            confirmButtonText: 'Try again!'
        })
    }finally{
        loading.value = false;
        progress.value = 0;
    }
}
</script>

<template>
    <div class="flex flex-col md:flex-row md:justify-between md:items-center p-8 md:p-10 lg:p-12 bg-linear-to-r from-second-admin to-white">
        <div class="flex items-center">
            <input
                id="profile"
                type="file"
                class="hidden"
                @change="uploadPhoto"
            >
            <label
                for="profile"
                class="w-24 h-24 rounded-lg bg-cover bg-center cursor-pointer block ring-2 ring-white"
                :style="{ backgroundImage: `url(${props?.user?.profile ?? `https://ui-avatars.com/api/?name=${encodeURIComponent(props.user?.name)}&background=7DD3FC&color=fff`})`}"
            />
            <div class="mx-5 grid grid-cols-1 gap-y-1.5">
                <h2 class="font-semibold">
                    {{ props?.user?.name }}
                </h2>

                <p class="text-gray-500 text-sm">
                    {{ props?.user?.email }}
                </p>
                <h3 v-show="props?.user?.verified" class="font-second text-xs md:text-sm bg-fifth-admin text-thrid-admin rounded-full px-2 py-1 max-w-max">
                    Verified Profile
                </h3>
            </div>
        </div>
    </div>
    <CircularLoading v-if="loading" :percentage="progress" />
</template>
