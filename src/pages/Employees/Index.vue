<template>
    <div class="mt-4">
        <CreateEmployeeForm
            v-model:form="form"
            v-model:open="showEmployeeModal"
            @submit="submitForm"
        />
        <ImportCSVModal v-model:open="showImportCSVModal" v-model="csv" />
        <div class="flex items-center justify-end pb-3 gap-2">
            <button
                type="button"
                @click="
                    reset();
                    showEmployeeModal = true;
                "
                class="inline-flex items-center gap-x-1.5 rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
            >
                Add

                <PlusIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
            </button>
        </div>
        <Table
            :data="employees"
            v-if="isFinished"
            @edit="edit"
            @delete="(employee) => deleteEmployee(employee)"
        />
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
    isFinished,
} = useAxios<App.Models.Employee[]>("/employees", { method: "GET" }, instance);

const showEmployeeModal = ref(false);

const initialValues = {
    id: null as number | null,
    name: "",
    email: "",
    password: "",
    phone_number: "",
    username: "",
    image: null,
    image_url: "",
    role: "",
    description: "",
};
const editMode = ref(true);

const form = reactive({
    values: initialValues,
    errors: {},
});

const { execute: sendDeleteRequest } = useAxios(
    "",
    { method: "DELETE" },
    instance,
    { immediate: false },
);

const { execute: sendPostRequest, data: postData } = useAxios(
    "",
    { method: "POST", data: form },
    instance,
    { immediate: false },
);

const { execute: sendPutRequest, data: putData } = useAxios(
    "",
    { method: "PUT", data: form },
    instance,
    {
        immediate: false,
    },
);

const reset = () => {
    form.values = initialValues;
    form.errors = {};
};
const deleteEmployee = (employee: App.Models.Employee) => {
    sendDeleteRequest(`/employees/${employee.id}`).then(() => {
        if (employees.value)
            employees.value = employees.value.filter(
                (e) => e.id !== employee.id,
            );
    });
};

const submitForm = () => {
    if (form.values.id) {
        console.log("Sending edit request");
        console.log(form.values.id);
        sendPutRequest(`/employees/${form.values.id}`)
            .then(() => {
                console.log(putData.value);
                execute();
                showEmployeeModal.value = false;
                reset();
            })
            .catch((e) => {
                console.log(e);
            });
    } else {
        console.log("Sending post request");
        // @ts-ignore

        sendPostRequest("/employees")
            .then(() => {
                console.log(postData.value);
                execute();
                showEmployeeModal.value = false;
                reset();
            })
            .catch((e) => {
                console.log(e);
            });
    }
};

const showImportCSVModal = ref(false);

const csv = ref("");

const edit = (employee: App.Models.Employee) => {
    //@ts-ignore
    form.values = employee;
    form.values.name = employee.user?.name ?? "";
    form.values.email = employee.user?.email ?? "";
    form.values.phone_number = employee.user?.phone_number ?? "";

    form.errors = {};
    showEmployeeModal.value = true;
};
</script>
