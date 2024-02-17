import { createRouter, createWebHistory } from 'vue-router'
import ListingsView from '@/views/Listings/ListingsView.vue'
import ListingView from '@/views/Listings/ListingView.vue'
import CreateListingView from '@/views/Listings/CreateListingView.vue'
import RegisterView from '@/views/Users/RegisterView.vue'
import LoginView from '@/views/Users/LoginView.vue'
import axios from 'axios'
import { useStore } from 'vuex'

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
  },  
  {
    path: '/create',
    name: 'Create',
    component: CreateListingView,
    meta: {
      requiresAuthentication: true
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
  } else if(to.meta.requiresAuthentication && !localStorage.getItem('Authentication')){
    //initial check for token
    next({name: 'Login'})
  } else if(to.meta.requiresAuthentication && localStorage.getItem('Authentication')){
    // to check the token authenticity
      axios.defaults.withCredentials = true
      axios.defaults.withXSRFToken = true
      const store = useStore()
      axios.get('http://localhost:8000/api/user')
      .then((response)=>{
        next()
      })
      .catch(error => {
        localStorage.removeItem('Authentication')
        localStorage.removeItem('User')
        store.commit('setAuthentication')
        store.commit('setUser')
        next({name: 'Login'})
      })
  }
  else {
    next()
  }
})



export default router
