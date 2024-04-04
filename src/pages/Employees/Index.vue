<template>
    <div>
        <CreateEmployeeForm v-model:open="showModal" />
        <div class="flex items-center justify-end pb-3">
            <button
                type="button"
                @click="showModal = true"
                class="inline-flex items-center gap-x-1.5 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                <PlusIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                Add
            </button>
        </div>
        <Table :data="employees" />
    </div>
</template>
<script setup lang="ts">
import { PlusIcon } from "@heroicons/vue/20/solid";
import Table from "@/pages/Employees/Partials/Table.vue";
import CreateEmployeeForm from "@/pages/Employees/Partials/CreateEmployeeForm.vue";
import { useFetch } from "@vueuse/core";
import { ref } from "vue";
const { data: employees } = useFetch<App.Models.Employee[]>(
    `${import.meta.env.VITE_APP_API_URL}/employees/`,
)
    .get()
    .json();

const showModal = ref(false);
</script>
