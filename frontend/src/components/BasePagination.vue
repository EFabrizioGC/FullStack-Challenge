<template>
  <vue-awesome-paginate
    :total-items="totalItems"
    :items-per-page="itemsPerPage"
    :max-pages-shown="5"
    v-model="currentPage"
    :on-click="onClickHandler"
  />
</template>

<script setup lang="ts">
import { ref } from "vue";
import { VueAwesomePaginate } from "vue-awesome-paginate";

const emit = defineEmits<{
  (e: "page-change", page: number): void;
}>();

const onClickHandler = (page: number) => {
  emit("page-change", page);
};

defineProps<{
  currentPage: number;
  itemsPerPage: number;
  totalItems: number;
}>();

const currentPage = ref(1);
</script>

<style>
.pagination-container {
  display: flex;
  column-gap: 10px;
}
.paginate-buttons {
  height: 40px;
  width: 40px;
  border-radius: 20px;
  cursor: pointer;
  background-color: rgb(242, 242, 242);
  border: 1px solid rgb(217, 217, 217);
  color: black;
}
.paginate-buttons:hover {
  background-color: #d8d8d8;
}
.active-page {
  background-color: #1e40af;
  border: 1px solid #1e40af;
  color: white;
}
.active-page:hover {
  background-color: #2988c8;
}
</style>
