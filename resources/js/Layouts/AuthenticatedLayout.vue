<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Logs } from "lucide-vue-next";
import NavButton from "@/Components/Layout/Admin/NavButton.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props?.auth;
const sidebar = ref(false);
const showset = ref(false);
const openSidebar = () => {
    sidebar.value = true;
};

const closeSidebar = () => {
    sidebar.value = false;
};

const resize = () => {
    if (window.innerWidth >= 1024) {
        sidebar.value = false;
    }
};

onMounted(() => {
    console.log('user : ', user);
    window.addEventListener("resize", resize);
});

onUnmounted(() => {
    window.removeEventListener("resize", resize);
});
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-[#F4F7FC]">
        <Transition enter-active-class="transition duration-300" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="transition duration-300" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="sidebar" @click="closeSidebar" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"/>
        </Transition>
        <aside :class="[ sidebar ? 'translate-x-0' : '-translate-x-full', 'fixed inset-y-0 left-0 z-50 w-[308px] bg-[#06192E] border-r border-white/5 flex flex-col transition-transform duration-300 lg:translate-x-0 lg:static lg:flex']">
            <div class="flex h-24 items-center border-b border-white/5 px-7">
                <div class="w-14 h-14 bg-contain bg-no-repeat bg-white bg-center rounded-lg" style="background-image: url('/lumba.png');">

                </div>
                <div class="ml-4">
                    <h1 class="text-[23px] font-bold font-exotic1 leading-none text-white">
                        Bali Exotic
                    </h1>
                    <p class="mt-1 text-[10px] font-semibold font-exotic2 uppercase tracking-[4px] text-cyan-400">
                        Marine PARK
                    </p>
                </div>
            </div>
            <div class="sidebar-scroll flex-1 overflow-y-auto px-5 py-6">
                <p class="mb-4 text-[11px] font-semibold uppercase tracking-[3px] text-[#71839A]">
                    Overview
                </p>
                <NavButton :href="route('dashboard')" :class="route().current('dashboard') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                    <div class="flex items-center gap-x-1.5">
                        <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-width="2" d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5ZM14 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5ZM4 16a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3ZM14 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6Z"/>
                        </svg>
                        Dashboard
                    </div>
                    <div v-if="route().current('dashboard')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                </NavButton>
                <template v-if="user?.level == 1">
                    <div class="mt-8">
                        <p class="mb-4 text-[11px] font-semibold uppercase tracking-[3px] text-[#71839A]">
                            Master Data
                        </p>
                        <NavButton :href="route('super.admin.user')" :class="route().current('super.admin.user') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM4 8a6 6 0 1 1 12 0A6 6 0 0 1 4 8zm12.828-4.243a1 1 0 0 1 1.415 0 6 6 0 0 1 0 8.486 1 1 0 1 1-1.415-1.415 4 4 0 0 0 0-5.656 1 1 0 0 1 0-1.415zm.702 13a1 1 0 0 1 1.212-.727c1.328.332 2.169 1.18 2.652 2.148.468.935.606 1.98.606 2.822a1 1 0 1 1-2 0c0-.657-.112-1.363-.394-1.928-.267-.533-.677-.934-1.349-1.102a1 1 0 0 1-.727-1.212zM6.5 18C5.24 18 4 19.213 4 21a1 1 0 1 1-2 0c0-2.632 1.893-5 4.5-5h7c2.607 0 4.5 2.368 4.5 5a1 1 0 1 1-2 0c0-1.787-1.24-3-2.5-3h-7z"/></svg>
                                Users
                            </div>
                            <div v-if="route().current('super.admin.user')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.division')" :class="route().current('super.admin.division') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="-0.15 0 33.41 33.41" xmlns="http://www.w3.org/2000/svg">
                                    <g transform="translate(-160.123 -641.343)">
                                        <path d="M176.373,650.843a4.75,4.75,0,1,1,4.75-4.75A4.755,4.755,0,0,1,176.373,650.843Zm0-7.5a2.75,2.75,0,1,0,2.75,2.75A2.752,2.752,0,0,0,176.373,643.343Z"/>
                                        <path d="M164.873,674.753a4.75,4.75,0,1,1,4.75-4.75A4.755,4.755,0,0,1,164.873,674.753Zm0-7.5a2.75,2.75,0,1,0,2.75,2.75A2.752,2.752,0,0,0,164.873,667.253Z"/>
                                        <path d="M188.482,674.753a4.75,4.75,0,1,1,4.75-4.75A4.756,4.756,0,0,1,188.482,674.753Zm0-7.5a2.75,2.75,0,1,0,2.75,2.75A2.752,2.752,0,0,0,188.482,667.253Z"/>
                                        <path d="M166.487,667.622a.989.989,0,0,1-.431-.1,1,1,0,0,1-.47-1.334l8.223-17.171a1,1,0,0,1,1.8.864l-8.224,17.17A1,1,0,0,1,166.487,667.622Z"/>
                                        <path d="M186.869,667.622a1,1,0,0,1-.9-.557l-8.495-17.171a1,1,0,1,1,1.793-.886l8.5,17.17a1,1,0,0,1-.453,1.34A.988.988,0,0,1,186.869,667.622Z"/>
                                        <path d="M184.732,671H168.623a1,1,0,0,1,0-2h16.109a1,1,0,0,1,0,2Z"/>
                                    </g>
                                </svg>
                                Division
                            </div>
                            <div v-if="route().current('super.admin.division')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.area')" :class="route().current('super.admin.area') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 16.016c1.245.529 2 1.223 2 1.984 0 1.657-3.582 3-8 3s-8-1.343-8-3c0-.76.755-1.456 2-1.984"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8.444C17 11.537 12 17 12 17s-5-5.463-5-8.556C7 5.352 9.239 3 12 3s5 2.352 5 5.444z"/><circle cx="12" cy="8" r="1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                Area
                            </div>
                            <div v-if="route().current('super.admin.area')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.supplier')" :class="route().current('super.admin.supplier') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20.929,1.629A1,1,0,0,0,20,1H4a1,1,0,0,0-.929.629C1.04,6.778,1.022,6.589,1.008,6.961,1.007,6.975,1,6.986,1,7V22a1,1,0,0,0,1,1H22a1,1,0,0,0,1-1V7C23,6.539,22.5,5.7,20.929,1.629ZM4.677,3H19.323l1.2,3H3.477ZM21,21H3V8H21ZM11,15.5H9v-2h2v-2h2v2h2v2H13v2H11Z"/></svg>
                                Supplier
                            </div>
                            <div v-if="route().current('super.admin.supplier')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.question')" :class="route().current('super.admin.question') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8,16 C3.58172,16 0,12.4183 0,8 C0,3.58172 3.58172,0 8,0 C12.4183,0 16,3.58172 16,8 C16,12.4183 12.4183,16 8,16 Z M4.4325,6.19122 C4.4325,5.7729 4.57483,5.34907 4.8595,4.91974 C5.14417,4.49041 5.5595,4.13484 6.1055,3.85303 C6.6515,3.57121 7.28848,3.43033 8.01648,3.43033 C8.69315,3.43033 9.2905,3.54811 9.8085,3.78369 C10.3265,4.01927 10.7267,4.33961 11.009,4.74472 C11.2913,5.14983 11.4325,5.59017 11.4325,6.06573 C11.4325,6.44002 11.352,6.76805 11.191,7.04987 C11.03,7.33168 10.8387,7.57497 10.617,7.77972 C10.3953,7.98448 9.9975,8.32904 9.42349,8.81342 C9.26483,8.94992 9.13766,9.06989 9.04199,9.17337 C8.94633,9.27685 8.87516,9.37153 8.82849,9.4574 C8.4428,10.3468 6.77018,10.2464 7.0925,9.00165 C7.21383,8.73084 7.37483,8.49306 7.5755,8.2883 C7.77617,8.08354 8.04681,7.84026 8.38748,7.55844 C8.68615,7.31185 8.902,7.12583 9.035,7.00034 C9.168,6.87484 9.28,6.73502 9.371,6.5809 C9.462,6.42678 9.50748,6.25946 9.50748,6.07892 C9.50748,5.72665 9.36867,5.42944 9.091,5.18726 C8.81334,4.94507 8.45515,4.82397 8.01648,4.82397 C7.50314,4.82397 7.12514,4.94616 6.88248,5.19055 C6.63981,5.43494 6.43448,5.79491 6.26648,6.27048 C6.10781,6.76806 5.80683,7.01685 5.36349,7.01685 C5.10216,7.01685 4.88166,6.92988 4.702,6.75595 C4.52233,6.58202 4.4325,6.39378 4.4325,6.19122 Z M8,13 C7.44771,13 7,12.5523 7,12 C7,11.4477 7.44771,11 8,11 C8.55229,11 9,11.4477 9,12 C9,12.5523 8.55229,13 8,13 Z"/>
                                </svg>
                                Question
                            </div>
                            <div v-if="route().current('super.admin.question')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                    </div>
                    <div class="mt-8">
                        <p class="mb-4 text-[11px] font-semibold uppercase tracking-[3px] text-[#71839A]">
                            Assignment
                        </p>

                        <NavButton :href="route('super.admin.attachment')" :class="route().current('super.admin.attachment') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.31802 0.974872C7.94222 0.350671 8.78882 0 9.67157 0C11.5098 0 13 1.49019 13 3.32843C13 4.21118 12.6493 5.05778 12.0251 5.68198L6.26777 11.4393C5.90878 11.7983 5.42189 12 4.91421 12C3.85702 12 3 11.143 3 10.0858C3 9.5781 3.20168 9.09122 3.56066 8.73223L9.14645 3.14645L9.85355 3.85355L4.26777 9.43934C4.09632 9.61079 4 9.84332 4 10.0858C4 10.5907 4.40931 11 4.91421 11C5.15668 11 5.38921 10.9037 5.56066 10.7322L11.318 4.97487C11.7547 4.53821 12 3.94596 12 3.32843C12 2.04247 10.9575 1 9.67157 1C9.05404 1 8.46179 1.24531 8.02513 1.68198L2.09619 7.61091C1.39431 8.31279 1 9.26475 1 10.2574C1 12.3244 2.67564 14 4.74264 14C5.73525 14 6.6872 13.6057 7.38909 12.9038L13.1464 7.14645L13.8536 7.85355L8.09619 13.6109C7.20678 14.5003 6.00047 15 4.74264 15C2.12335 15 0 12.8766 0 10.2574C0 8.99953 0.49967 7.79322 1.38909 6.90381L7.31802 0.974872Z"/>
                                </svg>
                                Supervisor
                            </div>
                            <div v-if="route().current('super.admin.attachment')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                    </div>
                </template>
                
                <div class="mt-8">
                    <p class="mb-4 text-[11px] font-semibold uppercase tracking-[3px] text-[#71839A]">
                        Workforce
                    </p>
                    <template v-if="user?.level == 1">
                        <NavButton :href="route('super.admin.work')" :class="route().current('super.admin.work') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 Z M12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 Z M12,6 C12.5128358,6 12.9355072,6.38604019 12.9932723,6.88337887 L13,7 L13,11.5857864 L14.7071068,13.2928932 C15.0976311,13.6834175 15.0976311,14.3165825 14.7071068,14.7071068 C14.3466228,15.0675907 13.7793918,15.0953203 13.3871006,14.7902954 L13.2928932,14.7071068 L11.2928932,12.7071068 C11.1366129,12.5508265 11.0374017,12.3481451 11.0086724,12.131444 L11,12 L11,7 C11,6.44771525 11.4477153,6 12,6 Z"/>
                                </svg>
                                Work schedule
                            </div>
                            <div v-if="route().current('super.admin.work')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                    </template>

                    <NavButton :href="route('schedule')" :class="route().current('schedule') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                        <div class="flex items-center gap-x-1.5">
                            <svg width="18px" height="18px" viewBox="-2 -3 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-calendar fill-current"><path d='M18 7V5a1 1 0 0 0-1-1h-1v1a1 1 0 0 1-2 0V4H6v1a1 1 0 1 1-2 0V4H3a1 1 0 0 0-1 1v2h16zm0 2H2v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9zm-2-7h1a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3h1V1a1 1 0 1 1 2 0v1h8V1a1 1 0 0 1 2 0v1z'/></svg>
                            Schedule
                        </div>
                        <div v-if="route().current('schedule')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                    </NavButton>
                    <NavButton :href="route('reschedules')" :class="route().current('reschedules') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                        <div class="flex items-center gap-x-1.5">
                            <svg width="18px" height="18px" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 Z M12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 Z M12,6 C12.5128358,6 12.9355072,6.38604019 12.9932723,6.88337887 L13,7 L13,11.5857864 L14.7071068,13.2928932 C15.0976311,13.6834175 15.0976311,14.3165825 14.7071068,14.7071068 C14.3466228,15.0675907 13.7793918,15.0953203 13.3871006,14.7902954 L13.2928932,14.7071068 L11.2928932,12.7071068 C11.1366129,12.5508265 11.0374017,12.3481451 11.0086724,12.131444 L11,12 L11,7 C11,6.44771525 11.4477153,6 12,6 Z"/>
                            </svg>
                            Reschedule
                        </div>
                        <div v-if="route().current('reschedules')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                    </NavButton>
                </div>
                <template v-if="user?.level !== 1">
                    <div class="mt-8">
                        <p class="mb-4 text-[11px] font-semibold uppercase tracking-[3px] text-[#71839A]">
                            Daily
                        </p>
                        <template v-if="user?.web?.includes('daily.basic')">
                            <NavButton :href="route('daily.basic')" :class="route().current('daily.basic') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" viewBox="0 0 76 76" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="full" enable-background="new 0 0 76.00 76.00" xml:space="preserve">
                                        <path fill-opacity="1" stroke-width="0.2" stroke-linejoin="round" d="M 19,20L 33,20L 33,23L 19,23L 19,20 Z M 35,17.0001L 56.9999,17.0001L 56.9999,26.0001L 35,26.0001L 35,17.0001 Z M 37,19.0001L 37,24.0001L 54.9999,24.0001L 54.9999,19.0001L 37,19.0001 Z M 19,39L 42,39L 42,42L 19,42L 19,39 Z M 22,47L 23,47L 23,51L 22,51L 22,47 Z M 19,44L 57,44L 57,60L 19,60L 19,44 Z M 21,46L 21,58L 55,58L 55,46L 21,46 Z M 19,31L 33,31L 33,34L 19,34L 19,31 Z M 35,28L 57,28L 57,37L 35,37L 35,28 Z M 37,30L 37,35L 54.9999,35L 55,30L 37,30 Z M 38,33L 39,33L 39,34L 38,34L 38,33 Z M 38,22L 39,22L 39,23L 38,23L 38,22 Z M 40,33L 41,33L 41,34L 40,34L 40,33 Z M 42,33L 43,33L 43,34L 42,34L 42,33 Z M 40,22L 41,22L 41,23L 40,23L 40,22 Z M 42,22L 43,22L 43,23L 42,23L 42,22 Z "/>
                                    </svg>
                                    Basic
                                </div>
                                <div v-if="route().current('daily.basic')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <!-- Security -->
                        <template v-if="user?.web?.includes('security.daily.patrols')">
                            <NavButton :href="route('security.daily.patrols')" :class="route().current('security.daily.patrols') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" version="1.1" id="XMLID_179_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 24 24" xml:space="preserve">
                                    <g id="user-police">
                                        <g>
                                            <path d="M21,24H3v-2c0-3,1.4-5.7,3.8-7.3C5.7,13.4,5,11.6,5,9.6V9h2v0.6c0,3.1,2.1,5.4,5,5.4s5-2.3,5-5.4V9h2v0.6
                                                c0,2-0.7,3.8-1.8,5.1c0.4,0.3,0.8,0.6,1.2,1c1.7,1.5,2.6,3.9,2.6,6.3V24z M5,22h14c0-1.9-0.7-3.6-2-5c-0.4-0.4-0.9-0.8-1.3-1
                                                c-1,0.6-2.3,1-3.6,1s-2.6-0.4-3.6-1C6.3,17.2,5,19.5,5,22z M19,9L5,9L1.8,5.4l0.4-0.7C4.2,1.8,8,0,12,0s7.8,1.7,9.8,4.7l0.4,0.7
                                                L19,9z M5.9,7h12.3l1.6-1.7C18,3.2,15.1,2,12,2S6,3.2,4.3,5.3L5.9,7z"/>
                                        </g>
                                        <g>
                                            <path d="M12,3h-2c0,0-0.1,3,2,3c2,0,2-3,2-3H12z"/>
                                        </g>
                                    </g>
                                    </svg>
                                    Patrol
                                </div>
                                <div v-if="route().current('security.daily.patrols')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <template v-if="user?.web?.includes('security.visitor')">
                            <NavButton :href="route('security.visitor')" :class="route().current('security.visitor') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 293.709 293.709" style="enable-background:new 0 0 293.709 293.709;" xml:space="preserve">
                                    <g>
                                        <path d="M251.742,58.307c0,0,0-2.502,0-5.58s-0.386-9.894-3.878-13.168c-1.757-1.648-4.297-2.904-7.93-2.904
                                            h-19.668c0,0-10.481,0-10.481,9.834V56.98c0,11.166-20.511,10.878-20.511,10.878l-84.469,0.044c0,0-20.897-0.462-20.897-9.589
                                            V44.954c0,0,0.658-8.501-10.492-8.501H52.449c0,0-10.514,0-10.514,9.159v12.706c0,0,0.375,5.461-8.126,8.246
                                            c-6.478,2.121-20.641,0.109-27.489,5.972C2.768,75.57,0,80.65,0,89.097v147.839c0,0,0.647,20.32,20.973,20.32h250.436
                                            c0,0,22.3-1.305,22.3-19.662V88.45c0,0-0.68-20.309-21.647-20.309C272.062,68.135,251.742,66.803,251.742,58.307z M220.26,57.627
                                            c0-5.776,4.068-10.487,9.834-10.487h0.658c5.798,0,10.508,4.71,10.508,10.487v20.989c0,5.776-4.373,10.481-10.171,10.481h-0.658
                                            c-5.798,0-10.171-4.699-10.171-10.481V57.627z M184.335,162.525h52.449c2.888,0,5.232,2.339,5.232,5.254
                                            c0,2.888-2.344,5.238-5.232,5.238h-52.449c-2.888,0-5.254-2.35-5.254-5.238C179.081,164.863,181.447,162.525,184.335,162.525z
                                            M241.701,189.405c0,3.089-2.491,4.911-5.564,4.911h-51.144c-3.073,0-5.575-1.822-5.575-4.911c0-3.073,2.497-5.575,5.575-5.575
                                            h51.144C239.21,183.829,241.701,186.331,241.701,189.405z M89.674,99.627c16.176,0,29.289,14.354,29.289,33.711
                                            c0,19.363-13.114,35.077-29.289,35.077s-29.278-15.713-29.278-35.077C60.395,113.981,73.498,99.627,89.674,99.627z M52.764,57.072
                                            c0-5.776,4.036-9.834,9.834-9.834h0.658c5.798,0,10.16,4.052,10.16,9.834v21.544c0,5.776-4.71,10.481-10.481,10.481H62.25
                                            c-5.765,0-9.486-4.699-9.486-10.481C52.764,78.616,52.764,57.072,52.764,57.072z M144.489,212.64
                                            c-2.567,3.688-8.322,3.198-8.322,3.198H44.133c0,0-6.211,0.408-8.947-3.361c-1.474-2.034-0.451-6.162,0.566-8.469l2.48-5.64
                                            c0,0,6.842-15.306,14.637-24.182c4.786-5.439,10.481-4.199,14.163-2.431c2.268,1.088,4.835,4.264,6.706,5.945
                                            c2.584,2.317,7.141,4.95,14.598,5.096h4.574c7.452-0.141,12.009-2.779,14.588-5.096c1.876-1.681,4.368-4.95,6.614-6.075
                                            c3.383-1.692,8.523-2.73,13.184,2.567c7.8,8.877,13.968,24.465,13.968,24.465l2.535,5.532
                                            C144.848,206.467,145.925,210.573,144.489,212.64z M237.285,214.968h-53.439c-2.807,0-5.075-2.252-5.075-5.069
                                            c0-2.812,2.268-5.096,5.075-5.096h53.439c2.779,0,5.075,2.284,5.075,5.096C242.359,212.716,240.064,214.968,237.285,214.968z"/>
                                    </g>
                                    </svg>
                                    Visitor
                                </div>
                                <div v-if="route().current('security.visitor')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                    </div>
                </template>
                <template v-else>
                    <div class="mt-8">
                        <p class="mb-4 text-[11px] font-semibold uppercase tracking-[3px] text-[#71839A]">
                            Access
                        </p>

                        <NavButton :href="route('super.admin.permision.web')" :class="route().current('super.admin.permision.web') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.51211712,15 L8.17190229,15 C8.05949197,14.0523506 8,13.0444554 8,12 C8,10.9555446 8.05949197,9.94764942 8.17190229,9 L3.51211712,9 C3.18046266,9.93833678 3,10.9480937 3,12 C3,13.0519063 3.18046266,14.0616632 3.51211712,15 L3.51211712,15 Z M3.93551965,16 C5.12590433,18.3953444 7.35207678,20.1851177 10.0280093,20.783292 C9.24889451,19.7227751 8.65216136,18.0371362 8.31375067,16 L3.93551965,16 L3.93551965,16 Z M20.4878829,15 C20.8195373,14.0616632 21,13.0519063 21,12 C21,10.9480937 20.8195373,9.93833678 20.4878829,9 L15.8280977,9 C15.940508,9.94764942 16,10.9555446 16,12 C16,13.0444554 15.940508,14.0523506 15.8280977,15 L20.4878829,15 L20.4878829,15 Z M20.0644804,16 L15.6862493,16 C15.3478386,18.0371362 14.7511055,19.7227751 13.9719907,20.783292 C16.6479232,20.1851177 18.8740957,18.3953444 20.0644804,16 L20.0644804,16 Z M9.18440269,15 L14.8155973,15 C14.9340177,14.0623882 15,13.0528256 15,12 C15,10.9471744 14.9340177,9.93761183 14.8155973,9 L9.18440269,9 C9.06598229,9.93761183 9,10.9471744 9,12 C9,13.0528256 9.06598229,14.0623882 9.18440269,15 L9.18440269,15 Z M9.3349823,16 C9.85717082,18.9678295 10.9180729,21 12,21 C13.0819271,21 14.1428292,18.9678295 14.6650177,16 L9.3349823,16 L9.3349823,16 Z M3.93551965,8 L8.31375067,8 C8.65216136,5.96286383 9.24889451,4.27722486 10.0280093,3.21670804 C7.35207678,3.81488234 5.12590433,5.60465556 3.93551965,8 L3.93551965,8 Z M20.0644804,8 C18.8740957,5.60465556 16.6479232,3.81488234 13.9719907,3.21670804 C14.7511055,4.27722486 15.3478386,5.96286383 15.6862493,8 L20.0644804,8 L20.0644804,8 Z M9.3349823,8 L14.6650177,8 C14.1428292,5.03217048 13.0819271,3 12,3 C10.9180729,3 9.85717082,5.03217048 9.3349823,8 L9.3349823,8 Z M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z"/>
                                </svg>
                                WEB
                            </div>
                            <div v-if="route().current('super.admin.permision.web')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.permission.api')" :class="route().current('super.admin.permission.api') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg width="18px" height="18px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon fill-current">
                                <path d="M917.7 148.8l-42.4-42.4c-1.6-1.6-3.6-2.3-5.7-2.3s-4.1.8-5.7 2.3l-76.1 76.1a199.27 199.27 0 0 0-112.1-34.3c-51.2 0-102.4 19.5-141.5 58.6L432.3 308.7a8.03 8.03 0 0 0 0 11.3L704 591.7c1.6 1.6 3.6 2.3 5.7 2.3 2 0 4.1-.8 5.7-2.3l101.9-101.9c68.9-69 77-175.7 24.3-253.5l76.1-76.1c3.1-3.2 3.1-8.3 0-11.4zM769.1 441.7l-59.4 59.4-186.8-186.8 59.4-59.4c24.9-24.9 58.1-38.7 93.4-38.7 35.3 0 68.4 13.7 93.4 38.7 24.9 24.9 38.7 58.1 38.7 93.4 0 35.3-13.8 68.4-38.7 93.4zm-190.2 105a8.03 8.03 0 0 0-11.3 0L501 613.3 410.7 523l66.7-66.7c3.1-3.1 3.1-8.2 0-11.3L441 408.6a8.03 8.03 0 0 0-11.3 0L363 475.3l-43-43a7.85 7.85 0 0 0-5.7-2.3c-2 0-4.1.8-5.7 2.3L206.8 534.2c-68.9 69-77 175.7-24.3 253.5l-76.1 76.1a8.03 8.03 0 0 0 0 11.3l42.4 42.4c1.6 1.6 3.6 2.3 5.7 2.3s4.1-.8 5.7-2.3l76.1-76.1c33.7 22.9 72.9 34.3 112.1 34.3 51.2 0 102.4-19.5 141.5-58.6l101.9-101.9c3.1-3.1 3.1-8.2 0-11.3l-43-43 66.7-66.7c3.1-3.1 3.1-8.2 0-11.3l-36.6-36.2zM441.7 769.1a131.32 131.32 0 0 1-93.4 38.7c-35.3 0-68.4-13.7-93.4-38.7a131.32 131.32 0 0 1-38.7-93.4c0-35.3 13.7-68.4 38.7-93.4l59.4-59.4 186.8 186.8-59.4 59.4z"/>
                                </svg>
                                API
                            </div>
                            <div v-if="route().current('super.admin.permission.api')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                    </div>
                </template>
            </div>
            <!-- Bottom Status -->
            <div class="mb-5 px-5 font-second">
                <div class="rounded-2xl border border-white/5 p-5 bg-[#39BEFF]">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 v-for="position in user?.position" :key="position" class="font-semibold text-white inline">
                                |{{ position ?? 'Unrecognize position' }}
                            </h3>
                            <p class="mt-1 text-sm text-slate-200">
                                User Level {{ user?.level ?? 'Unknow' }}
                            </p>
                        </div>
                        <div class="h-3 w-3 rounded-full bg-teal-300 animate-pulse"></div>
                    </div>
                </div>
            </div>
            <!-- Profile -->
            <div class="border-t border-white/20 p-6 grid grid-cols-1 gap-y-2">
                <div class="flex items-center py-2">
                    <img :class="showset ? 'ring-2 ring-teal-400' : ''" :src="`https://ui-avatars.com/api/?background=2DD4BF&color=ffff&name=${user?.division}`" class="h-12 w-12 rounded-xl object-cover border-2 border-sky-600">
                    <div class="ml-4 flex-1">
                        <h3 class="font-semibold text-white">
                            {{ user?.division ?? 'Unrecognize division' }}
                        </h3>
                        <p class="mt-1 text-sm text-[#8FA2B6]">
                            Setting
                        </p>
                    </div>
                    <button @click="showset = !showset" type="button" class="flex max-w-max max-h-max items-center justify-center rounded-lg text-[#8FA2B6] transition hover:bg-white/10 hover:text-white">
                        <svg class="fill-current" width="20px" height="20px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.1025513,12.7783485 L16.8106554,6.0794438 C17.0871744,5.80330401 17.5303978,5.80851813 17.8006227,6.09108986 C18.0708475,6.37366159 18.0657451,6.82658676 17.7892261,7.10272655 L10.5858152,14.2962587 C10.3114043,14.5702933 9.87226896,14.5675493 9.60115804,14.2901058 L2.2046872,6.72087106 C1.93149355,6.44129625 1.93181183,5.98834118 2.20539811,5.7091676 C2.47898439,5.42999401 2.92223711,5.43031926 3.19543076,5.70989407 L10.1025513,12.7783485 Z"/>
                        </svg>
                    </button>
                </div>
                <Transition name="nested" :duration="600">
                    <div v-if="showset" class="grid grid-cols-1 gap-y-2">
                        <NavButton :href="route('profile.edit')" :class="route().current('profile.edit') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold menu-item">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,11A5,5,0,1,0,7,6,5.006,5.006,0,0,0,12,11Zm0-8A3,3,0,1,1,9,6,3,3,0,0,1,12,3ZM3,22V18a5.006,5.006,0,0,1,5-5h8a5.006,5.006,0,0,1,5,5v4a1,1,0,0,1-2,0V18a3,3,0,0,0-3-3H8a3,3,0,0,0-3,3v4a1,1,0,0,1-2,0Z"/></svg>
                                Profile
                            </div>
                            <div v-if="route().current('profile.edit')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <DropdownLink :href="route('logout')" method="post" as="button" class="text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold menu-item">
                            Log Out
                            <svg class="fill-current" width="18px" height="18px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.2392344,0 C13.3845587,0 16.2966635,1.39466883 18.2279685,3.74426305 C18.4595621,4.02601608 18.4134356,4.43777922 18.124942,4.66396176 C17.8364485,4.89014431 17.4148346,4.84509553 17.183241,4.5633425 C15.5035716,2.51988396 12.9739849,1.30841121 10.2392344,1.30841121 C5.32416443,1.30841121 1.33971292,5.19976806 1.33971292,10 C1.33971292,14.8002319 5.32416443,18.6915888 10.2392344,18.6915888 C13.0144533,18.6915888 15.5774656,17.443711 17.2546848,15.3485857 C17.4825482,15.0639465 17.9035339,15.0136047 18.1949827,15.2361442 C18.4864315,15.4586837 18.5379776,15.8698333 18.3101142,16.1544725 C16.3816305,18.5634688 13.4311435,20 10.2392344,20 C4.58426141,20 8.8817842e-14,15.5228475 8.8817842e-14,10 C8.8817842e-14,4.4771525 4.58426141,0 10.2392344,0 Z M17.0978642,7.15999289 L19.804493,9.86662172 C20.0660882,10.1282169 20.071043,10.5473918 19.8155599,10.802875 L17.17217,13.4462648 C16.9166868,13.701748 16.497512,13.6967932 16.2359168,13.435198 C15.9743215,13.1736028 15.9693667,12.7544279 16.2248499,12.4989447 L17.7715361,10.9515085 L7.46239261,10.9518011 C7.0924411,10.9518011 6.79253615,10.6589032 6.79253615,10.2975954 C6.79253615,9.93628766 7.0924411,9.64338984 7.46239261,9.64338984 L17.7305361,9.64250854 L16.1726778,8.08517933 C15.9110825,7.82358411 15.9061278,7.40440925 16.1616109,7.14892607 C16.4170941,6.89344289 16.836269,6.89839767 17.0978642,7.15999289 Z"/>
                            </svg>
                        </DropdownLink>
                    </div>
                </Transition>
            </div>
        </aside>
        <!-- Content -->
        <div class="flex flex-1 flex-col overflow-hidden bg-[#F3F8FF]">
            <!-- Header -->
            <header class="sticky top-0 z-30 flex p-3 items-center justify-between bg-white shadow-lg px-5 lg:px-6">
                <div class="flex items-center gap-4">
                    <button  @click="openSidebar"  class="max-w-max max-h-max p-1 rounded-lg text-xl transition bg-[#0B3A63] hover:bg-[#0B2E4B] lg:hidden active:scale-95">
                        <Logs size="30" class="text-[#39BEFF]" />
                    </button>
                    <slot name="header"/>
                </div>
                <div class="md:hidden">
                    <slot name="search" />
                </div>
                <div class="flex items-center gap-x-3">
                    <button class="flex h-11 w-11 items-center justify-center rounded-xl border border-[#DCE8F5] bg-white transition hover:bg-slate-50">
                        🔔
                    </button>
                    <img  :src="`https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${user?.user?.name}`"  class="h-11 w-11 rounded-xl object-cover border-2">
                    <div class="hidden lg:block">
                        <h4 class="font-semibold text-[#0F2742]">
                            {{ user?.user?.name }}
                        </h4>
                        <p class="text-sm text-[#8FA2B6]">
                            {{ user?.position[0] }}
                        </p>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="flex-1 overflow-y-auto p-5 lg:p-8 content-scroll bg-gradient scroll-smooth">
                <slot/>
            </main>
        </div>
    </div>
</template>

<style scoped>
.bg-gradient{
    background:
    radial-gradient(
        800px circle at -10% -20%,
        rgba(79,70,229,.08),
        transparent 50%
    ),
    radial-gradient(
        700px circle at 110% 10%,
        rgba(59,130,246,.06),
        transparent 45%
    ),
    radial-gradient(
        600px circle at 50% 120%,
        rgba(168,85,247,.05),
        transparent 45%
    ),
    linear-gradient(
        180deg,
        #fcfcff 0%,
        #f7f8ff 55%,
        #ffffff 100%
    );
}
.sidebar-scroll::-webkit-scrollbar {
    width: 6px;
}

.sidebar-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-scroll::-webkit-scrollbar-thumb {
    background: #173552;
    border-radius: 999px;
}

.sidebar-scroll::-webkit-scrollbar-thumb:hover {
    background: #24527F;
}

/* Firefox */
.sidebar-scroll {
    scrollbar-width: thin;
    scrollbar-color: #173552 transparent;
}
.content-scroll {
    scrollbar-width: thin;
    scrollbar-color: rgba(100,116,139,.35) transparent;
}

.content-scroll::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.content-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.content-scroll::-webkit-scrollbar-thumb {
    background: rgba(100,116,139,.35);
    border: 2px solid transparent;
    background-clip: content-box;
    border-radius: 9999px;
    transition: all .2s ease;
}

.content-scroll::-webkit-scrollbar-thumb:hover {
    background: rgba(100,116,139,.55);
    background-clip: content-box;
}

.content-scroll::-webkit-scrollbar-corner {
    background: transparent;
}
.nested-enter-active,
.nested-leave-active {
    transition: all 0.3s ease-in-out;
}

.nested-enter-active .menu-item,
.nested-leave-active .menu-item {
    transition: all 0.3s ease-in-out;
}

/* ENTER */
.nested-enter-from .menu-item {
    opacity: 0;
    transform: translateY(20px);
}

.nested-enter-active .menu-item:nth-child(2) {
    transition-delay: 300ms;
}


/* LEAVE (dari bawah ke atas) */
.nested-leave-to .menu-item {
    opacity: 0;
    transform: translateY(20px);
}

.nested-leave-active .menu-item:nth-child(1) {
    transition-delay: 300ms;
}

.nested-leave-active .menu-item:nth-child(2) {
    transition-delay: 0ms;
}
</style>