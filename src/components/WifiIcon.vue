<template>
    <div class="w-5 h-5 relative">
        <svg
            v-if="modelValue == 0"
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 text-blue-400 absolute z-10"
            viewBox="0 0 24 24"
        >
            <path
                fill="currentColor"
                d="M12 21q-1.05 0-1.775-.725T9.5 18.5t.725-1.775T12 16t1.775.725t.725 1.775t-.725 1.775T12 21"
            />
        </svg>
        <svg
            v-if="modelValue == 1"
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 text-blue-400 absolute z-10 left-0"
            width="1em"
            height="1em"
            viewBox="0 0 24 24"
        >
            <path
                fill="currentColor"
                d="M12 21q-1.05 0-1.775-.725T9.5 18.5t.725-1.775T12 16t1.775.725t.725 1.775t-.725 1.775T12 21m0-8q-1.275 0-2.425.375t-2.1 1.025q-.5.35-1.125.325t-1.05-.45q-.425-.45-.425-1.062t.5-.988q1.375-1.05 3.063-1.638T12 10t3.563.6t3.062 1.65q.5.375.513.988T18.7 14.3q-.425.425-1.05.438t-1.125-.338q-.95-.65-2.1-1.025T12 13"
            />
        </svg>
        <svg
            v-if="modelValue == 2"
            xmlns="http://www.w3.org/2000/svg"
            class="text-blue-400 absolute z-10 left-0"
            width="1em"
            height="1em"
            viewBox="0 0 24 24"
        >
            <path
                fill="currentColor"
                d="M12 21q-1.05 0-1.775-.725T9.5 18.5t.725-1.775T12 16t1.775.725t.725 1.775t-.725 1.775T12 21m0-11q1.875 0 3.563.6t3.062 1.65q.5.375.513.988T18.7 14.3q-.425.425-1.05.438t-1.125-.338q-.95-.65-2.1-1.025T12 13t-2.425.375t-2.1 1.025q-.5.35-1.125.325t-1.05-.45q-.425-.45-.425-1.062t.5-.988q1.375-1.05 3.063-1.638T12 10m0-6q3.125 0 5.888 1.025t4.962 2.9q.5.425.525 1.05t-.425 1.075q-.425.425-1.05.438t-1.125-.388q-1.8-1.475-4.037-2.287T12 7t-4.737.813T3.225 10.1q-.5.4-1.125.388t-1.05-.438Q.6 9.6.625 8.975t.525-1.05q2.2-1.875 4.963-2.9T12 4"
            />
        </svg>
    </div>
</template>
<script setup lang="ts">
interface Props {
    modelValue: number;
}
withDefaults(defineProps<Props>(), {
    modelValue: 1,
});
</script>
