<template>
  <div>
    <img
      v-if="src"
      class="w-8 h-8 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
      :src="src"
      alt="Bordered avatar"
    />
    <div
      v-else
      class="relative w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600"
    >
      <svg
        class="absolute w-10 h-10 text-gray-400 -left-1"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
          clip-rule="evenodd"
        ></path>
      </svg>
    </div>
  </div>
</template>
<script setup lang="ts">
interface Props {
  src?: string;
}
const props = defineProps<Props>();
</script>
