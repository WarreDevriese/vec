<template>
  <div class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-indigo-600 text-white">
      <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div>
          <Link href="/dashboard" class="text-2xl font-bold">Teacher Dashboard</Link>
        </div>
        <div class="space-x-4">
          <Link href="/tracks" class="hover:underline">Manage Tracks</Link>
          <Link href="/fields" class="hover:underline">Manage Fields</Link>
          <Link href="/courses" class="hover:underline">Manage Courses</Link>
          <Link href="/lessons" class="hover:underline">Manage Lessons</Link>
          <Link href="/profile" class="hover:underline">Profile</Link>
          <form method="POST" action="/logout" @submit.prevent="logout">
            <button type="submit" class="hover:underline">Logout</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-6">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-4">
      <div class="container mx-auto px-4 text-center">
        &copy; {{ currentYear }} Educational Platform. All rights reserved.
      </div>
    </footer>
  </div>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

export default {
  components: {
    Link,
  },
  setup() {
    const form = useForm();

    const logout = () => {
      form.post('/logout');
    };

    const currentYear = ref(new Date().getFullYear());

    return { logout, currentYear };
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
