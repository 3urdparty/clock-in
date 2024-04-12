<template>
    <div>
        <h3 class="text-base font-medium leading-6 text-gray-400 pb-1">
            Last 30 days
        </h3>

        <dl
            class="border mt-8 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow-sm md:grid-cols-3 md:divide-x md:divide-y-0"
            v-if="data"
        >
            <div v-for="item in data" :key="item.name" class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">
                    {{ item.name }}
                </dt>
                <dd
                    class="mt-1 flex items-baseline justify-between md:block lg:flex"
                >
                    <div
                        class="flex items-baseline text-2xl font-semibold text-blue-600"
                    >
                        {{ item.stat }}
                        <span
                            class="ml-2 text-sm font-medium text-gray-500 truncate"
                            >from {{ item.previousStat }}</span
                        >
                    </div>

                    <div
                        :class="[
                            item.changeType === 'increase'
                                ? 'bg-green-100 text-green-800'
                                : 'bg-red-100 text-red-800',
                            'inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0',
                        ]"
                    >
                        <ArrowUpIcon
                            v-if="item.changeType === 'increase'"
                            class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500"
                            aria-hidden="true"
                        />
                        <ArrowDownIcon
                            v-else
                            class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-red-500"
                            aria-hidden="true"
                        />
                        <span class="sr-only">
                            {{
                                item.changeType === "increase"
                                    ? "Increased"
                                    : "Decreased"
                            }}
                            by
                        </span>
                        {{ item.change.toFixed(1) }}%
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</template>

<script setup lang="ts">
import { ArrowDownIcon, ArrowUpIcon } from "@heroicons/vue/20/solid";

interface Props {
    data: App.Models.Statistic[] | undefined;
}
const props = defineProps<Props>();
</script>
