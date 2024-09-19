<template>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Manage Fields</h1>

    <Link href="/fields/create" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-4 inline-block">
      Create New Field
    </Link>

    <table class="min-w-full bg-white shadow rounded">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">ID</th>
          <th class="py-2 px-4 border-b">Name</th>
          <th class="py-2 px-4 border-b">Description</th>
          <th class="py-2 px-4 border-b">Track</th>
          <th class="py-2 px-4 border-b">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="field in fields" :key="field.id" class="hover:bg-gray-100">
          <td class="py-2 px-4 border-b">{{ field.id }}</td>
          <td class="py-2 px-4 border-b">{{ field.name }}</td>
          <td class="py-2 px-4 border-b">{{ field.description }}</td>
          <td class="py-2 px-4 border-b">{{ field.track.name }}</td>
          <td class="py-2 px-4 border-b space-x-2">
            <Link :href="`/fields/${field.id}/edit`" class="text-yellow-500 hover:underline">Edit</Link>
            <form :action="`/fields/${field.id}`" method="POST" @submit.prevent="deleteField(field.id)">
              <input type="hidden" name="_method" value="DELETE" />
              <input type="hidden" name="_token" :value="csrfToken" />
              <button type="submit" class="text-red-500 hover:underline">Delete</button>
            </form>
          </td>
        </tr>
        <tr v-if="fields.length === 0">
          <td colspan="5" class="text-center py-4">No fields available.</td>
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
    fields: Array,
  },
  setup() {
    const { props } = usePage();
    const csrfToken = props.value.csrf_token;

    const deleteField = (id) => {
      if (confirm('Are you sure you want to delete this field?')) {
        Inertia.delete(`/fields/${id}`);
      }
    };

    return { csrfToken, deleteField };
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
</style>
