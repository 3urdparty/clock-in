<template>
    <div v-if="device" class="space-y-4">
        <DeviceCard :modelValue="device" />
        <Table :data="[]" class="h-[40vh]" />
    </div>
</template>
<script setup lang="ts">
import Card from "@/components/Card.vue";
import Table from "@/pages/Employees/Partials/Table.vue";
import { useFetch } from "@vueuse/core";
import DeviceCard from "./Partials/DeviceCard.vue";

interface Props {
    id: number;
}

const props = defineProps<Props>();
const { data: device } = useFetch<App.Models.Device>(
    `${import.meta.env.VITE_APP_API_URL}/devices/${props.id}`,
)
    .get()
    .json();
</script>
