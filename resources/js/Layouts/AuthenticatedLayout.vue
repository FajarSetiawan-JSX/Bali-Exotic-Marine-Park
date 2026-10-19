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
    <div class="fixed inset-0 flex overflow-hidden bg-[#F4F7FC]">
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
                <NavButton :href="route('specific.notification')" :class="route().current('specific.notification') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                    <div class="flex items-center gap-x-1.5">
                        <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10.146 3.248a2 2 0 0 1 3.708 0A7.003 7.003 0 0 1 19 10v4.697l1.832 2.748A1 1 0 0 1 20 19h-4.535a3.501 3.501 0 0 1-6.93 0H4a1 1 0 0 1-.832-1.555L5 14.697V10c0-3.224 2.18-5.94 5.146-6.752zM10.586 19a1.5 1.5 0 0 0 2.829 0h-2.83zM12 5a5 5 0 0 0-5 5v5a1 1 0 0 1-.168.555L5.869 17H18.13l-.963-1.445A1 1 0 0 1 17 15v-5a5 5 0 0 0-5-5z"/></svg>
                        Notification
                    </div>
                    <div v-if="route().current('specific.notification')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
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
                        <NavButton :href="route('super.admin.contract')" :class="route().current('super.admin.contract') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.5 7H4V8H4.5V7ZM10.5 8H11V7H10.5V8ZM4.5 4H4V5H4.5V4ZM6.5 5H7V4H6.5V5ZM10.5 0.5L10.8536 0.146447L10.7071 0H10.5V0.5ZM13.5 3.5H14V3.29289L13.8536 3.14645L13.5 3.5ZM8 11L7.64645 11.3536L8 11ZM7.5 11.5L7.72361 11.9472L7.76393 11.9271L7.8 11.9L7.5 11.5ZM4.5 8H10.5V7H4.5V8ZM4.5 5H6.5V4H4.5V5ZM12.5 14H2.5V15H12.5V14ZM2 13.5V1.5H1V13.5H2ZM2.5 1H10.5V0H2.5V1ZM13 3.5V13.5H14V3.5H13ZM10.1464 0.853553L13.1464 3.85355L13.8536 3.14645L10.8536 0.146447L10.1464 0.853553ZM2.5 14C2.22386 14 2 13.7761 2 13.5H1C1 14.3284 1.67157 15 2.5 15V14ZM12.5 15C13.3284 15 14 14.3284 14 13.5H13C13 13.7761 12.7761 14 12.5 14V15ZM2 1.5C2 1.22386 2.22386 1 2.5 1V0C1.67157 0 1 0.671574 1 1.5H2ZM5.47434 11.6581C5.58548 11.3247 5.90087 11.0164 6.30473 10.9079C6.68131 10.8067 7.16602 10.8731 7.64645 11.3536L8.35355 10.6464C7.63399 9.92688 6.78536 9.74329 6.04527 9.94212C5.33246 10.1336 4.74785 10.6753 4.52566 11.3419L5.47434 11.6581ZM7.64645 11.3536C7.67908 11.3862 7.70467 11.4154 7.72459 11.4411L8.51426 10.8275C8.46608 10.7655 8.41233 10.7052 8.35355 10.6464L7.64645 11.3536ZM7.72459 11.4411C7.80288 11.5418 7.78541 11.5732 7.78796 11.5516C7.78967 11.537 7.7944 11.5596 7.73425 11.6143C7.67364 11.6694 7.57537 11.7298 7.4445 11.7829C7.31632 11.835 7.17676 11.8719 7.05043 11.891C6.91689 11.9112 6.83111 11.9066 6.80034 11.9005C6.78307 11.8971 6.81823 11.9001 6.86923 11.9376C6.93399 11.9852 7.01512 12.0856 7.02157 12.2302C7.02428 12.2912 7.01204 12.3388 7.00112 12.3682C6.99048 12.3968 6.97957 12.4125 6.978 12.4147C6.97644 12.4169 6.99299 12.3942 7.05032 12.3478C7.16415 12.2558 7.37375 12.1221 7.72361 11.9472L7.27639 11.0528C6.8991 11.2414 6.61656 11.4126 6.42161 11.5702C6.32456 11.6487 6.23256 11.737 6.16185 11.8368C6.09446 11.932 6.01405 12.0838 6.02256 12.2747C6.03219 12.4908 6.14944 12.6496 6.27681 12.7433C6.39042 12.8268 6.51467 12.8634 6.60653 12.8815C6.79402 12.9186 7.00664 12.909 7.20002 12.8798C7.58043 12.8222 8.07231 12.6585 8.40702 12.3541C8.58139 12.1955 8.74593 11.9674 8.78111 11.6684C8.81713 11.3623 8.70679 11.0753 8.51426 10.8275L7.72459 11.4411ZM7.8 11.9C7.98368 11.7622 8.1564 11.6631 8.31798 11.5932L7.92087 10.6754C7.68075 10.7793 7.44051 10.9196 7.2 11.1L7.8 11.9ZM8.31798 11.5932C8.96891 11.3115 9.54926 11.4604 10.1444 11.7438C10.2938 11.815 10.4398 11.8926 10.5877 11.9726C10.7318 12.0506 10.884 12.1345 11.0288 12.2078C11.3038 12.347 11.6465 12.5 12 12.5V11.5C11.9065 11.5 11.7523 11.4532 11.4804 11.3156C11.3518 11.2505 11.2181 11.1768 11.0638 11.0932C10.9132 11.0117 10.7483 10.9238 10.5744 10.841C9.876 10.5084 8.96304 10.2245 7.92087 10.6754L8.31798 11.5932Z"/>
                                </svg>
                                Contract
                            </div>
                            <div v-if="route().current('super.admin.contract')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
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
                        <NavButton :href="route('super.admin.booking.methode')" :class="route().current('super.admin.booking.methode') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M13.51 4l-5-3h-1l-5 3-.49.86v6l.49.85 5 3h1l5-3 .49-.85v-6L13.51 4zm-6 9.56l-4.5-2.7V5.7l4.5 2.45v5.41zM3.27 4.7l4.74-2.84 4.74 2.84-4.74 2.59L3.27 4.7zm9.74 6.16l-4.5 2.7V8.15l4.5-2.45v5.16z"/></svg>
                                Booking Methode
                            </div>
                            <div v-if="route().current('super.admin.booking.methode')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.program')" :class="route().current('super.admin.program') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.92993 2L8.95993 3.53003C8.97993 4.34003 9.64993 5 10.4599 5H13.4799C14.3099 5 14.9799 4.32 14.9799 3.5V2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 17L15 19L17 21" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 17L22 19L20 21" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7V14" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Program
                            </div>
                            <div v-if="route().current('super.admin.program')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.program.category')" :class="route().current('super.admin.program.category') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 13C15.24 13 13 15.24 13 18C13 20.76 15.24 23 18 23C20.76 23 23 20.76 23 18C23 15.24 20.76 13 18 13ZM17.16 19.27C17.41 19.52 17.41 19.93 17.16 20.19C17.03 20.32 16.87 20.38 16.7 20.38C16.53 20.38 16.37 20.32 16.24 20.19L14.51 18.46C14.26 18.21 14.26 17.8 14.51 17.54L16.24 15.81C16.49 15.56 16.9 15.56 17.16 15.81C17.41 16.06 17.41 16.47 17.16 16.73L15.89 18L17.16 19.27ZM21.48 18.46L19.75 20.19C19.62 20.32 19.46 20.38 19.29 20.38C19.12 20.38 18.96 20.32 18.83 20.19C18.58 19.94 18.58 19.53 18.83 19.27L20.11 18L18.84 16.73C18.59 16.48 18.59 16.07 18.84 15.81C19.09 15.56 19.5 15.56 19.76 15.81L21.49 17.54C21.73 17.8 21.73 18.2 21.48 18.46Z"/>
                                <path d="M21 7.00078V11.4708C21 11.8208 20.66 12.0608 20.34 11.9408C19.23 11.5108 17.99 11.3708 16.69 11.6308C14.09 12.1508 12.02 14.2808 11.59 16.9008C11.33 18.5008 11.65 20.0108 12.38 21.2408C12.58 21.5808 12.34 22.0008 11.95 22.0008H8C4.5 22.0008 3 20.0008 3 17.0008V7.00078C3 4.34078 4.18 2.47078 6.89 2.08078C7.18 2.04078 7.44 2.27078 7.45 2.57078L7.48 3.58078C7.51 5.18078 8.86 6.50078 10.48 6.50078H13.5C15.15 6.50078 16.5 5.15078 16.5 3.50078V2.57078C16.5 2.27078 16.76 2.03078 17.05 2.07078C19.8 2.44078 21 4.32078 21 7.00078Z"/>
                                <path d="M14.9996 3V3.5C14.9996 4.32 14.3196 5 13.4996 5H10.4696C9.65963 5 8.98963 4.35 8.96963 3.54L8.95963 3.03C8.93963 2.46 9.38963 2 9.95963 2H13.9996C14.5496 2 14.9996 2.45 14.9996 3Z"/>
                                </svg>
                                Program Available
                            </div>
                            <div v-if="route().current('super.admin.program.category')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.pool')" :class="route().current('super.admin.pool') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title/>
                                    <g data-name="Layer 2" id="Layer_2">
                                    <path d="M18,18V5a3,3,0,0,0-3-3,3,3,0,0,0-3,3V6h2V5a1,1,0,0,1,1-1,1,1,0,0,1,.71.31A1,1,0,0,1,16,5V7H8V5a2.92,2.92,0,0,0-.87-2.11A2.94,2.94,0,0,0,5,2,3,3,0,0,0,2,5V6H4V5A1,1,0,0,1,5,4a1,1,0,0,1,.71.31A1,1,0,0,1,6,5V20H6c-.56,0-.8-.22-1.29-.71A3.56,3.56,0,0,0,2,18v2c.56,0,.8.22,1.29.71A3.56,3.56,0,0,0,6,22,3.56,3.56,0,0,0,8.7,20.71c.49-.49.73-.71,1.29-.71s.8.22,1.29.71a3.48,3.48,0,0,0,5.42,0c.49-.49.73-.71,1.3-.71s.8.22,1.29.71A3.57,3.57,0,0,0,22,22V20c-.56,0-.8-.22-1.29-.71A3.57,3.57,0,0,0,18,18Zm-2-3H8V13h8Zm0-6v2H8V9ZM14,20c-.56,0-.8-.22-1.29-.71A3.56,3.56,0,0,0,10,18a3.2,3.2,0,0,0-2,.65V17h8v1.65a6.48,6.48,0,0,0-.71.64C14.79,19.78,14.55,20,14,20Z"/>
                                    </g>
                                </svg>
                                Pool
                            </div>
                            <div v-if="route().current('super.admin.pool')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                        </NavButton>
                        <NavButton :href="route('super.admin.mamal')" :class="route().current('super.admin.mamal') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                            <div class="flex items-center gap-x-1.5">
                                <svg class="fill-current" width="18px" height="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                <path d="M17.3890829,4.60305058 C20.0880643,3.58920045 22.95837,3.08227539 26,3.08227539 C29.04163,3.08227539 31.9119357,3.58920045 34.6109171,4.60305058 C35.4598238,3.05190158 37.1070695,2 39,2 C41.7614237,2 44,4.23857625 44,7 C44,7.82153519 43.8018664,8.5967938 43.4507773,9.28059773 C44.6893037,10.3202506 45.5390445,13.5600514 46,19 C46.3942871,22.0083008 48.9873047,31.0666504 49,33 C49.0522637,40.9591521 41.385597,46.6258188 26,50 C10.6666667,46.7063802 3,41.0397135 3,33 C3.04736328,30.9470215 5.49975586,22.1008301 6,19 C6.60252733,13.7112015 7.47002244,10.5050274 8.60248532,9.38147786 C8.21823697,8.67344093 8,7.86220645 8,7 C8,4.23857625 10.2385763,2 13,2 C14.8929305,2 16.5401762,3.05190158 17.3890829,4.60305058 Z M20.9679344,22.6949428 C19.2115289,23.2457145 18.0577532,24.92405 18.1725751,26.7612016 L18.563352,33.013632 C18.8087908,36.9406527 22.0653168,40 26,40 C29.9346832,40 33.1912092,36.9406527 33.436648,33.013632 L33.8190397,26.8953652 C33.93443,25.0491197 32.7688091,23.3645882 31.0003642,22.821873 C29.2149747,22.2739577 27.4300226,22 25.6455078,22 C24.0045692,22 22.4453781,22.2316476 20.9679344,22.6949428 Z M36,23 C37.6568542,23 39,21.209139 39,19 C39,16.790861 37.6568542,15 36,15 C34.3431458,15 33,16.790861 33,19 C33,21.209139 34.3431458,23 36,23 Z M16,23 C17.6568542,23 19,21.209139 19,19 C19,16.790861 17.6568542,15 16,15 C14.3431458,15 13,16.790861 13,19 C13,21.209139 14.3431458,23 16,23 Z M29.0736299,27.7089195 C27.3059198,29.7387833 24.4498682,29.7306529 22.7268765,27.6908335 C21.0039682,25.6510141 22.4503068,23.9901712 25.9410086,24.0000438 C29.4317105,24.0099164 30.8413399,25.6788897 29.0736299,27.7089195 Z"/>
                                </svg>
                                Mammal
                            </div>
                            <div v-if="route().current('super.admin.mamal')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
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
                        <template v-if="user?.web?.includes('daily.patrols')">
                            <NavButton :href="route('daily.patrols')" :class="route().current('daily.patrols') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
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
                                <div v-if="route().current('daily.patrols')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
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
                        <template v-if="user?.web?.includes('incidents')">
                            <NavButton :href="route('incidents')" :class="route().current('incidents') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" viewBox="0 0 24 24" version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg"><path d="M21.171 15.398l-5.912-9.854c-.776-1.293-1.963-2.033-3.259-2.033s-2.483.74-3.259 2.031l-5.912 9.856c-.786 1.309-.872 2.705-.235 3.83.636 1.126 1.878 1.772 3.406 1.772h12c1.528 0 2.77-.646 3.406-1.771.637-1.125.551-2.521-.235-3.831zm-9.171 2.151c-.854 0-1.55-.695-1.55-1.549 0-.855.695-1.551 1.55-1.551s1.55.696 1.55 1.551c0 .854-.696 1.549-1.55 1.549zm1.633-7.424c-.011.031-1.401 3.468-1.401 3.468-.038.094-.13.156-.231.156s-.193-.062-.231-.156l-1.391-3.438c-.09-.233-.129-.443-.129-.655 0-.965.785-1.75 1.75-1.75s1.75.785 1.75 1.75c0 .212-.039.422-.117.625z"/></svg>
                                    Incident
                                </div>
                                <div v-if="route().current('incidents')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton> 
                        </template>
                        <template v-if="user?.web?.includes('specific.bookings')">
                            <NavButton :href="route('specific.bookings')" :class="route().current('specific.bookings') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M9,10a1,1,0,0,0-1,1v2a1,1,0,0,0,2,0V11A1,1,0,0,0,9,10Zm12,1a1,1,0,0,0,1-1V6a1,1,0,0,0-1-1H3A1,1,0,0,0,2,6v4a1,1,0,0,0,1,1,1,1,0,0,1,0,2,1,1,0,0,0-1,1v4a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V14a1,1,0,0,0-1-1,1,1,0,0,1,0-2ZM20,9.18a3,3,0,0,0,0,5.64V17H10a1,1,0,0,0-2,0H4V14.82A3,3,0,0,0,4,9.18V7H8a1,1,0,0,0,2,0H20Z"/></svg>
                                    Booking
                                </div>
                                <div v-if="route().current('specific.bookings')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <template v-if="user?.web?.includes('security.delivery')">
                            <NavButton :href="route('security.delivery')" :class="route().current('security.delivery') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M19.8292943,16 L21,16 L21,12.5351838 L18.2243368,10.6847416 L16.381966,7 L3,7 L3,16 L4.17070571,16 C4.58254212,14.8348076 5.69378117,14 7,14 C8.30621883,14 9.41745788,14.8348076 9.82929429,16 L14.1707057,16 C14.5825421,14.8348076 15.6937812,14 17,14 C18.3062188,14 19.4174579,14.8348076 19.8292943,16 Z M19.8292943,18 C19.4174579,19.1651924 18.3062188,20 17,20 C15.6937812,20 14.5825421,19.1651924 14.1707057,18 L9.82929429,18 C9.41745788,19.1651924 8.30621883,20 7,20 C5.69378117,20 4.58254212,19.1651924 4.17070571,18 L3,18 C1.8954305,18 1,17.1045695 1,16 L1,7 C1,5.8954305 1.8954305,5 3,5 L16.381966,5 C17.1395101,5 17.8320364,5.42800475 18.1708204,6.10557281 L19.7756632,9.31525835 L23,11.4648162 L23,16 C23,17.1045695 22.1045695,18 21,18 L19.8292943,18 Z M7,18 C7.55228475,18 8,17.5522847 8,17 C8,16.4477153 7.55228475,16 7,16 C6.44771525,16 6,16.4477153 6,17 C6,17.5522847 6.44771525,18 7,18 Z M17,18 C17.5522847,18 18,17.5522847 18,17 C18,16.4477153 17.5522847,16 17,16 C16.4477153,16 16,16.4477153 16,17 C16,17.5522847 16.4477153,18 17,18 Z"/>
                                    </svg>
                                    Delivery
                                </div>
                                <div v-if="route().current('security.delivery')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <template v-if="user?.web?.includes('specific.diet')">
                            <NavButton :href="route('specific.diet')" :class="route().current('specific.diet') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                                    <path d="M17.3890829,4.60305058 C20.0880643,3.58920045 22.95837,3.08227539 26,3.08227539 C29.04163,3.08227539 31.9119357,3.58920045 34.6109171,4.60305058 C35.4598238,3.05190158 37.1070695,2 39,2 C41.7614237,2 44,4.23857625 44,7 C44,7.82153519 43.8018664,8.5967938 43.4507773,9.28059773 C44.6893037,10.3202506 45.5390445,13.5600514 46,19 C46.3942871,22.0083008 48.9873047,31.0666504 49,33 C49.0522637,40.9591521 41.385597,46.6258188 26,50 C10.6666667,46.7063802 3,41.0397135 3,33 C3.04736328,30.9470215 5.49975586,22.1008301 6,19 C6.60252733,13.7112015 7.47002244,10.5050274 8.60248532,9.38147786 C8.21823697,8.67344093 8,7.86220645 8,7 C8,4.23857625 10.2385763,2 13,2 C14.8929305,2 16.5401762,3.05190158 17.3890829,4.60305058 Z M20.9679344,22.6949428 C19.2115289,23.2457145 18.0577532,24.92405 18.1725751,26.7612016 L18.563352,33.013632 C18.8087908,36.9406527 22.0653168,40 26,40 C29.9346832,40 33.1912092,36.9406527 33.436648,33.013632 L33.8190397,26.8953652 C33.93443,25.0491197 32.7688091,23.3645882 31.0003642,22.821873 C29.2149747,22.2739577 27.4300226,22 25.6455078,22 C24.0045692,22 22.4453781,22.2316476 20.9679344,22.6949428 Z M36,23 C37.6568542,23 39,21.209139 39,19 C39,16.790861 37.6568542,15 36,15 C34.3431458,15 33,16.790861 33,19 C33,21.209139 34.3431458,23 36,23 Z M16,23 C17.6568542,23 19,21.209139 19,19 C19,16.790861 17.6568542,15 16,15 C14.3431458,15 13,16.790861 13,19 C13,21.209139 14.3431458,23 16,23 Z M29.0736299,27.7089195 C27.3059198,29.7387833 24.4498682,29.7306529 22.7268765,27.6908335 C21.0039682,25.6510141 22.4503068,23.9901712 25.9410086,24.0000438 C29.4317105,24.0099164 30.8413399,25.6788897 29.0736299,27.7089195 Z"/>
                                    </svg>
                                    Diet Plan
                                </div>
                                <div v-if="route().current('specific.diet')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <template v-if="user?.web?.includes('specific.work.order')">
                            <NavButton :href="route('specific.work.order')" :class="route().current('specific.work.order') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current icon" viewBox="0 0 1024 1024"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M53.6 1023.2c-6.4 0-12.8-2.4-17.6-8-4.8-4.8-7.2-11.2-6.4-18.4L80 222.4c0.8-12.8 11.2-22.4 24-22.4h211.2v-3.2c0-52.8 20.8-101.6 57.6-139.2C410.4 21.6 459.2 0.8 512 0.8c108 0 196.8 88 196.8 196.8 0 0.8-0.8 1.6-0.8 2.4v0.8H920c12.8 0 23.2 9.6 24 22.4l49.6 768.8c0.8 2.4 0.8 4 0.8 6.4-0.8 13.6-11.2 24.8-24.8 24.8H53.6z m25.6-48H944l-46.4-726.4H708v57.6h0.8c12.8 8.8 20 21.6 20 36 0 24.8-20 44.8-44.8 44.8s-44.8-20-44.8-44.8c0-14.4 7.2-27.2 20-36h0.8v-57.6H363.2v57.6h0.8c12.8 8.8 20 21.6 20 36 0 24.8-20 44.8-44.8 44.8-24.8 0-44.8-20-44.8-44.8 0-14.4 7.2-27.2 20-36h0.8v-57.6H125.6l-46.4 726.4zM512 49.6c-81.6 0-148.8 66.4-148.8 148.8v3.2h298.4l-0.8-1.6v-1.6c0-82.4-67.2-148.8-148.8-148.8z" /></svg>
                                    Work Order
                                </div>
                                <div v-if="route().current('specific.work.order')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <template v-if="user?.web?.includes('specific.purchase.order')">
                            <NavButton :href="route('specific.purchase.order')" :class="route().current('specific.purchase.order') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                    <g id="Solid">
                                    <path d="M8,8H5A3,3,0,0,1,5,2H8a2.9938,2.9938,0,0,1,2.84111,2.08154A4.48267,4.48267,0,0,1,14.44332,7.833L15.30464,14h6.69529v6H14.12361L12.46285,8.11035a2.46006,2.46006,0,0,0-1.6878-1.97967A3.00169,3.00169,0,0,1,8,8ZM47.99984,40a.99943.99943,0,0,1-1,1H45.23807a4.48671,4.48671,0,0,1-7.2382,5.29352A4.48728,4.48728,0,0,1,30.76168,41H26.23813a4.4867,4.4867,0,0,1-7.23819,5.29352,4.48037,4.48037,0,0,1-7.09952-5.46643A3.98929,3.98929,0,0,1,13,33h2.93957l-.55872-4h6.61912v4h2V29h6v4h2V29h6v4h2V29h5.50761l-.77228,3.62109A3.03255,3.03255,0,0,1,41.77525,35H13a2,2,0,0,0,0,4H46.99984A.99943.99943,0,0,1,47.99984,40Zm-12,3.5a1.5,1.5,0,1,0-1.5,1.5A1.50164,1.50164,0,0,0,35.99988,43.5Zm7,0a1.5,1.5,0,1,0-1.5,1.5A1.50164,1.50164,0,0,0,42.99986,43.5Zm-25.99991,0A1.5,1.5,0,1,0,15.5,45,1.50164,1.50164,0,0,0,16.99995,43.5Zm7,0a1.5,1.5,0,1,0-1.5,1.5A1.50164,1.50164,0,0,0,23.99992,43.5Zm6.98045-33.30371A1.00025,1.00025,0,0,0,30.287,9.042l-10-3a.99986.99986,0,0,0-1.25683.71582L17.71967,12h12.9Zm1.96093.39355L32.65919,12h5.34068V3a.99942.99942,0,0,0-1-1h-12a.99943.99943,0,0,0-1,1V5.06757L30.86123,7.126A2.98711,2.98711,0,0,1,32.9413,10.58984Zm12.05855,1.41162V6a.99943.99943,0,0,0-1-1h-4v7h4.97361ZM23.99992,27h6V22h-6Zm6-13h-6v6h6Zm-8,13V22H14.403l.69843,5ZM37.99987,14h-6v6h6Zm9.93454,3.62012a2.97173,2.97173,0,0,0-.60156-2.498A3.02179,3.02179,0,0,0,44.97348,14H39.99987v6h7.427ZM47.00033,22H39.99987v5H45.934ZM31.99989,27h6V22h-6Z"/>
                                    </g>
                                    </svg>
                                    Purchase Order
                                </div>
                                <div v-if="route().current('specific.purchase.order')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <template v-if="user?.web?.includes('specific.healthchecks')">
                            <NavButton :href="route('specific.healthchecks')" :class="route().current('specific.healthchecks') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m17.355 20.131 2.616-.146.153-2.615-4.978-4.978-2.767 2.762z"/><path d="m10.236 1.607-1.553 1.553-2.016-2.016c-.715-.765-1.73-1.242-2.856-1.242-2.157 0-3.906 1.749-3.906 3.906 0 1.126.477 2.141 1.24 2.854l.002.002 2.017 2.016-1.553 1.553 1.967 1.967 1.663-1.664 11.532 11.531 3.653-.207 2.136 2.136 1.45-1.45-2.136-2.136.207-3.653-11.531-11.531 1.664-1.664zm10.3 18.948-3.266.186-11.112-11.112 3.453-3.453 11.112 11.112z"/></svg>
                                    Blood Check
                                </div>
                                <div v-if="route().current('specific.healthchecks')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <template v-if="user?.web?.includes('specific.mammal.report')">
                            <NavButton :href="route('specific.mammal.report')" :class="route().current('specific.mammal.report') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" viewBox="0 0 512 512" id="icon" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g>
                                        <path d="M119.1818008,326.2879944c0.1753006,0.0464172,0.3169022,0.1577148,0.5004959,0.1860046   c0.0713043,0.0103149,0.135704-0.0176086,0.2065048-0.0097046c6.4304962,1.5917969,13.0685959,2.503418,19.8577042,2.503418   c20.6362,0,40.0484009-7.5381165,55.2206879-21.331604c15.1697083,13.7934875,34.5818024,21.331604,55.2180023,21.331604   c22.213913,0,43.3108063-8.9453125,58.7598114-24.7359009c13.2020874,13.4892883,30.5336914,21.9277954,49.148407,24.1166992   c0.015686,0,0.0287781,0.0087891,0.0446777,0.0087891c0.0037231,0,0.0068054,0,0.010498,0   c3.1577148,0.3687134,6.3403015,0.6104126,9.5586243,0.6104126c24.2138977,0,47.1056824-10.6319275,62.8029785-29.1753235   c1.8911133-2.2353821,1.6141968-5.577179-0.6208801-7.4711914c-2.2273254-1.8778992-5.5800171-1.6138-7.4660034,0.6210938   c-13.6822205,16.1631165-33.625,25.4291992-54.716095,25.4291992c-1.5027161,0-2.9824219-0.1508789-4.471405-0.2442017   c-0.7820129-22.6898804-2.0447083-125.0365906,35.010498-189.3568878   c7.7785034-13.5038986,5.2096863-21.9009018,1.6835938-26.5630035   c-11.2529907-14.9057007-43.718811-9.4057007-62.0682068-4.8012009   C263.5436096,116.0541,139.2509003,191.240097,116.3809967,314.4031982   c-10.0682983-3.4692078-19.3356934-9.1185913-27.1158981-16.8407898c-2.0822983-2.0644226-5.4328995-2.0537109-7.4944,0.0312805   c-2.0590973,2.074707-2.046402,5.4272156,0.0283051,7.4916992   C92.3201981,315.5263062,105.1932983,322.6947021,119.1818008,326.2879944z M340.4406128,107.6868973   c29.2350769-7.3471985,46.6996765-4.8378983,51.0351868,0.905304c2.8924866,3.8281021,0.2849121,10.2080002-2.4136047,14.8900986   C351.0541077,189.4608002,351.648407,289.90271,352.5606995,316.734314   c-15.2969055-3.3115234-29.2279968-11.5698242-39.5725098-23.7920227c-2.0126953-2.3695984-6.0739746-2.3695984-8.0867004,0   c-13.6766968,16.1631165-33.6195984,25.4291992-54.7162933,25.4291992c-19.5131989,0-37.771698-7.7397766-51.4152985-21.7973938   c-0.9981995-1.0292969-2.3692932-1.6088867-3.8027039-1.6088867c-1.4332886,0-2.8043976,0.5795898-3.800293,1.6088867   c-13.6461945,14.0576172-31.907196,21.7973938-51.4203949,21.7973938c-4.4446106,0-8.819809-0.4408875-13.1018066-1.2299805   C148.1994019,198.3690033,268.5340881,125.7265015,340.4406128,107.6868973z"/>
                                        <path d="M422.4233093,343.5379944c-13.6822205,16.1625977-33.625,25.4291992-54.716095,25.4291992   c-21.0940247,0-41.0393066-9.2666016-54.7190247-25.4291992c-2.0126953-2.3700867-6.0739746-2.3700867-8.0867004,0   c-13.6766968,16.1625977-33.6195984,25.4291992-54.7162933,25.4291992c-19.5131989,0-37.771698-7.7402039-51.4152985-21.7978821   c-0.9981995-1.0292969-2.3692932-1.6088257-3.8027039-1.6088257c-1.4332886,0-2.8043976,0.5795288-3.800293,1.6088257   c-13.6461945,14.0576782-31.907196,21.7978821-51.4203949,21.7978821c-19.0322037,0-36.9595032-7.3887024-50.4814072-20.8096008   c-2.0822983-2.059082-5.4328995-2.0487976-7.4944,0.031311c-2.0590973,2.074707-2.046402,5.4271851,0.0283051,7.4921875   c15.5219955,15.4023132,36.1007996,23.8822937,57.9475021,23.8822937c20.6362,0,40.0484009-7.5385742,55.2206879-21.3320923   c15.1697083,13.7935181,34.5818024,21.3320923,55.2180023,21.3320923c22.213913,0,43.3108063-8.9457703,58.7598114-24.7362976   c15.4541016,15.7905273,36.5507813,24.7362976,58.762207,24.7362976c24.2138977,0,47.1056824-10.6322937,62.8029785-29.1757813   c1.8911133-2.2348938,1.6141968-5.5776062-0.6208801-7.4711914   C427.6619873,341.0331116,424.3092957,341.3026123,422.4233093,343.5379944z"/>
                                        <path d="M422.4233093,394.1326904c-13.6822205,16.1631165-33.625,25.429718-54.716095,25.429718   c-21.0940247,0-41.0393066-9.2666016-54.7190247-25.429718c-2.0126953-2.3695984-6.0739746-2.3695984-8.0867004,0   c-13.6766968,16.1631165-33.6195984,25.429718-54.7162933,25.429718c-19.5131989,0-37.771698-7.7402039-51.4152985-21.7973938   c-0.9981995-1.0297241-2.3692932-1.609314-3.8027039-1.609314c-1.4332886,0-2.8043976,0.5795898-3.800293,1.609314   c-13.6461945,14.0571899-31.907196,21.7973938-51.4203949,21.7973938c-19.0322037,0-36.9595032-7.3882141-50.4814072-20.8091125   c-2.0822983-2.0649109-5.4328995-2.0541992-7.4944,0.0307922c-2.0590973,2.074707-2.046402,5.4272156,0.0283051,7.4916992   c15.5219955,15.4028015,36.1007996,23.8828125,57.9475021,23.8828125c20.6362,0,40.0484009-7.5386047,55.2206879-21.3320007   c15.1697083,13.793396,34.5818024,21.3320007,55.2180023,21.3320007c22.213913,0,43.3108063-8.9458008,58.7598114-24.7367859   c15.4541016,15.7909851,36.5507813,24.7367859,58.762207,24.7367859c24.2138977,0,47.1056824-10.6322937,62.8029785-29.175293   c1.8911133-2.235321,1.6141968-5.5776062-0.6208801-7.4712219   C427.6619873,391.6336975,424.3092957,391.8978882,422.4233093,394.1326904z"/>
                                        <path d="M168.7695007,283.2825928c0.5043945,0.1499023,1.0113983,0.2227173,1.5133972,0.2227173   c2.283905,0,4.3899078-1.4849243,5.0751953-3.7875977c1.4463043-4.8579102,3.1382141-9.7368164,5.0317078-14.4916992   c1.0812988-2.7217102-0.2456055-5.8003235-2.9645996-6.8814087c-2.7136078-1.0863953-5.7973022,0.2431946-6.8811035,2.9595032   c-2.0099945,5.0552063-3.8054047,10.2284851-5.3423004,15.3920898   C164.3688049,279.5003967,165.9649963,282.449585,168.7695007,283.2825928z"/>
                                        <path d="M188.8515015,236.102005c0.8798981,0.5643921,1.862793,0.8280945,2.8354034,0.8280945   c1.753891,0,3.4692993-0.8692017,4.478302-2.4575043c26.5597992-41.8154907,72.9718781-78.4824982,124.1519012-98.0917969   c2.7319031-1.0449982,4.0979004-4.1078949,3.0499878-6.8399048c-1.0476074-2.7367935-4.1159058-4.1024933-6.8422852-3.0521927   c-53.2286987,20.3900986-101.5686035,58.6352005-129.3054047,102.3026962   C185.6515045,231.259201,186.3813019,234.5346069,188.8515015,236.102005z"/>
                                        <path d="M342.9371948,128.9564056c0.4189148,0,0.8435059-0.0463104,1.2677917-0.1552124   c4.6021118-1.1279907,9.0075989-1.9970932,13.0974121-2.5766907c2.8974915-0.4140015,4.9101868-3.0937042,4.4989929-5.9912033   c-0.416687-2.8974991-3.138092-4.910202-5.9940796-4.501503c-4.4338074,0.6314011-9.1890259,1.5679016-14.1271973,2.7842026   c-2.8430176,0.6929016-4.5815125,3.5644989-3.8831177,6.405304   C338.3919983,127.3373032,340.5545959,128.9564056,342.9371948,128.9564056z"/>
                                        <path d="M179.6470947,150.3450928c0.3492126,0.0674133,0.6988068,0.1035004,1.0455017,0.1035004   c1.8339081,0,3.5673065-0.9515991,4.5400085-2.5658875c0.1266937-0.2124023,13.0665894-21.4199066,33.9120941-31.0952072   c8.2987976-3.8544998,13.2837067-10.0424957,13.6797028-16.9756012c0.3414917-5.9447937-2.7319031-11.4960938-8.2187958-14.8539963   c-7.750412-4.733902-18.3979034-4.0461044-28.4794006,1.8676987   c-26.6661072,15.6201019-20.933609,57.3212967-20.6773071,59.0858994   C175.7718964,148.1307983,177.4510956,149.9002991,179.6470947,150.3450928z M201.4810944,95.9627991   c4.0098114-2.3490982,7.9910126-3.5493011,11.4756012-3.5493011c2.2998047,0,4.3848114,0.5273056,6.1209106,1.5884018   c2.0980988,1.2778015,3.2826996,3.2285004,3.1687012,5.2050018c-0.1653137,2.9072952-2.923111,5.8149948-7.5640106,7.9673004   c-12.6269989,5.8622971-22.550293,15.1753006-29.1625977,22.7548904   C186.1611023,118.3915024,189.4338074,103.0252991,201.4810944,95.9627991z"/>
                                        <path d="M155.4620972,179.5359955c0.046402,0,0.0828094,0,0.1035004,0   c1.7953949-0.0361023,3.4329071-1.0135956,4.3798981-2.5350952c0.9490051-1.5263977,1.0422058-3.4662933,0.2817078-5.0908051   c-0.0437012-0.0932922-4.4365082-9.8305969,0.403595-30.9346008c2.5299988-11.0312958-1.9790039-16.0287933-4.8894043-18.0312958   c-4.9279938-3.3783951-12.0780945-2.8920975-18.2118988,1.2471008   c-6.6201019,4.4649048-12.6681976,13.8710938-9.7941971,26.8784027   C133.8845062,178.884201,153.6513062,179.5359955,155.4620972,179.5359955z M143.4559937,132.9765015   c1.7126007-1.1538086,3.4538116-1.6708984,4.7444-1.6708984c0.6523132,0,1.1875,0.134201,1.5444031,0.3773956   c0.8567047,0.5899048,1.5133972,2.7525024,0.5590973,6.9228973c-2.8146973,12.2671051-2.9049988,21.368103-2.1964874,27.6025085   c-3.7044067-2.5923004-7.8592072-7.6265106-10.0242004-17.4258118   C135.9073944,138.9472046,141.6452026,134.1972046,143.4559937,132.9765015z"/>
                                        </g>
                                    </svg>
                                    Mamals Report
                                </div>
                                <div v-if="route().current('specific.mammal.report')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                            </NavButton>
                        </template>
                        <template v-if="user?.web?.includes('specific.bookings')">
                            <NavButton :href="route('specific.bookings')" :class="route().current('specific.bookings') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                                <div class="flex items-center gap-x-1.5">
                                    <svg height="18px" width="18px" class="fill-current" viewBox="0 0 56 56" id="Layer_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g>
                                        <path d="M28,39.1c-3.7,0-12.3,0.3-12.3,3c0,2.7,8.6,3,12.3,3s12.3-0.3,12.3-3C40.3,39.4,31.7,39.1,28,39.1z M28,43.2   c-5,0-8.3-0.6-9.7-1c1.4-0.5,4.7-1,9.7-1s8.3,0.6,9.7,1C36.3,42.7,33,43.2,28,43.2z"/>
                                        <path d="M28,31.4c-14,0-25,4.7-25,10.8S14,53,28,53s25-4.7,25-10.8S42,31.4,28,31.4z M28,51c-13.8,0-23-4.6-23-8.8s9.2-8.8,23-8.8   s23,4.6,23,8.8S41.8,51,28,51z"/>
                                        <path d="M28,35.3c-9,0-18.6,2.4-18.6,6.9c0,4.5,9.6,6.9,18.6,6.9s18.6-2.4,18.6-6.9C46.6,37.7,37,35.3,28,35.3z M28,47.1   c-10.3,0-16.6-2.9-16.6-4.9c0-2.1,6.3-4.9,16.6-4.9s16.6,2.9,16.6,4.9C44.6,44.2,38.3,47.1,28,47.1z"/>
                                        <path d="M29.1,28.3c5,0,9.1-4.1,9.1-9c0-4.6-7.4-14.7-8.3-15.8C29.7,3.1,29.4,3,29.1,3c0,0,0,0,0,0c-0.3,0-0.6,0.1-0.8,0.4   C27.4,4.5,20,14.6,20,19.2C20,24.2,24.1,28.3,29.1,28.3z M29.1,5.7c2.5,3.5,7.1,10.5,7.1,13.5c0,3.9-3.2,7-7.1,7c-3.9,0-7-3.2-7-7   C22,16.2,26.6,9.2,29.1,5.7z"/>
                                        <path d="M29.1,23.3c0.6,0,1-0.4,1-1s-0.4-1-1-1c-1.1,0-2-0.9-2-2c0-0.6-0.4-1-1-1s-1,0.4-1,1C25,21.4,26.8,23.3,29.1,23.3z"/>
                                        </g>
                                    </svg>
                                    Pool Plan
                                </div>
                                <div v-if="route().current('specific.bookings')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
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
            <div class="mb-5 px-5 font-second">
                <div class="rounded-2xl border border-white/5 p-5 bg-[#39BEFF]">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-white inline">
                                {{ user.position ?? 'Unrecognize position' }}
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
                    <img  :src="user?.user?.profile ? `storage/${user?.user?.profile}` : `https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${user?.user?.name}`"  class="h-11 w-11 rounded-xl object-cover border-2">
                    <div class="hidden lg:block">
                        <h4 class="font-semibold text-[#0F2742]">
                            {{ user?.user?.name }}
                        </h4>
                        <p class="text-sm text-[#8FA2B6]">
                            {{ user?.position }}
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