<template>
  <!-- Modal backdrop -->
  <transition
    enter-active-class="transition ease-out duration-200"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition ease-out duration-100"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div
      v-show="modalOpen"
      class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity"
      aria-hidden="true"
    ></div>
  </transition>
  <!-- Modal dialog -->
  <transition
    enter-active-class="transition ease-in-out duration-200"
    enter-from-class="opacity-0 translate-y-4"
    enter-to-class="opacity-100 translate-y-0"
    leave-active-class="transition ease-in-out duration-200"
    leave-from-class="opacity-100 translate-y-0"
    leave-to-class="opacity-0 translate-y-4"
  >
    <div
      v-show="modalOpen"
      class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
    >
      <div
        ref="modalContent"
        class="bg-white dark:bg-slate-800 rounded shadow-lg overflow-auto max-w-lg w-full max-h-full"
      >
        <!-- Modal header -->
        <div class="px-5 py-3 border-slate-200 dark:border-slate-700">
          <div class="flex justify-end items-center">
            <button
              class="text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400"
              @click.stop="$emit('close-modal')"
            >
              <div class="sr-only">Close</div>
              <svg class="w-4 h-4 fill-current">
                <path
                  d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z"
                />
              </svg>
            </button>
          </div>
        </div>
        <slot />
      </div>
    </div>
  </transition>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted, ref } from "vue";

const props = defineProps<{
  modalOpen: Boolean;
}>();

const modalContent = ref();

const emit = defineEmits<{
  (e: "close-modal"): void;
}>();

// close on click outside
const clickHandler = (handler: any) => {
  if (!props.modalOpen || modalContent.value.contains(handler.target)) return;
  emit("close-modal");
};

// close if the esc key is pressed
const keyHandler = (handler: any) => {
  if (!props.modalOpen || handler.keyCode !== 27) return;
  emit("close-modal");
};

onMounted(() => {
  document.addEventListener("click", clickHandler);
  document.addEventListener("keydown", keyHandler);
});

onUnmounted(() => {
  document.removeEventListener("click", clickHandler);
  document.removeEventListener("keydown", keyHandler);
});
</script>

<style scoped></style>
