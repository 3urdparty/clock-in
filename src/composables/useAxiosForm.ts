import { instance } from "@/api/instance"
import { useAxios } from "@vueuse/integrations/useAxios"
import { AxiosRequestConfig } from "axios";
import { computed, reactive } from "vue"

// export interface Form<T> extends ReturnType<typeof useAxios> { }
export const useAxiosForm = (data: { [key: string]: any }, options: AxiosRequestConfig, transform?: (data: { [key: string]: any }) => {}) => {
    const values = reactive({ ...data });
    const errors = reactive({});

    const { execute, isLoading, isFinished, isAborted, isCanceled } = useAxios('', options, instance, { immediate: false })

    const form = computed(() => ({
        values, errors,
        isLoading: isLoading.value, isFinished: isFinished.value, isAborted: isAborted.value, isCanceled: isCanceled.value,
    }))


    const submit = (url: string) => {
        if (transform) {
            transform(values)
        }
        execute(url, { data: values }).catch((error) => {
            Object.assign(errors, error.response.data.errors)
        })
    }

    const reset = () => {
        Object.assign(errors, {})
    }
    return { form, submit, reset }
}

// usage : const {form} = useAxiosForm(url, {options}, data)
