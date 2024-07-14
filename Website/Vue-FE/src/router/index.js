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
        props: true,
        meta: {
            requiresAuth: true // Add meta field to indicate protected route
          }
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

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        const token = localStorage.getItem('token');
        if (token) {
          // User is authenticated, proceed to the route
          next();
        } else {
          // User is not authenticated, redirect to login
          next('/login');
        }
    } else {
        // Non-protected route, allow access
        next();
      }
})

export default router
