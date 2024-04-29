<template>
    <div>
        <div class="grid grid-cols-3 gap-4 px-0.5">
            {{ statistics?.barchart.last_7_days.total }}
            <StatSection class="col-span-3" :data="statistics?.stats" />
            <Barchart :data="statistics?.barchart" />

            <LineChart :hours="statistics?.barchart.last_7_days.total" />

            <EmployeesCard :data="employees ?? []" />
        </div>
    </div>
</template>
<script setup lang="ts">
import StatSection from "@/pages/Partials/StatSection.vue";
import LineChart from "@/components/LineChart.vue";
import Barchart from "@/components/Barchart.vue";
import EmployeesCard from "@/pages/Partials/EmployeesCard.vue";
import { useAxios } from "@vueuse/integrations/useAxios";
import { instance } from "@/api/instance";
const { data: employees } = useAxios<App.Models.Employee[]>(
    "/employees",
    { method: "GET" },
    instance,
);

interface Statistics {
    barchart: App.Models.BarChart;
    stats: App.Models.Statistic[];
}
const { data: statistics } = useAxios<Statistics>(
    "/statistics",
    { method: "GET" },
    instance,
);
</script>
