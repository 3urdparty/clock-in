<template>
    <div class="flex h-full flex-col">
        <header
            class="flex flex-none items-center justify-between border-b border-gray-200 px-6 py-4"
        >
            <h1 class="text-base font-semibold leading-6 text-gray-900">
                <time datetime="2022-01">January 2022</time>
            </h1>
            <div class="flex items-center">
                <div
                    class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch"
                >
                    <button
                        type="button"
                        class="flex h-9 w-12 items-center justify-center rounded-l-md border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50"
                    >
                        <span class="sr-only">Previous week</span>
                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                    <button
                        type="button"
                        class="hidden border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block"
                    >
                        Today
                    </button>
                    <span
                        class="relative -mx-px h-5 w-px bg-gray-300 md:hidden"
                    />
                    <button
                        type="button"
                        class="flex h-9 w-12 items-center justify-center rounded-r-md border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50"
                    >
                        <span class="sr-only">Next week</span>
                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
                <div class="hidden md:ml-4 md:flex md:items-center">
                    <div class="ml-6 h-6 w-px bg-gray-300" />
                    <button
                        type="button"
                        class="ml-6 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500"
                    >
                        Add event
                    </button>
                </div>
                <Menu as="div" class="relative ml-6 md:hidden">
                    <MenuButton
                        class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500"
                    >
                        <span class="sr-only">Open menu</span>
                        <EllipsisHorizontalIcon
                            class="h-5 w-5"
                            aria-hidden="true"
                        />
                    </MenuButton>

                    <transition
                        enter-active-class="transition ease-out duration-100"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
                    >
                        <MenuItems
                            class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        >
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Create event</a
                                    >
                                </MenuItem>
                            </div>
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Go to today</a
                                    >
                                </MenuItem>
                            </div>
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Day view</a
                                    >
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Week view</a
                                    >
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Month view</a
                                    >
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        :class="[
                                            active
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm',
                                        ]"
                                        >Year view</a
                                    >
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </header>
        <div
            ref="container"
            class="isolate flex flex-auto flex-col overflow-auto bg-white"
        >
            <div
                style="width: 165%"
                class="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full"
            >
                <div
                    ref="containerNav"
                    class="sticky top-0 z-30 flex-none bg-white shadow ring-1 ring-black ring-opacity-5 sm:pr-8"
                >
                    <div
                        class="grid grid-cols-7 text-sm leading-6 text-gray-500 sm:hidden"
                    >
                        <button
                            type="button"
                            class="flex flex-col items-center pb-3 pt-2"
                        >
                            M
                            <span
                                class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900"
                                >10</span
                            >
                        </button>
                        <button
                            type="button"
                            class="flex flex-col items-center pb-3 pt-2"
                        >
                            T
                            <span
                                class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900"
                                >11</span
                            >
                        </button>
                        <button
                            type="button"
                            class="flex flex-col items-center pb-3 pt-2"
                        >
                            W
                            <span
                                class="mt-1 flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 font-semibold text-white"
                                >12</span
                            >
                        </button>
                        <button
                            type="button"
                            class="flex flex-col items-center pb-3 pt-2"
                        >
                            T
                            <span
                                class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900"
                                >13</span
                            >
                        </button>
                        <button
                            type="button"
                            class="flex flex-col items-center pb-3 pt-2"
                        >
                            F
                            <span
                                class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900"
                                >14</span
                            >
                        </button>
                        <button
                            type="button"
                            class="flex flex-col items-center pb-3 pt-2"
                        >
                            S
                            <span
                                class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900"
                                >15</span
                            >
                        </button>
                        <button
                            type="button"
                            class="flex flex-col items-center pb-3 pt-2"
                        >
                            S
                            <span
                                class="mt-1 flex h-8 w-8 items-center justify-center font-semibold text-gray-900"
                                >16</span
                            >
                        </button>
                    </div>

                    <div
                        class="-mr-px hidden grid-cols-7 divide-x divide-gray-100 border-r border-gray-100 text-sm leading-6 text-gray-500 sm:grid"
                    >
                        <div class="col-end-1 w-14" />
                        <div
                            class="flex items-center justify-center py-3"
                            v-for="date in dates"
                        >
                            <span>
                                {{ date.weekDay }}
                                <span
                                    class="items-center justify-center font-semibold text-gray-900"
                                    :class="[
                                        selectedDate == date
                                            ? 'ml-1.5 flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 font-semibold text-white'
                                            : 'items-center justify-center font-semibold text-gray-900',
                                    ]"
                                    >{{ date.date }}</span
                                ></span
                            >
                        </div>
                    </div>
                </div>
                <div class="flex flex-auto">
                    <div
                        class="sticky left-0 z-10 w-14 flex-none bg-white ring-1 ring-gray-100"
                    />
                    <div class="grid flex-auto grid-cols-1 grid-rows-1">
                        <!-- Horizontal lines -->
                        <div
                            class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100"
                            style="
                                grid-template-rows: repeat(
                                    48,
                                    minmax(3.5rem, 1fr)
                                );
                            "
                        >
                            <div ref="containerOffset" class="row-end-1 h-7" />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    12AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    1AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    2AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    3AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    4AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    5AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    6AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    7AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    8AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    9AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    10AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    11AM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    12PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    1PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    2PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    3PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    4PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    5PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    6PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    7PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    8PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    9PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    10PM
                                </div>
                            </div>
                            <div />
                            <div>
                                <div
                                    class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400"
                                >
                                    11PM
                                </div>
                            </div>
                            <div />
                        </div>

                        <!-- Vertical lines -->
                        <div
                            class="col-start-1 col-end-2 row-start-1 hidden grid-cols-7 grid-rows-1 divide-x divide-gray-100 sm:grid sm:grid-cols-7"
                        >
                            <div class="col-start-1 row-span-full" />
                            <div class="col-start-2 row-span-full" />
                            <div class="col-start-3 row-span-full" />
                            <div class="col-start-4 row-span-full" />
                            <div class="col-start-5 row-span-full" />
                            <div class="col-start-6 row-span-full" />
                            <div class="col-start-7 row-span-full" />
                            <div class="col-start-8 row-span-full w-8" />
                        </div>

                        <!-- Events -->
                        <ol
                            class="col-start-1 col-end-2 row-start-1 grid grid-cols-1 sm:grid-cols-7 sm:pr-8"
                            style="
                                grid-template-rows:
                                    1.75rem repeat(288, minmax(0, 1fr))
                                    auto;
                            "
                        >
                            <li
                                v-for="shift in data"
                                class="relative mt-px flex"
                                :style="{
                                    gridRow: `${calculateSegment(shift.start as number) + 2} / span ${calculateSegment(shift.duration as number) + 2}`,
                                    gridColumnStart: `${shift.week_day}`,
                                }"
                            >
                                <a
                                    href="#"
                                    class="group absolute inset-1 flex flex-col overflow-y-auto rounded-lg bg-blue-500/20 p-2 text-xs leading-5 hover:bg-blue-500/30"
                                >
                                    <p
                                        class="order-1 font-semibold text-blue-700"
                                    >
                                        Shift
                                    </p>
                                    <p
                                        class="order-2 font-normal text-blue-500 group-hover:text-blue-700 flex gap-1 items-center"
                                    >
                                        <img
                                            :src="shift.employee?.image_url"
                                            alt=""
                                            class="rounded-full bg-white w-4 h-4 opacity-80 group-hover:opacity-100 transition"
                                        />
                                        {{ shift.employee?.user?.name }}
                                    </p>
                                    <p
                                        class="text-blue-500 group-hover:text-blue-700 flex items-center justify-between"
                                    >
                                        <time datetime="2022-01-12T07:30">
                                            {{
                                                formatTime(
                                                    shift?.start as number,
                                                )
                                            }}
                                            AM</time
                                        >
                                        <time
                                            datetime="2022-01-12T07:30 "
                                            class="text-blue-500/0 group-hover:text-blue-500 transition text-2xs"
                                        >
                                            {{
                                                Math.floor(
                                                    shift.duration as number,
                                                )
                                            }}hrs,{{
                                                Math.floor(
                                                    ((shift.duration as number) -
                                                        Math.floor(
                                                            shift.duration as number,
                                                        )) *
                                                        60,
                                                )
                                            }}m
                                        </time>
                                    </p>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, reactive } from "vue";
