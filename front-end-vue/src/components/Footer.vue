<template>
     <footer
            class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-black text-white h-12 mt-24 opacity-100 md:justify-center"
        >
            <p class="ml-2">Copyright &copy; {{ new Date().getFullYear() }}, All Rights reserved</p>

            <router-link to="/create" class="absolute top-1/10 right-10 bg-orange-400 text-white py-1 px-3"> Post a Listing </router-link>
        </footer>

</template>

<style scoped>
.router-link-exact-active{
    display: none;
}
</style>