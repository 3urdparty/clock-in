import { createGlobalState, useLocalStorage } from "@vueuse/core"
import { computed, ref } from "vue"

import { useRouter } from 'vue-router'
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
            useRouter().push('/')
        }

        const logout = () => {
            user.value = null;
            useRouter().push('/login')

        }
        return {
            logout,
            isAuthenticated,
            returnUrl,
            login
        }
    }
)
