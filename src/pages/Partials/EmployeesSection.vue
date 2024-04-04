<template>
    <ul
        role="list"
        class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
    >
        <li
            v-for="employee in data"
            :key="employee.user?.email"
            class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow border"
        >
            <div class="flex flex-1 flex-col p-8">
                <img
                    class="mx-auto h-32 w-32 flex-shrink-0 rounded-full"
                    :src="employee.image_url"
                    alt=""
                />
                <h3 class="mt-6 text-sm font-medium text-gray-900">
                    {{ employee.user?.name }}
                </h3>
                <dl class="mt-1 flex flex-grow flex-col justify-between">
                    <dt class="sr-only">Title</dt>
                    <dd class="text-sm text-gray-500">
                        {{ employee.user?.name }}
                    </dd>
                    <dt class="sr-only">Role</dt>
                    <dd class="mt-3">
                        <span
                            class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 capitalize"
                            >{{ employee.role }}</span
                        >
                    </dd>
                </dl>
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-200">
                    <div class="flex w-0 flex-1">
                        <a
                            :href="`mailto:${employee.user?.email}`"
                            class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900"
                        >
                            <EnvelopeIcon
                                class="h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                            Email
                        </a>
                    </div>
                    <div class="-ml-px flex w-0 flex-1">
                        <a
                            :href="`tel:${employee.user?.phone_number}`"
                            class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900"
                        >
                            <PhoneIcon
                                class="h-5 w-5 text-gray-400"
                                aria-hidden="true"
                            />
                            Call
                        </a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>
<script setup lang="ts">
import { EnvelopeIcon, PhoneIcon } from "@heroicons/vue/20/solid";

interface Props {
    data: App.Models.Employee[];
}
defineProps<Props>();
</script>
