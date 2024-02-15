import { createRouter, createWebHistory } from 'vue-router'
import ListingsView from '@/views/Listings/ListingsView.vue'
import ListingView from '@/views/Listings/ListingView.vue'
import RegisterView from '@/views/RegisterView.vue'
import LoginView from '@/views/LoginView.vue'

const routes = [
  {
    path: '/',
    name: 'Listings',
    component: ListingsView
  },
  // single listing
  {
    path: '/listings/:id',
    name: 'Listing',
    component: ListingView,
    props:true
  },
  // login and register
  {
    path: '/register',
    name: 'Register',
    component: RegisterView
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
