import { instance } from "@/api/instance"
import { useAxios } from "@vueuse/integrations/useAxios"
import { AxiosRequestConfig } from "axios";
import { computed, reactive } from "vue"

export interface Errors {
    [key: string]: string[]
}
// export interface Form<T> extends ReturnType<typeof useAxios> { }
export const useAxiosForm = (data: { [key: string]: any }, options: AxiosRequestConfig, transform?: (data: { [key: string]: any }) => {}) => {
    const values = reactive({ ...data });
    const errors = reactive<Errors>({});
    const hasErrors = computed(() => Object.keys(errors).length > 0)

    const { execute, isLoading, isFinished, isAborted, isCanceled } = useAxios('', options, instance, { immediate: false })

    const form = computed(() => ({
        values, errors,
        isLoading: isLoading.value, isFinished: isFinished.value, isAborted: isAborted.value, isCanceled: isCanceled.value,
    }))


    const submit = (url: string): Promise<void> => {
        return new Promise((resolve, reject) => {
            for (const prop of Object.getOwnPropertyNames(errors)) {
                delete errors[prop];
            }

            if (transform) {
                transform(values);
            }

            execute(url, { data: values })
                .then(() => {
                    resolve(); // Resolve the Promise when the operation is successful
                })
                .catch((error) => {
                    Object.assign(errors, error.response.data.errors);
                    reject(error); // Reject the Promise when an error occurs
                });
        });
    };

    const reset = () => {
        Object.assign(errors, {})
    }
    return { form, submit, reset, hasErrors, values }
}

// usage : const {form} = useAxiosForm(url, {options}, data)
