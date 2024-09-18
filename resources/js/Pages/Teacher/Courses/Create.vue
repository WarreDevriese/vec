<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Create New Course</h1>
    <form @submit.prevent="submit">
      <div>
        <label for="name">Course Name</label>
        <input v-model="form.name" type="text" id="name" class="border rounded px-2 py-1">
        <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>
      </div>
      <div>
        <label for="field_id">Field</label>
        <select v-model="form.field_id" id="field_id" class="border rounded px-2 py-1">
          <option value="" disabled>Select Field</option>
          <option v-for="field in fields" :key="field.id" :value="field.id">
            {{ field.name }}
          </option>
        </select>
        <div v-if="errors.field_id" class="text-red-500">{{ errors.field_id }}</div>
      </div>
      <div>
        <label for="description">Description</label>
        <textarea v-model="form.description" id="description" class="border rounded px-2 py-1"></textarea>
        <div v-if="errors.description" class="text-red-500">{{ errors.description }}</div>
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Course</button>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  props: {
    fields: Array,
  },
  setup() {
    const form = useForm({
      name: '',
      field_id: '',
      description: '',
    });

    const submit = () => {
      form.post('/courses');
    };

    return { form, submit };
  },
};
</script>
