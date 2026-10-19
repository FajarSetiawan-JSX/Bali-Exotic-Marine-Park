<script setup>
import FormLoading from '@/Components/FormLoading.vue';
import { X, Plus } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { eror } from '@/Helper/Toast';
import { computed } from 'vue';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['divisions', 'sections']);
const divisions = ref([]);
const sections = ref([]);
const show = ref(false);
const loading = ref(false);
const form = ref({
    question: '',
    type: '',
    division: '',
    section: '',
    part: ''
});
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post(route('super.admin.question.store'), form.value);
        emit('success', response?.data?.data);
    }catch(error){
        if(error?.response?.status == 422){
            err.value = error?.response?.data?.errors;
        }
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
const opensection = computed(()=>{
    const selecdivision = divisions.value.find((item)=>{
        return item.id === form.value.division
    })
    return selecdivision?.name === 'Security' ? true : false
})
const openpart = computed(()=>{
    const selecsection = sections.value.find((item)=>{
        return item?.id == form.value.section
    })
    return selecsection?.incident == 1 ? true : false
})
onMounted(()=>{
    divisions.value = props?.divisions;
    sections.value = props?.sections;
    setTimeout(()=>{
        show.value = true;
    },500)
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm p-4">
        <div data-aos="zoom-in" class="flex max-h-max w-full max-w-lg flex-col overflow-hidden rounded-3xl bg-white shadow-2xl">
            <div class="border-b border-slate-200 px-6 py-5 flex-shrink-0">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            Create new question
                        </h2>
                        <p class="text-sm text-slate-500">Add a new question.</p>
                    </div>
                    <button type="button" @click="emit('close')" class="rounded-lg p-2 transition hover:bg-slate-100">
                        <X size="20" />
                    </button>
                </div>
            </div>

            <form @submit.prevent="create" class="flex flex-1 flex-col overflow-hidden font-second">
                <div class="flex-1 overflow-y-auto max-h-max p-6 space-y-2">
                    <div class="col-span-2">
                        <label for="desc" class="block text-sm font-medium text-slate-700">Question</label>
                        <textarea v-model="form.question" type="text" name="desc" id="desc" placeholder="how are you?" class="mt-1 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"></textarea>
                        <p v-if="err.question" class="mt-2 text-red-500 text-xs">{{ err.question[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-slate-700">Type Question?</label>
                        <div class="flex items-center justify-start gap-x-5 text-sm mt-2">
                            <label for="yes">
                                <input type="radio" name="" id="yes" :value="'Checklist'" v-model="form.type">
                                Checklist
                            </label>
                            <label for="no">
                                <input type="radio" name="" id="no" :value="'Text'" v-model="form.type">
                                Text
                            </label>
                        </div>
                        <p v-if="err.trigger" class="mt-2 text-red-500 text-xs">{{ err.trigger[0] }}</p>
                    </div>
                    <div class="col-span-2">
                        <label for="" class="block text-sm font-medium text-slate-700">Division</label>
                        <select name="" id="" v-model="form.division" class="flex w-full rounded-lg mt-1 border-2 border-slate-300 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="" disabled selected>Select Division</option>
                            <option :value="division?.id" v-for="division in divisions" :key="division?.id" >{{ division?.name }}</option>
                        </select>
                        <p v-if="err.division" class="mt-2 text-red-500 text-xs">{{ err.division[0] }}</p>
                    </div>
                    <div v-if="opensection" class="col-span-2">
                        <label for="" class="block text-sm font-medium text-slate-700">Section</label>
                        <select name="" id="" v-model="form.section" class="flex w-full rounded-lg mt-1 border-2 border-slate-300 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="" disabled selected>Select Section</option>
                            <option :value="section?.id" v-for="section in sections" :key="section?.id" >{{ section?.name }}</option>
                        </select>
                        <p v-if="err.section" class="mt-2 text-red-500 text-xs">{{ err.section[0] }}</p>
                    </div>
                    <div v-if="openpart && opensection" class="col-span-2">
                        <label for="part" class="block text-sm font-medium text-slate-700">Part Question</label>
                        <select name="" id="part" v-model="form.part" class="flex rounded-lg mt-1 w-full border-2 border-slate-300 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="" disabled selected>Select Part Question</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                        </select>
                        <p v-if="err.part" class="mt-2 text-red-500 text-xs">{{ err.part[0] }}</p>
                    </div>
                </div>
                <div class="flex-shrink-0 border-t border-slate-200 bg-white px-6 py-4">
                    <Transition name="zoom">
                        <button v-if="show" type="submit" :disabled="loading" class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-emerald-400 py-2 text-white transition hover:bg-emerald-500 disabled:cursor-not-allowed">
                            <template v-if="!loading">
                                <Plus size="20" />
                                <span>Create</span>
                            </template>
                            <template v-else>
                                <FormLoading color="bg-white my-3" />
                            </template>
                        </button>
                    </Transition>
                </div>
            </form>
        </div>
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