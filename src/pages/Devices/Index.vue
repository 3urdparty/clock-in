<template>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div v-if="isLoading || error" class="w-full">
            <div
                class="rounded-md px-4 py-5 sm:p-6 bg-gradient-to-br from-blue-200/50 to-blue-300/30 animate-pulse h-10 w-full"
            ></div>
            <div class="space-y-2">
                <div
                    class="rounded-md px-4 py-2 h-6 sm:p-6 bg-gradient-to-br from-blue-200/50 to-blue-300/30 animate-pulse"
                ></div>
                <div
                    class="rounded-md px-4 py-2 h-6 sm:p-6 bg-gradient-to-br from-blue-200/50 to-blue-300/30 animate-pulse"
                ></div>
            </div>
            <div class="flex gap-1 w-full mt-2">
                <div
                    class="rounded-full w-10 h-10 bg-gradient-to-br from-blue-200/50 to-blue-300/30 animate-pulse"
                ></div>
            </div>
        </div>
        <DeviceCard
            :modelValue="device"
            v-for="device in devices ?? []"
            navigateable
        />
    </div>
</template>

<script setup lang="ts">
import DeviceCard from "./Partials/DeviceCard.vue";
import { useAxios } from "@vueuse/integrations/useAxios";
import { instance } from "@/api/instance";
const {
    data: devices,
    isLoading,
    error,
} = useAxios<App.Models.Device[]>("/devices", { method: "GET" }, instance);
</script>
