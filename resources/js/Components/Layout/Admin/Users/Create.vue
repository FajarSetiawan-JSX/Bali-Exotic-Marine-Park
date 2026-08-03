<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import Loading from '@/Components/Loading.vue';
import { UserRoundPlus, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const emit = defineEmits(['close']);
const props = defineProps(['divisions']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    first_name: '',
    last_name: '',
    mid_name: '',
    email: '',
    gender: '',
    phone: '',
    address: '',
    division_id: ''
});
function reset(){
    form.value.first_name = '';
    form.value.last_name = '';
    form.value.mid_name = '';
    form.value.email = '';
    form.value.gender = '';
    form.value.phone = '';
    form.value.address = '';
    form.value.division_id = '';
}
async function create() {
    try{
        loading.value = true;
        const response = await axios.post('/api/', form.value);
    }catch(error){
        console.log(error.response);
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
                <div class="grid grid-cols-2 gap-5 max-h-96 overflow-y-scroll scroll-smooth px-3">
                    <div data-aos="fade-left" data-aos-delay="500" data-aos-offset="0" class="grid grid-cols-1 gap-2">
                        <label for="" class="text-lg text-white italic">First name</label>
                        <input type="text" name="" id="" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        <p class="text-xs font-second text-red-800">Error</p>
                    </div>

                    <div data-aos="fade-right" data-aos-delay="500" data-aos-offset="0" class="grid grid-cols-1 gap-2">
                        <label for="" class="text-lg text-white italic">Last name</label>
                        <input type="text" name="" id="" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        <p class="text-xs font-second text-red-800">Error</p>
                    </div>

                    <div data-aos="fade-left" data-aos-delay="700" data-aos-offset="0" class="grid grid-cols-1 gap-2">
                        <label for="" class="text-lg text-white italic">Middle name</label>
                        <input type="text" name="" id="" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        <p class="text-xs font-second text-red-800">Error</p>
                    </div>

                    <div data-aos="fade-right" data-aos-delay="700" data-aos-offset="0" class="grid grid-cols-1 gap-2">
                        <label for="" class="text-lg text-white italic">Email</label>
                        <input type="text" name="" id="" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        <p class="text-xs font-second text-red-800">Error</p>
                    </div>

                    <div data-aos="fade-left" data-aos-delay="900" data-aos-offset="0" class="grid grid-cols-1 gap-2">
                        <label for="" class="text-lg text-white italic">Phone</label>
                        <input type="text" name="" id="" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                        <p class="text-xs font-second text-red-800">Error</p>
                    </div>

                    <div data-aos="fade-right" data-aos-delay="900" data-aos-offset="0" class="grid grid-cols-1 gap-2">
                        <label for="" class="text-lg text-white italic">Gender</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label for="male" class="text-white/70">
                                <input type="radio" name="gender" id="male" value="male">
                                Male
                            </label>

                            <label for="female" class="text-white/70">
                                <input type="radio" name="gender" id="female" value="female">
                                Female
                            </label>
                        </div>
                        <p class="text-xs font-second text-red-800">Error</p>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="500" data-aos-offset="0" class="col-span-2 grid grid-cols-1 gap-2">
                        <label for="" class="text-lg text-white italic">Division</label>
                        <select name="" id="" class="rounded-lg">
                            <option selected value="">Select Division</option>
                            <option v-for="division in props.divisions" :key="division.id" :value="division.id" class="text-black">{{ division.nama }}</option>
                        </select>
                        <p class="text-xs font-second text-red-800">Error</p>
                    </div>
                    <div data-aos="fade-down" data-aos-delay="500" data-aos-offset="0" class="col-span-2 grid grid-cols-1 gap-2">
                        <label for="" class="text-lg text-white italic">Address</label>
                        <textarea name="" id="" class="px-4 py-2 rounded-lg border max-h-20 border-cyan-400 bg-white/50 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]"></textarea>
                        <p class="text-xs font-second text-red-800">Error</p>
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