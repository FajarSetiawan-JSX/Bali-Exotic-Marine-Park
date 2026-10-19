<script setup>
import { ref } from 'vue'
import { Calendar, ChevronUp, PawPrint, Stethoscope, Plus } from 'lucide-vue-next'

const open = ref(false);
const props = defineProps(['report']);
</script>

<template>
  <section class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white">
        <div class="flex items-center justify-between gap-4 p-6">
          <div class="flex items-center gap-4">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-base font-semibold text-sky-800">
              AP
            </div>
            <div>
              <h3 class="text-lg font-semibold text-slate-900">{{ props?.report?.officer }}</h3>
              <p class="mt-1 text-sm text-slate-500">{{ props?.report?.mamal }}</p>
            </div>
          </div>

          <div class="flex items-center gap-5">
            <div class="space-y-1.5">
              <div class="flex items-center gap-2 text-sm font-medium text-slate-900">
                <Calendar class="h-4 w-4 text-slate-500" />
                {{ props?.report?.date }}
              </div>
            </div>

            <button type="button" aria-label="Toggle detail" @click="open = !open" class="flex h-10 w-10 items-center justify-center rounded-full bg-sky-100 text-sky-800 transition-colors hover:bg-sky-200">
              <ChevronUp class="h-5 w-5 transition-transform duration-300" :class="open ? 'rotate-0' : 'rotate-180'"/>
            </button>
          </div>
        </div>
        <div class="grid transition-all duration-300" :class="open ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'">
          <div class="overflow-hidden">
            <div class="grid border-t border-slate-200 md:grid-cols-2 md:divide-x md:divide-slate-200">
              <div class="p-6">
                <div class="flex items-center gap-3">
                  <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-50 text-sky-800">
                    <PawPrint class="h-5 w-5" />
                  </div>
                  <div>
                    <p class="text-xs font-medium uppercase text-slate-500">Daily Observation</p>
                    <h4 class="text-xl font-semibold text-slate-900">Mammal Report</h4>
                  </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-5">
                  <div>
                    <p class="text-xs text-slate-500">Diet (kg)</p>
                    <p class="mt-1 text-2xl font-medium text-slate-900">{{ props?.report?.diet }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Breathing / min</p>
                    <p class="mt-1 text-2xl font-medium text-slate-900">{{ props?.report?.breathe }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Feces count</p>
                    <p class="mt-1 text-2xl font-medium text-slate-900">{{ props?.report?.faces }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Floating count</p>
                    <p class="mt-1 text-2xl font-medium text-slate-900">{{ props?.report?.floating }}</p>
                  </div>
                </div>

                <div class="mt-6 space-y-5 border-t border-slate-200 pt-6">
                  <div>
                    <p class="text-xs text-slate-500">Attentive</p>
                    <p class="mt-1 text-sm text-slate-900">{{ props?.report?.attentive ?? '' }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Skin condition</p>
                    <p class="mt-1 text-sm text-slate-900">{{ props?.report?.skin ?? '' }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Eye condition</p>
                    <p class="mt-1 text-sm text-slate-900">{{ props?.report?.eyes ?? '' }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Remark</p>
                    <p class="mt-1 text-sm text-slate-900">
                      {{ props?.report?.remark ?? '' }}
                    </p>
                  </div>
                </div>
              </div>
              <div v-if="props?.report?.vet" class="p-6">
                <div class="flex items-center gap-3">
                  <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                    <Stethoscope class="h-5 w-5" />
                  </div>
                  <div>
                    <p class="text-xs font-medium uppercase text-slate-500">Veterinary Assessment</p>
                    <h4 class="text-xl font-semibold text-slate-900">Vet Report</h4>
                  </div>
                </div>

                <div class="mt-6 grid grid-cols-4 gap-x-6">
                  <div>
                    <p class="text-xs text-slate-500">Group</p>
                    <p class="mt-1 text-2xl font-medium text-slate-900">{{ props?.report?.vet?.group }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Health</p>
                    <span :class="props?.report?.vet?.health == 'FIT' ? 'bg-emerald-50 text-emerald-700' : props?.report?.vet?.health == 'FIT RINGAN' ? 'bg-orange-50 text-orange-700' : 'bg-red-50 text-red-700'"
                      class="mt-2 inline-block rounded-md px-2.5 py-1 text-xs font-semibold"
                    >
                      {{ props?.report?.vet?.health }}
                    </span>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Social</p>
                    <span :class="props?.report?.vet?.social == 'STABLE' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'"
                      class="mt-2 inline-block rounded-md px-2.5 py-1 text-xs font-semibold"
                    >
                      {{ props?.report?.vet?.social }}
                    </span>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Status</p>
                    <span :class="props.report.vet.status == 'GO' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'"
                      class="mt-2 inline-block rounded-md px-2.5 py-1 text-xs font-semibold"
                    >
                      {{ props?.report?.vet?.status }}
                    </span>
                  </div>
                </div>

                <div class="mt-6 space-y-5 border-t border-slate-200 pt-6 md:mt-12">
                  <div>
                    <p class="text-xs text-slate-500">Recommendation program</p>
                    <p class="mt-1 text-sm text-slate-900">{{ props?.report?.vet?.program }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Clinical / Klinis</p>
                    <p class="mt-1 text-sm text-slate-900">{{ props?.report?.vet?.klinis }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Additional</p>
                    <p class="mt-1 text-sm text-slate-900">
                      {{ props?.report?.vet?.additional ?? '' }}
                    </p>
                  </div>
                  <div>
                    <p class="text-xs text-slate-500">Remark</p>
                    <p class="mt-1 text-sm text-slate-900">{{ props?.report?.vet?.remark ?? '' }}</p>
                  </div>
                </div>
              </div>
            </div>
            <slot />
          </div>
        </div>
  </section>
</template>