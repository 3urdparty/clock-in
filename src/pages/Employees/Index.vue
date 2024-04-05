<template>
    <div>
        <CreateEmployeeForm
            v-model:form="form"
            v-model:open="showModal"
            @submit="() => submit('employees')"
            @reset="reset"
        />
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
import { useAxios } from "@vueuse/integrations/useAxios";
import { instance } from "@/api/instance";
import { reactive, ref } from "vue";
import { useAxiosForm } from "@/composables/useAxiosForm";
const { data: employees } = useAxios<App.Models.Employee[]>(
    "/employees",
    { method: "GET" },
    instance,
);
const showModal = ref(false);

const { form, submit, reset } = useAxiosForm(
    {
        name: "John Doe",
        email: "john.doe@gmail.com",
        password: "JohnDoe123",
        phone_number: "+601123049307",
        username: "johndoe",
        image_url:
            "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        role: "Software Engineer",
        description: "I am a software engineer",
    },
    { method: "POST" },
);
</script>
