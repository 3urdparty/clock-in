<template>
    <div>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
            class="fill-red-500 w-5"
            v-if="modelValue < 20"
        >
            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
                d="M80 160c-8.8 0-16 7.2-16 16V336c0 8.8 7.2 16 16 16H464c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H80zM0 176c0-44.2 35.8-80 80-80H464c44.2 0 80 35.8 80 80v16c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32v16c0 44.2-35.8 80-80 80H80c-44.2 0-80-35.8-80-80V176z"
            />
        </svg>
        <svg
            v-if="modelValue >= 20 && modelValue < 40"
            class="fill-red-500 w-5"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
        >
            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
                d="M464 160c8.8 0 16 7.2 16 16V336c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16H464zM80 96C35.8 96 0 131.8 0 176V336c0 44.2 35.8 80 80 80H464c44.2 0 80-35.8 80-80V320c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32V176c0-44.2-35.8-80-80-80H80zm112 96H96V320h96V192z"
            />
        </svg>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
            class="fill-orange-400 w-5"
            v-if="modelValue >= 40 && modelValue < 60"
        >
            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
                d="M464 160c8.8 0 16 7.2 16 16V336c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16H464zM80 96C35.8 96 0 131.8 0 176V336c0 44.2 35.8 80 80 80H464c44.2 0 80-35.8 80-80V320c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32V176c0-44.2-35.8-80-80-80H80zm208 96H96V320H288V192z"
            />
        </svg>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
            class="fill-yellow-400 w-5"
            v-if="modelValue >= 60 && modelValue < 80"
        >
            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
                d="M464 160c8.8 0 16 7.2 16 16V336c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16H464zM80 96C35.8 96 0 131.8 0 176V336c0 44.2 35.8 80 80 80H464c44.2 0 80-35.8 80-80V320c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32V176c0-44.2-35.8-80-80-80H80zm272 96H96V320H352V192z"
            />
        </svg>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
            class="fill-green-500 w-5"
            v-else-if="modelValue >= 80"
        >
            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
                d="M464 160c8.8 0 16 7.2 16 16V336c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16H464zM80 96C35.8 96 0 131.8 0 176V336c0 44.2 35.8 80 80 80H464c44.2 0 80-35.8 80-80V320c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32V176c0-44.2-35.8-80-80-80H80zm368 96H96V320H448V192z"
            />
        </svg>
    </div>
</template>
<script setup lang="ts">
interface Props {
    modelValue: number;
}
withDefaults(defineProps<Props>(), {
    modelValue: 0,
});
</script>
