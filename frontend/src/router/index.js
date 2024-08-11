import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from '@/stores/authStore'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/timeline',
      component: () => import('../views/dashboard/Home.vue'),
      beforeEnter(to, from, next){
        const store = useAuthStore();
        if (store.isLoggedIn) {
          next();
        }else{
          next('/login');
        }
      }
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/auth/Register.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/auth/Login.vue'),
      beforeEnter(to, from, next){
        const store = useAuthStore();
        if (store.isLoggedIn) {
          next('/timeline');
        }else{
          next();
        }
      }
    }

  ]
})

export default router
