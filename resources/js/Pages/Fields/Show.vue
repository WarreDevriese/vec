<template>
  <div class="container mx-auto px-4 py-6">
    <div class="mb-4">
      <Link :href="`/tracks/${field.track.id}`" class="text-blue-500 hover:underline">&larr; Back to Track</Link>
    </div>

    <h1 class="text-3xl font-bold mb-4">{{ field.name }}</h1>
    <p class="text-gray-700 mb-6">{{ field.description }}</p>

    <h2 class="text-2xl font-semibold mb-4">Courses in this Field</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="course in field.courses" :key="course.id" class="bg-white shadow rounded p-4">
        <h3 class="text-xl font-semibold mb-2">{{ course.name }}</h3>
        <p class="text-gray-600">{{ course.description }}</p>
        <Link :href="`/courses/${course.id}`" class="text-blue-500 hover:underline mt-4 block">
          View Lessons
        </Link>
      </div>
      <div v-if="field.courses.length === 0" class="col-span-full text-center text-gray-500">
        No courses available in this field.
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
    field: Object,
  },
  components: {
    Link,
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
