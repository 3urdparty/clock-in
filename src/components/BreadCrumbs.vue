<template>
  <div>
    <nav class="sm:hidden" aria-label="Back">
      {{ links }}
      <a
        href="#"
        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700"
      >
        <ChevronLeftIcon
          class="-ml-1 mr-1 h-5 w-5 flex-shrink-0 text-gray-400"
          aria-hidden="true"
        />
        Back
      </a>
    </nav>
    <nav class="hidden sm:flex" aria-label="Breadcrumb">
      <ol role="list" class="flex items-center space-x-4">
        <li v-for="link in links">
          <div class="flex">
            <a
              href="#"
              class="text-sm font-medium text-gray-500 hover:text-gray-700"
              >{{ link.name }}</a
            >
          </div>
        </li>
      </ol>
    </nav>
  </div>
</template>
<script setup lang="ts">
import { useRoute } from "vue-router";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";
const route = useRoute();
interface Props {
  links: { name: string; href: string }[];
}
const props = defineProps<Props>();
</script>
