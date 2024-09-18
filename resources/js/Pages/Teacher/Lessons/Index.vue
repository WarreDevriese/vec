<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Your Lessons</h1>
    <Link href="/lessons/create" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Create New Lesson</Link>
    <table class="min-w-full bg-white">
      <thead>
        <tr>
          <th class="py-2">Title</th>
          <th class="py-2">Course</th>
          <th class="py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="lesson in lessons" :key="lesson.id">
          <td class="py-2">{{ lesson.title }}</td>
          <td class="py-2">{{ lesson.course.name }}</td>
          <td class="py-2">
            <Link :href="`/lessons/${lesson.id}/edit`" class="text-blue-500">Edit</Link>
            <form :action="`/lessons/${lesson.id}`" method="POST" @submit.prevent="destroy(lesson.id)" style="display:inline;">
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
    lessons: Array,
  },
  components: {
    Link,
  },
  setup() {
    const destroy = (id) => {
      if (confirm('Are you sure you want to delete this lesson?')) {
        useForm().delete(`/lessons/${id}`);
      }
    };
    return { destroy };
  },
};
</script>
