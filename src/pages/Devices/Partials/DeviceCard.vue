<template>
    <div
        class="flex max-w-md overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800 h-full border"
    >
        <img :src="modelValue.image_url" class="w-1/3 object-cover" />

        <div class="w-2/3 p-4 md:p-4 flex flex-col justify-between">
            <div>
                <span class="flex items-center gap-2">
                    <h1 class="text-xl font-bold text-gray-800 dark:text-white">
                        {{ modelValue.name }}
                    </h1>

                    <FingerPrintIcon class="w-6 text-white/80" />
                </span>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ modelValue.description }}
                </p>
            </div>

            <div class="flex justify-between item-center mt-8">
                <div
                    v-if="modelValue.status == 'online'"
                    class="flex items-center gap-x-1.5"
                >
                    <div
                        class="flex-none rounded-full p-1"
                        :class="{
                            'bg-emerald-500/20 animate-pulse ':
                                modelValue.status == 'online',
                            'bg-gray-200/20': modelValue.status != 'online',
                        }"
                    >
                        <div class="h-1.5 w-1.5 rounded-full bg-emerald-500" />
                    </div>
                    <p class="text-xs leading-5 text-gray-500 capitalize">
                        {{ modelValue.status }}
                    </p>
                </div>
                <RouterLink
                    :to="`/devices/${modelValue.id}`"
                    class="px-2 py-1 text-xs font-bold text-white uppercase transition-colors duration-300 transform bg-gray-800 rounded dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:bg-gray-700 dark:focus:bg-gray-600"
                >
                    View
                </RouterLink>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { FingerPrintIcon } from "@heroicons/vue/24/outline";
import { RouterLink } from "vue-router";
interface Props {
    modelValue: App.Models.Device;
}
defineProps<Props>();
</script>
