<template>
    <div v-if="showMenu"
        class="min-h-screen w-full fixed top-0 left-0 bg-black/80 backdrop-blur-md z-[999999999999999999999999999999999999]">
        <div ref="target" class="w-full flex items-center justify-center max-w-sm bg-red- h-screen mx-auto">
            <slot />
            <div class="absolute bottom-3 right-3">
                <button @click="showMenu = false"
                    class="rounded-full flex items-center justify-center p-2 text-center text-white group transition duration-300">
                    <i class="ph ph-x group-hover:scale-125"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="fixed sm:hidden bottom-0 right-3 text-black z-[99999999999999999999999999999999999999]" v-else
        @click="showMenu = true">
        <div class="p-3"><i class="ph ph-list group-hover:scale-125"></i></div>
    </div>
</template>

<script setup>
import { inject } from "vue";

const Splade = inject("$splade");

import { useMouse, onKeyStroke, useMagicKeys, whenever, onClickOutside } from "@vueuse/core";
import { watch, watchEffect, ref } from "vue";

const { ctrl, shift, space, a, escape } = useMagicKeys()
const showMenu = ref(false)

whenever(ctrl, () => showMenu.value = !showMenu.value)
whenever(escape, () => showMenu.value = false)

const target = ref(null)

onClickOutside(target, event =>
    showMenu.value = false
)
</script>