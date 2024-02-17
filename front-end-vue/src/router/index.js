import { createRouter, createWebHistory } from 'vue-router'
import ListingsView from '@/views/Listings/ListingsView.vue'
import ListingView from '@/views/Listings/ListingView.vue'
import RegisterView from '@/views/Users/RegisterView.vue'
import LoginView from '@/views/Users/LoginView.vue'

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
    component: RegisterView,
    meta:{
      requiresGuest : true
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginView,
    meta: {
      requiresGuest: true
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

// guarding routes 

router.beforeEach((to, from, next) => {
  if(to.meta.requiresGuest && localStorage.getItem('Authentication')){
    next({name: 'Listings'})
  } else {
    next()
  }
})


export default router
