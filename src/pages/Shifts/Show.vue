<template>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-4">
            <div
                class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-8 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3"
            >
                <!-- Shift summary -->
                <div class="lg:col-start-3 lg:row-end-1">
                    <h2 class="sr-only">Summary</h2>
                    <div
                        class="rounded-lg bg-blue-50/50 shadow-sm ring-1 ring-blue-900/5"
                    >
                        <dl class="flex flex-wrap">
                            <div class="flex-auto pl-6 pt-6">
                                <dt
                                    class="text-sm font-semibold leading-6 text-gray-900"
                                >
                                    Duration
                                </dt>
                                <div class="px-4">
                                    <ShiftProgressBar
                                        v-if="shift"
                                        :start="shift.start as number"
                                        :ongoing="!shift.end"
                                        :end="shift.end as number"
                                        class="mt-1"
                                    />
                                </div>
                                <dd
                                    class="mt-1 text-base font-semibold leading-6 text-gray-900"
                                >
                                    9 hours 20 minutes
                                </dd>
                            </div>
                            <div class="flex-none self-end px-6 pt-4">
                                <dt class="sr-only">Status</dt>
                                <dd
                                    class="rounded-md px-2 py-1 text-xs font-medium text-green-600 ring-1 ring-inset ring-green-600/20"
                                >
                                    Completed
                                </dd>
                            </div>
                            <div
                                class="mt-6 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6"
                            >
                                <dt class="flex-none">
                                    <span class="sr-only">Client</span>
                                    <img
                                        :src="shift?.employee?.image_url"
                                        class="h-6 w-6 text-gray-400 rounded-full"
                                        aria-hidden="true"
                                    />
                                </dt>
                                <dd
                                    class="text-sm font-medium leading-6 text-gray-900"
                                >
                                    {{ shift?.employee?.user?.name }}
                                </dd>
                            </div>
                            <div
                                class="mt-4 flex w-full flex-none gap-x-4 px-6"
                            >
                                <dt class="flex-none">
                                    <span class="sr-only">Due date</span>
                                    <CalendarDaysIcon
                                        class="h-6 w-5 text-gray-400"
                                        aria-hidden="true"
                                    />
                                </dt>
                                <dd class="text-sm leading-6 text-gray-500">
                                    {{ shift?.date }}
                                </dd>
                            </div>
                        </dl>
                        <div
                            class="mt-6 border-t border-gray-900/5 px-6 py-6"
                        ></div>
                    </div>
                </div>

                <!-- Invoice -->
                <div
                    class="-mx-4 px-4 py-8 shadow-sm ring-1 ring-gray-900/5 sm:mx-0 sm:rounded-lg sm:px-8 sm:pb-14 lg:col-span-2 lg:row-span-2 lg:row-end-2 xl:px-16 xl:pb-20 xl:pt-16"
                >
                    <h2 class="text-base font-semibold leading-6 text-gray-900">
                        Shift
                    </h2>
                    <dl
                        class="mt-6 grid grid-cols-1 text-sm leading-6 sm:grid-cols-2"
                    >
                        <div class="sm:pr-4">
                            <dt class="inline text-gray-500">Finished on</dt>
                            {{ " " }}
                            <dd class="inline text-gray-700">
                                {{ shift?.date }}
                            </dd>
                        </div>
                        <div class="mt-2 sm:mt-0 sm:pl-4"></div>
                    </dl>
                </div>
            </div>
        </div>
    </main>
</template>
<script setup lang="ts">
import { CalendarDaysIcon } from "@heroicons/vue/20/solid";
import { useAxios } from "@vueuse/integrations/useAxios";
import { instance } from "@/api/instance";
import ShiftProgressBar from "@/components/ShiftProgressBar.vue";

interface Props {
    id: number;
}
const props = defineProps<Props>();

const { data: shift } = useAxios<App.Models.Shift>(
    `/shifts/${props.id}`,
    { method: "GET" },
    instance,
);
</script>
