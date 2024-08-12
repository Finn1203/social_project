<script setup>
import Header from "@/components/Header.vue";
</script>

<template>
  <div class="bg-gray-200 w-full  flex flex-col">
    <!-- md:w-[50%] -->
    <Header />
    <div class="py-6">
      <router-view />
    </div>
  </div>
</template>
