<template>
  <div
    class="w-48 h-1.5 overflow-hidden rounded-full"
    :class="[ongoing ? 'bg-green-100/80' : 'bg-blue-100/80']"
  >
    <div
      class="h-1.5 rounded-full relative"
      :class="[
        ongoing ? 'animate-pulse bg-green-400' : 'animate-none bg-blue-500',
      ]"
      :style="{ width: `${(end - start) / 0.24}%`, left: `${start / 0.24}%` }"
    ></div>
  </div>
</template>
<script setup lang="ts">
import { defineProps } from "vue";
interface Props {
  start: number;
  end: number;
  ongoing: boolean;
}
const props = defineProps<Props>();
</script>
