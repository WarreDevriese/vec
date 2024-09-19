<template>
  <div class="container mx-auto px-4 py-6">
    <div class="mb-4">
      <Link :href="`/fields/${course.field.id}`" class="text-blue-500 hover:underline">&larr; Back to Field</Link>
    </div>

    <h1 class="text-3xl font-bold mb-4">{{ course.name }}</h1>
    <p class="text-gray-700 mb-6">{{ course.description }}</p>
    <p class="text-gray-600 mb-6">Field: {{ course.field.name }}</p>

    <h2 class="text-2xl font-semibold mb-4">Lessons in this Course</h2>

    <div class="space-y-4">
      <div v-for="lesson in course.lessons" :key="lesson.id" class="bg-white shadow rounded p-4">
        <h3 class="text-xl font-semibold mb-2">{{ lesson.title }}</h3>
        <p class="text-gray-600 mb-2">{{ lesson.text_content }}</p>
        <a
          v-if="lesson.video_url"
          :href="lesson.video_url"
          target="_blank"
          class="text-blue-500 hover:underline"
        >
          Watch Video
        </a>
      </div>
      <div v-if="course.lessons.length === 0" class="text-center text-gray-500">
        No lessons available in this course.
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
    course: Object,
  },
  components: {
    Link,
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
