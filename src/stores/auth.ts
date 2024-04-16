import { createGlobalState, useLocalStorage } from "@vueuse/core"
import { computed, ref } from "vue"

import { useRoute, useRouter } from 'vue-router'
export interface User {
    name: string
}
export const useAuthStore = createGlobalState(
    () => {
        const user = useLocalStorage<User | null>('user', null)
        const isAuthenticated = computed(() => user.value !== null)

        const returnUrl = ref()
        const login = () => {
            user.value = { name: 'John Doe' }
            useRouter().push(returnUrl.value as string ?? '/')

        }
        return {
            isAuthenticated,
            returnUrl,
            login
        }
    }
)
