<template>
    <div class="cards-container">
        <slot></slot>
    </div>
</template>

<script setup>



</script>

<style scoped>
.cards-container{
    margin-top:2rem;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap:1rem;
}
</style>