<script setup>
import { onMounted, onUnmounted, ref, watch } from 'vue'
import axios from 'axios';
import { eror,succes } from '@/Helper/Toast';
const props = defineProps(['open']);
const otp = ref(['', '', '', '', '', '']);
const emit = defineEmits(['close']);
const inputs = ref([]);
const sending = ref(false);

const handleInput = (e, index) => {
    const value = e.target.value.replace(/\D/g, '')

    otp.value[index] = value

    if (value && index < 5) {
        inputs.value[index + 1]?.focus()
    }
}

const handleBackspace = (e, index) => {
    if (e.key === 'Backspace' && !otp.value[index] && index > 0) {
        inputs.value[index - 1]?.focus()
    }
}

const handlePaste = (e) => {
    e.preventDefault()

    const pasted = e.clipboardData
        .getData('text')
        .replace(/\D/g, '')
        .slice(0, 6)

    pasted.split('').forEach((char, index) => {
        otp.value[index] = char
    })

    const nextIndex = Math.min(pasted.length, 5)
    inputs.value[nextIndex]?.focus()
}
async function sendOTP() {
    try{
        sending.value = true;
        const response = await axios.get('/api/send')
        console.log(response?.data);
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
        console.log(error);
    }finally{
        sending.value = false;
    }
}
onMounted(()=>{
    sendOTP();
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] bg-[#050B2E] opacity-90 flex items-center justify-center p-6">
        <div class="w-full max-w-2xl rounded-[32px] bg-white/10 backdrop-blur-xl border border-white/10 shadow-[0_20px_80px_rgba(0,0,0,0.4)] p-8">
            <h1 class="text-5xl font-bold text-white mb-2 font-second">
                Security Check
            </h1>

            <p class="mb-8 font-second text-second-admin">
                Set up 2-step verification to protect your account.
            </p>

            <!-- OTP -->
             <form action="">
                <div class="mb-6">
                    <h2 class="text-white font-semibold mb-2">
                        Enter verification code
                    </h2>

                    <p class="text-second-admin text-sm mb-4 font-primary">
                        We sent a one-time code to your device.
                    </p>

                    <div class="grid grid-cols-6 gap-3">
                        <input
                            v-for="(digit, index) in otp"
                            :key="index"
                            :ref="el => inputs[index] = el"
                            v-model="otp[index]"
                            maxlength="1"
                            type="text"
                            inputmode="numeric"
                            @input="handleInput($event, index)"
                            @keydown="handleBackspace($event, index)"
                            @paste="handlePaste"
                            data-aos="zoom-in"
                            :data-aos-delay="index * 150"
                            :data-aos-duration="500"
                            class="w-14 h-14 rounded-2xl bg-white/5 border border-cyan-400 text-center text-white text-xl font-bold outline-none focus:border-blue-500 transition-all"
                        />
                    </div>
                </div>

                <!-- Alert -->
                <div data-aos="flip-up" data-aos-duration="1500"
                    class="bg-pink-500 rounded-2xl p-4 text-white mb-8"
                >
                <Transition name="flip-down" :duration="{enter:0, leave:500}">
                    <p v-if="sending" class="text-second-admin font-second">
                        Please wait, we are sending the OTP Code to your Email address.
                    </p>
                </Transition>
                <Transition name="zoom-out-up">
                    <p v-if="!sending" class="font-semibold">
                        Tip: Keep backup codes in a safe place.
                    </p>
                </Transition>
                <Transition name="zoom-out-down">
                    <p v-if="!sending" class="text-sm opacity-80">
                        Never share your code with anyone.
                    </p>
                </Transition>
                </div>

                <!-- Action -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="submit" data-aos="fade-right" class="h-14 rounded-2xl font-primary text-white bg-gradient-to-r from-blue-500 to-violet-500 active:scale-105 duration-300 ease-in-out">
                        Send
                    </button>

                    <button type="button" @click="emit('close')" data-aos="fade-left" class="h-14 rounded-2xl bg-white/5 text-slate-300 font-primary active:scale-95 duration-300 ease-in-out">
                        cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
.flip-down-enter-active,
.flip-down-leave-active {
    transition: all 1s ease;
    transform-origin: top;
    perspective: 1000px;
}

.flip-down-enter-from {
    opacity: 0;
    transform: rotateX(-90deg) translateY(-10px);
}

.flip-down-enter-to {
    opacity: 1;
    transform: rotateX(0deg) translateY(0);
}

.flip-down-leave-from {
    opacity: 1;
    transform: rotateX(0deg);
}

.flip-down-leave-to {
    opacity: 0;
    transform: rotateX(-90deg) translateY(-10px);
}

.zoom-out-up-enter-active{
    transition: all 0.45s cubic-bezier(0.2, 0.8, 0.2, 1);
    transition-delay: 1000ms;
}
.zoom-out-up-leave-active {
    transition: all 0.45s cubic-bezier(0.2, 0.8, 0.2, 1);
    transform-origin: center;
}

.zoom-out-up-enter-from {
    opacity: 0;
    transform: scale(0.7) translateY(30px);
}

.zoom-out-up-enter-to {
    opacity: 1;
    transform: scale(1) translateY(0);
}

.zoom-out-up-leave-from {
    opacity: 1;
    transform: scale(1) translateY(0);
}

.zoom-out-up-leave-to {
    opacity: 0;
    transform: scale(0.7) translateY(-30px);
}

.zoom-out-down-enter-active{
    transition: all 0.45s cubic-bezier(0.2, 0.8, 0.2, 1);
    transition-delay: 2000ms;
}
.zoom-out-down-leave-active {
    transition: all 0.45s cubic-bezier(0.2, 0.8, 0.2, 1);
    transform-origin: center;
}

.zoom-out-down-enter-from {
    opacity: 0;
    transform: scale(0.7) translateY(-30px);
}

.zoom-out-down-enter-to {
    opacity: 1;
    transform: scale(1) translateY(0);
}

.zoom-out-down-leave-from {
    opacity: 1;
    transform: scale(1) translateY(0);
}

.zoom-out-down-leave-to {
    opacity: 0;
    transform: scale(0.7) translateY(30px);
}
</style>