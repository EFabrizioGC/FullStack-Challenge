<script setup lang="ts">
import BaseButton from "@/components/BaseButton.vue";
</script>

<template>
  <BaseButton
    class="bg-blue-800 text-white hover:bg-blue-700 disabled:bg-blue-500"
  >
    <slot />
  </BaseButton>
</template>
