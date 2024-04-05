import axios from 'axios'
export const instance = axios.create({
    baseURL: `${import.meta.env.VITE_APP_URL}:${import.meta.env.VITE_APP_PORT}/api/`,
    timeout: 1000,
})
