<template>
    <div class="mt-4">
        <CreateEmployeeForm
            v-model:form="form"
            v-model:open="showCreateEmployeeModal"
            @submit="submitForm"
            @reset="reset"
        />
        <ImportCSVModal v-model:open="showImportCSVModal" v-model="csv" />
        <div class="flex items-center justify-end pb-3 gap-2">
            <button
                type="button"
                @click="showCreateEmployeeModal = true"
                class="inline-flex items-center gap-x-1.5 rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
            >
                Add

                <PlusIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
            </button>

            <button
                type="button"
                @click="showImportCSVModal = true"
                class="inline-flex items-center gap-x-1.5 rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
            >
                Import from CSV
                <TableCellsIcon class="w-5 h-5 text-white" />
            </button>
        </div>
        <Table :data="employees" />
    </div>
</template>
<script setup lang="ts">
import { PlusIcon, TableCellsIcon } from "@heroicons/vue/20/solid";
import Table from "@/pages/Employees/Partials/EmployeeTable.vue";
import CreateEmployeeForm from "@/pages/Employees/Partials/CreateEmployeeForm.vue";
import { useAxios } from "@vueuse/integrations/useAxios";
import { instance } from "@/api/instance";
import { reactive, ref } from "vue";
import { useAxiosForm } from "@/composables/useAxiosForm";
import ImportCSVModal from "./Partials/ImportCSVModal.vue";
const {
    execute,
    data: employees,
    isLoading,
    error,
} = useAxios<App.Models.Employee[]>("/employees", { method: "GET" }, instance);

const showCreateEmployeeModal = ref(false);

const { hasErrors, form, submit, reset } = useAxiosForm(
    {
        name: "John Doe",
        email: "john.doe@gmail.com",
        password: "JohnDoe123",
        phone_number: "+601123049307",
        username: "johndoe",
        image: null,
        image_url:
            "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        role: "Software Engineer",
        description: "I am a software engineer",
    },
    { method: "POST" },
);

const submitForm = () => {
    submit("employees").then(() => {
        if (hasErrors.value) return;
        execute();
        showCreateEmployeeModal.value = false;
    });
};
const showImportCSVModal = ref(false);
const csv = ref("");
</script>
