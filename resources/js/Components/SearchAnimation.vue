<script setup>
import { ref, nextTick, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    placeholder: {
        type: String,
        default: 'Search...'
    }
})

const emit = defineEmits(['search'])

const toolbar = ref(null)
const input = ref(null)

const isOpen = ref(false)
const keyword = ref('')

function open() {
    isOpen.value = true

    nextTick(() => {
        input.value?.focus()
    })
}

function close() {
    isOpen.value = false
    keyword.value = ''
}

function toggle() {
    isOpen.value ? close() : open()
}

function clear() {
    keyword.value = ''
    emit('search', '')
    nextTick(() => input.value?.focus())
}

function search() {
    emit('search', keyword.value)
}

function clickOutside(e) {
    if (!toolbar.value) return

    if (!toolbar.value.contains(e.target)) {
        close()
    }
}

function keydown(e) {
    if (e.key === 'Escape') {
        close()
    }
}

onMounted(() => {
    document.addEventListener('mousedown', clickOutside)
    document.addEventListener('keydown', keydown)
})

onUnmounted(() => {
    document.removeEventListener('mousedown', clickOutside)
    document.removeEventListener('keydown', keydown)
})
</script>
<template>
    <div
        ref="toolbar"
        class="relative"
    >
        <div
            class="flex items-center overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition-all duration-300 ease-in-out"
            :class="isOpen ? 'w-[250px] sm:w-[320px]' : 'w-[49px]'"
        >
            <!-- Search / Back -->
            <button
                @click="toggle"
                class="flex h-12 w-12 shrink-0 items-center justify-center hover:bg-slate-100 transition-all duration-300"
            >
                <Transition name="icon" mode="out-in">
                    <span :key="isOpen">
                        <slot
                            v-if="!isOpen"
                            name="search"
                        />
                        <slot
                            v-else
                            name="back"
                        />
                    </span>
                </Transition>
            </button>

            <!-- Input -->
            <Transition name="input">
                <div
                    v-if="isOpen"
                    class="flex flex-1 items-center pr-3"
                >
                    <input
                        ref="input"
                        v-model="keyword"
                        :placeholder="placeholder"
                        @input="search"
                        class="h-12 flex-1 bg-transparent text-sm outline-none"
                    >

                    <button
                        v-if="keyword"
                        @click="clear"
                        class="flex h-8 w-8 items-center justify-center rounded-full hover:bg-slate-100"
                    >
                        ✕
                    </button>
                </div>
            </Transition>
        </div>
    </div>
</template>
<style scoped>
input{
    outline:none;
    border:none;
    background:transparent;
    box-shadow:none;
}

input:focus{
    outline:none;
    box-shadow:none;
}

input::-webkit-search-decoration,
input::-webkit-search-cancel-button,
input::-webkit-search-results-button,
input::-webkit-search-results-decoration{
    display:none;
}

button{
    transition:
        background-color .2s ease,
        transform .2s ease,
        opacity .2s ease,
        width .3s ease;
}

button:hover:not(:disabled){
    transform:scale(1.03);
}

button:active:not(:disabled){
    transform:scale(.96);
}

/* Icon Animation */
.icon-enter-active,
.icon-leave-active{
    transition:all .2s ease;
}

.icon-enter-from{
    opacity:0;
    transform:rotate(-90deg) scale(.7);
}

.icon-enter-to{
    opacity:1;
    transform:rotate(0) scale(1);
}

.icon-leave-from{
    opacity:1;
    transform:rotate(0) scale(1);
}

.icon-leave-to{
    opacity:0;
    transform:rotate(90deg) scale(.7);
}

/* Input Animation */
.input-enter-active,
.input-leave-active{
    transition:all .25s ease;
}

.input-enter-from{
    opacity:0;
    transform:translateX(12px);
}

.input-enter-to{
    opacity:1;
    transform:translateX(0);
}

.input-leave-from{
    opacity:1;
    transform:translateX(0);
}

.input-leave-to{
    opacity:0;
    transform:translateX(12px);
}

/* Shadow */
.shadow-sm{
    transition:
        box-shadow .25s ease,
        width .3s ease;
}

.shadow-sm:hover{
    box-shadow:0 12px 30px rgba(15,23,42,.08);
}
</style>