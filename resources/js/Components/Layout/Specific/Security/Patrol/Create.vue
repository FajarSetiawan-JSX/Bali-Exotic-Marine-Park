<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Plus, Check, AlertTriangle } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['worktime']);
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
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post(route('super.admin.fulltime.store'), form.value);
        emit('success')
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
                            New Daily Report
                        </h2>
                        <p class="mt-1 text-sm text-slate-300">
                            Input daily patrol
                        </p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-md bg-white/10 p-1.5 text-slate-300 transition hover:bg-white/20 hover:text-white">
                        <X :size="15" />
                    </button>
                </div>
            </header>

            <form @submit.prevent="submit">
                <div class="space-y-3 px-4 py-4 font-second">
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="shift">
                                Shift
                            </label>
                            <select id="shift" v-model="form.shift" class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-2.5 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white">
                                <option value="shift-1">Shift 1 - Pagi (08:00 - 16:00 WITA)</option>
                                <option value="shift-2">Shift 2 - Sore (16:00 - 00:00 WITA)</option>
                                <option value="shift-3">Shift 3 - Malam (00:00 - 08:00 WITA)</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="area">
                                Patrol Area
                            </label>

                            <select id="area" v-model="form.area" class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-2.5 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white">
                                <option value="dolphin-lagoon">Dolphin Lagoon & Marine Pool Section A</option>
                                <option value="perimeter">North Perimeter & Main Gate</option>
                                <option value="aviary">Aviary & Service Corridor</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="method">
                                Patrol Method
                            </label>

                            <select id="method" v-model="form.method" class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-2.5 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white">
                                <option value="foot-patrol">Foot Patrol (Patroli Jalan Kaki)</option>
                                <option value="vehicle-patrol">Vehicle Patrol (Patroli Kendaraan)</option>
                                <option value="cctv">CCTV Monitoring</option>
                            </select>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="water-condition">
                                Water Condition
                            </label>

                            <select id="water-condition" v-model="form.waterCondition" class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-2.5 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white">
                                <option value="optimum">Optimum (Salinity 32 PSU, Clear, 26°C)</option>
                                <option value="monitor">Needs Monitoring</option>
                                <option value="attention">Needs Attention</option>
                            </select>
                        </div>
                    </div>

                    <section class="rounded-lg border border-slate-200 bg-white px-3 py-2.5">
                        <div class="flex items-center gap-2.5">
                            <div class="flex h-6 w-6 items-center justify-center rounded-md border border-emerald-200 bg-emerald-50 text-emerald-500">
                                <Check :size="13" />
                            </div>

                            <div class="flex-1">
                                <p class="text-sm font-bold text-slate-700">
                                    Handover Received (Serah Terima Lengkap)
                                </p>
                                <p class="mt-0.5 text-xs text-slate-400">
                                    Master Keys, Motorola HT Radios, flashlights, and logs verified
                                </p>
                            </div>

                            <button type="button" :class="form.handoverReceived ? 'bg-cyan-500' : 'bg-slate-300'" @click="form.handoverReceived = !form.handoverReceived" class="flex h-4 w-7 shrink-0 items-center rounded-full p-0.5 transition-colors">
                                <span class="h-3 w-3 rounded-full bg-white shadow-sm transition-transform" :class="form.handoverReceived ? 'translate-x-3' : 'translate-x-0'" />
                            </button>
                        </div>
                    </section>

                    <section class="rounded-lg border border-amber-200 bg-amber-50/60 px-3 py-3">
                        <div class="flex items-center gap-2.5">
                            <AlertTriangle :size="15" class="text-amber-500" />

                            <p class="flex-1 text-sm font-bold text-amber-800">
                                Outstanding Issue Detected? (Ada Kendala / Insiden?)
                            </p>

                            <button
                                type="button"
                                class="flex h-4 w-7 shrink-0 items-center rounded-full p-0.5 transition-colors"
                                :class="form.hasIssue ? 'bg-amber-500' : 'bg-slate-300'"
                                @click="form.hasIssue = !form.hasIssue"
                            >
                                <span class="h-3 w-3 rounded-full bg-white shadow-sm transition-transform" :class="form.hasIssue ? 'translate-x-3' : 'translate-x-0'" />
                            </button>
                        </div>

                        <div class="mt-3">
                            <label for="issue-detail" class="mb-1.5 block text-xs font-bold uppercase text-amber-800">
                                Outstanding Detail (Detail Kendala)
                            </label>

                            <textarea
                                id="issue-detail"
                                v-model="form.issueDetail"
                                rows="2"
                                class="block w-full resize-none rounded-md border border-amber-200 bg-white px-2.5 py-2 text-sm leading-4 text-slate-700 outline-none focus:border-amber-400"
                            />

                            <p class="mt-1.5 text-xs text-amber-700/75">
                                Auto-notifies Duty Supervisor and logs maintenance ticket if marked active.
                            </p>
                        </div>
                    </section>
                </div>

                <footer class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 px-4 py-3">
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-cyan-500 px-3 py-2 text-sm font-bold text-white shadow-md shadow-cyan-500/20 hover:bg-cyan-600">
                        <Plus :size="13" />
                        Save & Submit Report
                    </button>
                </footer>
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