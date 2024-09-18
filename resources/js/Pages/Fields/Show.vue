<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">{{ field.name }}</h1>
    <p>{{ field.description }}</p>
    <h2 class="text-xl font-semibold mt-6 mb-2">Courses</h2>
    <ul>
      <li v-for="course in field.courses" :key="course.id" class="mb-2">
        <Link :href="route('courses.show', course.id)" class="text-blue-500 hover:underline">
          {{ course.name }}
        </Link>
      </li>
    </ul>
    <Link :href="route('tracks.show', field.track_id)" class="text-gray-500 hover:underline mt-4 inline-block">Back to Track</Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    field: Object,
  },
  components: {
    Link,
  },
};
</script>
