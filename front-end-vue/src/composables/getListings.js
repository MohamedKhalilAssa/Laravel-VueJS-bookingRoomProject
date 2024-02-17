import { ref } from "vue";

const getListings =  () => {
    
    const listings = ref([])
    const errors = ref(null)
    

    const loadPosts = async () => {
        try{
                const res = await fetch('http://localhost:8000/api/listings')
                if(!res.ok){
                    throw Error('could not fetch the data for that resource')
                }
                
                listings.value = await res.json()


        } catch(err){
            errors.value = err
        }
    }


    return {listings,errors,loadPosts}
}









export default getListings;