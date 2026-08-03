<script setup>
import { ref, computed, onMounted, onUnmounted } from "vue";
import { LayoutDashboard, Users, Building2, FileText, BarChart3, Bell,
    ChevronLeft,
    ChevronDown,
    BriefcaseBusiness,
    User,
    Settings,
    Search,
    LogOut,
    Folder,
} from "lucide-vue-next";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props?.auth?.user;

const sidebar = ref(true);
const dropdown = ref(false);
const mobile = ref(false);

const profileRef = ref(null);

const menus = ref([
    {
        title: "OVERVIEW",
        children: [
            {
                name: "Dashboard",
                icon: LayoutDashboard,
                href: "/dashboard",
                badge: "LIVE",
            },
        ],
    },

    {
        title: "MASTER DATA",
        children: [
            {
                name: "Users",
                icon: Users,
                href: "/users",
            },
            {
                name: "Division",
                icon: Building2,
                href: "/division",
            },
            {
                name: "Attachment",
                icon: Folder,
                href: "/attachment",
            },
        ],
    },

    {
        title: "REPORT",
        children: [
            {
                name: "Reports",
                icon: FileText,
                href: "/reports",
            },
            {
                name: "Analytics",
                icon: BarChart3,
                href: "/analytics",
            },
        ],
    },
]);

const mobileMenus = [
    {
        name: "Home",
        icon: LayoutDashboard,
        href: "/dashboard",
    },

    {
        name: "Users",
        icon: Users,
        href: "/users",
    },

    {
        name: "Reports",
        icon: FileText,
        href: "/reports",
    },

    {
        name: "Analytics",
        icon: BarChart3,
        href: "/analytics",
    },

    {
        name: "Profile",
        icon: User,
        href: "/profile",
    },
];

const sidebarWidth = computed(() => {
    if (mobile.value) return 0;

    return sidebar.value ? 320 : 96;
});

const layoutStyle = computed(() => ({
    marginLeft: mobile.value ? "0px" : sidebarWidth.value + "px",
}));

const headerStyle = computed(() => ({
    left: mobile.value ? "0px" : sidebarWidth.value + "px",
}));

const toggleSidebar = () => {
    sidebar.value = !sidebar.value;
};

const active = (url) => {
    return window.location.pathname === url;
};

const go = (url) => {
    window.location.href = url;
};

const checkScreen = () => {
    mobile.value = window.innerWidth < 1024;

    if (mobile.value) {
        sidebar.value = false;
    }
};

const clickOutside = (e) => {
    if (
        profileRef.value &&
        !profileRef.value.contains(e.target)
    ) {
        dropdown.value = false;
    }
};

onMounted(() => {
    console.log(user);
    checkScreen();

    window.addEventListener("resize", checkScreen);

    document.addEventListener(
        "click",
        clickOutside
    );
});

onUnmounted(() => {
    window.removeEventListener(
        "resize",
        checkScreen
    );

    document.removeEventListener(
        "click",
        clickOutside
    );
});
</script>

