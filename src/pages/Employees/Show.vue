<template>
    <div class="text-white">
        <AddFingerprintModal
            :employeeId="employee.id"
            :isOpen="isOpen"
            @update:isOpen="(newIsOpen) => (isOpen = newIsOpen)"
        />
        <div :class="{ 'opacity-50': isOpen }">
            <div class="flex gap-4">
                <EmployeeCard :employee="employee" />
                <div class="space-y-4 w-full">
                    <div
                        class="sm:flex sm:items-center sm:justify-between px-1"
                    >
                        <h2
                            class="text-lg font-medium text-gray-800 dark:text-white"
                        >
                            Fingerprints
                        </h2>

                        <div class="flex items-center gap-x-3">
                            <button
                                class="w-1/2 px-5 py-2 text-sm text-gray-800 transition-colors duration-200 bg-white border rounded-lg sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-white dark:border-gray-700"
                            >
                                Remove All
                            </button>

                            <button
                                @click="isOpen = true"
                                class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600"
                            >
                                <FingerPrintIcon class="text-white w-4" />

                                <span>Add Fingerprint</span>
                            </button>
                        </div>
                    </div>
                    <FingerprintTable :data="employee.fingerprints" />
                    <Table :data="[]" />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { instance } from "@/api/instance";
import { ClockIcon, FingerPrintIcon } from "@heroicons/vue/24/outline";
import FingerprintTable from "./Partials/FingerprintTable.vue";
import { ref } from "vue";
import AddFingerprintModal from "./Partials/AddFingerprintModal.vue";
import Table from "./Partials/Table.vue";
import EmployeeCard from "./Partials/EmployeeCard.vue";
import { useAxios } from "@vueuse/integrations/useAxios";
interface Props {
    id: string;
}
const props = defineProps<Props>();
const { data: employee } = useAxios<App.Models.Employee>(
    `/employees/${props.id}`,
    { method: "GET" },
    instance,
);
const isOpen = ref(false);
</script>
