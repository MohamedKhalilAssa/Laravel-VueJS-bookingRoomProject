<template>
    <nav ref="nav"  id="nav" class="bg-white">
        <router-link to="/"><p class="brand">WanderStay</p></router-link>
      
  
          <div ref="btn" class="hamburger" @click="toggleMenu">
              <span class="layer"></span>
              <span class="layer"></span>
              <span class="layer"></span>
          </div>
          <div  class="linksHolder">
            <div v-if="!isAuthenticated" class="guest">
                <router-link class="links" to="/login">Login</router-link>
                <router-link class="links" to="/register">Register</router-link>
            </div>
            <div v-else class="other">
                <button class="links" @click="logoutHandling" >Logout <i class="fas fa-door-open"></i></button>

            </div>
          </div>
    </nav>
  </template>
  
  <script setup>
import { ref, computed, mapGetters, watch } from 'vue'
import { useStore } from 'vuex';
import axios from "axios"
import { useRouter } from 'vue-router';

//   hamburger configuration
  const btn = ref(null)
  const nav = ref(null)

  const store = useStore()
  let isAuthenticated = computed(() => store.getters.getAuthentication)



  const toggleMenu = ()=>{
      btn.value.classList.toggle('active')
      nav.value.classList.toggle('bigger')
  }


 


const router = useRouter()

const logoutHandling  = async ()=>{
    axios.defaults.withCredentials = true
    axios.defaults.withXSRFToken = true
    try{
        await axios.post('http://localhost:8000/logout')

    // taking out the user from storage/store
        localStorage.removeItem('Authentication')
        localStorage.removeItem('User')
        store.commit('setAuthentication')
        store.commit('setUser')

    } catch (error){
        console.log(error)
    }
    router.push({name: 'Listings'})
}

</script>
  
  <style scoped>
  /* to cancel scss effect  */
  p{
    margin:0;
  }
  /* styling the navbar */
  #nav{
      height:7vh;
      width:100%;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      padding: 0 2rem;
      position: sticky;
      top:0;
      z-index: 100;
      transition: all 0.3s ease;
      overflow: hidden;
  }
  #nav::after{
      content: "";
      width:60%;
      height: 1px;
      background-color: #333;
      position: absolute;
      bottom: 0;
      left: 20%;
  }
  #nav .brand{
      color:#E2725B;
      font-size: 1.5rem;
      font-weight: 700;
  }
  #nav .links{
      text-decoration: none;
      color: #333;
      margin-left: 1rem;
      position:relative;
      transition: all 0.3s ease;
      font-size: 1.2rem;
  }
  #nav .links::after{
      content: "";
      width:0;
      height: 1px;
      background-color: #333;
      position: absolute;
      bottom: -0.4rem;
      left: 20%;
      transition: all 0.3s ease;
  }
  #nav .links:hover::after{
      width:60%;
  }
  .router-link-exact-active{
      font-weight: 700;
  }
  #nav .links.router-link-exact-active::after{
      width:60%;
  }
  /* setting up hamburger menu  */
  .hamburger{
      width:2rem;
      height: 5rem;
      display:none;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      transition:all 0.4s ease-in-out
  }
  
  .layer{
      display: block;
      width: 100%;
      height:4px;
      background: #333;
      margin-top:6px;
      transition:all 0.4s ease-in-out
  }
  .hamburger:hover .layer:nth-child(2) {
      width: 20%;
  }
  
  
  @media screen and (max-width: 550px){
      .brand{
          position:fixed;
          top: 12px;
          left:16px;
      }
      .hamburger{
          display: flex;
          position:fixed;
          height:2.5rem;
          right:16px;
          top:5px;
      }
      .hamburger.active{
          top:0;
      }
      .hamburger.active .layer:nth-child(2){
          display: none;
      }
      .hamburger.active .layer:nth-child(1){
          background: red;
          rotate: -45deg;
          transform: translate(-7px,5.5px );
      }
      .hamburger.active .layer:nth-child(3){
          background: red;
          rotate: 45deg;
      }
      
      #nav.bigger .linksHolder{
          display: block;
          position: absolute;
          top:12vh;
          left:50%;
          transform: translateX(-50%);
      }
      .linksHolder{
          display: none;
      }
      .links{
          display: block;
          font-size:1.3rem;
          margin-top:1rem;
      }
      .links::after{
          display: none;
      }
     
      #nav.bigger{
          height:40vh;
      }
  }
  </style>