<script lang="ts" setup>
withDefaults(
  defineProps<{
    as?: "a" | "button";
  }>(),
  {
    as: "button",
  }
);
</script>

<template>
  <Component
    :is="as"
    class="inline-flex items-center justify-center px-4 py-2 sm:px-8 sm:py-3 text-sm font-medium text-white"
  >
    <slot />
  </Component>
</template>
