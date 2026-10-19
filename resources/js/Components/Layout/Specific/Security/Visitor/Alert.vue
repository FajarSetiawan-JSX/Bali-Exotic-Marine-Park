<script setup>
import { MessageCircleWarning } from 'lucide-vue-next';
import { onMounted } from 'vue';

const emit = defineEmits(['close']);
const props = defineProps(['tipe']);
onMounted(()=>{
    console.log(props?.tipe)
})
</script>

<template>
    <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-gradient-to-br from-indigo-950/95 via-violet-900/85 to-fuchsia-900/90 backdrop-blur-sm p-4">
        <div data-aos="zoom-in" class="w-full max-w-sm md:max-w-md rounded-2xl md:rounded-3xl bg-white shadow-2xl overflow-hidden">
            <div class="flex items-center justify-center border-b border-slate-200 px-5 md:px-6 py-4 md:py-5">
                <div>
                    <MessageCircleWarning size="30" class="text-yellow-500 mx-auto" />
                    <h2 class="text-sm font-semibold text-slate-500">
                        Instruction
                    </h2>
                </div>
            </div>
            <div class="my-5">
                <h3 class="text-center text-xl font-second">Berikan nametag warna {{ props?.tipe == 'supplier' ? 'Hijau' : props?.tipe == 'vendor' ? 'Biru' : 'Kuning' }}!</h3>
            </div>
            <footer class="flex flex-col gap-2 border-t border-slate-200 px-5 md:px-6 py-4">
                <button type="button" @click="emit('close')" class="w-full rounded-lg bg-emerald-500 px-4 py-2.5 text-sm md:text-base font-semibold text-white shadow-md shadow-emerald-500/20 transition hover:bg-emerald-600">
                    OK
                </button>
            </footer>
        </div>
    </div>
</template>