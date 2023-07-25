<script setup lang="ts">
import UserPartial from "@/views/partials/UserPartial.vue";
import HeadingPartial from "@/views/partials/HeadingPartial.vue";
import FooterPartial from "@/views/partials/FooterPartial.vue";
</script>

<template>
  <HeadingPartial />

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
    <UserPartial />
  </main>

  <FooterPartial />
</template>
