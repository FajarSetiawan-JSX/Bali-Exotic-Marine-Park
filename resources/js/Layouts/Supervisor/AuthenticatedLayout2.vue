<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { LayoutDashboard, ChevronLeft, ClipboardCheck, Search, User, LogOut, CircleChevronDown, ChevronDown } from "lucide-vue-next";
import NavButton from '@/Components/Layout/Supervisor/NavButton.vue';

const user = usePage().props?.auth?.user;
const sidebar = ref(true);
const showText = ref(true);
const dropdown = ref(false);
const dropdownRef = ref(null);
const toggleSidebar = () => {
    if (sidebar.value) {
        showText.value = false

        setTimeout(() => {
            sidebar.value = false
        }, 150)
    } else {
        sidebar.value = true

        setTimeout(() => {
            showText.value = true
        }, 300)
    }
}
const handleClickOutside = (event) => {
    if (!dropdownRef.value) return;

    if (!dropdownRef.value.contains(event.target)) {
        dropdown.value = false;
    }
};
onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});
console.log(user)
</script>

<template>
    <div class="w-full h-screen bg-slate-200 flex relative lg:static">
        <aside :class="!sidebar ? 'w-40' : 'w-80'" class="hidden lg:flex lg:flex-col gap-y-4 lg:relative h-full py-7 rounded-r-4xl bg-gradient-to-b from-[#7165F8] via-[#4978FF] to-[#15B9FF] transition-all duration-300 ease-in-out">
            <div class="pointer-events-none absolute -left-24 -top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"/>
            <div class="pointer-events-none absolute bottom-0 right-0 h-80 w-80 rounded-full bg-cyan-300/10 blur-3xl"/>
            <div class="mx-4">
                <div class="backdrop-blur-lg w-full p-1 rounded-lg relative">
                    <div class="w-full flex items-center justify-start gap-x-3">
                        <div class="h-16 w-16 rounded-2xl bg-contain bg-white bg-no-repeat bg-center" style="background-image: url('/EXOTIC.png');"/>
                        <div class="flex justify-between items-center">
                            <div  class="overflow-hidden whitespace-nowrap transition-all duration-300 ease-in-out" :class="sidebar ? 'opacity-100 w-40 translate-x-0' : 'opacity-0 w-0 -translate-x-4'">
                                <h2 class="text-xl font-exotic1 font-bold text-sky-200">
                                    Bali Exotic
                                </h2>
                                <p class="text-sm font-exotic2 text-blue-100">
                                    Marine Park
                                </p>
                            </div>
                            <button type="button" @click="toggleSidebar" class=" bg-white/30 backdrop-blur-lg rounded-full active:scale-95 transition-all duration-300">
                                <ChevronLeft size="30" :class="!sidebar ? 'rotate-180' : ' rotate-0'" class="text-white transition-all duration-300 delay-300"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ml-4 overflow-y-scroll max-h-[450px] menu max-w-max overflow-x-hidden mt-5">
                <div class="pr-4 text-white/80 font-second">
                    <p class="text-sm tracking-widest mb-2">Overview</p>
                    <NavButton :href="route('supervisor.dashboard')" :class="[sidebar ? 'w-full gap-x-3' : 'max-w-max', route().current('supervisor.dashboard') ? 'bg-white/20' : '']" class="p-3 rounded-2xl flex justify-start items-center active:scale-95 group">
                        <div class="p-3 group-hover:bg-white/30 rounded-2xl transition-all duration-200">
                            <LayoutDashboard size="30" class="text-white" />
                        </div>
                        <p class="text-md transition-all duration-300 ease-in-out" :class="sidebar ? 'opacity-100 w-40 translate-x-0' : 'opacity-0 w-0 -translate-x-4'">Dashboard</p>
                    </NavButton>
                    <NavButton :href="route('supervisor.report')" :class="[sidebar ? 'w-full gap-x-3' : 'max-w-max', route().current('supervisor.report') ? 'bg-white/20' : '']" class="p-3 rounded-2xl flex justify-start items-center active:scale-95 group">
                        <div class="p-3 group-hover:bg-white/30 rounded-2xl transition-all duration-200">
                            <ClipboardCheck size="30" class="text-white" />
                        </div>
                        <p class="text-md transition-all duration-300 ease-in-out" :class="sidebar ? 'opacity-100 w-40 translate-x-0' : 'opacity-0 w-0 -translate-x-4'">Report</p>
                    </NavButton>
                </div>
            </div>
            <footer class="mt-auto mx-4">
                <div :class="sidebar ? 'w-full gap-x-3' : 'max-w-max'" class="flex items-center justify-start bg-white/20 backdrop-blur-lg p-2 rounded-2xl transition-all duration-300 font-second">
                    <img :src="user?.profile ? `${user?.profile}` : `https://ui-avatars.com/api/?background=FFFFFF&color=3567FF&name=${user?.first_name}`" alt="" class="w-16 h-16 bg-white rounded-2xl">
                    <div  class="overflow-hidden whitespace-nowrap text-white transition-all duration-300 ease-in-out" :class="sidebar ? 'opacity-100 w-40 translate-x-0' : 'opacity-0 w-0 -translate-x-4'">
                        <h2 class="text-md font-semibold uppercase">
                            {{ user?.first_name ?? 'Supervisor' }}
                        </h2>
                        <p class="text-sm font-exotic2">
                            {{ user?.division?.name ?? 'Supervisor' }}
                        </p>
                    </div>
                </div>
            </footer>
        </aside>
        <div class="w-full h-full p-4 relative">
            <div class="px-5 py-3 bg-white rounded-2xl border-1 border-slate-300 flex items-center justify-center sm:justify-between font-second">
                <h1 class="">Dashboard</h1>
                <div class="flex items-center justify-start gap-0.5 px-2 rounded-lg border-1 max-w-sm focus-within:border-sky-500 focus-within:ring-1 focus-within:ring-sky-300">
                    <Search size="20" class="text-slate-400" />
                    <input type="search" class="border-0 focus:ring-0" placeholder="search">
                </div>
                <button ref="dropdownRef" @click="dropdown = !dropdown" class="rounded-2xl hidden sm:block md:flex md:justify-start md:items-center md:gap-x-5 p-1.5 shadow-md active:scale-95 transition-all duration-300">
                    <img :src="`https://ui-avatars.com/api/?background=4bc0c0&color=FFFFFF&name=${user?.first_name}`" class="rounded-2xl">
                    <div class="hidden md:flex md:justify-start md:items-center gap-x-5">
                        <div class="font-second">
                            <p class="text-slate-800 text-sm">{{ user?.first_name }}</p>
                            <p class="text-sm text-slate-500">{{ user?.division?.name }}</p>
                        </div>
                        <ChevronDown size="20" :class="dropdown ? 'rotate-180' : ' rotate-0'" class="transition-all duration-300" />
                    </div>
                </button>
            </div>
            <div @click.stop="dropdown = !dropdown" v-if="dropdown" class="absolute right-3 w-64 rounded-3xl border border-slate-200 bg-white p-3 shadow-xl">
                <NavButton :href="route('profile.edit')" class="flex w-full items-center gap-3 rounded-2xl p-3 transition hover:bg-slate-100">
                    <User class="h-5 w-5"/>
                    <span>
                        Profile
                    </span>
                </NavButton>
                <NavButton :href="route('logout')" method="post" as="button" class="flex w-full items-center gap-3 rounded-2xl p-3 text-red-500 transition hover:bg-red-50">
                    <LogOut class="h-5 w-5" />
                    <span>
                        Logout
                    </span>
                </NavButton>
            </div>

            <div class="w-96 h-10 bg-sky-400">

            </div>
        </div>
        <!-- mobile -->
        <div class="absolute bottom-0 px-3 pt-5 pb-3 rounded-t-lg w-full flex gap-x-2 items-center lg:hidden menu overflow-x-auto scrollbar-hide bg-gradient-to-r from-[#7165F8] via-[#4978FF] to-[#15B9FF]">
            <NavButton :href="route('supervisor.dashboard')" :class="route().current('supervisor.dashboard') ? 'bg-white/20' : ''" class="max-w-max flex flex-col gap-y-0.5 group p-1 rounded-lg active:scale-95 transition-all duration-300">
                <div class="p-1 group-hover:bg-white/30 max-w-max mx-auto rounded-lg">
                    <LayoutDashboard size="40" class="text-white" />
                </div>
                <p class="text-xs text-white text-center">Dashboard</p>
            </NavButton>
            <NavButton :href="route('profile.edit')" :class="route().current('profile.edit') ? 'bg-white/20' : ''" class="sm:hidden max-w-max flex flex-col gap-y-0.5 group p-1 rounded-lg active:scale-95 transition-all duration-300">
                <div class="p-1 group-hover:bg-white/30 max-w-max mx-auto rounded-lg">
                    <User size="40" class="text-white" />
                </div>
                <p class="text-xs text-white text-center">Profile</p>
            </NavButton>
            <NavButton :href="route('logout')" method="post" as="button" class="sm:hidden max-w-max flex flex-col gap-y-0.5 group p-1 rounded-lg active:scale-95 transition-all duration-300">
                <div class="p-1 group-hover:bg-white/30 max-w-max mx-auto rounded-lg">
                    <LogOut size="40" class="text-white" />
                </div>
                <p class="text-xs text-white text-center">Log Out</p>
            </NavButton>
        </div>
    </div>
</template>

<style scoped>
.menu::-webkit-scrollbar{
    width:6px;
}

.menu::-webkit-scrollbar-thumb{
    border-radius:999px;
    background:#c2d4ea;
}
.scrollbar-hide {
    -ms-overflow-style: none; /* IE & Edge */
    scrollbar-width: none; /* Firefox */
}

.scrollbar-hide::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Edge */
}
</style>