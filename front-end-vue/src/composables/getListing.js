import { ref } from "vue";

const getListing =  () => {
    
    const listing = ref(null)
    const errors = ref(null)
    

    const loadPost = async (id) => {
        try{
                const res = await fetch('http://api.bookhotel.test/api/listings/'+ id)
                if(!res.ok){
                    throw Error('could not fetch the data for that resource')
                }
                
                listing.value = await res.json()


        } catch(err){
            errors.value = err
        }
    }


    return {listing,errors,loadPost}
}









export default getListing;