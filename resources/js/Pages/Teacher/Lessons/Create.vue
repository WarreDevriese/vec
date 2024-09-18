<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Create New Lesson</h1>
    <form @submit.prevent="submit">
      <div>
        <label for="title">Lesson Title</label>
        <input v-model="form.title" type="text" id="title" class="border rounded px-2 py-1">
        <div v-if="form.errors.title" class="text-red-500">{{ form.errors.title }}</div>
      </div>
      <div>
        <label for="course_id">Course</label>
        <select v-model="form.course_id" id="course_id" class="border rounded px-2 py-1">
          <option value="" disabled>Select Course</option>
          <option v-for="course in courses" :key="course.id" :value="course.id">
            {{ course.name }}
          </option>
        </select>
        <div v-if="form.errors.course_id" class="text-red-500">{{ form.errors.course_id }}</div>
      </div>
      <div>
        <label for="video_url">Video URL</label>
        <input v-model="form.video_url" type="url" id="video_url" class="border rounded px-2 py-1">
        <div v-if="form.errors.video_url" class="text-red-500">{{ form.errors.video_url }}</div>
      </div>
      <div>
        <label for="text_content">Content</label>
        <textarea v-model="form.text_content" id="text_content" class="border rounded px-2 py-1"></textarea>
        <div v-if="form.errors.text_content" class="text-red-500">{{ form.errors.text_content }}</div>
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Lesson</button>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  props: {
    courses: Array,
  },
  setup() {
    const form = useForm({
      title: '',
      course_id: '',
      video_url: '',
      text_content: '',
    });

    const submit = () => {
      form.post('/lessons');
    };

    return { form, submit };
  },
};
</script>
