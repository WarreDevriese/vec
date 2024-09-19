<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Teacher Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-2">Manage Tracks</h2>
        <Link href="/tracks" class="text-blue-500 hover:underline">View Tracks</Link>
      </div>

      <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-2">Manage Fields</h2>
        <Link href="/fields" class="text-blue-500 hover:underline">View Fields</Link>
      </div>

      <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-2">Manage Courses</h2>
        <Link href="/courses" class="text-blue-500 hover:underline">View Courses</Link>
        <br />
        <Link href="/courses/create" class="text-blue-500 hover:underline">Create New Course</Link>
      </div>

      <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-2">Manage Lessons</h2>
        <Link href="/lessons" class="text-blue-500 hover:underline">View Lessons</Link>
        <br />
        <Link href="/lessons/create" class="text-blue-500 hover:underline">Create New Lesson</Link>
      </div>
    </div>

    <div class="mt-8">
      <h2 class="text-2xl font-semibold mb-4">Your Courses</h2>
      <ul class="space-y-2">
        <li v-for="course in courses" :key="course.id" class="bg-white shadow rounded p-4">
          <h3 class="text-xl font-bold">{{ course.name }}</h3>
          <p class="text-gray-600">{{ course.description }}</p>
          <p class="text-sm text-gray-500">Field: {{ course.field.name }}</p>
          <Link :href="`/courses/${course.id}/edit`" class="text-blue-500 hover:underline">Edit Course</Link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';

export default {
    layout: TeacherLayout,
  props: {
    courses: Array,
  },
  components: {
    Link,
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
