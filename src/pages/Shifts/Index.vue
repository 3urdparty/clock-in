<template>
    <div>
        <div class="overflow-scroll h-[82vh] border rounded-md">
            <Calendar :data="shifts" />
        </div>
    </div>
</template>
<script setup lang="ts">
import Calendar from "@/components/Calendar.vue";
import { useFetch } from "@vueuse/core";
const { data: shifts } = useFetch<App.Models.Shift[]>(
    "http://127.0.0.1:8000/api/calendar?week_number=52",
)
    .get()
    .json();
</script>