<template>
    <div class="min-h-screen bg-[#EEF3FA]">
        <aside v-if="!mobile" class="fixed left-0 top-0 z-40 h-screen transition-all duration-500 ease-in-out"
            :style="{
                width: sidebarWidth + 'px'
            }"
        >
            <div class="relative flex h-full flex-col overflow-hidden rounded-r-[32px] bg-gradient-to-b from-[#7165F8] via-[#4978FF] to-[#15B9FF]">
                <div class="absolute -left-24 -top-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"/>
                <div class="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-cyan-300/10 blur-3xl"/>
                <div class="relative flex items-center justify-between px-7 pt-8">
                    <div class="flex items-center gap-4">
                        <div class="h-16 w-16 rounded-2xl bg-contain bg-white bg-no-repeat bg-center" style="background-image: url('/EXOTIC.png');"/>
                        <Transition name="fade">
                            <div v-if="sidebar">
                                <h2 class="text-xl font-exotic1 font-bold text-sky-200">
                                    Bali Exotic
                                </h2>
                                <p class="text-sm font-exotic2 text-blue-100">
                                    Marine Park
                                </p>
                            </div>
                        </Transition>
                    </div>
                </div>
                <button @click="toggleSidebar" class="absolute right-5 top-25 grid h-10 w-10 place-items-center rounded-full bg-white/15 text-white backdrop-blur transition active:scale-95">
                    <ChevronLeft class="transition-transform duration-300" :class="!sidebar && 'rotate-180'"/>
                </button>
                <div class="relative mt-10 flex-1 overflow-y-auto px-5 pb-6">
                    <template v-for="group in menus" :key="group.title">
                        <Transition name="fade">
                            <p v-if="sidebar" class="mb-3 mt-7 px-3 text-xs font-bold tracking-[4px] text-blue-100/70">
                                {{ group.title }}
                            </p>
                        </Transition>
                        <button v-for="item in group.children" :key="item.href" @click="go(item.href)" class="group relative mb-2 flex w-full items-center gap-4 overflow-hidden rounded-2xl p-3 transition-all duration-300" :class="active(item.href) ? 'bg-white text-[#3567FF] shadow-xl' : 'text-white hover:bg-white/10'">
                            <div v-if="active(item.href)" class="absolute left-0 top-3 h-8 w-1 rounded-r-full bg-[#3567FF]" />
                            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-xl transition-all" :class=" active(item.href) ? 'bg-[#EEF3FA]' : 'bg-white/15 group-hover:bg-white/20'">
                                <component :is="item.icon" class="h-6 w-6" />
                            </div>
                            <Transition name="fade">
                                <div v-if="sidebar" class="flex flex-1 items-center justify-between">
                                    <span class="font-semibold">
                                        {{ item.name }}
                                    </span>
                                    <span v-if="item.badge" class="rounded-full bg-red-500 px-2 py-1 text-[10px] font-bold text-white">
                                        {{ item.badge }}
                                    </span>
                                </div>
                            </Transition>
                        </button>
                    </template>
                </div>
                <div class="p-5">
                    <div class="rounded-3xl bg-white/15 p-4 backdrop-blur">
                        <div class="flex items-center gap-4">
                            <img :src="user?.profile ? `${user?.profile}` : `https://ui-avatars.com/api/?background=FFFFFF&color=3567FF&name=${user?.first_name}`" class="h-14 w-14 rounded-2xl object-cover">
                            <Transition name="fade">
                                <div v-if="sidebar" class="flex-1">
                                    <h4 class="font-semibold text-white">
                                        {{ user?.first_name ?? 'unknow user' }}
                                    </h4>
                                    <p class="text-sm text-blue-100">
                                        {{ user?.division?.name ?? 'Unknow division' }}
                                    </p>
                                </div>
                            </Transition>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <header class="fixed top-0 right-0 z-30 transition-all duration-500 ease-in-out" :style="headerStyle">
            <div class="p-3 lg:p-5">
                <div class="flex h-20 items-center justify-between rounded-[28px] border border-slate-200/70 bg-white/90 px-6 shadow-sm backdrop-blur-xl">
                    <div class="flex flex-col" :class="mobile && 'hidden'">
                        <h2 class="text-2xl font-bold text-slate-800">
                            Dashboard
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Welcome Back 👋
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="hidden lg:flex xl:flex">
                            <div
                                class="flex h-12 w-[330px] items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4">
                                <Search class="h-5 w-5 text-slate-400" />
                                <input type="text" placeholder="Search..." class="flex-1 bg-transparent text-sm outline-none placeholder:text-slate-400" >
                            </div>
                        </div>
                        <button type="button" class="relative grid h-12 w-12 place-items-center rounded-2xl border border-slate-200 bg-white transition hover:bg-slate-50 active:scale-95">
                            <Bell class="h-5 w-5 text-slate-700"/>
                            <span class="absolute right-3 top-3 h-2.5 w-2.5 rounded-full bg-red-500">
                            </span>
                        </button>
                        <div ref="profileRef" class="relative">
                            <button @click.stop="dropdown=!dropdown" class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-2 transition hover:bg-slate-50 active:scale-95">
                                <img src="https://ui-avatars.com/api/?background=3567FF&color=fff&name=SA" class="h-10 w-10 lg:h-12 lg:w-12">
                                <Transition name="fade">
                                    <div v-if="!mobile" class="hidden text-left lg:block">
                                        <h4 class="font-semibold text-slate-800">
                                            {{ user?.name ?? 'Super Admin' }}
                                        </h4>
                                        <p class="text-sm text-slate-500">
                                            {{ user?.division?.name ?? 'Supervisor'}}
                                        </p>
                                    </div>
                                </Transition>
                                <ChevronDown class="transition duration-300" :class="dropdown && 'rotate-180'" />
                            </button>
                            <Transition enter-active-class="transition duration-200" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="transition duration-150" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                                <div v-if="dropdown" class="absolute right-0 mt-3 w-64 rounded-3xl border border-slate-200 bg-white p-3 shadow-xl">
                                    <button class="flex w-full items-center gap-3 rounded-2xl p-3 transition hover:bg-slate-100">
                                        <User class="h-5 w-5"/>
                                        <span>
                                            Profile
                                        </span>
                                    </button>
                                    <button class="flex w-full items-center gap-3 rounded-2xl p-3 transition hover:bg-slate-100">
                                        <Settings class="h-5 w-5" />
                                        <span>
                                            Settings
                                        </span>
                                    </button>
                                    <hr class="my-2">
                                    <button class="flex w-full items-center gap-3 rounded-2xl p-3 text-red-500 transition hover:bg-red-50">
                                        <LogOut class="h-5 w-5" />
                                        <span>
                                            Logout
                                        </span>
                                    </button>
                                </div>
                            </Transition>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="min-h-screen transition-all duration-500 ease-in-out" :style="layoutStyle">
            <div class="px-3 pb-28 pt-24 lg:px-5 lg:pt-28">

                <!-- ============================ -->
                <!-- BREADCRUMB -->
                <!-- ============================ -->
                <div class="mb-6 flex items-center gap-2 text-sm">
                    <span class="text-slate-400">
                        Dashboard
                    </span>
                    <span class="text-slate-300">
                        /
                    </span>
                    <span class="font-semibold text-slate-700">
                        Overview
                    </span>
                </div>

                <!-- ============================ -->
                <!-- PAGE HEADER -->
                <!-- ============================ -->
                <div class="mb-6 flex flex-col justify-between gap-4 rounded-[28px] bg-white p-7 shadow-sm lg:flex-row lg:items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-800">
                            Dashboard
                        </h1>
                        <p class="mt-2 text-slate-500">
                            Monitor your latest activity and business performance.
                        </p>
                    </div>
                    <button class="rounded-2xl bg-[#3567FF] px-6 py-3 font-medium text-white transition hover:bg-[#2c58da] active:scale-95">
                        Create Report
                    </button>
                </div>

                <!-- ============================ -->
                <!-- STATS -->
                <!-- ============================ -->
                <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                    <div v-for="i in 4" :key="i" class="rounded-[28px] bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-500">
                                    Total Users
                                </p>
                                <h2 class="mt-3 text-3xl font-bold">
                                    12,345
                                </h2>
                            </div>
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-blue-100">
                                <Users class="h-8 w-8 text-[#3567FF]" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================ -->
                <!-- CONTENT -->
                <!-- ============================ -->
                <div class="mt-6 grid gap-6 xl:grid-cols-3">
                    <!-- LEFT -->
                    <div class="xl:col-span-2">
                        <div class="rounded-[24px] lg:rounded-[30px]">
                            <div class="border-b border-slate-100 p-6">
                                <h2 class="text-xl font-bold text-slate-800">
                                    Recent Activity
                                </h2>
                                <p class="mt-1 text-slate-500">
                                    Latest user activity.
                                </p>
                            </div>
                            <div class="divide-y">
                                <div v-for="i in 8" :key="i" class="flex items-center justify-between p-6 transition hover:bg-slate-50">
                                    <div class="flex items-center gap-2 lg:gap-4">
                                        <div class="h-14 w-14 rounded-2xl bg-slate-100">
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-slate-700">
                                                User Login
                                            </h4>
                                            <p class="mt-1 text-sm text-slate-500">
                                                5 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                    <span class="rounded-full bg-green-100 px-3 py-2 text-xs font-semibold text-green-600">
                                        Success
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- RIGHT -->
                    <div>
                        <div class="rounded-[24px] lg:rounded-[30px]">
                            <h3 class="text-xl font-bold">
                                Overview
                            </h3>
                            <div class="mt-6 space-y-5">
                                <div v-for="i in 5" :key="i">
                                    <div class="mb-2 flex justify-between">
                                        <span>
                                            Progress {{ i }}
                                        </span>
                                        <span>
                                            75%
                                        </span>
                                    </div>
                                    <div class="h-3 rounded-full bg-slate-100">
                                        <div class="h-3 w-3/4 rounded-full bg-[#3567FF]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <slot />
                </div>
            </div>
        </main>

        <!-- ================================================= -->
        <!-- MOBILE NAVIGATION -->
        <!-- ================================================= -->
        <Transition enter-active-class="transition duration-300" enter-from-class="translate-y-full opacity-0" enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-300" leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-full opacity-0">
            <nav v-if="mobile" class="fixed bottom-0 left-0 right-0 z-50 border-t border-slate-200/70 bg-white/90 backdrop-blur-xl">
                <div class="grid grid-cols-5 px-2 py-2">
                    <button v-for="item in mobileMenus" :key="item.href" @click="go(item.href)" class="group flex flex-col items-center gap-1 rounded-2xl py-2 transition active:scale-95">
                        <!-- ICON -->
                        <div class="grid h-12 w-12 place-items-center rounded-2xl transition-all duration-300" :class="active(item.href) ? 'bg-[#3567FF] text-white shadow-lg' : 'text-slate-500 group-hover:bg-slate-100'">
                            <component :is="item.icon" class="h-6 w-6" />
                        </div>
                        <!-- TEXT -->
                        <span class="text-[11px] transition" :class=" active(item.href) ? 'font-semibold text-[#3567FF]' : 'text-slate-500'">
                            {{ item.name }}
                        </span>
                    </button>
                </div>
            </nav>
        </Transition>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active{
    transition:opacity .25s,
    transform .25s;
}

.fade-enter-from,
.fade-leave-to{
    opacity:0;
    transform:translateX(-10px);
}

::-webkit-scrollbar{
    width:6px;
}

::-webkit-scrollbar-thumb{
    border-radius:999px;
    background:#cbd5e1;
}
</style>