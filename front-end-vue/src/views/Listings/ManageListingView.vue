<template>
    <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-xxl mx-auto mt-24">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Gigs</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody v-if="listings.length">
                <tr v-for="Listing in listings" :key="Listing.id" class="border-gray-300">
                    <td class="text-left px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <router-link :to="'/listings/' + Listing.id">
                            {{ Listing.title }}
                        </router-link>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <router-link :to="'/edit/' + Listing.id" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                class="fa-solid fa-pen-to-square"></i> Edit</router-link>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <button @click="deleteHandling" :data-id="Listing.id" class="text-red-600">
                            <i class="fa-solid fa-trash-can"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
            <div v-else>
                <h1 class="text-3xl font-bold">No Listings</h1>
            </div>
        </table>
    </div>
</template>

<script setup>
import getListingsByUser from "@/composables/getListingsByUser";
import deleteListing from "@/composables/deleteListing";
import { useStore } from "vuex";

// to access the current user
const store = useStore();
const User = store.getters.getUser;

const { listings, errors, loadListings } = getListingsByUser();
// loading listings
loadListings(User.id);
// deleting a listing

const deleteHandling = (e) => {
    if (confirm("Are you sure you want to delete this listing?")) {
        if (deleteListing(e.target.dataset.id)) {
            e.target.parentNode.parentNode.parentNode.removeChild(
                e.target.parentNode.parentNode
            )
        }
    }
}
</script>

<style></style>
