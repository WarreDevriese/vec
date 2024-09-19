<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Create New Track</h1>
    <form @submit.prevent="submit">
      <div>
        <label for="name">Name</label>
        <input v-model="form.name" type="text" id="name" class="border rounded px-2 py-1">
        <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
      </div>
      <div class="mt-4">
        <label for="description">Description</label>
        <textarea v-model="form.description" id="description" class="border rounded px-2 py-1"></textarea>
        <div v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</div>
      </div>
      <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Create Track</button>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
    layout: MainLayout,
  setup() {
    const form = useForm({
      name: '',
      description: '',
    });

    const submit = () => {
      form.post('/tracks');
    };

    return { form, submit };
  },
};
</script>
