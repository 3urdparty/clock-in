<template>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 pt-6">
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
