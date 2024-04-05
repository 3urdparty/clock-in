<template>
    <ul
        role="list"
        class="divide-y divide-gray-100 overflow-hidden bg-white ring-1 ring-gray-900/5 sm:rounded-lg border overflow-scroll h-[25rem]"
    >
        <div
            class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6 sticky top-0 bg-white z-10 shadow-sm"
        >
            <div
                class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap"
            >
                <div class="ml-4 mt-2">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">
                        Employees
                    </h3>
                </div>
                <div class="ml-4 mt-2 flex-shrink-0">
                    <RouterLink
                        to="/employees"
                        class="relative inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                    >
                        View All
                    </RouterLink>
                </div>
            </div>
        </div>
        <RouterLink
            :to="`/employees/${employee.id}`"
            v-for="employee in data"
            :key="employee.user?.email"
        >
            <li
                class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6"
            >
                <div class="flex min-w-0 gap-x-4">
                    <img
                        class="h-12 w-12 flex-none rounded-full bg-gray-50"
                        :src="employee.image_url"
                        alt=""
                    />
                    <div class="min-w-0 flex-auto">
                        <p
                            class="text-sm font-semibold leading-6 text-gray-900"
                        >
                            <RouterLink :to="`/employees/${employee.id}`">
                                <span
                                    class="absolute inset-x-0 -top-px bottom-0"
                                />
                                {{ employee.user?.name }}
                            </RouterLink>
                        </p>
                        <p class="mt-1 flex text-xs leading-5 text-gray-500">
                            <a
                                :href="`mailto:${employee.user?.email}`"
                                class="relative truncate hover:underline"
                                >@{{ employee.username }}</a
                            >
                        </p>
                    </div>
                </div>
                <div class="flex shrink-0 items-center gap-x-4">
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm leading-6 text-gray-900 capitalize">
                            {{ employee.role }}
                        </p>

                        <StatusTag
                            :status="employee.status as 'online' | 'offline'"
                        />
                    </div>
                    <ChevronRightIcon
                        class="h-5 w-5 flex-none text-gray-400"
                        aria-hidden="true"
                    />
                </div>
            </li>
        </RouterLink>
    </ul>
</template>

<script setup lang="ts">
import StatusTag from "@/components/StatusTag.vue";
import { ChevronRightIcon } from "@heroicons/vue/20/solid";
import { RouterLink } from "vue-router";
interface Props {
    data: App.Models.Employee[];
}

//@ts-ignore
withDefaults(defineProps<Props>(), () => ({
    data: [],
}));
</script>
