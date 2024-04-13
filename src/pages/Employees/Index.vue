<template>
    <div>
        <div v-if="isLoading || error" class="grid grid-cols-2 gap-2">
            <div
                class="animate-pulse w-full h-20 rounded-md bg-gradient-to-br from-blue-200/50 to-blue-200/30"
            ></div>
            <div
                class="animate-pulse w-full h-20 rounded-md bg-gradient-to-br from-blue-200/50 to-blue-200/30"
            ></div>
            <div
                class="animate-pulse w-full h-80 rounded-md col-span-2 bg-gradient-to-br from-blue-200/50 to-blue-200/30"
            ></div>
        </div>
        <template v-else>
            <CreateEmployeeForm
                v-model:form="form"
                v-model:open="showModal"
                @submit="submitForm"
                @reset="reset"
            />
            <div class="flex items-center justify-end pb-3">
                <button
                    type="button"
                    @click="showModal = true"
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                >
                    <PlusIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                    Add
                </button>
            </div>
            <Table :data="employees" />
        </template>
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
const {
    execute,
    data: employees,
    isLoading,
    error,
} = useAxios<App.Models.Employee[]>("/employees", { method: "GET" }, instance);

const showModal = ref(false);

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
        showModal.value = false;
    });
};
</script>
