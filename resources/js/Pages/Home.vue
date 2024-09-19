<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Available Tracks</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="track in tracks" :key="track.id" class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-2">{{ track.name }}</h2>
        <p class="text-gray-600">{{ track.description }}</p>
        <Link :href="`/tracks/${track.id}`" class="text-blue-500 hover:underline mt-4 block">
          View Fields
        </Link>
      </div>
      <div v-if="tracks.length === 0" class="col-span-full text-center text-gray-500">
        No tracks available at the moment.
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    tracks: Array,
  },
  components: {
    Link,
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
