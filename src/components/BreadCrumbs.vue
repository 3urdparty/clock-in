<template>
    <nav class="flex" aria-label="Breadcrumb">
        <ol
            role="list"
            class="flex space-x-4 rounded-lg border border-slate-300 bg-white px-6 shadow-sm"
        >
            <li class="flex">
                <div class="flex items-center py-0">
                    <RouterLink
                        to="/"
                        class="text-gray-400 hover:text-gray-500"
                    >
                        <svg
                            class="h-5 w-5 flex-shrink-0"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="sr-only">Home</span>
                    </RouterLink>
                </div>
            </li>
            <li class="flex" v-for="link in links.slice(0)">
                <div class="flex items-center">
                    <svg
                        class="h-full w-6 flex-shrink-0 text-gray-300"
                        viewBox="0 0 24 44"
                        preserveAspectRatio="none"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                    </svg>
                    <RouterLink
                        :to="link.href"
                        class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                        aria-current="page"
                        >{{ link.name }}</RouterLink
                    >
                </div>
            </li>
        </ol>
    </nav>
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
