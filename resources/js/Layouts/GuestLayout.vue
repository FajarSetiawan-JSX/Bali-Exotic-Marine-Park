<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
const mobile = ref(false);
const boun = ref(false);
const props = defineProps(['reset']);
onMounted(()=>{
    mobile.value = true;
    boun.value = true;
})
</script>

<template>
    <div class="flex min-h-screen flex-col items-center gradient-bg justify-center sm:pt-0">
        <div class="w-full shadow-md sm:max-w-md sm:rounded-xl grid grid-cols-1 md:grid-cols-2 md:max-w-6xl bg-white">
            <div class="bg-slate-200 p-8">
                <Transition name="bounce">
                  <template v-if="boun">
                    <template v-if="props.reset">
                      <img src="/assets/changepass.png" class="m-auto">
                    </template>
                    <template v-else>
                      <div class="max-w-max rounded-xl overflow-hidden" style="background: linear-gradient(135deg, #F6FBFF 0%, #EAF5FB 100%);">
                        <img src="/BEMP.png" class="m-auto">
                      </div>
                    </template>
                  </template>
                </Transition>
                <h2 data-aos="zoom-out" data-aos-offset="0" class="text-3xl font-bold text-slate-800 text-center font-second mt-5">
                    {{ props.reset ? 'Reset your password' : 'Seamless Connectivity' }}
                </h2>
                <p data-aos="zoom-out" data-aos-delay="500" data-aos-offset="0" class="text-slate-500 text-center font-primary">
                    {{ props.reset ? 'We prioritize security. Your personal data and reports are our top priority. Update your password for enhanced security.' : 'Experience the future of data synchronization across all your professional devices with our unified platform.' }}  
                </p>
            </div>
            <div class="bg-white p-8">
                <slot />
            </div>
        </div>
    </div>
</template>


<style scoped>
.slide-b-enter-active {
  transition: all 1s ease-out;
}

.slide-b-leave-active {
  transition: all 1s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-b-enter-from,
.slide-b-leave-to {
  transform: translateY(-40px);
  opacity: 0;
}
.gradient-bg {
    background: linear-gradient(
        200deg,
        #dcc1f8,
        #FFFFFF,
        #dcc1f8
    );
}

.bounce-enter-active {
  animation: bounce-in 0.8s;
}
.bounce-leave-active {
  animation: bounce-in 0.8s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}
</style>
