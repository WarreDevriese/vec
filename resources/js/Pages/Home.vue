<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Available Tracks</h1>
    <ul>
      <li v-for="track in tracks" :key="track.id" class="mb-2">
        <Link :href="route('tracks.show', track.id)" class="text-blue-500 hover:underline">
          {{ track.name }}
        </Link>
        <p>{{ track.description }}</p>
      </li>
    </ul>
    <Link href="/tracks/create" class="text-blue-500 hover:underline">Add New Track</Link>
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
