<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import Loading from '@/Components/Loading.vue';
import { UserRoundPlus, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
const emit = defineEmits(['close', 'success']);
const props = defineProps(['units', 'levels', 'worktime']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    name: '',
    level: '',
    unit: '',
    worktime: '',
    description : ''
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post('/api/priority-first/division', form.value);
        emit('success')
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
        <section @click.stop data-aos="zoom-in" class="p-3 rounded-lg border-2 border-slate-300 bg-black mx-3">
            <UserRoundPlus data-aos="zoom-in" data-aos-delay="500" size="40" class="text-white mx-auto" />
            <h1 data-aos="fade-up" data-aos-delay="500" class="text-white font-second text-lg text-center">New Division</h1>
            <p data-aos="fade-down" data-aos-delay="500" class="text-center text-sm text-white/80">Create new division</p>
            <form action="" @submit.prevent="create" class="font-second text-black my-2">
                <div class="grid grid-cols-2 px-3 gap-2">

                    <div data-aos="fade-left" data-aos-delay="500" data-aos-offset="0" class="grid grid-cols-1 gap-2 col-span-2">
                        <label for="name" class="text-lg text-white italic">Name</label>
                        <input type="text" name="" id="name" v-model="form.name" class="px-4 py-2 rounded-lg border border-cyan-400 bg-white/90 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee] w-full">
                        <p v-if="err?.name" class="text-xs font-second text-red-800">{{ err?.name[0] }}</p>
                    </div>

                    <div data-aos="fade-left" data-aos-delay="500" data-aos-offset="0" class="min-w-0">
                        <label for="unit" class="text-lg text-white italic block mb-2">Unit</label>
                        <select v-model="form.unit" id="unit" class="flex gap-x-2 mb-2 w-full rounded-lg border border-cyan-400 bg-white/90 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                            <option selected disabled value="">Select unit</option>
                            <option v-for="unit in props?.units" :key="unit?.id" :value="unit?.id">{{ unit?.name }}</option>
                        </select>
                        <p v-if="err?.unit" class="text-xs font-second text-red-800 mt-2">{{ err?.unit[0] }}</p>
                    </div>

                    <div data-aos="fade-left" data-aos-delay="500" data-aos-offset="0" class="min-w-0">
                        <label for="level" class="text-lg text-white italic block mb-2">Level</label>
                        <select v-model="form.level" id="level" class="flex gap-x-2 mb-2 w-full rounded-lg border border-cyan-400 bg-white/90 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                            <option selected disabled value="">Select level</option>
                            <option v-for="level in props?.levels" :key="level.id" :value="level.id">Level {{ level.level }}</option>
                        </select>
                        <p v-if="err?.level" class="text-xs font-second text-red-800 mt-2">{{ err?.level[0] }}</p>
                    </div>

                    <div data-aos="fade-left" data-aos-delay="500" data-aos-offset="0" class="grid grid-cols-1 gap-2 col-span-2">
                        <label for="work" class="text-lg text-white italic">Work Time</label>
                        <select v-model="form.worktime" id="work" class="flex gap-x-2 mb-2 w-full rounded-lg border border-cyan-400 bg-white/90 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]">
                            <option selected disabled value="">Select Work Time</option>
                            <option v-for="time in props?.worktime" :key="time.id" :value="time.id">{{ time?.name }}</option>
                        </select>
                        <p v-if="err?.worktime" class="text-xs font-second text-red-800">{{ err?.worktime[0] }}</p>
                    </div>

                    <div data-aos="fade-down" data-aos-delay="500" data-aos-offset="0" class="col-span-2 grid grid-cols-1 gap-2">
                        <label for="desc" class="text-lg text-white italic">Description</label>
                        <textarea name="" id="desc" v-model="form.description" class="px-4 py-2 rounded-lg border max-h-20 border-cyan-400 bg-white/90 backdrop-blur-sm text-black outline-none transition-all duration-300 focus:border-cyan-400 focus:shadow-[0_0_5px_#22d3ee,0_0_10px_#22d3ee,0_0_20px_#22d3ee]"></textarea>
                        <p v-if="err?.description" class="text-xs font-second text-red-800">{{ err?.description[0] }}</p>
                    </div>

                </div>
                <Transition name="zoom">
                    <button v-if="show" type="submit" :disabled="loading" :class="loading ? 'cursor-not-allowed' : 'cursor-pointer hover:bg-emerald-600 transition-all duration-500'" class="py-1.5 my-4 rounded-lg bg-emerald-500 w-full text-white active:scale-95 flex items-center justify-center gap-x-0.5">
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