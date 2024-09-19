<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Edit Course</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="name" class="block text-gray-700">Course Name</label>
        <input
          v-model="form.name"
          type="text"
          id="name"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        />
        <span v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</span>
      </div>

      <div class="mb-4">
        <label for="description" class="block text-gray-700">Description</label>
        <textarea
          v-model="form.description"
          id="description"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          rows="4"
        ></textarea>
        <span v-if="form.errors.description" class="text-red-500 text-sm">{{ form.errors.description }}</span>
      </div>

      <div class="mb-4">
        <label for="field_id" class="block text-gray-700">Field</label>
        <select
          v-model="form.field_id"
          id="field_id"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        >
          <option value="" disabled>Select a Field</option>
          <option v-for="field in fields" :key="field.id" :value="field.id">
            {{ field.name }}
          </option>
        </select>
        <span v-if="form.errors.field_id" class="text-red-500 text-sm">{{ form.errors.field_id }}</span>
      </div>

      <button
        type="submit"
        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
      >
        Update Course
      </button>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    course: Object,
    fields: Array,
  },
  setup(props) {
    const form = useForm({
      name: props.course.name,
      description: props.course.description,
      field_id: props.course.field_id,
    });

    const submit = () => {
      form.put(`/courses/${props.course.id}`);
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
