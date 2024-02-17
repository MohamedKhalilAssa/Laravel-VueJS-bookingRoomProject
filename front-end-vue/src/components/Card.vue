<template>
    <div class="card-container">
        <div class="imgContainer">
            <img  :src="hotel.image" alt="Hotel Room" class="hotel-room-image" />
        </div>
        <div class="hotel-room-info">
          <h1 style="font-size: 1.5rem; font-weight: 600;" class="hotel-room-title">{{ hotel.title }}</h1>
          <p class="hotel-room-description">{{hotel.address}}</p>
          <p class="hotel-room-price"><strong>${{hotel.price_per_night ?? 0}}/night</strong></p>
          <router-link :to="'/listings/'+ hotel.id">
              <button class="btn btn-dark">Book Now</button>
          </router-link>
        </div>
    </div>
</template>

<script setup>

const props = defineProps(['hotel'])
</script>

<style scoped>
/* Styling the card */

.card-container{
    width: calc(93%/4);
    min-width: 320px;
    /* margin-right:2rem; */
    display: flex;
    flex-direction: column;
    background: #eee;
    padding:15px;
    border-radius: 1rem;
}
/* text styling */
h1,p{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space:nowrap;
}
/* styling img */
.imgContainer{
    width: 300px;
    height: 170px;
    margin-bottom:10px;
    margin-left: auto;
    margin-right: auto;
}
.hotel-room-image{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border-radius: 1rem;
}


</style>