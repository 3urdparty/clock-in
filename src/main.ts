import { createApp } from 'vue'
import App from './App.vue'

import './style.css'

import './demos/ipc'
// If you want use Node.js, the`nodeIntegration` needs to be enabled in the Main process.
// import './demos/node'
import { createMemoryHistory, createRouter } from 'vue-router'

import LoginView from '@/pages/Login.vue'
import HomeView from '@/pages/Home.vue'
import EmployeesView from './pages/Employees/Index.vue'
import DevicesView from './pages/Devices/Index.vue'
import DeviceView from '@/pages/Devices/Show.vue'
import EmployeeView from '@/pages/Employees/Show.vue'
import SettingsView from '@/pages/Settings.vue'
import ShiftsIndexView from '@/pages/Shifts/Index.vue'
import { RectangleGroupIcon } from '@heroicons/vue/24/outline'
import { useAuthStore } from './stores/auth'
const routes = [
    { path: '/login', component: LoginView },
    { path: '/', component: HomeView, name: 'Dashboard' },
    { path: '/employees', component: EmployeesView, name: 'Employees' },
    { path: '/devices', component: DevicesView, name: 'Devices' },
    { path: '/settings', component: SettingsView, name: 'Settings' },
    { path: '/devices/:id', component: DeviceView, name: 'Device Detail', props: true },
    { path: '/employees/:id', component: EmployeeView, name: 'Employee', props: true },
    { path: '/shifts', component: ShiftsIndexView, name: 'Shifts', props: true }
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})

router.beforeEach(async (to) => {
    // redirect to login page if not logged in and trying to access a restricted page
    const publicPages = ['/login'];
    const authRequired = !publicPages.includes(to.path);
    const auth = useAuthStore();

    if (authRequired && !auth.isAuthenticated.value) {
        auth.returnUrl.value = to.fullPath;
        return '/login';
    }
});
createApp(App)
    .use(router)
    .mount('#app')
    .$nextTick(() => {
        postMessage({ payload: 'removeLoading' }, '*')
    })
