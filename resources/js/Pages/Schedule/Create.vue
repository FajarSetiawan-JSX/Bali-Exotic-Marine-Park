<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { ArrowLeft, User, Save, ChevronDown, CalendarDays } from 'lucide-vue-next';
import { eror } from '@/Helper/Toast';
import axios from 'axios';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';
import { usePage } from '@inertiajs/vue3';

const user = usePage().props?.auth?.user;
const search = ref('');
onMounted(()=>{
    console.log('user', user);
})

const emit = defineEmits(['save'])

// data dummy
const employees = ref([
    { id: 1, name: 'Dimas', position: 'Head of Security' },
    { id: 2, name: 'Sarah Jenkins', position: 'Tour Guide' },
    { id: 3, name: 'Marcus', position: 'Marine Biologist' },
])

const totalDays = 31

const selectedEmployeeId = ref(employees.value[0].id)

// shift value per tanggal: 'off' | 'shift1' | 'shift2'
const shiftMap = ref(
    Object.fromEntries(
        Array.from({ length: totalDays }, (_, i) => [i + 1, i < 1 ? 'off' : 'shift1'])
    )
)

const shiftOptions = [
    { value: 'off', label: 'Off' },
    { value: 'shift1', label: 'Shift 1 (08:00 - 16:00)' },
    { value: 'shift2', label: 'Shift 2 (16:00 - 00:00)' },
]

function setShift(day, value) {
    shiftMap.value[day] = value
}

function handleSave() {
    emit('save', {
        employeeId: selectedEmployeeId.value,
        shifts: shiftMap.value
    })
}
</script>

<template>
    <Head title="Supervisor assign" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Schedule</h1>
        </template>
        <template #search>
            <SearchAnimation placeholder="Search name" v-model="search">
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
        <section class="w-full overflow-hidden rounded-xl border border-slate-200 bg-gradient-to-r from-sky-900 via-teal-700 to-teal-500 px-5 py-4 shadow-sm sm:px-6 sm:py-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="min-w-0 font-second">
                    <h2 class="text-lg font-bold tracking-tight text-white sm:text-lg">
                        Schedule Management
                    </h2>
                    <p class="mt-1 max-w-xl text-sm leading-relaxed text-slate-100 sm:text-xs">
                        Quickly generate automated schedules or manually create
                        custom shifts for your workforce to ensure optimal daily
                        coverage.
                    </p>
                </div>
                <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:shrink-0 font-second">

                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="w-full mx-auto space-y-4">
                <!-- Card: Pilih Pengguna -->
                <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <User class="h-5 w-5 text-gray-700" />
                        <h2 class="text-base sm:text-lg font-semibold text-gray-800">Select division members</h2>
                    </div>

                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Name
                    </label>
                    <div class="relative">
                        <select
                            v-model="selectedEmployeeId"
                            class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-4 py-2.5 pr-10 text-sm sm:text-base text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400"
                        >
                            <option v-for="emp in employees" :key="emp.id" :value="emp.id">
                                {{ emp.name }} ({{ emp.position }})
                            </option>
                        </select>
                        <ChevronDown class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" />
                    </div>
                </div>

                <!-- Card: Template Jadwal Bulanan -->
                <div class="rounded-xl border border-gray-200 bg-gray-50 overflow-hidden">
                    <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <CalendarDays class="h-5 w-5 text-gray-700" />
                            <h2 class="text-base sm:text-lg font-semibold text-gray-800">Template Jadwal Bulanan</h2>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Atur shift harian untuk pengguna terpilih.</p>
                    </div>

                    <div class="bg-white divide-y divide-gray-100">
                        <div
                            v-for="day in totalDays"
                            :key="day"
                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-4 sm:px-6 py-4"
                        >
                            <span class="text-sm sm:text-base font-medium text-gray-800">
                                Tanggal {{ day }}
                            </span>

                            <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                                <label
                                    v-for="option in shiftOptions"
                                    :key="option.value"
                                    class="flex items-center gap-2 cursor-pointer"
                                >
                                    <input
                                        type="radio"
                                        :name="`shift-day-${day}`"
                                        :value="option.value"
                                        :checked="shiftMap[day] === option.value"
                                        @change="setShift(day, option.value)"
                                        class="h-4 w-4 accent-sky-600"
                                    />
                                    <span
                                        class="text-sm sm:text-base"
                                        :class="option.value === 'off' && shiftMap[day] === 'off' ? 'text-red-600 font-medium' : 'text-gray-700'"
                                    >
                                        {{ option.label }}
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end px-4 sm:px-6 py-4 bg-gray-50">
                        <button
                            type="button"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm sm:text-base font-medium text-white hover:bg-blue-800 transition-colors"
                            @click="handleSave"
                        >
                            <Save class="h-4 w-4" />
                            Simpan Jadwal
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>