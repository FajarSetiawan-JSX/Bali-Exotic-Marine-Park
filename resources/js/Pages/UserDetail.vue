<script setup>
import SearchAnimation from '@/Components/SearchAnimation.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { ArrowLeft, User, IdCard, Copy, Phone, ShieldAlert, MapPin, EyeOff, Eye } from 'lucide-vue-next'
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';
import { usePage } from '@inertiajs/vue3';

// data dummy
const level = usePage().props?.auth?.level;
const loading = ref(false);
const eye = ref(false);
const props = defineProps(['user']);
const user = ref({});
async function get(id) {
    try{
        loading.value = true;
        const response = await axios.get(route('user.show', id));
        user.value = response?.data?.data;
        console.log(response.data);
    }catch(error){
        console.log(error?.response);
        eror(error.response.status, error?.response?.data?.message);
    }finally{
        loading.value = false
    }
}

function copyEmail() {
    navigator.clipboard.writeText(user.value.email)
}

onMounted(()=>{
    get(props?.user?.id);
})
</script>

<template>
    <Head title="User Detail" />
    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold">User Detail</h1>
        </template>
        <div class="w-full mx-auto space-y-4">
            <template v-if="level == 1">
                <Link :href="route('super.admin.user')" class="inline-flex items-center gap-1.5 text-sm font-medium text-red-500 hover:text-red-600">
                    <ArrowLeft class="h-4 w-4" />
                    Back to User Management
                </Link>
            </template>
            <template v-else>
                <Link :href="route('dashboard')" class="inline-flex items-center gap-1.5 text-sm font-medium text-red-500 hover:text-red-600">
                    <ArrowLeft class="h-4 w-4" />
                    Back to Dashboard
                </Link>
            </template>

            <template v-if="!loading">
                <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <img :src="user?.pict ? user.pict : `https://ui-avatars.com/api/?background=2DD4BF&color=fff&name=${user?.name}`" :alt="user?.name" class="h-16 w-16 rounded-xl object-cover"/>

                        <div class="flex-1 min-w-0">
                            <h1 class="text-lg sm:text-xl font-semibold text-gray-800">{{ user.name }}</h1>
                            <p v-for="position in user?.position" class="text-sm sm:text-base text-sky-600">{{ position }}</p>
                        </div>

                        <span class="inline-flex items-center gap-1.5 self-start sm:self-auto rounded-full bg-indigo-50 px-3 py-1.5 text-xs sm:text-sm font-medium text-indigo-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                            {{ user.status === 1 ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-100">
                        <User class="h-4 w-4 text-red-500" />
                        <h2 class="text-sm sm:text-base font-semibold text-red-500">Personal Information</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-6 gap-y-4">
                        <div>
                            <p class="text-xs font-semibold uppercase text-red-500 mb-1">Full Name</p>
                            <p class="text-sm text-gray-700">{{ user?.name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase text-gray-400 mb-1">NIK (National ID)</p>
                            <div class="flex items-center justify-between">
                                <template v-if="eye">
                                    <p class="text-sm text-gray-700">{{ user?.nik }}</p>
                                </template>
                                <template v-else>
                                    <p class="text-sm text-gray-700">****************</p>
                                </template>
                                <button type="button" @click="eye = !eye">
                                    <template v-if="eye">
                                        <EyeOff size="15" />
                                    </template>
                                    <template v-else>
                                        <Eye size="15" />
                                    </template>
                                </button>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase text-gray-400 mb-1">Gender</p>
                            <p class="text-sm text-sky-600">{{ user?.gender }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase text-gray-400 mb-1">Place of Birth</p>
                            <p class="text-sm text-gray-700">{{ user?.city }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase text-gray-400 mb-1">Birthday</p>
                            <p class="text-sm text-sky-600">{{ user?.birthday }}</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
                        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-100">
                            <IdCard class="h-4 w-4 text-indigo-500" />
                            <h2 class="text-sm sm:text-base font-semibold text-indigo-600">Account Info</h2>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-semibold uppercase text-gray-400 mb-1">Username</p>
                                <span class="inline-block rounded-md bg-gray-100 px-2.5 py-1 text-sm text-gray-700">
                                    {{ user?.username }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase text-gray-400 mb-1">Email Address</p>
                                <div class="flex items-center gap-1.5">
                                    <p class="text-sm sm:text-base text-sky-600 truncate">{{ user?.email }}</p>
                                    <button type="button" class="shrink-0 text-gray-400 hover:text-gray-600" @click="copyEmail">
                                        <Copy class="h-3.5 w-3.5" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6">
                        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-100">
                            <Phone class="h-4 w-4 text-red-500" />
                            <h2 class="text-sm sm:text-base font-semibold text-red-500">Contact Details</h2>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-semibold uppercase text-red-500 mb-1">Phone</p>
                                <p class="text-sm sm:text-base text-gray-700">{{ user?.phone }}</p>
                            </div>
                            <div>
                                <p class="flex items-center gap-1 text-xs font-semibold uppercase text-gray-400 mb-1">
                                    <ShieldAlert class="h-3.5 w-3.5" />
                                    Emergency Call
                                </p>
                                <p class="text-sm sm:text-base text-gray-700">{{ user?.emergency }}</p>
                            </div>
                            <div>
                                <p class="flex items-center gap-1 text-xs font-semibold uppercase text-gray-400 mb-1">
                                    <MapPin class="h-3.5 w-3.5" />
                                    Residential Address
                                </p>
                                <p class="text-sm sm:text-base text-gray-700 leading-relaxed">{{ user?.address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 animate-pulse">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <!-- Photo -->
                        <div class="h-16 w-16 shrink-0 rounded-xl bg-gray-200"></div>

                        <!-- Name + Role -->
                        <div class="flex-1 min-w-0 space-y-2">
                            <div class="h-5 w-40 sm:w-48 rounded bg-gray-200"></div>
                            <div class="h-4 w-24 sm:w-32 rounded bg-gray-200"></div>
                        </div>

                        <!-- Status -->
                        <div class="self-start sm:self-auto h-7 w-20 rounded-full bg-gray-200"></div>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 animate-pulse">
                    <!-- Header -->
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-100">
                        <div class="h-4 w-4 rounded bg-gray-200"></div>
                        <div class="h-4 w-36 sm:w-44 rounded bg-gray-200"></div>
                    </div>

                    <!-- Information -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-6 gap-y-4">

                        <div>
                            <div class="h-3 w-20 rounded bg-gray-200 mb-2"></div>
                            <div class="h-4 w-36 sm:w-44 rounded bg-gray-200"></div>
                        </div>

                        <div>
                            <div class="h-3 w-28 rounded bg-gray-200 mb-2"></div>
                            <div class="h-4 w-32 sm:w-40 rounded bg-gray-200"></div>
                        </div>

                        <div>
                            <div class="h-3 w-16 rounded bg-gray-200 mb-2"></div>
                            <div class="h-4 w-20 rounded bg-gray-200"></div>
                        </div>

                        <div>
                            <div class="h-3 w-28 rounded bg-gray-200 mb-2"></div>
                            <div class="h-4 w-32 sm:w-40 rounded bg-gray-200"></div>
                        </div>

                        <div>
                            <div class="h-3 w-20 rounded bg-gray-200 mb-2"></div>
                            <div class="h-4 w-28 sm:w-32 rounded bg-gray-200"></div>
                        </div>

                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Account Info -->
                    <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 animate-pulse">
                        <!-- Header -->
                        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-100">
                            <div class="h-4 w-4 rounded bg-gray-200"></div>
                            <div class="h-4 w-28 sm:w-32 rounded bg-gray-200"></div>
                        </div>

                        <div class="space-y-4">

                            <!-- Username -->
                            <div>
                                <div class="h-3 w-20 rounded bg-gray-200 mb-2"></div>
                                <div class="h-7 w-28 rounded-md bg-gray-200"></div>
                            </div>

                            <!-- Email -->
                            <div>
                                <div class="h-3 w-28 rounded bg-gray-200 mb-2"></div>

                                <div class="flex items-center gap-1.5">
                                    <div class="h-4 w-40 sm:w-52 rounded bg-gray-200"></div>
                                    <div class="h-4 w-4 shrink-0 rounded bg-gray-200"></div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Contact Details -->
                    <div class="rounded-xl border border-gray-200 bg-white p-4 sm:p-6 animate-pulse">
                        <!-- Header -->
                        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-100">
                            <div class="h-4 w-4 rounded bg-gray-200"></div>
                            <div class="h-4 w-32 sm:w-40 rounded bg-gray-200"></div>
                        </div>

                        <div class="space-y-4">

                            <!-- Primary Phone -->
                            <div>
                                <div class="h-3 w-24 rounded bg-gray-200 mb-2"></div>
                                <div class="h-4 w-32 sm:w-40 rounded bg-gray-200"></div>
                            </div>

                            <!-- Emergency Call -->
                            <div>
                                <div class="flex items-center gap-1 mb-2">
                                    <div class="h-3.5 w-3.5 rounded bg-gray-200"></div>
                                    <div class="h-3 w-28 rounded bg-gray-200"></div>
                                </div>

                                <div class="h-4 w-32 sm:w-40 rounded bg-gray-200"></div>
                            </div>

                            <!-- Address -->
                            <div>
                                <div class="flex items-center gap-1 mb-2">
                                    <div class="h-3.5 w-3.5 rounded bg-gray-200"></div>
                                    <div class="h-3 w-36 rounded bg-gray-200"></div>
                                </div>

                                <div class="space-y-2">
                                    <div class="h-4 w-full rounded bg-gray-200"></div>
                                    <div class="h-4 w-4/5 sm:w-3/4 rounded bg-gray-200"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </template>
        </div>
    </AuthenticatedLayout>
</template>