<script setup lang="ts">
import BaseCard from "@/components/BaseCard.vue";
import BaseModal from "@/components/BaseModal.vue";
import { onMounted, ref } from "vue";
import userApi from "@/lib/user-api";
import BasePagination from "@/components/BasePagination.vue";
import ButtonPrimary from "@/components/ButtonPrimary.vue";

const isWeatherModalOpen = ref(false);
const users = ref();
const weatherData = ref();
const API_URL = ref(import.meta.env.VITE_API_URL);

onMounted(() => {
  userApi.all().then((response) => {
    users.value = response.data;
  });
});

function open(userId: number) {
  isWeatherModalOpen.value = true;
  userApi.show(userId).then((response) => {
    weatherData.value = response.data;
  });
}

function closeModal() {
  isWeatherModalOpen.value = false;
}

function pageChange(currentPage: number) {
  userApi.all(currentPage).then((response) => {
    users.value = response.data;
  });
}
</script>

<template>
  <div v-if="users">
    <div class="flex flex-wrap justify-center">
      <BaseCard
        v-for="(user, index) in users.data"
        v-bind:key="index"
        class="m-4"
      >
        <div class="flex flex-col items-center p-4">
          <img
            class="w-24 h-24 mb-3 rounded-full shadow-lg"
            :src="API_URL + '/' + user.profile_path"
            alt="User Image"
          />
          <h5 class="mb-1 text-xl font-medium text-gray-900">
            {{ user.name }}
          </h5>
          <div class="flex mt-4 space-x-3 md:mt-4">
            <ButtonPrimary @click.stop="open(user.id)">
              Check Weather
            </ButtonPrimary>
          </div>
        </div>
      </BaseCard>
    </div>

    <div class="flex justify-center">
      <BasePagination
        class="py-4 overflow-x-auto"
        :total-items="users.total"
        :items-per-page="users.per_page"
        :current-page="users.current_page"
        @page-change="pageChange"
      ></BasePagination>
    </div>
  </div>

  <BaseModal
    v-if="weatherData"
    :modal-open="isWeatherModalOpen"
    @close-modal="closeModal"
  >
    <div class="flex flex-col items-center p-4">
      <h1 class="font-bold text-2xl">
        {{ weatherData.name ? weatherData.name : "Unknown Town" }}
      </h1>
      <img
        :src="
          'https://openweathermap.org/img/wn/' +
          weatherData.weather[0].icon +
          '@2x.png'
        "
        :alt="weatherData.weather[0].main"
      />

      <h1 class="text-lg font-semibold">{{ weatherData.weather[0].main }}</h1>
      <p class="capitalize text-sm">{{ weatherData.weather[0].description }}</p>

      <div>{{ weatherData.main.temp }} °F</div>
      <div>
        {{ weatherData.main.temp_max }} °F / {{ weatherData.main.temp_min }} °F
      </div>
    </div>
  </BaseModal>
</template>

<style scoped></style>
