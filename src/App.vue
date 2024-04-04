<template>
  <Dashboard>
    <main class="dark:bg-slate-950 p-8 pt-8 w-full">
      <RouterView />
    </main>
  </Dashboard>
</template>
<script setup lang="ts">
import Dashboard from "./layouts/Dashboard.vue";
</script>
