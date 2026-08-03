<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Image from '@/Components/Profile/Image.vue';
import General from '@/Components/Profile/General.vue';
import Authenticate from '@/Components/Profile/Authenticate.vue';
import Otp from '@/Components/Otp.vue';
import { onMounted, ref } from 'vue';
import ChangePass from '@/Components/Profile/ChangePass.vue';
import { timeNow } from '@/Helper/DateNow.js';
import { usePage } from '@inertiajs/vue3';

const user = usePage().props.auth?.user;
const dateNow = timeNow();
defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
const modalOTP = ref(false);
const handleopenOTP = (value)=>{
    modalOTP.value = value ?? true;
}
const handlcloseOTP = ()=>{
    setTimeout(()=>modalOTP.value = false, 500);
}
onMounted(()=>{
    console.log(user);
})
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h1 class="text-xl font-semibold font-second">
                    Welcome, {{ user.first_name }}
                </h1>

                <p class="text-gray-500 text-sm">
                    {{ dateNow }}
                </p>
            </div>
        </template>

        <div class="bg-white rounded-xl overflow-hidden shadow-sm">
            <Image />
            <General />
            <Authenticate @open="handleopenOTP" />
        </div>
        <Transition name="fold" :duration="{enter:0, leave:400}">
            <Otp v-if="modalOTP" @close="handlcloseOTP" />
        </Transition>
    </AuthenticatedLayout>
</template>

<style scoped>
.fold-enter-active,
.fold-leave-active {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.fold-enter-from {
    opacity: 0;
    transform: scaleY(0);
}

.fold-enter-to {
    opacity: 1;
    transform: scaleY(1);
}

.fold-leave-from {
    opacity: 1;
    transform: scaleY(1);
}

.fold-leave-to {
    opacity: 0;
    transform: scaleY(0);
}
</style>
