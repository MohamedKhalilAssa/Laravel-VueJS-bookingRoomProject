import { ref } from "vue";

const getListingByUser =  () => {
    
    const listings = ref([])
    const errors = ref(null)
    

    const loadListings = async (id) => {
        try{
                const res = await fetch('http://localhost:8000/api/listings/User/'+ id)
                if(!res.ok){
                    throw Error('could not fetch the data for that resource')
                }
                
                listings.value = await res.json()


        } catch(err){
            errors.value = err
        }
    }


    return {listings,errors,loadListings}
}


export default getListingByUser;