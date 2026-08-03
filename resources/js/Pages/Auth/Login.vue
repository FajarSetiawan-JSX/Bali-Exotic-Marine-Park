<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import TokenPass from '@/Components/TokenPass.vue';
import { eror } from '@/Helper/Toast';
import Login from '@/Layouts/Login.vue';
import { UserRoundKey } from 'lucide-vue-next'
 
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    login: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const bounce = ref(false);
const top = ref(false);
const btn = ref(false);
const openmodal = ref(false);
onMounted(()=>{
    bounce.value = true
    top.value = true;
    btn.value = true;
})

function handleemailerror({message, code}){
    eror(code, message)
    openmodal.value = false;
}
function handleemailclose(){
    openmodal.value = false
}
</script>

<template>
    <Login>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>
        <div class="flex justify-between items-center">
            <div data-aos="zoom-out" class="p-1.5 max-w-max flex items-center justify-center rounded-lg bg-indigo-500 font-bold text-white">
                <UserRoundKey size="30" />
            </div>
            <h2 class="font-primary text-slate-500">Portal Management</h2>
        </div>
        <div class="my-5">
            <h2 data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" class="text-2xl md:text-4xl font-title font-bold">Welcome</h2>
            <p data-aos="fade-down" data-aos-anchor-placement="bottom-bottom" class="my-3 font-second text-slate-500 text-sm">Sign in to BEMP Management with your account.</p>
        </div>
        <div class=" md:mt-24">
            <form @submit.prevent="submit">
                <Transition name="slide-b">
                    <div v-if="btn">
                        <label class="font-second font-semibold text-sm">Email or Username</label>
                        <div class="flex items-center my-2 border bg-indigo-500/5 border-gray-500/10 rounded-sm gap-1 pl-2">
                            <svg width="18" height="18" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="m2.5 4.375 3.875 2.906c.667.5 1.583.5 2.25 0L12.5 4.375" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.875 3.125h-8.75c-.69 0-1.25.56-1.25 1.25v6.25c0 .69.56 1.25 1.25 1.25h8.75c.69 0 1.25-.56 1.25-1.25v-6.25c0-.69-.56-1.25-1.25-1.25Z" stroke="#6B7280" stroke-opacity=".6" stroke-width="1.3" stroke-linecap="round"/>
                            </svg>
                            <TextInput
                                id="email"
                                type="text"
                                class="my-1 mx-2 block w-full"
                                v-model="form.login"
                                required
                                autofocus
                                autocomplete="username"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.login" />
                    </div>
                </Transition>

                <Transition name="slide-t">
                    <div v-if="top" class="mt-4">
                        <label class="font-second font-semibold text-sm">Password</label>
                        <div class="flex items-center mt-2 mb-8 border bg-indigo-500/5 border-gray-500/10 rounded-sm gap-1 pl-2">
                            <svg width="18" height="18" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="#6B7280" stroke-opacity=".6" d="M12.5 8.5V7.5C12.5 6.94772 12.0523 6.5 11.5 6.5H1.5C0.947715 6.5 0.5 6.94772 0.5 7.5V13.5C0.5 14.0523 0.947715 14.5 1.5 14.5H11.5C12.0523 14.5 12.5 14.0523 12.5 13.5V12.5M12.5 8.5H8.5C7.39543 8.5 6.5 9.39543 6.5 10.5C6.5 11.6046 7.39543 12.5 8.5 12.5H12.5M12.5 8.5C13.6046 8.5 14.5 9.39543 14.5 10.5C14.5 11.6046 13.6046 12.5 12.5 12.5M3.5 6.5V3.5C3.5 1.84315 4.84315 0.5 6.5 0.5C8.15685 0.5 9.5 1.84315 9.5 3.5V6.5M12 10.5H13M10 10.5H11M8 10.5H9"/>
                            </svg>
                            <TextInput
                                id="password"
                                type="password"
                                class="my-1 mx-2 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                </Transition>

                <div class="mt-4 flex justify-between">
                    <label data-aos="fade-left" data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="500" class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ms-2 text-sm text-gray-600"
                            >Remember me</span
                        >
                    </label>
                    <button type="button" @click="openmodal = true" data-aos="fade-right" data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="500" v-if="canResetPassword"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Forgot your password?
                    </button>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <Transition name="btn-aos" appear>
                        <button v-show="btn" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="text-center bg-linear-65 from-[#A855F7] to-[#6366F1] w-full p-2 rounded-lg shadow-lg text-white transition-colors duration-500 hover:from-[#6366F1] hover:to-[#A855F7] hover:bg-linear-65">
                            Sign in
                        </button>
                    </Transition>
                </div>
            </form>
        </div>
        <TokenPass v-if="openmodal" @error="handleemailerror" @close="handleemailclose" />
    </Login>
</template>

<style scoped>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

/*
  bawah ke atas
*/
.slide-b-enter-active {
  transition: all 0.8s ease-out;
}

.slide-b-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-b-enter-from,
.slide-b-leave-to {
  transform: translateY(40px);
  opacity: 0;
}

/*
  atas ke bawah
*/
.slide-t-enter-active {
  transition: all 0.8s ease-out;
}

.slide-t-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-t-enter-from,
.slide-t-leave-to {
  transform: translateY(-40px);
  opacity: 0;
}

.btn-aos-enter-active {
  transition: all 0.65s cubic-bezier(0.2, 0.9, 0.2, 1);
  will-change: transform, opacity;
}

.btn-aos-enter-from {
  opacity: 0;
  transform: translateY(18px) scale(0.92) rotateX(25deg);
}

.btn-aos-enter-to {
  opacity: 1;
  transform: translateY(0) scale(1) rotateX(0);
}

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
