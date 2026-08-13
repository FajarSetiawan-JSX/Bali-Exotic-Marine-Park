<script setup>
import FullTime from '@/Components/Layout/Admin/TypeSchedule/FullTime/FullTime.vue';
import Shifting from '@/Components/Layout/Admin/TypeSchedule/Shifting/Shifting.vue';
import SearchAnimation from '@/Components/SearchAnimation.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next'
import { ref, computed, onMounted } from 'vue'

const props = defineProps(['worktime']);
const active = ref(1)

const sliderStyle = computed(() => ({
    transform: active.value == 1
        ? 'translateX(0%)'
        : 'translateX(100%)'
}))
const search = ref('')

onMounted(()=>{
    console.log('parent : ',props?.worktime);
})
</script>

<template>
    <Head title="Type Work" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">Work Time</h1>
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
        <section class="mb-5">
            <div class="inline-flex rounded-xl bg-slate-100 p-1 shadow-inner relative">
                <div
                    class="absolute h-10 w-24 rounded-lg bg-white shadow transition-all duration-300 ease-in-out"
                    :style="sliderStyle"
                />
                <button
                    v-for="worktime in props.worktime"
                    :key="worktime.id"
                    @click="active = worktime.id"
                    class="relative z-10 flex h-10 w-24 items-center justify-center rounded-lg text-sm font-semibold transition-colors duration-300"
                    :class="active === worktime.id
                        ? 'text-slate-900'
                        : 'text-slate-500 hover:text-slate-700'"
                >
                    {{ worktime?.name }}
                </button>
            </div>
        </section>

        <template v-if="active == 1">
            <FullTime :worktime="props?.worktime[0]" />
        </template>
        <template v-else>
            <Shifting :worktime="props?.worktime[1]" />
        </template>
    </AuthenticatedLayout>
</template>

<style scoped>
.collapse-enter-active,
.collapse-leave-active {
    transition: all .35s ease;
}

.collapse-enter-from {
    opacity: 0;
    transform: translateY(-12px);
}

.collapse-enter-to {
    opacity: 1;
    transform: translateY(0);
}

.collapse-leave-from {
    opacity: 1;
    transform: translateY(0);
}

.collapse-leave-to {
    opacity: 0;
    transform: translateY(-12px);
}
</style>