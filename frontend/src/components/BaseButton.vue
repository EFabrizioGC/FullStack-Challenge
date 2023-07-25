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
    class="inline-flex items-center justify-center px-8 py-3 text-sm font-medium text-white transition"
  >
    <slot />
  </Component>
</template>
