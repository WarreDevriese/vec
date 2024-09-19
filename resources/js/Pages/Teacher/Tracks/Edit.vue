<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Edit Track</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label for="name" class="block text-gray-700">Track Name</label>
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

      <button
        type="submit"
        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
      >
        Update Track
      </button>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  props: {
    track: Object,
  },
  setup(props) {
    const form = useForm({
      name: props.track.name,
      description: props.track.description,
    });

    const submit = () => {
      form.put(`/tracks/${props.track.id}`);
    };

    return { form, submit };
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
