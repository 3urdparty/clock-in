<template>
    <div
        class="w-full max-w-[250px] overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800 h-fit border"
    >
        <img
            class="object-cover object-center w-full h-56 opacity-90"
            :src="employee.image_url"
            alt="avatar"
        />

        <div
            class="flex items-center px-4 py-3 border-y bg-gray-50 text-slate-600"
        >
            <ClockIcon class="w-6 h-6" />
            <h1 class="mx-3 text-md capitalize">
                {{ employee.status }}
            </h1>
        </div>

        <div class="px-4 py-4">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ employee.user?.name }}
            </h1>

            <p
                class="py-2 text-gray-700 text-sm text-slate-400 dark:text-gray-400"
            >
                {{ employee.description }}
            </p>

            <div
                class="flex items-center mt-4 text-gray-700 dark:text-gray-200"
            >
                <BriefcaseIcon class="w-6 h-6 text-blue-400" />

                <h1 class="px-2 text-sm capitalize">{{ employee.role }}</h1>
            </div>

            <div
                class="flex items-center mt-4 text-gray-700 dark:text-gray-200"
            >
                <MapIcon class="w-6 h-6 text-blue-400" />

                <h1 class="px-2 text-sm">Cyberjaya</h1>
            </div>

            <div
                class="flex items-center mt-4 text-gray-700 dark:text-gray-200"
            >
                <EnvelopeIcon class="w-6 h-6 text-blue-400" />
                <h1 class="px-2 text-sm">{{ employee.user?.email }}</h1>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import StatusTag from "@/components/StatusTag.vue";
import {
    BriefcaseIcon,
    MapIcon,
    ClockIcon,
    EnvelopeIcon,
} from "@heroicons/vue/20/solid";
interface Props {
    employee: App.Models.Employee;
}
defineProps<Props>();
</script>