import {
    ChevronLeftIcon,
    ChevronRightIcon,
    EllipsisHorizontalIcon,
} from "@heroicons/vue/20/solid";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

const container = ref<HTMLDivElement | null>(null);
const containerNav = ref<HTMLDivElement | null>(null);
const containerOffset = reactive({
    offsetHeight: 0,
});

interface Props {
    data: App.Models.Shift[];
}

defineProps<Props>();
onMounted(() => {
    const currentMinute = new Date().getHours() * 60;
    if (container.value && containerNav.value && containerOffset)
        container.value.scrollTop =
            ((container.value.scrollHeight -
                containerNav.value.offsetHeight -
                containerOffset.offsetHeight) *
                currentMinute) /
            1440;
});
const roundUpToNearestSixth = (value: number) => Math.floor(value * 6) / 6;

const calculateSegment = (value: number) => {
    const hours = Math.floor(value);
    const minutes = value - Math.floor(value);

    const hour_segments = hours * 12;
    const minutes_segments = roundUpToNearestSixth(minutes) * 12;
    return minutes_segments + hour_segments;
};

const dates = [
    {
        weekDay: "M",
        date: 10,
    },
    {
        weekDay: "T",
        date: 11,
    },
    {
        weekDay: "W",
        date: 12,
    },
    {
        weekDay: "T",
        date: 13,
    },
    {
        weekDay: "F",
        date: 14,
    },

    {
        weekDay: "S",
        date: 15,
    },

    {
        weekDay: "S",
        date: 16,
    },
];
const selectedDate = ref(dates[2]);
import { formatTime } from "@/utils/formatTime";
</script>
