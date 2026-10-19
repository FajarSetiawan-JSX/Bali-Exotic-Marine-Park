<script setup>
import { X, Upload, FileText } from 'lucide-vue-next';
import { ref } from 'vue';
import axios from 'axios';
import { eror, succes } from '@/Helper/Toast';
import FullScreenLoading from '@/Components/FullScreenLoading.vue';
import { onMounted } from 'vue';
import LoadingPrimary from '@/Components/Layout/LoadingPrimary.vue';

const emit = defineEmits(['close', 'success']);
const props = defineProps(['basic']);
const loading = ref(false);
const fileInput = ref(null);
const fileName = ref('');
const previewUrl = ref('');
const isImage = ref(false);

const form = ref({
    basic: props?.basic?.id,
    name: '',
    sender: '',
    type: '',
    information: '',
    img: null,
});
const err = ref({});

function pickFile(e) {
    const file = e.target.files?.[0];
    if (!file) return;
    form.value.img = file;
    fileName.value = file.name;
    isImage.value = file.type.startsWith('image/');
    previewUrl.value = isImage.value ? URL.createObjectURL(file) : '';
}

function removeFile() {
    form.value.img = null;
    fileName.value = '';
    previewUrl.value = '';
    if (fileInput.value) fileInput.value.value = '';
}

async function create() {
    try {
        err.value = {};
        loading.value = true;
        const data = new FormData();
        data.append('basic', form.value.basic);
        data.append('name', form.value.name);
        data.append('sender', form.value.sender);
        data.append('type', form.value.type);
        data.append('information', form.value.information);
        if (form.value.img) {
            data.append('img', form.value.img);
        }
        await axios.post(route('specific.security.delivery.store'), data);
        emit('success', form.value.type);
    } catch (error) {
        if (error?.response?.status == 422) {
            err.value = error?.response?.data?.errors;
        }
        eror(error?.response?.status, error?.response?.data?.message);
    } finally {
        loading.value = false;
    }
}
onMounted(()=>{
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm p-4">
        <div data-aos="zoom-in" class="w-full max-w-sm md:max-w-md rounded-2xl md:rounded-3xl bg-white shadow-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 md:px-6 py-4 md:py-5">
                <h2 class="text-base md:text-lg font-semibold text-slate-900">
                    New Delivery
                </h2>
                <button type="button" @click="emit('close')" class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                    <X :size="18" />
                </button>
            </div>
            <form @submit.prevent="create" class="flex flex-col">
                <div class="space-y-4 px-5 md:px-6 py-5 max-h-80 overflow-y-scroll">
                    <div>
                        <label for="owner" class="mb-1.5 block text-xs md:text-sm font-medium text-slate-700">
                            Owner Item
                        </label>
                        <input type="text" name="" id="owner" v-model="form.name" class="w-full resize-none rounded-lg border border-slate-300 px-3 py-2 text-sm md:text-base text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        <p v-if="err?.name" class="mt-1 text-xs text-red-500">{{ err.name[0] }}</p>
                    </div>
                    <div>
                        <label for="sender" class="mb-1.5 block text-xs md:text-sm font-medium text-slate-700">
                            Sender
                        </label>
                        <input type="text" name="" id="sender" v-model="form.sender" class="w-full resize-none rounded-lg border border-slate-300 px-3 py-2 text-sm md:text-base text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        <p v-if="err?.sender" class="mt-1 text-xs text-red-500">{{ err.sender[0] }}</p>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs md:text-sm font-medium text-slate-700">
                            Select category
                        </label>
                        <select v-model="form.type" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm md:text-base text-slate-800 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                            <option value="" disabled selected>Select category</option>
                            <option value="Personal">Personal</option>
                            <option value="Other Parties">Other Parties</option>
                        </select>
                        <p v-if="err?.type" class="mt-1 text-xs text-red-500">{{ err.type[0] }}</p>
                    </div>
                    <div>
                        <label for="info" class="mb-1.5 block text-xs md:text-sm font-medium text-slate-700">
                            Information
                        </label>
                        <textarea v-model="form.information" rows="3" for="info" placeholder="Tuliskan isi barang atau informasi lainnya" class="w-full resize-none rounded-lg border border-slate-300 px-3 py-2 text-sm md:text-base text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500"></textarea>
                        <p v-if="err?.information" class="mt-1 text-xs text-red-500">{{ err.information[0] }}</p>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs md:text-sm font-medium text-slate-700">
                            Photo
                        </label>
                        <div v-if="fileName" class="relative rounded-lg border border-slate-300 p-3">
                            <button type="button" @click="removeFile" class="absolute -right-2 -top-2 rounded-full bg-slate-700 p-1 text-white shadow hover:bg-slate-900">
                                <X :size="12" />
                            </button>

                            <img v-if="isImage" :src="previewUrl" class="mx-auto max-h-48 w-full rounded-lg object-contain" />
                            <div v-else class="flex items-center gap-2 py-4 justify-center">
                                <FileText :size="20" class="text-slate-500" />
                                <span class="text-sm md:text-base text-slate-700 truncate max-w-[70%]">{{ fileName }}</span>
                            </div>
                        </div>
                        <label v-else class="flex flex-col items-center justify-center gap-1.5 rounded-lg border-2 border-dashed border-slate-300 px-4 py-6 text-center cursor-pointer transition hover:border-emerald-400 hover:bg-emerald-50/40">
                            <input ref="fileInput" type="file" accept=".jpg,.jpeg,.png,.pdf" class="hidden" @change="pickFile" />
                            <div class="rounded-lg bg-emerald-500 p-2">
                                <Upload :size="16" class="text-white" />
                            </div>
                            <p class="text-xs md:text-sm text-slate-600">
                                <span class="font-medium text-emerald-600">Upload</span> or drop photo here.
                            </p>
                            <p class="text-[10px] md:text-xs text-slate-400">JPG, PNG, or PDF (Max. 2 MB)</p>
                        </label>
                        <input v-if="fileName" ref="fileInput" type="file" accept=".jpg,.jpeg,.png,.pdf" class="hidden" @change="pickFile" />
                        <p v-if="err?.img" class="mt-1 text-xs text-red-500">{{ err.img[0] }}</p>
                    </div>
                </div>
                <footer class="flex flex-col gap-2 border-t border-slate-200 px-5 md:px-6 py-4">
                    <button type="submit" class="w-full rounded-lg bg-emerald-500 px-4 py-2.5 text-sm md:text-base font-semibold text-white shadow-md shadow-emerald-500/20 transition hover:bg-emerald-600">
                        Submit
                    </button>
                </footer>
            </form>
        </div>
    </div>
    <FullScreenLoading v-if="loading">
        <LoadingPrimary />
    </FullScreenLoading>
</template>