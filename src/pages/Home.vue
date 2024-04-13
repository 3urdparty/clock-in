<template>
    <div>
        <div class="grid grid-cols-3 gap-4 px-0.5">
            <div
                v-if="isLoading || error"
                class="grid grid-cols-3 gap-2 col-span-3"
            >
                <div class="space-y-2">
                    <Skeleton />
                    <Skeleton />
                </div>
                <div class="flex gap-1 w-full">
                    <div
                        class="rounded-full w-10 h-10 bg-gradient-to-br from-blue-200/50 to-blue-300/30 animate-pulse"
                    ></div>
                </div>
            </div>

            <StatSection v-else class="col-span-3" :data="statistics?.stats" />
            <template v-if="isLoading || error">
                <div
                    v-for="i in 3"
                    class="bg-gradient-to-br from-blue-200/50 to-blue-300/30 w-full rounded-md animate-pulse"
                    :class="{
                        'h-[30rem]': i === 1,
                        'h-[25rem]': i === 2,
                        'h-80': i === 3,
                    }"
                ></div>
            </template>
            <template v-else>
                <Barchart :data="statistics?.barchart" />

                <LineChart />

                <EmployeesCard :data="employees ?? []" />
            </template>
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
import Skeleton from "@/components/Skeleton.vue";
const { data: employees } = useAxios<App.Models.Employee[]>(
    "/employees",
    { method: "GET" },
    instance,
);

interface Statistics {
    barchart: App.Models.BarChart;
    stats: App.Models.Statistic[];
}
const {
    data: statistics,
    isLoading,
    isFinished,
    error,
} = useAxios<Statistics>("/statistics", { method: "GET" }, instance);
</script>
