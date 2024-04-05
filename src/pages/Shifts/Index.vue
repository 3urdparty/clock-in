<template>
    <div>
        <div class="overflow-scroll h-[82vh] border rounded-md">
            <Calendar :data="shifts" />
        </div>
    </div>
</template>
<script setup lang="ts">
import Calendar from "@/components/Calendar.vue";
import { useAxios } from "@vueuse/integrations/useAxios";
import { instance } from "@/api/instance";
const { data: shifts } = useAxios<App.Models.Shift[]>(
    "/shifts",
    { method: "GET" },
    instance,
);
</script>
