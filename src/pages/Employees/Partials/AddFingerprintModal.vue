<template>
    <div class="relative flex justify-center">
        <Transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            enter-to-class="translate-y-0 opacity-100 sm:scale-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-y-0 opacity-100 sm:scale-100"
            leave-to-class="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        >
            <div
                v-show="isOpen"
                transition-enter-active-class="transition duration-300 ease-out"
                class="fixed inset-0 z-10 overflow-y-auto"
                aria-labelledby="modal-title"
                role="dialog"
                aria-modal="true"
            >
                <div
                    class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0"
                >
                    <span
                        class="hidden sm:inline-block sm:align-middle sm:h-screen"
                        aria-hidden="true"
                        >&#8203;</span
                    >

                    <div
                        class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6"
                    >
                        <div>
                            <FingerPrintIcon
                                class="w-12 h-12 mx-auto text-blue-600"
                            />
                            <div v-show="step == 0">
                                <div class="mt-4 text-center">
                                    <h3
                                        class="font-medium leading-6 text-gray-800 capitalize dark:text-white"
                                        id="modal-title"
                                    >
                                        Add New Fingerprint
                                    </h3>

                                    <p
                                        class="mt-2 text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        You can add a new fingerprint to your
                                        account by scanning your fingerprint at
                                        any of the connected devices.
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4 p-2 py-4">
                                    <label
                                        v-for="device in devices"
                                        class="opacity-50 has-[:checked]:opacity-100 has-[:disabled]:opacity-30 transition-opacity duration-300 has-[:checked]:ring rounded-lg ring-blue-200/50"
                                    >
                                        <input
                                            :disabled="
                                                device.status != 'online'
                                            "
                                            type="radio"
                                            v-model="selectedDevice"
                                            class="hidden"
                                            :value="device.id"
                                        />
                                        <DeviceCard
                                            :modelValue="device"
                                            class="h-full"
                                        />
                                    </label>
                                </div>
                            </div>
                            <div v-show="step == 1">
                                <div class="mt-4 text-center">
                                    <h3
                                        class="font-medium leading-6 text-gray-800 capitalize dark:text-white"
                                        id="modal-title"
                                    >
                                        Scan Fingerprint
                                    </h3>

                                    <p
                                        class="mt-2 text-sm text-gray-500 dark:text-gray-400"
                                    >
                                        Place your finger on the fingerprint
                                        scanner of the selected device to scan
                                        your fingerprint.
                                        <span
                                            class="inline-flex items-center gap-x-1.5 rounded-full bg-blue-200 px-2 py-1 text-xs font-medium text-blue-700 mt-1 capitalize"
                                        >
                                            <Spinner
                                                class="animate-spin w-5 text-red-500"
                                                v-if="true"
                                            />

                                            {{ status?.status }}
                                        </span>
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <div class="flex justify-center">
                                        <div
                                            class="w-40 h-40 flex justify-center items-center rounded-full"
                                        >
                                            <Fingerprint
                                                class="fill-slate-400/40 w-32 h-32"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="mt-4 sm:mt-6 sm:flex sm:items-end sm:-mx-2 sm:justify-end"
                        >
                            <button
                                @click="
                                    isOpen = false;
                                    selectedDevice = null;
                                    step = 0;
                                "
                                class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40"
                            >
                                Cancel
                            </button>

                            <button
                                @click="requestScan"
                                v-if="step == 0"
                                class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 disabled:opacity-20"
                                :disabled="!selectedDevice"
                            >
                                Select Device
                            </button>
                            <button
                                v-if="step == 2"
                                class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"
                            >
                                Scan Fingerprint
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<script setup lang="ts">
import { instance } from "@/api/instance";
//@ts-ignore
import Fingerprint from "@/assets/fingerprint.svg?component";

//@ts-ignore
import Spinner from "@/assets/spinner.svg?component";
import DeviceCard from "@/pages/Devices/Partials/DeviceCard.vue";
import { FingerPrintIcon } from "@heroicons/vue/24/outline";
import { useVModel, useTimeoutPoll } from "@vueuse/core";
import { useAxios } from "@vueuse/integrations/useAxios";
import { ref } from "vue";
interface Props {
    isOpen: boolean;
    employeeId: number;
}
interface Emit {
    (event: "update:isOpen", value: boolean): void;
}
const props = defineProps<Props>();
const emit = defineEmits<Emit>();
const isOpen = useVModel(props, "isOpen", emit);

const { data: devices } = useAxios<App.Models.Device[]>(
    "/devices",
    { method: "GET" },
    instance,
);

const selectedDevice = ref<App.Models.Device | null>(null);
const { execute } = useAxios(
    "/fingerprints/enroll",
    { method: "POST" },
    instance,
    { immediate: false },
);

const { execute: updateStatus, data: status } = useAxios<App.Models.Device>(
    "/sync",
    { method: "GET" },
    instance,
    { immediate: false },
);

const step = ref(0);

const { pause, resume } = useTimeoutPoll(
    () => {
        updateStatus();
    },
    1000,
    {
        immediate: false,
    },
);

const requestScan = () => {
    if (!selectedDevice.value) return;
    execute({
        data: {
            device_id: selectedDevice.value,
            employee_id: props.employeeId,
        },
    })
        .then(() => {
            step.value = 1;
            resume();
        })
        .catch((e) => {
            alert(e);
            pause();
        });
};
</script>
