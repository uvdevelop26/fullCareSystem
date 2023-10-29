<template>
  <div class="md:flex-shrink-0 md:w-56 md:h-screen md:block md:shadow-2xl">
    <div class="bg-turquesa shadow-md px-3 py-3 relative z-50 border-b flex justify-between md:block md:py-6 md:border-none">
      <slot name="header" />
    </div> 
    <div class="md:h-85p">
      <!-- este es la barra de navegación en sí-->
      <slot />
    </div>
  </div>
</template>

<script setup>

</script>

<style></style>