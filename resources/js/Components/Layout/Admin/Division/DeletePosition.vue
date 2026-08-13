<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import Loading from '@/Components/Loading.vue';
import { TriangleAlert, Trash2 } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
const emit = defineEmits(['close', 'success']);
const props = defineProps(['position']);
const show = ref(false);
const loading = ref(false);

const err = ref({});
async function hapus() {
    try{
        loading.value = true;
        const response = await axios.delete(`/api/priority-first/position/${props?.position?.id}`);
        emit('success')
    }catch(error){
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
        <section @click.stop data-aos="zoom-in" class="p-3 rounded-lg border-2 border-slate-300 bg-black mx-3 max-w-md">
            <TriangleAlert data-aos="zoom-in" data-aos-delay="500" size="50" class="text-red-500 mx-auto" />
            <h1 data-aos="fade-up" data-aos-delay="500" class="text-white font-second text-lg text-center">Delete Position</h1>
            <p data-aos="fade-down" data-aos-delay="500" class="text-center text-sm text-white/80">Deleting the <span class="text-white">{{ props?.position?.name }}</span> position means deleting all integrated data, including user position data. Are you sure you want to delete it?</p>
            <form action="" @submit.prevent="hapus" class="font-second text-black my-2">
                <Transition name="zoom">
                    <button v-if="show" type="submit" :disabled="loading" :class="loading ? 'cursor-not-allowed' : 'cursor-pointer hover:bg-red-600 transition-all duration-500'" class="py-1.5 my-4 rounded-lg bg-red-500 w-full text-white active:scale-95 flex items-center justify-center gap-x-0.5">
                        <template v-if="!loading">
                            <Trash2 size="20" class="text-white" />
                            <span>Delete</span>
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