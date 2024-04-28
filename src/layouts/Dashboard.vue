<template>
    <div class="flex w-screen">
        <aside
            class="flex flex-col w-64 h-screen px-4 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700"
        >
            <a href="#" class="flex gap-2 items-center justify-center">
                <img src="/src/assets/Logo.png" class="w-20 opacity-80" />
            </a>

            <div>
                <div class="relative mt-6 flex items-center">
                    <input
                        type="text"
                        name="search"
                        id="search"
                        class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                    />
                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                        <kbd
                            class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-xs text-gray-400"
                            >⌘K</kbd
                        >
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-between flex-1">
                <nav>
                    <RouterLink
                        v-for="item in links"
                        class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                        :to="item.href"
                    >
                        <component :is="item.icon" class="w-5 h-5" />
                        <span class="mx-4 font-medium">{{ item.name }}</span>
                    </RouterLink>

                    <hr class="my-6 border-gray-200 dark:border-gray-600" />

                    <RouterLink
                        class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700"
                        to="/settings"
                    >
                        <svg
                            class="w-5 h-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M10.3246 4.31731C10.751 2.5609 13.249 2.5609 13.6754 4.31731C13.9508 5.45193 15.2507 5.99038 16.2478 5.38285C17.7913 4.44239 19.5576 6.2087 18.6172 7.75218C18.0096 8.74925 18.5481 10.0492 19.6827 10.3246C21.4391 10.751 21.4391 13.249 19.6827 13.6754C18.5481 13.9508 18.0096 15.2507 18.6172 16.2478C19.5576 17.7913 17.7913 19.5576 16.2478 18.6172C15.2507 18.0096 13.9508 18.5481 13.6754 19.6827C13.249 21.4391 10.751 21.4391 10.3246 19.6827C10.0492 18.5481 8.74926 18.0096 7.75219 18.6172C6.2087 19.5576 4.44239 17.7913 5.38285 16.2478C5.99038 15.2507 5.45193 13.9508 4.31731 13.6754C2.5609 13.249 2.5609 10.751 4.31731 10.3246C5.45193 10.0492 5.99037 8.74926 5.38285 7.75218C4.44239 6.2087 6.2087 4.44239 7.75219 5.38285C8.74926 5.99037 10.0492 5.45193 10.3246 4.31731Z"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>

                        <span class="mx-4 font-medium">Settings</span>
                    </RouterLink>
                    <button
                        @click="() => logout()"
                        class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700 w-full"
                    >
                        <ArrowLeftEndOnRectangleIcon class="w-5" />
                        <span class="mx-4 font-medium">Logout</span>
                    </button>
                </nav>
            </div>
        </aside>

        <main
            class="dark:bg-slate-950 w-1/3 md:w-full sm:w-1/2 overflow-scroll"
        >
            <Header class="px- pt-6" />
            <slot />
        </main>
    </div>
</template>
<script setup lang="ts">
import Header from "@/components/Header.vue";
import LogoIcon from "@/assets/Logo.svg?url";
import { useAuthStore } from "@/stores/auth";
const { logout } = useAuthStore();

import {
    RectangleStackIcon,
    UsersIcon,
    ComputerDesktopIcon,
    CalendarIcon,
} from "@heroicons/vue/24/outline";

import { useToggle } from "@vueuse/core";
import { ArrowLeftEndOnRectangleIcon } from "@heroicons/vue/20/solid";

const [value, toggle] = useToggle();
const links = [
    {
        name: "Dashboard",
        icon: RectangleStackIcon,
        href: "/",
    },
    {
        name: "Employees",
        icon: UsersIcon,
        href: "/employees",
    },
    {
        name: "Devices",
        icon: ComputerDesktopIcon,
        href: "/devices",
    },
    {
        name: "Shifts",
        icon: CalendarIcon,
        href: "/shifts",
    },
];
</script>
