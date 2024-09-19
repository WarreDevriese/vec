<template>
  <div class="container mx-auto px-4 py-6">
    <div class="mb-4">
      <Link href="/" class="text-blue-500 hover:underline">&larr; Back to Home</Link>
    </div>

    <h1 class="text-3xl font-bold mb-4">{{ track.name }}</h1>
    <p class="text-gray-700 mb-6">{{ track.description }}</p>

    <h2 class="text-2xl font-semibold mb-4">Fields in this Track</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="field in track.fields" :key="field.id" class="bg-white shadow rounded p-4">
        <h3 class="text-xl font-semibold mb-2">{{ field.name }}</h3>
        <p class="text-gray-600">{{ field.description }}</p>
        <Link :href="`/fields/${field.id}`" class="text-blue-500 hover:underline mt-4 block">
          View Courses
        </Link>
      </div>
      <div v-if="track.fields.length === 0" class="col-span-full text-center text-gray-500">
        No fields available in this track.
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
    layout: MainLayout,
  props: {
    track: Object,
  },
  components: {
    Link,
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
