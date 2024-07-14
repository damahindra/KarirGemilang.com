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
    },
    {
        path: '/user/signup',
        name: 'karir.signup',
        component: () => import('@/views/auth/SignUp.vue'),
    },
    {
        path: '/signup',
        name: 'karir.roles',
        component: () => import('@/views/auth/RolesPage.vue'),
    },
    {
        path: '/employer/signup',
        name: 'karir.signupemployer',
        component: () => import('@/views/auth/SignUpEmployer.vue'),
    },
    {
        path: '/signin',
        name: 'karir.signin',
        component: () => import('@/views/auth/SignIn.vue'),
    },
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

export default router
