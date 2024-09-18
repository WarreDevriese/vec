<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Teacher Dashboard</h1>
    <h2 class="text-xl font-semibold mb-2">Your Courses</h2>
    <ul>
      <li v-for="course in courses" :key="course.id">
        {{ course.name }} - {{ course.field.name }}
      </li>
    </ul>
    <Link href="/courses/create" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Create New Course</Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    courses: Array,
  },
  components: {
    Link,
  },
};
</script>
