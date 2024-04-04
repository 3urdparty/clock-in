<template>
    <div>
        <div class="grid grid-cols-3 gap-4">
            <StatSection class="col-span-3" :data="statistics?.stats" />
            <Barchart :data="statistics?.barchart" />
            <LineChart />
            <RecentShiftsCard :data="employees ?? []" />
        </div>
    </div>
</template>
<script setup lang="ts">
import StatSection from "@/pages/Partials/StatSection.vue";
import LineChart from "@/components/LineChart.vue";
import Barchart from "@/components/Barchart.vue";
import RecentShiftsCard from "@/pages/Partials/RecentShiftsCard.vue";
import { useFetch } from "@vueuse/core";
const { data: shifts } = useFetch<App.Models.Shift[]>(
    `${import.meta.env.VITE_APP_API_URL}/shifts`,
)
    .get()
    .json();
const { data: employees } = useFetch<App.Models.Shift[]>(
    `${import.meta.env.VITE_APP_API_URL}/employees`,
)
    .get()
    .json();

const { data: statistics } = useFetch(
    `${import.meta.env.VITE_APP_API_URL}/statistics`,
)
    .get()
    .json();
</script>
