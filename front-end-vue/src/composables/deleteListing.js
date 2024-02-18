import axios from 'axios'



const deleteListing = async  (id) => {

    try{
        axios.defaults.withCredentials = true
        axios.defaults.withXSRFToken = true

        await axios.delete('http://localhost:8000/api/listings/'+ id)

        return true
    } catch(error){
        return error
    }
}


export default  deleteListing  