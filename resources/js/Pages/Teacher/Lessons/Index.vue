<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Manage Lessons</h1>

    <Link href="/lessons/create" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-4 inline-block">
      Create New Lesson
    </Link>

    <table class="min-w-full bg-white shadow rounded">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">ID</th>
          <th class="py-2 px-4 border-b">Title</th>
          <th class="py-2 px-4 border-b">Course</th>
          <th class="py-2 px-4 border-b">Status</th>
          <th class="py-2 px-4 border-b">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="lesson in lessons" :key="lesson.id" class="hover:bg-gray-100">
          <td class="py-2 px-4 border-b">{{ lesson.id }}</td>
          <td class="py-2 px-4 border-b">{{ lesson.title }}</td>
          <td class="py-2 px-4 border-b">{{ lesson.course.name }}</td>
          <td class="py-2 px-4 border-b capitalize">{{ lesson.status }}</td>
          <td class="py-2 px-4 border-b space-x-2">
            <Link :href="`/lessons/${lesson.id}/edit`" class="text-yellow-500 hover:underline">Edit</Link>
            <form :action="`/lessons/${lesson.id}`" method="POST" @submit.prevent="deleteLesson(lesson.id)">
              <input type="hidden" name="_method" value="DELETE" />
              <input type="hidden" name="_token" :value="csrfToken" />
              <button type="submit" class="text-red-500 hover:underline">Delete</button>
            </form>
          </td>
        </tr>
        <tr v-if="lessons.length === 0">
          <td colspan="5" class="text-center py-4">No lessons available.</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
    lessons: Array,
  },
  setup() {
    const { props } = usePage();
    const csrfToken = props.value.csrf_token;

    const deleteLesson = (id) => {
      if (confirm('Are you sure you want to delete this lesson?')) {
        Inertia.delete(`/lessons/${id}`);
      }
    };

    return { csrfToken, deleteLesson };
  },
  components: {
    Link,
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}

th {
  background-color: #f8f8f8;
  text-align: left;
}

td, th {
  padding: 12px;
}

.hover\:bg-gray-100:hover {
  background-color: #f1f1f1;
}

.capitalize {
  text-transform: capitalize;
}
</style>
