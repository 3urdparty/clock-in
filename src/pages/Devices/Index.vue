<template>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <DeviceCard :modelValue="device" v-for="device in devices ?? []" />
    </div>
</template>

<script setup lang="ts">
import { useFetch } from "@vueuse/core";
import DeviceCard from "./Partials/DeviceCard.vue";
const { data: devices } = useFetch<App.Models.Device[]>(
    `${import.meta.env.VITE_APP_API_URL}/devices`,
)
    .get()
    .json();
</script>
