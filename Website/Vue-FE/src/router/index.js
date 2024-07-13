import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'karir.splash',
        component: () => import('@/views/auth/SplashScreen.vue')
    },
    {
        path: '/home',
        name: 'karir.home',
        component: () => import('@/views/karir/HomePage.vue')
    },
    {
        path: '/job/:id',
        name: 'karir.job',
        component: () => import('@/views/karir/JobDetail.vue'),
        props: true
    }
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

export default router
