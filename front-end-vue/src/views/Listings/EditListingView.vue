<template>
    <div class="container-create bg-gray-50 border border-gray-200 p-10 max-w-lg mx-auto mt-24 mb-10">

        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Updata a Listing
            </h2>
            <p class="mb-4">
                Update a Hotel for people to book
            </p>
        </header>

        <form method="POST" @submit.prevent="uploadFiles" action="http://localhost:8000/create"
            enctype="multipart/form-data">
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Title</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" id="title"
                    v-model="form.title" placeholder="Example: My Awesome Hotel" />

            </div>

            <div class="mb-6">
                <label for="address" class="inline-block text-lg mb-2">Address</label>
                <input id="address" v-model="form.address" type="text" class="border border-gray-200 rounded p-2 w-full"
                    name="address" placeholder="Example: New York, NY" />

            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">Description</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="description" id="description"
                    placeholder="Write Description: details on location , rooms..." v-model="form.description" />

            </div>

            <div class="mb-6">
                <label for="price" class="inline-block text-lg mb-2">Price per night</label>
                <input type="number" id="price" class="border border-gray-200 rounded p-2 w-full" name="price_per_night"
                    v-model="form.price_per_night" placeholder="Example: 100$" />

            </div>

            <div class="mb-6">
                <label for="Amenities" class="inline-block text-lg mb-2">
                    Amenities
                </label>
                <div class="amnetie-container">
                    <label class="flex"><input type="checkbox" class="border border-gray-200 rounded p-2 w-4 mr-3"
                            value="amenity_wifi" v-model="form.amenities" />Wifi</label>
                    <label class="flex"><input type="checkbox" class="border border-gray-200 rounded p-2 w-4 mr-3"
                            value="amenity_tv" v-model="form.amenities" />TV</label>
                    <label class="flex"><input type="checkbox" class="border border-gray-200 rounded p-2 w-4 mr-3"
                            value="amenity_pets" v-model="form.amenities" />Pets</label>
                    <label class="flex"><input type="checkbox" class="border border-gray-200 rounded p-2 w-4 mr-3"
                            value="amenity_air_conditioning" v-model="form.amenities" />Air
                        conditioning</label>
                </div>

            </div>
            <div class="mb-6 flex justify-between items-center">

                <button class="bg-dark text-white rounded py-2 px-4 hover:scale-105 duration-300">
                    Create Listing
                </button>

                <a href="/" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </div>
</template>

<script setup>
import { onMounted, ref, watch, watchEffect } from 'vue'
import axios from 'axios'
import { useRoute, useRouter } from 'vue-router';
import getListing from '@/composables/getListing';

let formData = new FormData()
const router = useRouter()
const route = useRoute()

const form = ref({
    title: null,
    address: null,
    description: null,
    price_per_night: null,
    amenities: ref([]),
})

const { listing, errors, loadPost } = getListing();

loadPost(route.params.id).then(() => {
    form.value = {
        title: listing.value.title,
        address: listing.value.address,
        description: listing.value.description,
        price_per_night: listing.value.price_per_night,
        amenities: []
    }

    listing.value.amenity_wifi ? form.value.amenities.push('amenity_wifi') : null;
    listing.value.amenity_tv ? form.value.amenities.push('amenity_tv') : null;
    listing.value.amenity_pets ? form.value.amenities.push('amenity_pets') : null;
    listing.value.amenity_air_conditioning ? form.value.amenities.push('amenity_air_conditioning') : null;
})

watchEffect(() => {
    // console.log(form.value.amenities)
})



// Reference to the file input element
const files = ref(null)
// Method to upload files to the server{
const handleFileChange = (e) => {
    formData.append('image[]', e.target.files[0]);
}

// uploading files
const uploadFiles = async () => {

    formData.append('image', files.value)
    formData.append('title', form.value.title)
    formData.append('description', form.value.description)
    formData.append('address', form.value.address)
    formData.append('price_per_night', form.value.price_per_night)


    // sending amenities to the server as an array
    form.value.amenities.forEach((value, index) => {
        formData.append('amenities[]', value);
    });

    try {
        // Send the FormData object to the server using axios
        await axios.post('http://localhost:8000/update/' + route.params.id, formData).then(response => {
            router.push({ name: 'Listings' })
        })

    } catch (error) {
        console.error(error)
    }
}


</script>

<style></style>