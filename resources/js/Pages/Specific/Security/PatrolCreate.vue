<script setup>
import { computed, onMounted, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import {
    LandPlot,
    ChevronDown,
    ShieldAlert,
    Building,
    ScanEye,
    FireExtinguisher,
    Unplug,
    Activity,
    PackageCheck,
    ShieldQuestionMark,
    AlertTriangle,
    CheckCircle2,
    Send,
} from 'lucide-vue-next';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';

const props = defineProps(['areas']);
const areas = ref([]);
const loading = ref(false);

const form = ref({
    area: '',
    section: '',
});
const selectedSection = ref(null);
const selectedArea = computed(() =>
    areas.value.find(area => area.id == form.value.area)
);
function selectArea() {
    const area = selectedArea.value;
    const section = area?.areaSection?.[0] ?? null;
    selectedSection.value = section;
    form.value.section = section?.id ?? '';
}
function selectSection(section) {
    selectedSection.value = section;
    form.value.section = section.id;
}
async function create() {
    loading.value = true;
    setTimeout(() => {
        loading.value = false;
    }, 1000);

    // try {
    //     const response = await axios.post(
    //         route('specific.schedule.create'),
    //         form.value
    //     );
    //     console.log(response.data);
    // } catch (error) {
    //     console.log(error.response);
    // }
}

onMounted(() => {
    areas.value = props.areas ?? [];
    console.log(areas.value)
});
</script>

<template>
    <Head title="New Daily Patrol" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">New Daily Patrol</h1>
        </template>

        <section>
            <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
                <div class="mb-4 flex items-center gap-2">
                    <LandPlot class="h-5 w-5 text-emerald-600" />
                    <h2 class="text-base font-semibold text-gray-800 sm:text-lg">
                        Available Area
                    </h2>
                </div>

                <label class="mb-2 block text-sm font-medium text-gray-600">
                    Area
                </label>

                <div class="relative">
                    <select
                        v-model="form.area"
                        @change="selectArea"
                        class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-10 text-sm text-gray-800 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400 sm:text-sm"
                    >
                        <option value="" disabled>Select Area</option>

                        <option
                            v-for="area in areas"
                            :key="area.id"
                            :value="area.id"
                        >
                            {{ area.name }}
                        </option>
                    </select>

                    <ChevronDown
                        class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                    />
                </div>
            </div>
        </section>

        <section
            v-if="selectedArea"
            class="my-5 overflow-hidden rounded-xl bg-white"
        >
            <div class="mb-3 rounded-t-xl bg-[#0b1a2b] p-4 sm:p-5">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex min-w-0 items-center gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-cyan-400/10">
                            <ShieldAlert class="h-5 w-5 text-cyan-300" />
                        </div>

                        <div class="min-w-0">
                            <h1 class="truncate text-sm font-semibold text-white sm:text-base">
                                Step Checklist Security
                            </h1>
                            <p class="truncate text-xs text-slate-400">
                                Pilih tahapan inspeksi
                            </p>
                        </div>
                    </div>

                    <span class="text-xs text-slate-300">
                        {{ selectedArea.areaSection?.length ?? 0 }} Section
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto px-3">
                <div class="flex min-w-max gap-3 pb-1">
                    <button
                        v-for="(section, index) in selectedArea.areaSection"
                        :key="section.id"
                        type="button"
                        @click="selectSection(section)"
                        :class="selectedSection?.id === section.id
                            ? 'border-sky-400 ring-1 ring-sky-200'
                            : 'border-gray-200 hover:border-gray-300'"
                        class="w-40 shrink-0 rounded-xl border bg-white p-3 text-left transition-colors"
                    >
                        <div class="mb-2 flex items-center justify-between">
                            <Building
                                v-if="index === 0"
                                class="h-4 w-4 text-sky-500"
                            />
                            <ScanEye
                                v-else-if="index === 1"
                                class="h-4 w-4 text-sky-500"
                            />
                            <FireExtinguisher
                                v-else-if="index === 2"
                                class="h-4 w-4 text-sky-500"
                            />
                            <Unplug
                                v-else-if="index === 3"
                                class="h-4 w-4 text-sky-500"
                            />
                            <Activity
                                v-else-if="index === 4"
                                class="h-4 w-4 text-sky-500"
                            />
                            <PackageCheck
                                v-else-if="index === 5"
                                class="h-4 w-4 text-sky-500"
                            />
                            <ShieldQuestionMark
                                v-else
                                class="h-4 w-4 text-sky-500"
                            />
                        </div>

                        <p class="text-xs font-semibold text-gray-800">
                            {{ section.name }}
                        </p>

                        <p class="text-xs text-sky-500">
                            On progress
                        </p>
                    </button>
                </div>
            </div>
        </section>

        <section
            v-if="selectedSection"
            class="w-full space-y-4"
        >
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                <div class="flex items-center gap-3 border-b border-gray-100 px-4 py-4 sm:px-5">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-sky-50">
                        <ShieldAlert class="h-4 w-4 text-sky-600" />
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-800 sm:text-base">
                            {{ selectedSection.name }}
                        </p>
                        <p class="text-xs text-gray-400">
                            {{ selectedSection.question?.length ?? 0 }} Questions
                        </p>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    <div
                        v-for="(q, index) in selectedSection.question"
                        :key="q.id"
                        class="px-4 py-4 sm:px-5"
                    >
                        <p class="text-sm leading-relaxed text-gray-800 sm:text-base">
                            {{ index + 1 }}. {{ q.question }}
                        </p>
                        <template v-if="q.type == 'Checklist'">
                            <div class="flex gap-x-5 items-center justify-start">
                                <label for="">
                                    <input type="radio" name="" id="">
                                    Normal
                                </label>
                                <label for="">
                                    <input type="radio" name="" id="">
                                    Abnormal
                                </label>
                            </div>
                        </template>
                        
                        <template v-else>
                            <div class="">
                                <textarea name="" id="" class="mt-1.5 rounded-lg ring-slate-500 w-full focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400"></textarea>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-5">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full border-4 border-sky-100 text-xs font-semibold text-sky-600">
                            1/1
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-800">
                                Status Checklist
                            </p>

                            <p class="flex items-center gap-1 text-xs text-gray-400">
                                <CheckCircle2 class="h-3.5 w-3.5 text-emerald-500" />
                                Semua parameter telah terverifikasi
                            </p>
                        </div>
                    </div>

                    <button type="button" @click="create" class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-teal-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-teal-700">
                        <Send class="h-4 w-4" />
                        Submit Section
                    </button>
                </div>
            </div>
        </section>

        <FullScreenLoading v-if="loading">
            <LoadingPrimary />
        </FullScreenLoading>
    </AuthenticatedLayout>
</template>