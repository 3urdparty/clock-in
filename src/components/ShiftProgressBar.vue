<template>
    <div
        class="w-48 h-1.5 rounded-full px-3"
        :class="[ongoing ? 'bg-green-100/80' : 'bg-blue-100/80']"
    >
        <div
            class="h-1.5 rounded-full relative"
            :class="[
                ongoing
                    ? 'animate-pulse bg-green-400'
                    : 'animate-none bg-blue-500',
            ]"
            :style="{
                width: `${duration / 0.24 + 3}%`,
                left: `${start / 24}%`,
            }"
        >
            <span
                class="absolute -left-11 text-white -top-1.5 text-xs font-medium bg-blue-400 rounded-md px-1"
            >
                {{ formatTime(start as number) }}
            </span>
            <span
                v-if="end"
                class="absolute -right-12 text-white -top-1.5 text-xs font-medium bg-blue-400 rounded-md px-1"
            >
                {{ formatTime(end as number) }}</span
            >
        </div>
    </div>
</template>
<script setup lang="ts">
import { formatTime } from "@/utils/formatTime";
import { defineProps } from "vue";
interface Props {
    start: number;
    end: number;
    duration: number;
    ongoing: boolean;
}
const props = defineProps<Props>();
</script>
