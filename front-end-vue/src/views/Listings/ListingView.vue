<template>
<div v-if="show" class="container-style">
    <div class="imgField">
        <img :src="listing.image" alt="Hotel Image">
    </div>
    <div class="textField">
        <h1>{{listing.title}}</h1>
        <h5>{{listing.address}}</h5>
        <h5 style="font-weight: bold;">${{listing.price_per_night ?? 0 }} /night</h5>
        <hr/>
        <p class="description-field">
            <h1>What to expect: </h1>
            {{listing.description }}   <br> {{moreText}}
        </p>
    </div>
</div>
<h1 v-else style="margin-top: 7rem;">
    Loading...
</h1>

</template>

<script setup>
import { defineProps } from 'vue';


const props = defineProps(['id'])

import {ref, watchEffect } from "vue"
import getListing from "@/composables/getListing"

// to avoid showing while still fetching
let show = ref(false);

const {listing,errors,loadPost} = getListing()


loadPost(props.id)


watchEffect(()=>{
  if(listing.value){
    show.value = true;    

  }
})


// more text for better look 
const  moreText = `Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi reiciendis velit eveniet tenetur! Dolore quod tenetur enim fugit nihil, praesentium, iure voluptas eligendi sunt sequi velit ullam facilis provident? Dignissimos?
        Odio perspiciatis architecto consectetur, dignissimos, ad asperiores itaque vitae dolorem vero commodi, eligendi atque a ipsam! Consequatur cumque labore rem. Molestiae minima a maiores nesciunt tenetur architecto voluptatum odit sit?
        Deleniti in commodi ea. Dolorum harum quos vitae eligendi quae dolores, id illum atque hic neque molestiae ducimus facere excepturi aut dolor qui esse tenetur dolorem adipisci eaque laborum. Dicta?
        Aliquid inventore atque nihil eius nam sit quo numquam expedita asperiores blanditiis libero est harum quia autem illum in placeat nulla, eligendi ducimus natus? Assumenda similique perspiciatis doloremque in ut.
        Nihil, quisquam officia totam in voluptas doloremque, at illum molestiae omnis magnam harum nesciunt, dignissimos tenetur sunt laborum soluta earum. Repellendus delectus error provident ipsam. Aliquid eligendi placeat pariatur repellat?
        Perspiciatis tempora amet beatae, repellendus consequatur magni temporibus repudiandae! Iste architecto suscipit temporibus autem cumque eum laudantium quam harum sint! Quis, porro ullam tempora modi ea esse dolor repellendus praesentium!
        Ipsum quia temporibus, debitis inventore ipsa laudantium earum velit vero praesentium, voluptate error? Nam, aliquam magni, non porro amet neque consequuntur, nisi soluta laudantium voluptatibus eos adipisci saepe officiis quisquam!
        Illum, perspiciatis numquam quasi provident ad repellendus modi iusto reiciendis molestias sint odio? Error placeat recusandae perferendis repudiandae, culpa unde ex nostrum? Culpa similique et laboriosam maiores adipisci voluptatibus. Nobis.
        Eligendi laboriosam culpa tempora corporis eos obcaecati amet fugit nesciunt vel! Ducimus ipsa deserunt incidunt architecto, quasi explicabo expedita assumenda, minus inventore, similique illo nobis ex necessitatibus repudiandae. Tempora, totam?
        Nemo corrupti quibusdam repellat, eaque consequatur fugiat molestiae eum sunt officia consectetur repellendus, perspiciatis laboriosam exercitationem reiciendis quis! Repudiandae, quod expedita recusandae ducimus reiciendis quis ipsa. Omnis, temporibus! Quia, officiis?
        Consectetur, iusto itaque harum facere consequuntur quod laborum molestias architecto repellat optio dignissimos ipsam beatae perferendis voluptates sapiente officiis voluptatum vitae numquam tempore cupiditate distinctio dolores delectus provident? Quis, ut?
        Quis perferendis consequuntur voluptas aspernatur, debitis iste fugit, omnis sunt minima illo labore aut, quam est? Adipisci placeat repellendus voluptatibus, aperiam neque autem architecto harum dolor! Dolores blanditiis ea a!
        Libero molestiae omnis dolore odit minima hic repellat, reiciendis, ipsa ratione ut fugiat voluptatibus iusto dolor. Distinctio, dolor dolore. Necessitatibus praesentium itaque adipisci id animi explicabo laborum quam ad maxime.`</script>

<style scoped>
* {
    text-align: left;
}
h1{
    font-size: 2.3rem;
}
.container-style{
    width: 100%;
    height: 100%;
    margin:4rem 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between
}
/* styling images */
.imgField{
    width:100%;
    max-width: 800px;
    height:500px;
    margin: 0 auto;
}
.imgField img{
    width: 100%;
    height:100%;
    object-fit: cover;
}
/* styling texts */
.textField{
    width:60%;

    margin: 2rem auto;
}
.description-field{
    margin: 0 auto;
    max-width:1000px;
}
hr{
    width:80%;
    margin: 1rem auto;
}
@media  screen and (max-width: 800px) {
    .textField{
        width:95%;
    }
}
</style>