<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, PencilLine } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
import { formatTime } from '@/Helper/FormatTime.js';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['time']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    name: '',
    start: '',
    end: '',
    break_start: '',
    break_end: '',
});
const err = ref({});
async function update() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.patch(`/api/priority-first/Time/${props.time.id}`, form.value);
        emit('success')
    }catch(error){
        console.log(error?.response);
        if(error?.response?.status == 422){
            err.value = error?.response?.data?.errors;
        }
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
onMounted(()=>{
    form.value.name = props?.time?.name;
    form.value.start = formatTime(props?.time?.start);
    form.value.end = formatTime(props?.time?.end);
    form.value.break_start = formatTime(props?.time?.break_start);
    form.value.break_end = formatTime(props?.time?.break_end);
    setTimeout(()=>{
        show.value = true;
    },500)
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm p-4">
        <div data-aos="zoom-in" class="flex max-h-max w-full max-w-3xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="border-b border-slate-200 px-6 py-5 flex-shrink-0">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            Update Time
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Update the time settings for <span class="font-semibold">{{ props.time.name }}</span> work sessions.
                        </p>
                    </div>

                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="update" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-max p-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                            <input v-model="form.name" type="text" name="name" id="name" placeholder="Exp: Full Time Morning" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                            <p v-if="err.name" class="mt-2 text-red-500 text-xs">{{ err.name[0] }}</p>
                        </div>
                        <div class="">
                            <label for="start" class="block text-sm font-medium text-slate-700">Start Time</label>
                            <input v-model="form.start" type="time" name="start" id="start" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                            <p v-if="err.start" class="mt-2 text-red-500 text-xs">{{ err.start[0] }}</p>
                        </div>
                        <div class="">
                            <label for="end" class="block text-sm font-medium text-slate-700">End Time</label>
                            <input v-model="form.end" type="time" name="end" id="end" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                            <p v-if="err.end" class="mt-2 text-red-500 text-xs">{{ err.end[0] }}</p>
                        </div>
                        <div class="">
                            <label for="break_start" class="block text-sm font-medium text-slate-700">Break Start</label>
                            <input v-model="form.break_start" type="time" name="break_start" id="break_start" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                            <p v-if="err.break_start" class="mt-2 text-red-500 text-xs">{{ err.break_start[0] }}</p>
                        </div>
                        <div class="">
                            <label for="break_end" class="block text-sm font-medium text-slate-700">Break End</label>
                            <input v-model="form.break_end" type="time" name="break_end" id="break_end" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
                            <p v-if="err.break_end" class="mt-2 text-red-500 text-xs">{{ err.break_end[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 border-t border-slate-200 bg-white px-6 py-4">
                    <Transition name="zoom">
                        <button v-if="show" type="submit" :disabled="loading" class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-400 py-2 text-white transition hover:bg-emerald-500 disabled:cursor-not-allowed">
                            <template v-if="!loading">
                                <PencilLine size="20" />
                                <span>Update</span>
                            </template>

                            <template v-else>
                                <FormLoading color="bg-white my-3" />
                            </template>
                        </button>
                    </Transition>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>
.zoom-enter-active,
.zoom-leave-active {
    transition: opacity 0.5s ease, transform .35s ease;
}

.zoom-enter-from,
.zoom-leave-to {
    opacity: 0;
    transform: scale(.8);
}

.zoom-enter-to,
.zoom-leave-from {
    opacity: 1;
    transform: scale(1);
}
</style>