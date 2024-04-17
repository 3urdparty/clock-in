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
                                <div class="bg-white py-4 px-1">
                                    <h3
                                        class="text-base font-semibold leading-6 text-gray-900 font-bold text-3xl"
                                    >
                                        Import from CSV
                                    </h3>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="min-w-0 flex-1">
                                        <form action="#" class="relative">
                                            <div
                                                class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-blue-600"
                                            >
                                                <label
                                                    for="comment"
                                                    class="sr-only"
                                                    >Add your comment</label
                                                >
                                                <textarea
                                                    rows="3"
                                                    name="comment"
                                                    id="comment"
                                                    class="block w-full h-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="Add your .csv file content here..."
                                                />

                                                <!-- Spacer element to match the height of the toolbar -->
                                                <div
                                                    class="py-2"
                                                    aria-hidden="true"
                                                >
                                                    <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                                                    <div class="py-px">
                                                        <div class="h-9" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2"
                                            >
                                                <div
                                                    class="flex items-center space-x-5"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <button
                                                            type="button"
                                                            class="-m-2.5 flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                                                        >
                                                            <PaperClipIcon
                                                                class="h-5 w-5"
                                                                aria-hidden="true"
                                                            />
                                                            <span
                                                                class="sr-only"
                                                                >Attach a
                                                                file</span
                                                            >
                                                        </button>
                                                    </div>
                                                    <div
                                                        class="flex items-center"
                                                    ></div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                                    >
                                                        Import
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { useVModels } from "@vueuse/core";

interface Props {
    modelValue: string;
    open: boolean;
}

interface Emits {
    (e: "update:modelValue", value: Props["modelValue"]): void;
    (e: "submit"): void;
    (e: "reset"): void;
    (e: "update:open", value: boolean): void;
}
const emits = defineEmits<Emits>();
const props = withDefaults(defineProps<Props>(), {
    modelValue: "",
    open: false,
});
const { modelValue, open } = useVModels(props, emits);
</script>
