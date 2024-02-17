<template>
  <CardContainer v-if="show">
    <Card  v-for="listing in computedListings " :key="listing.id" :hotel="listing"/>
  </CardContainer>
  <h1 v-else style="margin-top: 6rem;">Loading data...</h1>
</template>

<script setup>
import {ref, computed, watchEffect } from "vue"
import Card from "@/components/Card.vue"
import CardContainer from "@/components/CardContainer.vue"
import getListings from "@/composables/getListings"

// to avoid showing while still fetching
let show = ref(false);

const {listings,errors,loadPosts} = getListings()

loadPosts()

let computedListings = computed(()=>null)



watchEffect(()=>{
  if(listings.value.data){
    show.value = true;
     computedListings = computed(()=>{
        return listings.value.data
      })
  }
})
</script>
