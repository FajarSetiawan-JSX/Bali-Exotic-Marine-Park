<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { UserStar, CircleCheckBig, CircleX, Workflow, Boxes, Info, User, BookUser, IdCardLanyard, EyeOff, Eye } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    user: Object
});

const showid = ref(false);
onMounted(()=>{
    console.log(props.user);
})
</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-second text-slate-800 text-lg font-semibold">
                Profile
            </h1>
        </template>

        <section class="my-5">
            <div class="px-5 py-7 rounded-lg shadow-sm bg-white flex items-center justify-start gap-x-3 font-second">
                <img :src="`https://ui-avatars.com/api/?background=2DD4BF&color=ffff&name=${props?.user?.name}`" alt="Profile Picture" class="w-20 h-20 rounded-full object-cover">
                <div>
                    <div class="flex items-center justify-start gap-x-3">
                        <h1 class="font-second text-slate-800 text-2xl font-semibold">
                            {{ props?.user?.name }}
                        </h1>
                        <p v-if="props?.user?.verified" class="text-xs px-3 py-1 rounded-xl bg-emerald-200 text-emerald-500 flex items-center justify-start gap-x-1.5"><CircleCheckBig size="15" /> Verified</p>
                        <p v-else class="text-xs px-3 py-1 rounded-xl bg-rose-200 text-rose-500 flex items-center justify-start gap-x-1.5"><CircleX size="15" /> Unverified</p>
                    </div>
                    <div class="flex items-center justify-start gap-x-1.5 text-slate-500 text-sm my-1">
                        <UserStar size="15" />
                        {{ props?.user?.username }}
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="p-5 rounded-lg bg-white shadow-sm w-full flex items-center justify-start gap-x-3">
                    <div class="p-2 rounded-full bg-sky-200">
                        <Workflow size="30" class="text-sky-500" />
                    </div>
                    <div>
                        <h1 class="font-second text-slate-800 text-md font-semibold">
                            Unit
                        </h1>
                        <p class="text-xs text-slate-500">
                            {{ props?.user?.unit ?? '' }}
                        </p>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white shadow-sm w-full flex items-center justify-start gap-x-3">
                    <div class="p-2 rounded-full bg-slate-200">
                        <Boxes size="30" class="text-slate-500" />
                    </div>
                    <div>
                        <h1 class="font-second text-slate-800 text-md font-semibold">
                            Level user
                        </h1>
                        <p class="text-xs text-slate-500">
                            User level {{ props?.user?.level }}
                        </p>
                    </div>
                </div>

                <div class="p-5 rounded-lg bg-white shadow-sm w-full flex items-center justify-start gap-x-3">
                    <div :class="props?.user?.status === 1 ? 'bg-emerald-200' : 'bg-red-200'" class="p-2 rounded-full">
                        <Info size="30" :class="props.user.status === 1 ? 'text-emerald-500' : 'text-red-500'" />
                    </div>
                    <div>
                        <h1 class="font-second text-slate-800 text-sm font-semibold">
                            Status
                        </h1>
                        <p class="text-xs text-slate-500">
                           {{ props?.user?.status === 1 ? 'Active' : 'Not active' }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-7">
                <div class="bg-white rounded-lg shadow-sm p-5 max-h-max">
                    <div class="flex items-center justify-start gap-x-3 text-slate-800 font-second text-lg font-semibold">
                        <IdCardLanyard size="20" />
                        Employment Profile
                    </div>
                    <div class="grid grid-cols-1 gap-5 mt-5 mb-2.5">
                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Supervisor</h1>
                            <p class="text-slate-800 text-md">Front House</p>
                        </div>

                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Head of Division</h1>
                            <p class="text-slate-800 text-md">Front House</p>
                        </div>

                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Division</h1>
                            <p class="text-slate-800 text-md">{{ props?.user?.division }}</p>
                        </div>

                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Position</h1>
                            <p v-for="position in props?.user?.position" class="text-slate-800 text-md">{{ position }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-5">
                    <div class="flex items-center justify-start gap-x-3 text-slate-800 font-second text-lg font-semibold">
                        <User size="20" />
                        Personal Information
                    </div>
                    <div class="grid grid-cols-2 gap-5 mt-5 mb-2.5">
                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Full Name</h1>
                            <p class="text-slate-800 text-sm">{{ props?.user?.name }}</p>
                        </div>

                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Date of Birthday</h1>
                            <p class="text-slate-800 text-sm">{{ props?.user?.birthday }}</p>
                        </div>

                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Gender</h1>
                            <p class="text-slate-800 text-sm">{{ props?.user?.gender }}</p>
                        </div>

                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Born at</h1>
                            <p class="text-slate-800 text-sm">{{ props?.user?.city }}</p>
                        </div>

                        <div class="flex-col font-second col-span-2">
                            <h1 class="text-slate-500 text-xs uppercase">ID</h1>
                            <div class="flex items-center justify-between">
                                <template v-if="!showid">
                                    <p class="text-slate-800 text-sm">****************</p>
                                </template>
                                <template v-else>
                                    <p class="text-slate-800 text-sm">{{ props?.user?.nik }}</p>
                                </template>
                                <button type="button" @click="showid = !showid">
                                    <template v-if="!showid">
                                        <EyeOff size="20" class="text-black" />
                                    </template>
                                    <template v-else>
                                        <Eye size="20" class="text-black" />
                                    </template>
                                </button>
                            </div>
                        </div>

                        <div class="flex-col font-second col-span-2">
                            <h1 class="text-slate-500 text-xs uppercase">Address</h1>
                            <p class="text-slate-800 text-sm">{{ props?.user?.address }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-start gap-x-3 text-slate-800 font-second text-lg font-semibold mt-5">
                        <BookUser size="20" />
                        Contact Detail
                    </div>
                    <div class="grid grid-cols-2 gap-5 mt-5 mb-2.5">
                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Phone</h1>
                            <p class="text-slate-800 text-sm">{{ props?.user?.phone }}</p>
                        </div>

                        <div class="flex-col font-second">
                            <h1 class="text-red-500 text-xs uppercase">Emergency Call</h1>
                            <p class="text-red-800 text-sm">{{ props?.user?.emergency }}</p>
                        </div>

                        <div class="flex-col font-second">
                            <h1 class="text-slate-500 text-xs uppercase">Email</h1>
                            <p class="text-slate-800 text-sm">{{ props?.user?.email }}</p>
                        </div>

                    </div>

                </div>
                
            </div>
        </section>
    </AuthenticatedLayout>
</template>