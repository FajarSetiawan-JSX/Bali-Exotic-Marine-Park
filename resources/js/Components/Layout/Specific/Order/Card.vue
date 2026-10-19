<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'
import { Ellipsis, Check, Package, Banknote, Zap, Truck, Clock } from 'lucide-vue-next'

const isOpen = ref(false)
const dropdown = ref(null)

function toogle() {
    isOpen.value = !isOpen.value
}

function closeDropdown(event) {
    if (dropdown.value && !dropdown.value.contains(event.target)) {
        isOpen.value = false
    }
}

onMounted(() => document.addEventListener('click', closeDropdown))
onBeforeUnmount(() => document.removeEventListener('click', closeDropdown))
</script>

<template>
    <article class="w-full rounded-xl border border-slate-200 bg-white p-4 text-slate-800 shadow-sm sm:p-6">
        <div class="flex items-center justify-between">
            <span class="text-xs text-slate-500 sm:text-sm">PO-2026-024</span>
            <div ref="dropdown" class="relative">
                <button type="button" @click.stop="toogle" class="relative z-20 rounded-md p-1 text-slate-500 hover:bg-slate-100" :class="{ 'bg-slate-100': isOpen }">
                    <Ellipsis class="size-4" />
                </button>
                <div @click.stop v-if="isOpen" class="absolute right-0 top-full z-20 mt-2 w-52 rounded-xl border border-slate-200 bg-white shadow-lg sm:w-56">
                    <p class="border-b border-slate-100 px-4 py-3 text-base font-semibold sm:text-lg">Purchase order</p>
                    <div class="p-1.5 space-y-2">
                        <button type="button" class="flex w-full items-center gap-3 rounded-lg bg-emerald-50 px-3 py-2 text-sm hover:bg-emerald-100 text-emerald-400 active:scale-95 transition-all duration-300">
                            <Check class="size-4" /> Confirmation
                        </button>
                        <button type="button" class="flex w-full items-center gap-3 rounded-lg bg-yellow-50 px-3 py-2 text-sm text-yellow-400 hover:bg-yellow-100 active:scale-95 transition-all duration-300">
                            <Package class="size-4" /> Arrival
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 flex items-center gap-3">
            <span class="grid size-10 shrink-0 place-items-center rounded-full bg-sky-100 text-xs font-medium text-sky-500">KS</span>
            <div>
                <p class="text-sm font-medium">Kadek Sukma</p>
                <p class="text-xs text-slate-500">Animal Care</p>
            </div>
        </div>

        <span class="mt-4 inline-block rounded-md bg-sky-100 px-2 py-1 text-xs text-sky-600">Operational</span>
        <h3 class="mt-3 text-base font-semibold sm:text-lg">Pompa sirkulasi kolam</h3>

        <p class="mt-6 text-xs text-slate-500">Nominal purchase order</p>
        <p class="mt-1 text-2xl font-bold sm:text-3xl">Rp 8.500.000</p>

        <div class="mt-5 border-t border-slate-200 pt-4">
            <p class="text-xs text-slate-500">Supplier</p>
            <p class="mt-2 text-sm font-medium">PT Tirta Teknik Bali</p>
            <p class="mt-3 flex items-center gap-2 text-xs text-slate-500"><Banknote class="size-4" /> Rekening supplier</p>
            <div class="mt-2 flex items-center gap-3">
                <span class="rounded-md bg-slate-100 px-2 py-1 text-xs font-semibold">BCA</span>
                <span class="text-sm">000 000 1001</span>
            </div>
        </div>

        <div class="mt-4 flex items-center justify-between">
            <span class="flex items-center gap-1.5 rounded-md bg-red-50 px-2 py-1.5 text-xs text-red-500"><Zap class="size-4" /> Urgent</span>
            <span class="flex items-center gap-1.5 text-xs text-slate-500"><Truck class="size-4" /> 2 hari pengiriman</span>
        </div>

        <div class="mt-4 flex items-center justify-between border-t border-slate-200 pt-4 text-xs">
            <span class="flex items-center gap-1.5 text-amber-600"><Clock class="size-4" /> Menunggu konfirmasi</span>
            <span class="flex items-center gap-1.5 text-slate-500"><Truck class="size-4" /> Belum tiba</span>
        </div>
    </article>
</template>
