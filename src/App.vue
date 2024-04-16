<template>
    <Dashboard v-if="currentRoute.fullPath != '/login'">
        <main class="dark:bg-slate-950 p-8 pt-8 w-full">
            <RouterView />
        </main>
    </Dashboard>

    <main class="dark:bg-slate-950 p-8 pt-8 w-full" v-else>
        <RouterView />
    </main>
</template>
<script setup lang="ts">
import { useRouter } from "vue-router";
const { currentRoute } = useRouter();
import Dashboard from "./layouts/Dashboard.vue";
</script>
