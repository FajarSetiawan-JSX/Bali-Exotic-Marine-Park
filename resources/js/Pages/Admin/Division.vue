<script setup>
import Header from '@/Components/Header.vue';
import Create from '@/Components/Layout/Admin/Division/Create.vue';
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ChessKing,
  ChessQueen,
  ChefHat,
  ChessKnight,
  BookA,
  Megaphone,
  Camera,
  Dumbbell,
  Cat,
  UserCog,
  Atom,
  Users,
  Trash2
} from "lucide-vue-next";
import { ref } from 'vue';
import { onMounted } from 'vue';

const props = defineProps(['divisions', 'Totaluser', 'Totaldivisi']);
const showcreate = ref(false)
const divisi = ref(0);
const user = ref(0);
onMounted(()=>{
    let a = 0;
    let b = 0;
    let d = props.Totaldivisi;
    let u = props.Totaluser

    const countdivisi = setInterval(()=>{
        if(a >= d) return clearInterval(countdivisi)
        divisi.value++;
        a++;
    }, 80)

    const countuser = setInterval(()=>{
        if(b >= u) return clearInterval(countuser)
        user.value++;
        b++;
    }, 80)
})
</script>

<template>
    <Head title="Division" />

    <AuthenticatedLayout>
        <header class="flex justify-between lg:mx-12">
            <div data-aos="fade-right" class="max-w-max">
                <h4 class="text-black font-semibold font-second my-1.5 text-2xl">Overview</h4>
                <h5 class="text-slate-700 text-sm font-second">Manage organizational units and member distribution.</h5>
            </div>
            <div data-aos="fade-left" class="max-w-max">
                <button type="button" @click="showcreate = true" class="flex items-center justify-center text-white bg-thrid-admin hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 gap-x-1.5 active:scale-95 transition-all duration-300">
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="15px" height="18px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                    <path d="M30,29h16.5c0.8,0,1.5-0.7,1.5-1.5v-3c0-0.8-0.7-1.5-1.5-1.5H30c-0.6,0-1-0.4-1-1V5.5C29,4.7,28.3,4,27.5,4
                        h-3C23.7,4,23,4.7,23,5.5V22c0,0.6-0.4,1-1,1H5.5C4.7,23,4,23.7,4,24.5v3C4,28.3,4.7,29,5.5,29H22c0.6,0,1,0.4,1,1v16.5
                        c0,0.8,0.7,1.5,1.5,1.5h3c0.8,0,1.5-0.7,1.5-1.5V30C29,29.4,29.4,29,30,29z"/>
                    </svg>
                    <p>
                        Add new division
                    </p>
                </button>
            </div>
        </header>

        <main class="my-3.5 md:my-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-1.5 sm:gap-3 md:gap-5">
            <div v-for="(division, index) in props.divisions" :key="index" data-aos="zoom-out-up" :data-aos-delay="index * 250" class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-xl transition duration-300">  
                <div class="w-full flex justify-between items-center relative">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5" :style="{ backgroundColor: division.hexa + '33' }">
                        <template v-if="division.name == 'Super Admin'">
                            <ChessKing class="w-8 h-18" :style="{ color: division.hexa }" />
                        </template>
                        <template v-else-if="division.name == 'Supervisor'">
                            <ChessQueen class="w-8 h-18" :style="{ color: division.hexa }" />
                        </template>
                        <template v-else-if="division.name == 'Reservation'">
                            <BookA class="w-8 h-18" :style="{ color: division.hexa }" />
                        </template>
                        <template v-else-if="division.name == 'Kitchen'">
                            <ChefHat class="w-8 h-18" :style="{ color: division.hexa }" />
                        </template>
                        <template v-else-if="division.name == 'Host'">
                            <Megaphone class="w-8 h-18" :style="{ color: division.hexa }" />
                        </template>
                        <template v-else>
                            <UserCog class="w-8 h-18" :style="{ color: division.hexa }" />
                        </template>
                    </div>
                    <button type="button" class="text-gray-400 hover:text-black">
                        ⋮
                    </button>
                    <div class="py-0.5 rounded-lg absolute bottom-0 right-0 bg-white shadow-lg">
                        <button type="button" class="hover:bg-slate-100 flex items-center justify-start gap-x-1 px-2.5">
                            <Trash2 size="20" class="text-red-500" />
                            Delete
                        </button>
                    </div>
                </div>

                <h2 class="font-semibold text-xl font-second">
                    {{ division.name }}
                </h2>

                <p class="font-primary text-slate-400 text-sm mt-2 leading-6">
                    {{ division.description }}
                </p>
                <div class="h-0.5 bg-slate-100/50" />
                <div class="flex justify-between items-center mt-4">
                    <div class="flex -space-x-2">

                        <img
                        v-for="(user, index) in division.users"
                        :key="index"
                        :src="user.profile ? `https://ui-avatars.com/api/?name=${user?.first_name}&background=7DD3fc&color=fff` : `https://ui-avatars.com/api/?name=${user?.first_name}&background=${division.hexa.replace('#', '')}&color=fff`"
                        :title="user.first_name"
                        class="w-8 h-8 rounded-full border-2 border-white" :class="division.users.length > 1 ? 'hover:-translate-y-1 transition-all duration-300' : ''">

                        <img v-if="division.member >= 5"
                        :src="`https://ui-avatars.com/api/?name=${division.member - division.users.length}&background=${division.hexa.replace('#', '')}&color=fff`"
                        class="w-8 h-8 rounded-full border-2 border-white">

                    </div>
                    <span class="text-thrid-admin font-second">
                        {{ division.member }} Members
                    </span>
                </div>
            </div>
        </main>

        <div class="w-full p-1.5 grid grid-cols-2 gap-x-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 lg:gap-x-5">
            <div class="bg-white rounded-2xl p-6 shadow-sm font-second flex items-center gap-x-10">
                <div class="p-2 rounded-2xl bg-emerald-100">
                    <Users class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 text-emerald-300" />
                </div>
                <div>
                    <p class="text-gray-400 text-sm">
                        Total Users
                    </p>

                    <h2 class="font-bold mt-2 text-md sm:text-lg md:text-xl">
                        {{ user }}
                    </h2>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm font-second flex items-center gap-x-10">
                <div class="p-2 rounded-2xl bg-red-100">
                    <Atom class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 text-red-300" />
                </div>
                <div>
                    <p class="text-gray-400 text-sm">
                        Total Division
                    </p>

                    <h2 class="font-bold mt-2 text-md sm:text-lg md:text-xl">
                        {{ divisi }}
                    </h2>
                </div>
            </div>
        </div>

        <Create v-if="showcreate" @close="showcreate = false" />
    </AuthenticatedLayout>
</template>

<style scoped>

</style>