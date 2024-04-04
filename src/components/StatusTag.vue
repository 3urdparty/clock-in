<template>
    <div class="mt-1 flex items-center gap-x-1.5">
        <div
            class="flex-none rounded-full bg-emerald-500/20 p-1"
            :class="{
                'animate-pulse bg-emerald-500': status === 'online',
                'bg-gray-100': status === 'offline',
            }"
        >
            <div
                class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                :class="{
                    'bg-emerald-500': status == 'online',
                    'bg-gray-300': status == 'offline',
                }"
            />
        </div>
        <p class="text-xs leading-5 text-gray-500 capitalize">{{ status }}</p>
    </div>
</template>
<script setup lang="ts">
interface Props {
    status: "online" | "offline";
}
defineProps<Props>();
</script>
