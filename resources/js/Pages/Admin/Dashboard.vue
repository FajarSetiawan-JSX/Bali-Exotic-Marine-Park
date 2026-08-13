<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Bar, Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { Users, Flag, UsersRound } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
ChartJS.register( BarElement, ArcElement, CategoryScale, LinearScale, Tooltip, Legend)

const datapriority = [1,4,7];
const datadivision = [4,3,5,5,1];
const colors = [
    "#ef4444", // merah
    "#3b82f6", // biru
    "#22c55e", // hijau
    "#f59e0b", // kuning
    "#8b5cf6", // ungu
    "#06b6d4", // cyan
    "#ec4899", // pink
    "#14b8a6", // teal
    "#f97316", // orange
    "#84cc16", // lime
];
const backgroundColor = Array.from({ length: 12 }, () => {
    return colors[Math.floor(Math.random() * colors.length)];
});
const dataBar = ref({
    labels: ['Division Level 1', 'Division Level 2', 'Division Level 3'],
    datasets: [
        {
            label: "Total division",
            data: [],
            backgroundColor: backgroundColor,
            borderRadius: 0,
            borderSkipped: false,
            barThickness: 20
        }
    ]
})
const doughnutData = ref({
    labels: ['Supervisor', 'Host', 'Reservation', 'Security', 'Admin'],
    datasets: [{
        label: "Total users",
        data: [],
        backgroundColor: backgroundColor,
        borderWidth: 2
    }]
})

const optionsBar = {
    responsive: true,
    maintainAspectRatio: false,

    animation: {
        duration: 1500,
        easing: 'easeOutQuart'
    },

    plugins: {
        legend: {
            display: false
        }
    },

    scales: {
        x: {
            grid: {
                display: false
            }
        },
        y: {
            beginAtZero: true
        }
    }
}
const doughnutOptions = {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
        duration: 1500,
        easing: 'easeOutQuart'
    },
    cutout: '70%',
    plugins: {
        legend: {
            position: 'bottom'
        }
    }
}
onMounted(()=>{
    setTimeout(() => {
        dataBar.value = {
            ...dataBar.value,
            datasets: [{
                ...dataBar.value.datasets[0],
                data: datapriority
            }
            ]
        }
        doughnutData.value = {
            ...doughnutData.value,
            datasets: [
                {
                    ...doughnutData.value.datasets[0],
                    data: datadivision
                }
            ]
        }
    }, 100);
})
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-second text-slate-800 text-lg font-semibold">
                Dashboard
            </h1>
        </template>
        <section class="relative flex items-center h-80 overflow-hidden bg-[#F8FEFF]">
            <!-- Wave belakang -->
            <svg data-aos="zoom-in" data-aos-delay="100" data-aos-offset="0"
                class="absolute bottom-0 w-full opacity-40"
                viewBox="0 0 1440 320"
                preserveAspectRatio="none">

                <path
                    fill="#8ADFD8"
                    d="M0,224L80,213.3C160,203,320,181,480,176C640,171,800,181,960,202.7C1120,224,1280,256,1360,272L1440,288L1440,320L0,320Z">
                </path>

            </svg>
            <!-- Wave depan -->
            <svg data-aos="fade-up" data-aos-delay="200" data-aos-offset="0"
                class="absolute bottom-0 w-full"
                viewBox="0 0 1440 320"
                preserveAspectRatio="none">

                <path
                    fill="#55C9C7"
                    d="M0,192L80,202.7C160,213,320,235,480,218.7C640,203,800,149,960,144C1120,139,1280,181,1360,202.7L1440,224L1440,320L0,320Z">
                </path>

            </svg>
            <div class="p-5 max-w-md z-10">
                <p data-aos="fade-up" class="font-primary text-sm text-[#7B93A7]">System overview</p>
                <h1 data-aos="fade-down" class="text-3xl font-semibold text-[#102A43]">Hello Administrator!</h1>
                <p data-aos="zoom-in-down" class="text-[#526D82] text-lg">
                    Manage employees, divisions, schedules, and daily operations of
                    <span class="text-[#0EA5E9] font-exotic1 text-2xl font-semibold">Bali Exotic </span><span class="font-exotic2 text-black text-lg">Marine Park</span>
                    from one centralized dashboard.
                </p>
            </div>
        </section>

        <section class="my-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
            <div data-aos="zoom-in" data-aos-offset="0" class="font-second shadow-lg rounded-lg overflow-hidden bg-emerald-400 max-h-max">
                <div class="p-3 bg-white ml-1 flex items-center gap-4 w-full rounded-lg">
                    <div class="p-2 rounded-lg bg-emerald-200">
                        <UsersRound size="30" class=" text-emerald-500" />
                    </div>
                    <div class="text-md">
                        <div>Total Division</div>
                        <div class="text-sm text-emerald-500">19</div>
                    </div>
                </div>
            </div>
            <div data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0" class="flex items-center gap-4 font-second shadow-lg p-3 rounded-lg">
                <div class="p-2 rounded-lg bg-cyan-200">
                    <Users size="30" class=" text-cyan-500" />
                </div>
                <div class="text-lg">
                    <div>Total users</div>
                    <div class="text-sm text-cyan-500">19</div>
                </div>
            </div>
            <div data-aos="zoom-in" data-aos-delay="600" data-aos-offset="0" class="flex items-center gap-4 font-second shadow-lg p-3 rounded-lg">
                <div class="p-2 rounded-lg bg-teal-200">
                    <Users size="30" class=" text-teal-500" />
                </div>
                <div class="text-lg">
                    <div>Attachment</div>
                    <div class="text-sm text-teal-500">19 %</div>
                </div>
            </div>
            <div data-aos="zoom-in" data-aos-delay="900" data-aos-offset="0" class="flex items-center gap-4 font-second shadow-lg p-3 rounded-lg">
                <div class="p-2 rounded-lg bg-red-200">
                    <Flag size="30" class=" text-red-400" />
                </div>
                <div class="text-lg">
                    <div>Total Report</div>
                    <div class="text-sm text-red-500">12</div>
                </div>
            </div>
        </section>
        <section class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="p-5 shadow-xl rounded-xl">
                <h2 class="text-xl font-semibold font-second text-slate-900">Level</h2>
                <div class="h-80">
                    <Bar :data="dataBar" :options="optionsBar" />
                </div>
            </div>
            <div class="p-5 shadow-xl rounded-xl">
                <h2 class="text-xl font-semibold font-second text-slate-900">Users Division</h2>
                <div class="h-80">
                    <Doughnut
                        :data="doughnutData"
                        :options="doughnutOptions"
                    />
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
