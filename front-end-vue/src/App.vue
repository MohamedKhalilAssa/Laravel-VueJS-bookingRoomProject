<template>
  <main class="mb-24">
    <Navbar/>
    <router-view/>
  </main>
  <Foooter />
</template>

<script setup>
import { onMounted, onUpdated } from "vue"
import { useStore } from "vuex"
import Navbar from "./components/NavBar.vue"
import Foooter from '@/components/Footer.vue'

onMounted(() => {
  const store = useStore()
  store.commit('setAuthentication')
  store.commit('setUser')
})
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

*{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
</style>
