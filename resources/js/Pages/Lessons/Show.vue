<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">{{ lesson.title }}</h1>
    <div v-if="lesson.video_url || lesson.video_path" class="mb-4">
      <video v-if="lesson.video_url" :src="lesson.video_url" controls class="w-full"></video>
      <video v-else :src="`/storage/${lesson.video_path}`" controls class="w-full"></video>
    </div>
    <div v-html="lesson.text_content" class="prose"></div>
    <Link :href="route('courses.show', lesson.course_id)" class="text-gray-500 hover:underline mt-4 inline-block">Back to Course</Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    lesson: Object,
  },
  components: {
    Link,
  },
};
</script>

<style>
/* Optional: Use Tailwind CSS Typography plugin for styling text content */
@import 'https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.4.1/dist/typography.min.css';
</style>
