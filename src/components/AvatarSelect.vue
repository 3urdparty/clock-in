<template>
    <div class="col-span-full">
        <label
            for="photo"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Photo</label
        >
        <div class="mt-2 flex items-center gap-x-3">
            <img
                :src="currentImageSrc"
                class="h-10 w-10 m-1 bg-gray-100 object-cover rounded-full"
                v-if="files"
                alt=""
            />
            <UserCircleIcon
                v-else
                class="h-12 w-12 text-gray-300"
                aria-hidden="true"
            />
            <button
                @click="open"
                type="button"
                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
            >
                Change
            </button>
            <div class="flex items-center gap-2">
                <span class="text-sm text-slate-400">
                    {{ files?.length ? files[0].name : "" }}
                </span>
                <button
                    @click="reset"
                    type="button"
                    class="rounded-full"
                    v-if="files?.length"
                >
                    <XCircleIcon
                        class="h-4 w-4 text-gray-400 mt-1"
                        aria-hidden="true"
                    />
                </button>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { UserCircleIcon, XCircleIcon } from "@heroicons/vue/20/solid";

import { useFileDialog, useVModel } from "@vueuse/core";
import { ref } from "vue";

const currentImageSrc = ref("");

const { files, open, reset, onChange } = useFileDialog({
    accept: "image/*", // Set to accept only image files
});

interface Props {
    modelValue: File | null;
}

interface Emits {
    (e: "update:modelValue", value: File): void;
}

const emits = defineEmits<Emits>();
const props = defineProps<Props>();

const file = useVModel(props, "modelValue", emits);

onChange((files) => {
    if (!files) {
        file.value = null;
    } else {
        file.value = files[0];
        const data = URL.createObjectURL(files[0]);
        currentImageSrc.value = data;
    }
});
</script>
