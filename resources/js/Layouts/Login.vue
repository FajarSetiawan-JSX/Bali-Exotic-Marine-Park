<script setup>
import Left from '@/Components/Login/left.vue';


</script>

<template>
    <section class="min-h-screen bg-stone-50 lg:grid lg:grid-cols-[44%_56%]">
        <left />
        <div class="flex items-center justify-center p-6 lg:p-12">
            <div class="w-full">
                <slot />
            </div>
        </div>
    </section>
</template>