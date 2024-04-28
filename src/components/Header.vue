<template>
    <div>
        <header class="relative isolate px-8">
            <BreadCrumbs :links="breadcrumbs" />
            <div
                class="absolute inset-0 -z-10 overflow-hidden"
                aria-hidden="true"
            >
                <div
                    class="absolute top-full -mt-16 transform-gpu opacity-50 blur-3xl xl:left-1/2 xl:-ml-80"
                >
                    <div
                        class="aspect-[1154/678] w-[72.125rem] bg-gradient-to-br from-blue-500 to-green-200"
                        style="
                            clip-path: polygon(
                                100% 38.5%,
                                82.6% 100%,
                                60.2% 37.7%,
                                52.4% 32.1%,
                                47.5% 41.8%,
                                45.2% 65.6%,
                                27.5% 23.4%,
                                0.1% 35.3%,
                                17.9% 0%,
                                27.7% 23.4%,
                                76.2% 2.5%,
                                74.2% 56%,
                                100% 38.5%
                            );
                        "
                    />
                </div>
                <div class="absolute inset-x-0 bottom-0 h-px bg-gray-900/5" />
            </div>

            <div class="mx-auto max-w-7xl py-2 pb-8 sm:px-6 lg:px-1">
                <div
                    class="mx-auto flex max-w-2xl items-center justify-between gap-x-8 lg:mx-0 lg:max-w-none"
                >
                    <div class="flex items-center gap-x-6">
                        <h1>
                            <div
                                class="mt-4 md:flex md:items-center md:justify-between"
                            >
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center pt-2">
                                        <h2
                                            class="text-2xl font-bold leading-7 text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight"
                                        >
                                            <!-- Alaa -->
                                            <!-- Alaa -->
                                            {{ route.name }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>

<script setup lang="ts">
import {
    Dialog,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
} from "@headlessui/vue";
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
