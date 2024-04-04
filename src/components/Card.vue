<template>
  <div
    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
  >
    <slot name="header">
      <h5
        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
      >
        {{ title }}
      </h5>
    </slot>
    <slot>
      <p class="font-normal text-gray-700 dark:text-gray-400">
        {{ text }}
      </p>
    </slot>
    <slot name="footer">
      {{ footer }}
    </slot>
  </div>
</template>
<script setup lang="ts">
interface Props {
  title?: string;
  text?: string;
  footer?: string;
}
withDefaults(defineProps<Props>(), {});
</script>
