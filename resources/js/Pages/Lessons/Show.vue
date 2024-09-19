<template>
  <div class="container mx-auto px-4 py-6">
    <div class="mb-4">
      <Link :href="`/courses/${lesson.course.id}`" class="text-blue-500 hover:underline">&larr; Back to Course</Link>
    </div>

    <h1 class="text-3xl font-bold mb-4">{{ lesson.title }}</h1>
    <p class="text-gray-700 mb-6">{{ lesson.text_content }}</p>
    <p class="text-gray-600 mb-6">Course: {{ lesson.course.name }}</p>

    <div v-if="lesson.video_url" class="mb-6">
      <h2 class="text-2xl font-semibold mb-2">Video Content</h2>
      <iframe
        :src="embedUrl"
        class="w-full h-64"
        frameborder="0"
        allowfullscreen
      ></iframe>
    </div>

    <div v-else class="text-gray-500">
      No video content available for this lesson.
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    lesson: Object,
  },
  computed: {
    embedUrl() {
      // Convert YouTube URL to embed URL if applicable
      const url = new URL(this.lesson.video_url);
      if (url.hostname.includes('youtube.com') || url.hostname.includes('youtu.be')) {
        let videoId = '';
        if (url.hostname.includes('youtube.com')) {
          videoId = url.searchParams.get('v');
        } else if (url.hostname.includes('youtu.be')) {
          videoId = url.pathname.slice(1);
        }
        return `https://www.youtube.com/embed/${videoId}`;
      }
      // Return original URL if not a YouTube link
      return this.lesson.video_url;
    },
  },
  components: {
    Link,
  },
};
</script>

<style scoped>
iframe {
  border: none;
}
</style>
