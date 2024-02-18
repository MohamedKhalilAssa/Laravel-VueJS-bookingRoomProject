<template>
  <main v-if="show">
    <CardContainer >
      <Card  v-for="listing in computedListings " :key="listing.id" :hotel="listing"/>
    </CardContainer>
    <div class="links mt-10" v-if="listings.last_page > 1">
      <router-link :to="{name:'Listings',query:{page:listings.current_page-1}}" v-if="listings.current_page > 1" class="w-12 h-7 py-2 px-4 rounded text-white bg-black m-4">Previous</router-link>
      <router-link :to="{name:'Listings',query:{page:listings.current_page+1}}" v-if="listings.current_page < listings.last_page" class="w-12 h-7 py-2 px-4 rounded text-white bg-black">Next</router-link>
    </div>
  </main>
  <h1 v-else style="margin-top: 6rem;">Loading data...</h1>
</template>

<script setup>
import {ref, computed, watchEffect, onMounted, watch } from "vue"
import Card from "@/components/Card.vue"
import CardContainer from "@/components/CardContainer.vue"
import getListings from "@/composables/getListings"
import { useRoute } from "vue-router";

// to avoid showing while still fetching
let show = ref(false);

const {listings,errors,loadPosts} = getListings()

const route = useRoute()
// loading initial Listings

onMounted(()=>{
  loadPosts(route.query.page)
})
// nextHandling
// const nextHandling = ()=>{
//   loadPosts(listings.value.current_page+1) // route.query.page
// }

// const prevHandling = ()=>{
//   loadPosts(listings.value.current_page-1 > 1 ? listings.value.current_page-1 : 1)
// }


let computedListings = computed(()=>null)
const current = ref(1)

watchEffect(()=>{
  if(listings.value.data){
    show.value = true;
     computedListings = computed(()=>{
        return listings.value.data
      })
  }
  if(listings.value.current_page != route.query.page){
      current.value = route.query.page
    }
})
watch(current, ()=>{
  loadPosts(current.value)
})

</script>
