<template>
    <div>
        <BreadCrumbs :links="breadcrumbs" />
        <div class="mt-4 md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <div class="flex items-center pt-2">
                    <h2
                        class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
                    >
                        {{ route.name }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";
import { useBreadCrumbs } from "@/composables/breadcrumbs";
import BreadCrumbs from "@/components/BreadCrumbs.vue";
import { useRoute } from "vue-router";
import { computed } from "vue";
const route = useRoute();
const path = computed(() => route.path);
const breadcrumbs = computed(() => {
    const pathArray = path.value.split("/");
    return pathArray
        .map((path, index) => {
            const name = path ? path[0].toUpperCase() + path.slice(1) : "Home";
            return {
                name: name,
                href: pathArray.slice(0, index + 1).join("/"),
            };
        })
        .slice(1);
});
</script>
