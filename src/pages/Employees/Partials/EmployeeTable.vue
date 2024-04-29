<template>
    <section class="container mx-auto text-black h-full:">
        <div class="flex flex-col h-[62vh]">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                >
                    <div
                        class="overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 md:rounded-lg"
                    >
                        <table
                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-1 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    ></th>
                                    <th
                                        scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    >
                                        <button
                                            class="flex items-center gap-x-3 focus:outline-none"
                                        >
                                            <span>Name</span>

                                            <svg
                                                class="h-3"
                                                viewBox="0 0 10 11"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z"
                                                    fill="currentColor"
                                                    stroke="currentColor"
                                                    stroke-width="0.1"
                                                />
                                                <path
                                                    d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z"
                                                    fill="currentColor"
                                                    stroke="currentColor"
                                                    stroke-width="0.1"
                                                />
                                                <path
                                                    d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z"
                                                    fill="currentColor"
                                                    stroke="currentColor"
                                                    stroke-width="0.3"
                                                />
                                            </svg>
                                        </button>
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    >
                                        Status
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    >
                                        Role
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                    >
                                        Most Recent Shift
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
                                            class="flex items-center flex-col w-full px-4 mx-auto py-6"
                                        >
                                            <div
                                                class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full dark:bg-gray-800"
                                            >
                                                <UserIcon
                                                    class="w-6 h-6 text-blue-500"
                                                />
                                            </div>
                                            <h1
                                                class="mt-3 text-lg text-gray-800 dark:text-white"
                                            >
                                                No Employees found
                                            </h1>
                                            <p
                                                class="mt-2 text-gray-500 dark:text-gray-400 text-center"
                                            >
                                                No Employees in the System Yet
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody
                                v-else
                                class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900"
                            >
                                <tr
                                    v-for="employee in data.slice(
                                        (pagination.currentPage.value - 1) * 6,
                                        pagination.currentPage.value * 6,
                                    )"
                                >
                                    <td
                                        class="pl-6 py-4 text-sm whitespace-nowrap"
                                    >
                                        <div class="flex items-center">
                                            <span class="relative inline-block">
                                                <img
                                                    class="h-8 w-8 rounded-full"
                                                    :src="employee.image_url"
                                                    alt=""
                                                />
                                                <span
                                                    class="absolute bottom-0 right-0 block h-1.5 w-1.5 rounded-full bg-gray-300 ring-2 ring-white"
                                                    :class="{
                                                        'bg-green-500':
                                                            employee.status ===
                                                            'online',
                                                        'bg-gray-300':
                                                            employee.status ===
                                                            'offline',
                                                    }"
                                                />
                                            </span>
                                        </div>
                                    </td>

                                    <td
                                        class="px-4 py-4 text-sm font-medium whitespace-nowrap"
                                    >
                                        <RouterLink
                                            :to="`/employees/${employee.id}`"
                                        >
                                            <h2
                                                class="font-medium text-gray-800 dark:text-white"
                                            >
                                                {{ employee.user?.name }}
                                            </h2>
                                            <p
                                                class="text-sm font-normal text-gray-600 dark:text-gray-400"
                                            >
                                                @{{ employee.username }}
                                            </p>
                                        </RouterLink>
                                    </td>
                                    <td
                                        class="px-12 py-4 text-sm font-medium whitespace-nowrap text-black"
                                    >
                                        <StatusTag
                                            :status="
                                                (employee.status as 'online') ||
                                                'offline'
                                            "
                                        />
                                    </td>
                                    <td
                                        class="px-4 py-4 text-sm whitespace-nowrap"
                                    >
                                        <div>
                                            <h4
                                                class="capitalize"
                                                :class="{
                                                    'text-green-500':
                                                        employee.role ===
                                                        'admin',
                                                    'text-blue-500':
                                                        employee.role ===
                                                        'employee',
                                                }"
                                            >
                                                {{ employee.role }}
                                            </h4>
                                        </div>
                                    </td>
                                    <td
                                        class="px-4 py-4 text-sm whitespace-nowrap text-black"
                                    >
                                        <ShiftProgressBar
                                            v-if="employee?.recent_shift"
                                            :ongoing="
                                                !employee?.recent_shift?.end
                                            "
                                            :duration="
                                                employee?.recent_shift
                                                    ?.duration as number
                                            "
                                            :start="
                                                employee?.recent_shift
                                                    ?.start as number
                                            "
                                            :end="
                                                employee?.recent_shift
                                                    ?.end as number
                                            "
                                        />
                                    </td>

                                    <td
                                        class="px-0 pl-4 py-4 text-sm whitespace-nowrap"
                                    >
                                        <Menu
                                            as="div"
                                            class="relative inline-block text-left"
                                        >
                                            <div>
                                                <MenuButton
                                                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-2 py-2 text-sm font-semibold text-gray-900 hover:bg-slate-100"
                                                >
                                                    <EllipsisVerticalIcon
                                                        class="h-5 w-5 text-gray-400"
                                                        aria-hidden="true"
                                                    />
                                                </MenuButton>
                                            </div>

                                            <transition
                                                enter-active-class="transition ease-out duration-100"
                                                enter-from-class="transform opacity-0 scale-95"
                                                enter-to-class="transform opacity-100 scale-100"
                                                leave-active-class="transition ease-in duration-75"
                                                leave-from-class="transform opacity-100 scale-100"
                                                leave-to-class="transform opacity-0 scale-95"
                                            >
                                                <MenuItems
                                                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                >
                                                    <div class="py-1">
                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <button
                                                                @click="
                                                                    $emit(
                                                                        'edit',
                                                                        employee,
                                                                    )
                                                                "
                                                                :class="[
                                                                    active
                                                                        ? 'bg-gray-100 text-gray-900'
                                                                        : 'text-gray-700',
                                                                    'group flex items-center px-4 py-2 text-sm',
                                                                ]"
                                                                class="w-full"
                                                            >
                                                                <PencilSquareIcon
                                                                    class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                                                    aria-hidden="true"
                                                                />
                                                                Edit
                                                            </button>
                                                        </MenuItem>
                                                    </div>
                                                    <div class="py-1">
                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <button
                                                                @click="
                                                                    $emit(
                                                                        'delete',
                                                                        employee,
                                                                    )
                                                                "
                                                                :class="[
                                                                    active
                                                                        ? 'bg-gray-100 text-red-900'
                                                                        : 'text-red-700',
                                                                    'group flex items-center px-4 py-2 text-sm ',
                                                                ]"
                                                                class="w-full"
                                                            >
                                                                <TrashIcon
                                                                    class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500"
                                                                    aria-hidden="true"
                                                                />
                                                                Delete
                                                            </button>
                                                        </MenuItem>
                                                    </div>
                                                </MenuItems>
                                            </transition>
                                        </Menu>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <button
                @click="pagination.prev"
                class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 rtl:-scale-x-100"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"
                    />
                </svg>

                <span> previous </span>
            </button>

            <div class="items-center hidden md:flex gap-x-3">
                <button
                    @click="pagination.currentPage.value = num as number"
                    v-for="num in pagination.pageCount.value"
                    class="px-2 py-1 text-sm text-blue-500 rounded-md"
                    :class="{
                        'bg-blue-500 text-white':
                            num === pagination.currentPage.value,
                    }"
                >
                    {{ num }}
                </button>
            </div>

            <button
                @click="pagination.next"
                class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800"
            >
                <span> Next </span>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 rtl:-scale-x-100"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"
                    />
                </svg>
            </button>
        </div>
    </section>
</template>
<script setup lang="ts">
import ShiftProgressBar from "@/components/ShiftProgressBar.vue";
import StatusTag from "@/components/StatusTag.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    EllipsisVerticalIcon,
    PencilSquareIcon,
    TrashIcon,
} from "@heroicons/vue/20/solid";
import { ClockIcon, UserIcon } from "@heroicons/vue/24/outline";
interface Props {
    data: App.Models.Employee[];
}
const props = withDefaults(defineProps<Props>(), {
    data: () => [] as App.Models.Employee[],
});

import { useOffsetPagination } from "@vueuse/core";
import { reactive, ref } from "vue";
import { RouterLink } from "vue-router";

const pagination = useOffsetPagination({
    total: props.data.length,
    pageSize: 6,
});

interface Emits {
    (e: "edit", employee: App.Models.Employee): void;
    (e: "delete", employee: App.Models.Employee): void;
}
const emits = defineEmits<Emits>();
</script>
