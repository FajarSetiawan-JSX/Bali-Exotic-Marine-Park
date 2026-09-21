<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import Loading from '@/Components/Loading.vue';
import { Globe, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
const emit = defineEmits(['close', 'success']);
const props = defineProps(['divisionposition', 'webs', 'my']);
const show = ref(false);
const loading = ref(false);
const form = ref({
    web: []
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post(route('super.admin.accessweb.store', props?.divisionposition?.id), form.value);
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
    form.value.web = props?.my;
    setTimeout(()=>{
        show.value = true;
    },500)
})
</script>

<template>
    <div @click="emit('close')" class="fixed inset-0 z-[9999] flex justify-center items-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm">
        <section @click.stop data-aos="zoom-in" class="p-3 rounded-lg border-2 border-slate-300 bg-black mx-3">
            <Globe data-aos="zoom-in" data-aos-delay="500" size="40" class="text-emerald-400 mx-auto" />
            <h1 data-aos="fade-up" data-aos-delay="500" class="text-white font-second text-lg text-center">New Access Page</h1>
            <p data-aos="fade-down" data-aos-delay="500" class="text-center text-sm text-white/80">{{ props?.divisionposition?.name }}</p>
            <form action="" @submit.prevent="create" class="font-second text-black my-2">
                <div class="grid grid-cols-1 gap-2 max-h-72 overflow-y-scroll">
                    <template v-if="props?.webs?.length > 0">
                        <div v-for="web in props?.webs" :key="web?.id" :class="form?.web?.includes(web?.id) ? 'border-2 border-sky-200 bg-sky-100' : 'bg-white'" class=" w-96 p-3 rounded-lg flex items-center justify-start gap-x-2">
                            <input type="checkbox" name="" id="" :value="web?.id" v-model="form.web">
                            <div class="flex items-center justify-between gap-x-2 font-second w-full">
                                <div>
                                    <h1 class="text-md">{{ web?.name }}</h1>
                                    <p class="text-xs text-slate-700">{{ web?.description }}</p>
                                </div>
                                <div :class="web?.scope == 'General' ? 'bg-emerald-500' : 'bg-sky-500'" class="text-sm  px-2 py-1 rounded-lg text-white">
                                    {{ web?.scope }}
                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="font-primary tex-md text-red-500 text-center">
                            No page options
                        </div>
                    </template>
                </div>
                <p v-if="err?.web" class="text-red-500 font-second text-xs my-2">{{ err?.web[0] }}</p>
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