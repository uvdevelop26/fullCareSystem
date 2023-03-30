<template>
  <div class="md:flex-shrink-0 md:w-56 md:h-screen md:block">
    <div class="px-3 py-3 bg-white relative z-200 border-b flex justify-between md:block md:py-6 md:border-none">
      <slot name="header" />
    </div>
    <div class="px-3 md:px-1 md:h-85p">
      <slot />
    </div>
  </div>
</template>

<script setup>

</script>

<style></style>