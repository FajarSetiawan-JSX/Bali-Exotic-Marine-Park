<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Plus, Check, AlertTriangle } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
import { formatTime } from '@/Helper/FormatTime';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['templets']);
const show = ref(false);
const loading = ref(false);
const issue = ref(false);
const form = ref({
    templete: '',
    handover: false,
    detail: ''
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post(route('specific.basics.information.daily.create'), form.value);
        console.log(response?.data?.data);
        emit('success', response?.data?.data)
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
onMounted(()=>{
    setTimeout(()=>{
        show.value = true;
    },500)
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm p-4">
        <div data-aos="zoom-in" class="flex max-h-max w-full max-w-3xl flex-col overflow-hidden rounded-3xl bg-white shadow-2xl">
            <header class="relative overflow-hidden bg-gradient-to-r from-[#08283f] via-[#073d60] to-[#07567b] px-4 py-4 text-white">
                <div class="pointer-events-none absolute -right-12 -top-10 h-28 w-28 rounded-full bg-cyan-300/15 blur-2xl" />
                <div class="relative flex items-start justify-between gap-4">
                    <div>
                        <div class="mb-1 flex items-center gap-1.5 text-sm font-bold uppercase tracking-wide text-cyan-300">
                            <span class="h-1.5 w-1.5 rounded-full bg-cyan-400" />
                            Basic Protocol Information
                        </div>
                        <h2 class="text-sm font-bold">
                            New Daily Basic Information
                        </h2>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-md bg-white/10 p-1.5 text-slate-300 transition hover:bg-white/20 hover:text-white">
                        <X :size="15" />
                    </button>
                </div>
            </header>

            <form @submit.prevent="create">
                <div class="space-y-3 px-4 py-4 font-second h-96 overflow-y-scroll lg:h-max">
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="shift">
                                Work Time
                            </label>
                            <select id="shift" v-model="form.templete" class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-2.5 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white">
                                <option selected disabled value="">Select Work Time</option>
                                <option v-for="templete in props?.templets" :value="templete?.id">{{ templete?.templetetime?.time?.name }} <span class="italic">{{ formatTime(templete?.templetetime?.time?.start) }} - {{ formatTime(templete?.templetetime?.time?.end) }}</span></option>
                            </select>
                        </div>

                        <div class="flex items-center gap-2.5">
                            <div class="flex-1">
                                <p class="text-sm font-bold text-slate-700">
                                    Handover Received
                                </p>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Master Keys, Motorola HT Radios, flashlights, and logs verified
                                </p>
                            </div>

                            <button type="button" :class="form.handover ? 'bg-cyan-500' : 'bg-slate-300'" @click="form.handover = !form.handover" class="flex h-4 w-7 shrink-0 items-center rounded-full p-0.5 transition-colors">
                                <span class="h-3 w-3 rounded-full bg-white shadow-sm transition-transform" :class="form.handover ? 'translate-x-3' : 'translate-x-0'" />
                            </button>
                        </div>
                    </div>

                    <section class="rounded-lg border border-amber-200 bg-amber-50/60 px-3 py-3">
                        <div class="flex items-center gap-2.5">
                            <AlertTriangle :size="15" class="text-amber-500" />

                            <p class="flex-1 text-sm font-bold text-amber-800">
                                Outstanding issue from previous shift?
                            </p>

                            <button type="button" class="flex h-4 w-7 shrink-0 items-center rounded-full p-0.5 transition-colors" :class="issue ? 'bg-amber-500' : 'bg-slate-300'" @click="issue = !issue">
                                <span class="h-3 w-3 rounded-full bg-white shadow-sm transition-transform" :class="issue ? 'translate-x-3' : 'translate-x-0'" />
                            </button>
                        </div>
                        <Transition enter-active-class="transition-all duration-300 ease-out" enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition-all duration-200 ease-in" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-1" >
                            <div v-if="issue" class="mt-3">
                                <label for="issue-detail" class="mb-1.5 block text-xs font-bold uppercase text-amber-800">
                                    Detail Issue
                                </label>

                                <textarea id="issue-detail" v-model="form.detail" rows="2" class="block w-full resize-none rounded-md border border-amber-200 bg-white px-2.5 py-2 text-sm leading-4 text-slate-700 outline-none focus:border-amber-400" />

                                <p class="mt-1.5 text-xs text-amber-700/75">
                                    Auto-notifies Duty Supervisor and logs maintenance ticket if marked active.
                                </p>
                            </div>
                        </Transition>
                    </section>
                </div>
                <div class="flex-shrink-0 border-t border-slate-200 bg-white px-6 py-4">
                    <Transition name="zoom">
                        <button v-if="show" type="submit" :disabled="loading" class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-400 py-2 text-white transition hover:bg-emerald-500 disabled:cursor-not-allowed">
                            <template v-if="!loading">
                                <Plus size="20" />
                                <span>Create new basic information</span>
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