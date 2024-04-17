<template>
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div
                class="overflow-hidden sm:rounded-lg border border-gray-200 dark:border-gray-700"
            >
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th
                                scope="col"
                                class="px-1 w-36 pl-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                            >
                                Shift
                            </th>
                            <th
                                scope="col"
                                class="px-1 pl-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                            >
                                Device
                            </th>
                            <th
                                scope="col"
                                class="px-1 pl-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                            >
                                Duration
                            </th>
                            <th
                                scope="col"
                                class="px-1 pl-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                            >
                                Date
                            </th>

                            <th
                                scope="col"
                                class="px-1 pl-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                            >
                                <span class=""></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-for="shift in data" :key="shift.id">
                            <td
                                class="whitespace-nowrap pr-10 p-3 text-sm font-medium text-gray-900 pl-12"
                            >
                                <ShiftProgressBar
                                    class="w-60"
                                    :start="shift.start as number"
                                    :ongoing="!shift.end"
                                    :end="shift.end as number"
                                />
                            </td>
                            <td
                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                            >
                                <RouterLink :to="`/devices/${shift.device_id}`">
                                    <span
                                        class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10"
                                    >
                                        {{ shift.device?.name }}
                                    </span>
                                </RouterLink>
                            </td>
                            <td
                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                            >
                                {{ shift.duration?.toFixed(0) ?? 0 * 60 }}m
                            </td>
                            <td
                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                            >
                                {{ shift.date }}
                            </td>
                            <td
                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                            >
                                <RouterLink
                                    :to="`/shifts/${shift.id}`"
                                    href="#"
                                    class="text-blue-600 hover:text-blue-900"
                                    >Show<span class="sr-only"></span
                                ></RouterLink>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import ShiftProgressBar from "@/components/ShiftProgressBar.vue";

interface Props {
    data: App.Models.Shift[];
}

withDefaults(defineProps<Props>(), {
    data: () => [],
});
</script>
