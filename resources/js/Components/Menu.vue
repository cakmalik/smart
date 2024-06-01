<template>
    <div v-if="showMenu"
        class="min-h-screen w-full fixed top-0 left-0 bg-black/80 backdrop-blur-md z-[999999999999999999999999999999999999]">
        <slot />
        <div class="absolute bottom-3 right-3">
            <button @click="showMenu = false"
                class="rounded-full flex items-center justify-center p-2 text-center text-white group transition duration-300">
                <i class="ph ph-x group-hover:scale-125"></i>
            </button>
        </div>
    </div>
</template>

<script setup>
import { inject } from "vue";

const Splade = inject("$splade");

import { useMouse, onKeyStroke, useMagicKeys, whenever } from "@vueuse/core";
import { watch, watchEffect, ref } from "vue";

const { ctrl, shift, space, a, escape } = useMagicKeys()
const showMenu = ref(false)

whenever(ctrl, () => showMenu.value = !showMenu.value)
whenever(escape, () => showMenu.value = false)

function visitCheckout() {
    console.log(123)
    Splade.visit("/checkout");
}
</script>