<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">{{ course.name }}</h1>
    <p>{{ course.description }}</p>
    <h2 class="text-xl font-semibold mt-6 mb-2">Lessons</h2>
    <ul>
      <li v-for="lesson in course.lessons" :key="lesson.id" class="mb-2">
        <Link :href="route('lessons.show', lesson.id)" class="text-blue-500 hover:underline">
          {{ lesson.title }}
        </Link>
      </li>
    </ul>
    <Link :href="route('fields.show', course.field_id)" class="text-gray-500 hover:underline mt-4 inline-block">Back to Field</Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    course: Object,
  },
  components: {
    Link,
  },
};
</script>
