<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Create New Lesson</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="title" class="block text-gray-700">Lesson Title</label>
        <input
          v-model="form.title"
          type="text"
          id="title"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
        <span v-if="form.errors.title" class="text-red-500 text-sm">{{ form.errors.title }}</span>
      </div>

      <div class="mb-4">
        <label for="course_id" class="block text-gray-700">Course</label>
        <select
          v-model="form.course_id"
          id="course_id"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        >
          <option value="" disabled>Select a Course</option>
          <option v-for="course in courses" :key="course.id" :value="course.id">
            {{ course.name }}
          </option>
        </select>
        <span v-if="form.errors.course_id" class="text-red-500 text-sm">{{ form.errors.course_id }}</span>
      </div>

      <div class="mb-4">
        <label for="text_content" class="block text-gray-700">Text Content</label>
        <textarea
          v-model="form.text_content"
          id="text_content"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          rows="6"
        ></textarea>
        <span v-if="form.errors.text_content" class="text-red-500 text-sm">{{ form.errors.text_content }}</span>
      </div>

      <div class="mb-4">
        <label for="video_url" class="block text-gray-700">Video URL</label>
        <input
          v-model="form.video_url"
          type="url"
          id="video_url"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        />
        <span v-if="form.errors.video_url" class="text-red-500 text-sm">{{ form.errors.video_url }}</span>
      </div>

      <button
        type="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
      >
        Create Lesson
      </button>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    courses: Array,
  },
  setup() {
    const form = useForm({
      title: '',
      text_content: '',
      video_url: '',
      course_id: '',
    });

    const submit = () => {
      form.post('/lessons');
    };

    return { form, submit };
  },
  components: {
    Link,
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
