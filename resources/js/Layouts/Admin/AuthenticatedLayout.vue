<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Logs } from "lucide-vue-next";
import NavButton from "@/Components/Layout/Admin/NavButton.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props?.auth?.user;
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
    console.log(user)
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
        <!-- Sidebar -->
        <aside :class="[ sidebar ? 'translate-x-0' : '-translate-x-full', 'fixed inset-y-0 left-0 z-50 w-[308px] bg-[#06192E] border-r border-white/5 flex flex-col transition-transform duration-300 lg:translate-x-0 lg:static lg:flex']">
            <!-- Logo -->
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
            <!-- Scroll -->
            <div class="sidebar-scroll flex-1 overflow-y-auto px-5 py-6">
                <!-- Dashboard -->
                <p class="mb-4 text-[11px] font-semibold uppercase tracking-[3px] text-[#71839A]">
                    Overview
                </p>
                <NavButton :href="route('super.admin.dashboard')" :class="route().current('super.admin.dashboard') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                    <div class="flex items-center gap-x-1.5">
                        <svg class="fill-current" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-width="2" d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5ZM14 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5ZM4 16a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3ZM14 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6Z"/>
                        </svg>
                        Dashboard
                    </div>
                    <div v-if="route().current('super.admin.dashboard')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                </NavButton>
                <!-- Visitor -->
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

                    <NavButton :href="route('super.admin.attachment')" :class="route().current('super.admin.attachment') ? 'bg-[#0B3A63] text-[#39BEFF] shadow-lg shadow-cyan-500/10' : 'text-[#AEBBC9] transition hover:bg-[#0B2E4B] hover:text-white'" class="relative flex justify-between h-12 w-full items-center rounded-xl  px-4 font-semibold mb-4">
                        <div class="flex items-center gap-x-1.5">
                            <svg class="fill-current" width="18px" height="18px" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.31802 0.974872C7.94222 0.350671 8.78882 0 9.67157 0C11.5098 0 13 1.49019 13 3.32843C13 4.21118 12.6493 5.05778 12.0251 5.68198L6.26777 11.4393C5.90878 11.7983 5.42189 12 4.91421 12C3.85702 12 3 11.143 3 10.0858C3 9.5781 3.20168 9.09122 3.56066 8.73223L9.14645 3.14645L9.85355 3.85355L4.26777 9.43934C4.09632 9.61079 4 9.84332 4 10.0858C4 10.5907 4.40931 11 4.91421 11C5.15668 11 5.38921 10.9037 5.56066 10.7322L11.318 4.97487C11.7547 4.53821 12 3.94596 12 3.32843C12 2.04247 10.9575 1 9.67157 1C9.05404 1 8.46179 1.24531 8.02513 1.68198L2.09619 7.61091C1.39431 8.31279 1 9.26475 1 10.2574C1 12.3244 2.67564 14 4.74264 14C5.73525 14 6.6872 13.6057 7.38909 12.9038L13.1464 7.14645L13.8536 7.85355L8.09619 13.6109C7.20678 14.5003 6.00047 15 4.74264 15C2.12335 15 0 12.8766 0 10.2574C0 8.99953 0.49967 7.79322 1.38909 6.90381L7.31802 0.974872Z"/>
                            </svg>
                            Attachment
                        </div>
                        <div v-if="route().current('super.admin.attachment')" class="absolute right-5 h-2 w-2 rounded-full bg-cyan-400"/>
                    </NavButton>
                </div>
            </div>
            <!-- Bottom Status -->
            <div class="mb-5 px-5 font-second">
                <div class="rounded-2xl border border-white/5 p-5 bg-[#39BEFF]">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-white">
                                {{ user.division.name }}
                            </h3>
                            <p class="mt-1 text-sm text-slate-200">
                                User Level 1
                            </p>
                        </div>
                        <div class="h-3 w-3 rounded-full bg-teal-300 animate-pulse"></div>
                    </div>
                </div>
            </div>
            <!-- Profile -->
            <div class="border-t border-white/20 p-6 grid grid-cols-1 gap-y-2">
                <div class="flex items-center py-2">
                    <img :class="showset ? 'ring-2 ring-teal-400' : ''" src="https://ui-avatars.com/api/?background=2DD4BF&color=ffff&name=A" class="h-12 w-12 rounded-xl object-cover border-2 border-sky-600">
                    <div class="ml-4 flex-1">
                        <h3 class="font-semibold text-white">
                            {{ user.division.name }}
                        </h3>
                        <p class="mt-1 text-sm text-[#8FA2B6]">
                            {{ user.name }}
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
                    <img  :src="`https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${user?.name}`"  class="h-11 w-11 rounded-xl object-cover border-2">
                    <div class="hidden lg:block">
                        <h4 class="font-semibold text-[#0F2742]">
                            {{ user?.name }}
                        </h4>
                        <p class="text-sm text-[#8FA2B6]">
                            {{ user?.email }}
                        </p>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="flex-1 overflow-y-auto p-5 lg:p-8 content-scroll bg-[#F3F8FF]">
                <slot/>
            </main>
        </div>
    </div>
</template>

<style scoped>
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