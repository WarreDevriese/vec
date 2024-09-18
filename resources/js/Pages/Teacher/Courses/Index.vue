<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Your Courses</h1>
    <Link href="/courses/create" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Create New Course</Link>
    <table class="min-w-full bg-white">
      <thead>
        <tr>
          <th class="py-2">Name</th>
          <th class="py-2">Field</th>
          <th class="py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="course in courses" :key="course.id">
          <td class="py-2">{{ course.name }}</td>
          <td class="py-2">{{ course.field.name }}</td>
          <td class="py-2">
            <Link :href="`/courses/${course.id}/edit`" class="text-blue-500">Edit</Link>
            <form :action="`/courses/${course.id}`" method="POST" @submit.prevent="destroy(course.id)" style="display:inline;">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="text-red-500 ml-2">Delete</button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3';

export default {
  props: {
    courses: Array,
  },
  components: {
    Link,
  },
  setup() {
    const destroy = (id) => {
      if (confirm('Are you sure you want to delete this course?')) {
        useForm().delete(`/courses/${id}`);
      }
    };
    return { destroy };
  },
};
</script>
