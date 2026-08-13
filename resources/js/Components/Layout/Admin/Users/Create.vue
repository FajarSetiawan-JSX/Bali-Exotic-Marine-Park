<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import Loading from '@/Components/Loading.vue';
import { UserRoundPlus, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['divisions', 'positions']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    name: '',
    username: '',
    nik: '',
    email: '',
    gender: '',
    birthday: '',
    phone: '',
    emergency: '',
    city: '',
    address: '',
    division: '',
    position: ''
});
function reset(){
    form.value.name = '';
    form.value.username = '';
    form.value.nik = '';
    form.value.email = '';
    form.value.gender = '';
    form.value.birthday = '';
    form.value.phone = '';
    form.value.emergency = '';
    form.value.city = '';
    form.value.address = '';
    form.value.division = '';
    form.value.position = '';
}
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post('/api/priority-first/user', form.value);
        emit('success');
        reset();
    }catch(error){
        if(error?.response?.status == 422){
            err.value = error?.response?.data?.errors
        }
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
onMounted(()=>{
    setTimeout(()=>{
        show.value = true;
    },500)
})
</script>

<template>
    <div @click="emit('close')" class="fixed inset-0 z-[9999] flex justify-center items-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm">
        <section @click.stop data-aos="zoom-in" class="p-3 rounded-lg border-2 border-slate-300 bg-white/30 mx-3">
            <UserRoundPlus data-aos="zoom-in" data-aos-delay="500" size="40" class="text-white mx-auto" />
            <h1 data-aos="fade-up" data-aos-delay="500" class="text-white font-second text-lg text-center">New User</h1>
            <p data-aos="fade-down" data-aos-delay="500" class="text-center text-sm text-white/80">Create new account to your employee</p>
            <form action="" @submit.prevent="create" class="font-second text-black my-2">
                <div class="grid grid-cols-2 gap-5 max-h-96 overflow-y-scroll scroll-smooth px-3 py-3">
                    <div data-aos="fade-left" data-aos-delay="500" data-aos-offset="0">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="name" class="text-lg text-white italic">Name<span class="text-red-400">*</span></label>
                            <input v-model="form.name" type="text" id="name" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        </div>
                        <p v-if="err?.name" class="text-xs font-second text-red-800">{{ err?.name[0] }}</p>
                    </div>

                    <div data-aos="fade-right" data-aos-delay="500" data-aos-offset="0">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="username" class="text-lg text-white italic">Username<span class="text-red-400">*</span></label>
                            <input type="text" v-model="form.username" id="username" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        </div>
                        <p v-if="err?.username" class="text-xs font-second text-red-800">{{ err?.username[0] }}</p>
                    </div>

                    <div data-aos="fade-left" data-aos-delay="700" data-aos-offset="0">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="nik" class="text-lg text-white italic">ID Number (NIK)<span class="text-red-400">*</span></label>
                            <input type="text" v-model="form.nik" id="nik" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        </div>
                        <p v-if="err?.nik" class="text-xs font-second text-red-800">{{ err?.nik[0] }}</p>
                    </div>

                    <div data-aos="fade-right" data-aos-delay="700" data-aos-offset="0">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="email" class="text-lg text-white italic">Email<span class="text-red-400">*</span></label>
                            <input type="email"v-model="form.email" id="email" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        </div>
                        <p v-if="err?.email" class="text-xs font-second text-red-800">{{ err?.email[0] }}</p>
                    </div>

                    <div data-aos="fade-left" data-aos-delay="900" data-aos-offset="0">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="phone" class="text-lg text-white italic">Phone<span class="text-red-400">*</span></label>
                            <input type="text" v-model="form.phone" id="phone" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        </div>
                        <p v-if="err?.phone" class="text-xs font-second text-red-800">{{ err?.phone[0] }}</p>
                    </div>

                    <div data-aos="fade-right" data-aos-delay="900" data-aos-offset="0">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="emergency" class="text-lg text-white italic">Emergency phone<span class="text-red-400">*</span></label>
                            <input type="text" v-model="form.emergency" id="emergency" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        </div>
                        <p v-if="err?.emergency" class="text-xs font-second text-red-800">{{ err?.emergency[0] }}</p>
                    </div>

                    <div data-aos="zoom-in" data-aos-delay="1100" data-aos-offset="0" class="grid grid-cols-1 gap-2 col-span-2">
                        <label for="" class="text-lg text-white italic">Gender</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label for="male" class="text-white/70">
                                <input v-model="form.gender" type="radio" name="gender" id="male" value="male">
                                Male
                            </label>

                            <label for="female" class="text-white/70">
                                <input v-model="form.gender" type="radio" name="gender" id="female" value="female">
                                Female
                            </label>
                        </div>
                        <p v-if="err?.gender" class="text-xs font-second text-red-800">{{ err?.gender[0] }}</p>
                    </div>

                    <div data-aos="fade-left" data-aos-delay="1300" data-aos-offset="0">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="birthday" class="text-lg text-white italic">Date of birthday</label>
                            <input type="date" v-model="form.birthday" id="birthday" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        </div>
                        <p v-if="err?.birthday" class="text-xs font-second text-red-800">{{ err?.birthday[0] }}</p>
                    </div>

                    <div data-aos="fade-right" data-aos-delay="1300" data-aos-offset="0">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="city" class="text-lg text-white italic">City of birth</label>
                            <input type="text" v-model="form.city" id="city" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        </div>
                        <p v-if="err?.city" class="text-xs font-second text-red-800">{{ err?.city[0] }}</p>
                    </div>

                    <div>
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label class="text-lg text-white italic">Division<span class="text-red-400">*</span></label>
                            <select v-model="form.division" class="rounded-lg">
                                <option selected value="">Select Division</option>
                                <option v-for="division in props.divisions" :key="division.id" :value="division.id" class="text-black">{{ division.nama }}</option>
                            </select>
                        </div>
                        <p v-if="err?.division" class="text-xs font-second text-red-800">{{ err?.division[0] }}</p>
                    </div>

                    <div>
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label class="text-lg text-white italic">Position<span class="text-red-400">*</span></label>
                            <select v-model="form.position" class="rounded-lg">
                                <option selected value="">Select Position</option>
                                <option v-for="position in props.positions" :key="position.id" :value="position.id" class="text-black">{{ position.name }}</option>
                            </select>
                        </div>
                        <p v-if="err?.position" class="text-xs font-second text-red-800">{{ err?.position[0] }}</p>
                    </div>

                    <div class="col-span-2">
                        <div class="max-h-max grid grid-cols-1 gap-2 mb-1.5">
                            <label for="address" class="text-lg text-white italic">Address</label>
                            <textarea v-model="form.address" id="address" class="px-4 py-2 rounded-lg border max-h-20 border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]"></textarea>
                        </div>
                        <p v-if="err?.address" class="text-xs font-second text-red-800">{{ err?.address[0] }}</p>
                    </div>
                </div>
                <Transition name="zoom">
                    <button v-if="show" type="submit" :disabled="loading" :class="loading ? 'cursor-not-allowed' : 'cursor-pointer hover:bg-emerald-400 transition-all duration-500'" class="py-1.5 my-2 rounded-lg bg-emerald-300 w-full text-white active:scale-95 flex items-center justify-center gap-x-0.5">
                        <template v-if="!loading">
                            <Plus size="20" class="text-white" />
                            <span>Create</span>
                        </template>
                        <template v-else>
                            <FormLoading color="bg-white my-3" />
                        </template>
                    </button>
                </Transition>
            </form>
        </section>
    </div>
</template>

<style scoped>
.zoom-enter-active,
.zoom-leave-active {
    transition: opacity 0.5s ease, transform .35s ease;
}

.zoom-enter-from,
.zoom-leave-to {
    opacity: 0;
    transform: scale(.8);
}

.zoom-enter-to,
.zoom-leave-from {
    opacity: 1;
    transform: scale(1);
}
</style>