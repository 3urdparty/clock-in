<template>
    <section class="container mx-auto">
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                >
                    <div
                        class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg"
                    >
                        <table
                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th
                                        scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    >
                                        <div class="flex items-center gap-x-3">
                                            <input
                                                type="checkbox"
                                                class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700"
                                            />
                                            <span>File name</span>
                                        </div>
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    >
                                        File size
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    >
                                        Date uploaded
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    >
                                        Device ID
                                    </th>

                                    <th
                                        scope="col"
                                        class="relative py-3.5 px-4"
                                    >
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="data.length == 0">
                                <tr>
                                    <td colspan="5">
                                        <div
                                            class="flex items-center flex-col w-full px-4 mx-auto py-10"
                                        >
                                            <div
                                                class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full dark:bg-gray-800"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="w-6 h-6"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                                                    />
                                                </svg>
                                            </div>
                                            <h1
                                                class="mt-3 text-lg text-gray-800 dark:text-white"
                                            >
                                                No Fingerprints found
                                            </h1>
                                            <p
                                                class="mt-2 text-gray-500 dark:text-gray-400 text-center"
                                            >
                                                It seems this employee has no
                                                registered fingerprints. Please
                                                add a fingerprint to this
                                                employee.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody
                                class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900"
                                v-else
                            >
                                <tr v-for="fingerprint in data">
                                    <td
                                        class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap"
                                    >
                                        <div
                                            class="inline-flex items-center gap-x-3"
                                        >
                                            <input
                                                type="checkbox"
                                                class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700"
                                            />

                                            <div
                                                class="flex items-center gap-x-2"
                                            >
                                                <div
                                                    class="flex items-center justify-center w-8 h-8 text-blue-500 bg-blue-100 rounded-full dark:bg-gray-800"
                                                >
                                                    <FingerPrintIcon
                                                        class="w-5 h-5"
                                                    />
                                                </div>

                                                <div>
                                                    <h2
                                                        class="font-normal text-gray-800 dark:text-white"
                                                    >
                                                        Fingerprint
                                                        {{ fingerprint.id }}
                                                    </h2>
                                                    <p
                                                        class="text-xs font-normal text-gray-500 dark:text-gray-400"
                                                    >
                                                        120KB
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="px-12 py-4 text-sm font-normal text-gray-700 whitespace-nowrap"
                                    >
                                        120KB
                                    </td>
                                    <td
                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap"
                                    >
                                        {{ fingerprint.created_at }}
                                    </td>
                                    <td
                                        class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap"
                                    >
                                        {{ fingerprint.device_id }}
                                    </td>
                                    <td
                                        class="px-4 py-4 text-sm whitespace-nowrap"
                                    >
                                        <button
                                            class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-6 h-6"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import { FingerPrintIcon } from "@heroicons/vue/24/outline";
interface Props {
    data: App.Models.Fingerprint[];
}
const props = defineProps<Props>();
const pageSize = 9;
import { useOffsetPagination } from "@vueuse/core";

const {
    currentPage,
    currentPageSize,
    pageCount,
    isFirstPage,
    isLastPage,
    prev,
    next,
} = useOffsetPagination({
    total: props.data.length,
    page: 1,
    pageSize: pageSize,
});
</script>
