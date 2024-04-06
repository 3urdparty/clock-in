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
                                                        v-model="
                                                            form.values.username
                                                        "
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
                                                        v-model="
                                                            form.values.role
                                                        "
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                        placeholder="Role"
                                                    />
                                                </div>
                                            </div>
                                            <AvatarSelect
                                                v-model="form.values.image"
                                            />
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
                                                            form.values
                                                                .description
                                                        "
                                                        name="about"
                                                        rows="3"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
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
                                                        v-model="
                                                            form.values.name
                                                        "
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
                                                            form.values
                                                                .phone_number
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
                                                        v-model="
                                                            form.values.email
                                                        "
                                                        name="email"
                                                        type="email"
                                                        autocomplete="email"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition"
                                                        :class="{
                                                            'ring-red-500 focus:ring-red-500':
                                                                form.errors
                                                                    ?.email,
                                                        }"
                                                    />
                                                </div>
                                                <span
                                                    class="text-red-500 text-sm"
                                                    v-for="error in form.errors
                                                        ?.email"
                                                >
                                                    {{ error }}
                                                </span>
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
                                        @click="
                                            open = false;
                                            emits('reset');
                                        "
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        @click="emits('submit')"
                                        type="button"
                                        class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 flex gap-1"
                                        :class="{
                                            'opacity-50 cursor-not-allowed':
                                                form.isLoading,
                                        }"
                                    >
                                        <Spinner
                                            class="animate-spin w-5"
                                            v-if="!!form.isLoading"
                                        />
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

<script setup lang="ts" generic="T extends Form">
export interface Form {}
import { UserCircleIcon } from "@heroicons/vue/24/solid";
// @ts-ignore
import Spinner from "@/assets/spinner.svg?component";
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { useVModels } from "@vueuse/core";
import AvatarSelect from "@/components/AvatarSelect.vue";

interface Props {
    form: T;
    open: boolean;
}

interface Emits {
    (e: "update:form", value: Props["form"]): void;
    (e: "submit"): void;
    (e: "reset"): void;
    (e: "update:open", value: boolean): void;
}
const emits = defineEmits<Emits>();
const props = defineProps<Props>();
const { form, open } = useVModels(props, emits);
</script>
