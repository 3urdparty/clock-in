<template>
    <div v-if="device" class="space-y-4">
        <DeviceCard :modelValue="device" />
        <Table :data="[]" class="h-[40vh]" />
    </div>
</template>
<script setup lang="ts">
import Table from "@/pages/Employees/Partials/EmployeeTable.vue";
import DeviceCard from "./Partials/DeviceCard.vue";
import { useAxios } from "@vueuse/integrations/useAxios";
import { instance } from "@/api/instance";
interface Props {
    id: number;
}

const props = defineProps<Props>();
const { data: device } = useAxios<App.Models.Device>(
    "/devices/" + props.id,
    { method: "GET" },
    instance,
);
</script>
