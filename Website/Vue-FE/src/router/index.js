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
        path: '/employer/home',
        name: 'employer.home',
        component: () => import('@/views/karir/EmployerHomePage.vue')
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
        path: '/user/:id',
        name: 'karir.user',
        component: () => import('@/views/karir/UserProfile.vue'),
        props: true,
        meta: {
            requiresAuth: true // Add meta field to indicate protected route
          }
    },
    {
        path: '/employer/:id',
        name: 'karir.employer',
        component: () => import('@/views/karir/EmployerProfile.vue'),
        props: true,
        meta: {
            requiresAuth: true // Add meta field to indicate protected route
          }
    },
    {
        path: '/user/signup',
        name: 'karir.signup',
        component: () => import('@/views/auth/SignUp.vue'),
        meta: {
            noAuth: true // Add meta field to indicate protected route
          }
    },
    {
        path: '/signup',
        name: 'karir.roles',
        component: () => import('@/views/auth/RolesPage.vue'),
    },
    {
        path: '/login',
        name: 'karir.roles.login',
        component: () => import('@/views/auth/RolesLogin.vue'),
    },
    {
        path: '/employer/signup',
        name: 'karir.signupemployer',
        component: () => import('@/views/auth/SignUpEmployer.vue'),
        meta: {
            noAuth: true // Add meta field to indicate protected route
          }
    },
    {
        path: '/user/login',
        name: 'karir.signin',
        component: () => import('@/views/auth/SignIn.vue'),
        meta: {
            noAuth: true // Add meta field to indicate protected route
          }
    },
    {
        path: '/employer/login',
        name: 'employer.signin',
        component: () => import('@/views/auth/EmployerSignin.vue'),
        meta: {
            noAuth: true // Add meta field to indicate protected route
          }
    },
    {
        path: '/employer/createjob',
        name: 'employer.createjob',
        component: () => import('@/views/karir/AddJob.vue'),
        meta: {
            requiresAuth: true // Add meta field to indicate protected route
          }
    },
    {
        path: '/job/:id/apply',
        name: 'karir.apply',
        component: () => import('@/views/karir/ApplyJob.vue'),
        props: true,
        meta: {
            requiresAuth: true // Add meta field to indicate protected route
          }
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
          next('/signin');
        }
    } 
    else if (to.meta.noAuth) {
        const token = localStorage.getItem('token');
        if (token) {
            if (to.path === '/user/signup' || to.path === '/login') {
                next('/home');
            }
        }
          // User is authenticated, proceed to the route
          next();
    } 
    else {
        // Non-protected route, allow access
        next();
      }
})

export default router
