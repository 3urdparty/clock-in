<template>
    <div>
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="relative z-10" @close="open = false">
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    />
                </TransitionChild>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div
                        class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100"
                            leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <DialogPanel
                                class="relative transform rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl sm:p-6 overflow-scroll h-[80vh]"
                            >
                                <div class="space-y-12">
                                    <div
                                        class="border-b border-gray-900/10 pb-12"
                                    >
                                        <h2
                                            class="text-base font-semibold leading-7 text-gray-900"
                                        >
                                            Create Employee Form
                                        </h2>
                                        <p
                                            class="mt-1 text-sm leading-6 text-gray-600"
                                        >
                                            Fill in the form below to create a
                                            new employee.
                                        </p>

                                        <div
                                            class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                                        >
                                            <div class="sm:col-span-2">
                                                <label
                                                    for="company-website"
                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                    >Username</label
                                                >
                                                <div
                                                    class="mt-2 flex rounded-md shadow-sm"
                                                >
                                                    <span
                                                        class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 px-3 text-gray-500 sm:text-sm text-slate-400"
                                                        >@</span
                                                    >
                                                    <input
                                                        type="text"
                                                        v-model="form.username"
                                                        name="company-website"
                                                        id="company-website"
                                                        class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                        placeholder="Username"
                                                    />
                                                </div>
                                            </div>

                                            <div class="sm:col-span-3">
                                                <label
                                                    for="email"
                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                    >Role</label
                                                >
                                                <div class="mt-2">
                                                    <input
                                                        type="text"
                                                        name="role"
                                                        id="role"
                                                        v-model="form.role"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                        placeholder="Role"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-span-full">
                                                <label
                                                    for="photo"
                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                    >Photo</label
                                                >
                                                <div
                                                    class="mt-2 flex items-center gap-x-3"
                                                >
                                                    <UserCircleIcon
                                                        class="h-12 w-12 text-gray-300"
                                                        aria-hidden="true"
                                                    />
                                                    <button
                                                        type="button"
                                                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                                    >
                                                        Change
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-span-full">
                                                <label
                                                    for="about"
                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                    >About</label
                                                >
                                                <div class="mt-2">
                                                    <textarea
                                                        id="about"
                                                        v-model="
                                                            form.description
                                                        "
                                                        name="about"
                                                        rows="3"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                    />
                                                </div>
                                                <p
                                                    class="mt-3 text-sm leading-6 text-gray-600"
                                                >
                                                    Write a few sentences about
                                                    yourself.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="border-b border-gray-900/10 pb-12"
                                    >
                                        <h2
                                            class="text-base font-semibold leading-7 text-gray-900"
                                        >
                                            Personal Information
                                        </h2>
                                        <p
                                            class="mt-1 text-sm leading-6 text-gray-600"
                                        >
                                            Use a permanent address where you
                                            can receive mail.
                                        </p>

                                        <div
                                            class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                                        >
                                            <div class="sm:col-span-3">
                                                <label
                                                    for="first-name"
                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                    >First name</label
                                                >
                                                <div class="mt-2">
                                                    <input
                                                        type="text"
                                                        v-model="form.name"
                                                        name="first-name"
                                                        id="first-name"
                                                        autocomplete="given-name"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                    />
                                                </div>
                                            </div>

                                            <div class="sm:col-span-3">
                                                <label
                                                    for="last-name"
                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                    >Last name</label
                                                >
                                                <div class="mt-2">
                                                    <input
                                                        type="text"
                                                        name="last-name"
                                                        id="last-name"
                                                        autocomplete="family-name"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                    />
                                                </div>
                                            </div>
                                            <div class="sm:col-span-3">
                                                <label
                                                    for="phone-number"
                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                    >Phone Number</label
                                                >
                                                <div
                                                    class="relative mt-2 rounded-md shadow-sm"
                                                >
                                                    <div
                                                        class="absolute inset-y-0 left-0 flex items-center"
                                                    >
                                                        <label
                                                            for="country"
                                                            class="sr-only"
                                                            >Country</label
                                                        >
                                                        <select
                                                            id="country"
                                                            name="country"
                                                            autocomplete="country"
                                                            class="h-full rounded-md border-0 bg-transparent py-0 pl-3 pr-7 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm"
                                                        >
                                                            <option>MY</option>
                                                        </select>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        name="phone-number"
                                                        id="phone-number"
                                                        v-model="
                                                            form.phone_number
                                                        "
                                                        class="block w-full rounded-md border-0 py-1.5 pl-16 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                        placeholder="+1 (555) 987-6543"
                                                    />
                                                </div>
                                            </div>
                                            <div class="sm:col-span-4">
                                                <label
                                                    for="email"
                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                    >Email address</label
                                                >
                                                <div class="mt-2">
                                                    <input
                                                        id="email"
                                                        v-model="form.email"
                                                        name="email"
                                                        type="email"
                                                        autocomplete="email"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-6 flex items-center justify-end gap-x-6"
                                >
                                    <button
                                        type="button"
                                        class="text-sm font-semibold leading-6 text-gray-900"
                                        @click="open = false"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        @click="handleSubmit"
                                        type="submit"
                                        class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                    >
                                        Save
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup lang="ts">
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { reactive } from "vue";
import { useVModel } from "@vueuse/core";
import { useAxios } from "@vueuse/integrations/useAxios";

interface Props {
    open: boolean;
}

interface Emits {
    (e: "update:open", value: boolean): void;
}
const emits = defineEmits<Emits>();
const props = defineProps<Props>();
const open = useVModel(props, "open", emits);

import { UserCircleIcon } from "@heroicons/vue/24/solid";
import { instance } from "@/api/instance";

const form = reactive({
    name: "John Doe",
    email: "john.doe@gmail.com",
    password: "JohnDoe123",
    phone_number: "+601123049307",
    username: "johndoe",
    image_url:
        "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    role: "Software Engineer",
    description: "I am a software engineer",
});

const { execute, data } = useAxios("/employees", { method: "POST" }, instance);
const handleSubmit = () => {
    //open.value = false;
    execute({ data: form });
};
</script>
