<script setup>
import { Link } from '@inertiajs/vue3';

import {
  Mail,
  Phone,
  MapPin,
} from 'lucide-vue-next'

const footerLinks = {
  Page: [
  {
    name: 'Fitur',
    link: '#fitur'
  },{
    name: 'Cara Kerja',
    link: '#cara'
  },{
    name: 'Sign In',
    link: '/login'
  }],
  Divisi: [
    'Marketing',
    'Kitchen',
    'Supervisor',
    'Security',
    'etc'
  ]
}
</script>

<template>
    <footer class="bg-slate-900 text-slate-400">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-2 md:grid-cols-6 gap-8 mb-12">
                <!-- Address -->
                <div class="col-span-2 space-y-4">
                    <div class="md:max-w-114 flex justify-start items-center gap-x-1.5">
                        <img id="logo-footer" class="h-9 md:h-9.5 w-auto shrink-0" src="/EXOTIC.png" alt="Logo" width={140} height={40} priority fetchPriority="high" />
                        <div>
                            <h1 class="font-exotic1 text-white text-2xl font-semibold">Bali Exotic</h1>
                            <h2 class="font-exotic2 text-slate-300 tracking-wide text-sm">Marine Park</h2>
                        </div>
                    </div>

                    <p class="text-sm leading-7 font-second">
                        Platform manajemen SDM dan jadwal otomatis Bali Exotic Marine Park.
                    </p>

                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <Mail class="w-4 h-4 shrink-0" />
                            <span class="text-[0.85rem]">
                                baliexoticmarinepark@gmail.com
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <Phone class="w-4 h-4 shrink-0" />
                            <span class="text-[0.85rem]">
                                +62 853-3883-3678
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <MapPin class="w-4 h-4 shrink-0" />
                            <span class="text-[0.85rem]">
                                Jalan Bali Eksotik No.8, Pedungan Denpasar City, Bali – 80222
                            </span>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-1">
                        <a v-for="(Icon, index) in socialIcons" :key="index" href="#" class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 hover:border-white/20 transition-colors">
                            <component :is="Icon" class="w-4 h-4" />
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div v-for="(links, heading) in footerLinks" :key="heading" class="space-y-4">
                    <h4 class="text-white text-sm font-semibold">
                        {{ heading }}
                    </h4>

                    <ul v-if="heading === 'Page'" class="space-y-2.5">
                        <li v-for="link in links" :key="link">
                            <a :href="link.link" class="text-[0.85rem] hover:text-white transition-colors">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                    <ul v-else class="space-y-2.5">
                        <li v-for="link in links" :key="link">
                            <a :href="link" class="text-[0.85rem] hover:text-white transition-colors">
                                {{ link }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-4 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-[0.82rem]">
                © 2026 Bali Exotic Marine Park. Hak cipta dilindungi
                undang-undang.
                </p>
            </div>
        </div>
    </footer>
</template>

<style scoped>

</style>