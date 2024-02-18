import { ref } from "vue";
import axios from 'axios';
const getListingByUser =  () => {
    
    const listings = ref([])
    const errors = ref(null)
    

    const loadListings = async (id) => {
        try{
            axios.defaults.withCredentials = true
            axios.defaults.withXSRFToken = true

                const res = await axios.get('http://localhost:8000/api/listings/User/'+ id)
                
                if(res.statusText != 'OK'){
                    throw Error('could not fetch the data for that resource')
                }


                const {data} = res
                listings.value = data

        } catch(err){
            errors.value = err
        }
    }


    return {listings,errors,loadListings}
}


export default getListingByUser;