<template>
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">

        <header class="text-center">
                 <h2 class="text-2xl font-bold uppercase mb-1">
                     Register
                 </h2>
                 <p class="mb-4">Create an account to book your favorite hotels</p>
             </header>
     
             <form method="POST" action="" @submit.prevent="RegisterHandling">
     
                 <div class="mb-6">
                     <label  for="name" class="inline-block text-lg mb-2">Name</label>
                     <input v-model = "form.name" id="name" type="text" class="border border-gray-200 rounded p-2 w-full" name="name" />
                     <div class="errors" v-if="errors">
                        <p class="text-red-600" v-if="errors.name">{{ errors.name[0]}}</p> 
                    </div>
                 </div>
                 <div class="mb-6">
                     <label for="email" class="inline-block text-lg mb-2">Email</label>
                     <input v-model = "form.email" id="email" type="email" class="border border-gray-200 rounded p-2 w-full" name="email"  />
                     <div class="errors" v-if="errors">
                        <p class="text-red-600" v-if="errors.email">{{ errors.email[0]}}</p> 
                    </div>
                 </div>
     
                 <div class="mb-6">
                     <label for="password" class="inline-block text-lg mb-2">Password</label>
                     <input v-model = "form.password" id="password" type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
                     <div class="errors" v-if="errors">
                        <p class="text-red-600" v-if="errors.password">{{ errors.password[0] }}</p>
                    </div>
                 </div>
                 <div class="mb-6">
                     <label for="password2" class="inline-block text-lg mb-2">Confirm Password</label>
                     <input v-model = "form.password_confirmation" id="password2" type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" />
                                   
                </div>
                 <div class="mb-6">
                     <button   type="submit" class="bg-black text-white rounded py-2 px-4 hover:scale-105 duration-300">Sign Up</button>
                 </div>
     
                 <div class="mt-8">
                     <p>
                         Already have an account?
                         <router-link to="/login" class="text-blue-500 hover:scale-105 duration-300 inline-block">Login</router-link>
                     </p>
                 </div>
             </form>
    </div>
</template>

<script setup>
import {ref} from "vue"
import axios from "axios"
import { useRouter } from "vue-router"
import { useStore } from "vuex"



const form = ref({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const user = ref(null)
const errors = ref(null)
const router = useRouter()
const store = useStore()

const RegisterHandling = async () =>{
    axios.defaults.withCredentials = true
    axios.defaults.withXSRFToken = true
    try{
    await axios.get('http://localhost:8000/sanctum/csrf-cookie')
    await axios.post('http://localhost:8000/register', {
        name: form.value.name,
        email: form.value.email,
        password: form.value.password,
        password_confirmation: form.value.password_confirmation
    })

        let {data} = await axios.get('http://localhost:8000/api/user')

        localStorage.setItem('Authentication', true)
        localStorage.setItem('User', JSON.stringify(data))
        store.commit('setAuthentication')
        store.commit('setUser')

        router.push({name: 'Listings'})
    } catch (error){
        if(error.response){
            errors.value = error.response.data.errors ?? null 
        }
    }
}
</script>

<style>

</style>