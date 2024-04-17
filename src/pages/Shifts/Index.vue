<template>
    <div>
        <div class="overflow-scroll h-[73vh] border rounded-md mt-8">
            <Calendar :data="shifts as App.Models.Shift[]" />
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
