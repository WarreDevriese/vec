<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Edit Field</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="name" class="block text-gray-700">Field Name</label>
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
        <label for="track_id" class="block text-gray-700">Track</label>
        <select
          v-model="form.track_id"
          id="track_id"
          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
          required
        >
          <option value="" disabled>Select a Track</option>
          <option v-for="track in tracks" :key="track.id" :value="track.id">
            {{ track.name }}
          </option>
        </select>
        <span v-if="form.errors.track_id" class="text-red-500 text-sm">{{ form.errors.track_id }}</span>
      </div>

      <button
        type="submit"
        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
      >
        Update Field
      </button>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import TeacherLayout from '@/Layouts/TeacherLayout.vue';

export default {
    layout: TeacherLayout,
  props: {
    field: Object,
    tracks: Array,
  },
  setup(props) {
    const form = useForm({
      name: props.field.name,
      description: props.field.description,
      track_id: props.field.track_id,
    });

    const submit = () => {
      form.put(`/fields/${props.field.id}`);
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
