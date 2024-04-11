<template>
    <div
        class="w-48 h-1.5 rounded-full"
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
                width: `${(end - start) / 0.24}%`,
                left: `${start / 0.24}%`,
            }"
        >
            <span
                class="absolute -left-12 text-white -top-1.5 text-xs font-medium bg-blue-400 rounded-md px-1"
            >
                {{ formatTime(start as number) }}
            </span>
            <span
                class="absolute -right-12 text-white -top-1.5 text-xs font-medium bg-blue-400 rounded-md px-1"
            >
                {{ formatTime(end as number) }}</span
            >
        </div>
    </div>
</template>
<script setup lang="ts">
import { defineProps } from "vue";
interface Props {
    start: number;
    end: number;
    ongoing: boolean;
}
const props = defineProps<Props>();
const pad = (n: number) => (n.toString().length <= 1 ? "0" : "") + n.toString();
const formatTime = (time: number) =>
    `${pad(Math.floor(time))}:${pad(Math.floor((time - Math.floor(time)) * 60))}`;
</script>
