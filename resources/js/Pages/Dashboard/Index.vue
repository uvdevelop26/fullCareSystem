
<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';

export default {

  layout: LayoutApp,

  props: {

    totalResidentes: Number,
    cumpleanioResidentes: Array,
  },

  setup() {

    //PARA MOSTRAR IMAGEN
    const urlbase = (url) => {
      if (url.includes('https')) {
        return url;
      } else {
        return url.replace('public/', 'storage/')
      }
    }

    return { urlbase }
  }

}
</script>
<template>
  <div>
    <!-- HEADER -->
    <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
      <h1 class="uppercase">
        <span class="text-turquesa text-2xl font-semibold">Dashboard</span>
      </h1>
    </div>
    <!-- CONTENIDO -->
    <div>
      <!-- CANTIDAD DE RESIDENTES -->
      <!-- <div class="bg-white p-1 text-center rounded-md shadow-md max-w-xs">
        <div class="border  p-3">
          <div class="font-bold pb-2 text-indigo-400">Total Residentes:</div>
          <span
            class="inline-block font-bold text-indigo-400 bg-indigo-100 px-6 py-1 rounded-xl border border-indigo-400 ">{{
              totalResidentes }}</span>
        </div>
      </div> -->
       <!-- RESIDENTES CUMPLEN AÑOS -->
       <!-- <div>
        <div v-for="cumpleanioResidente in cumpleanioResidentes" :key="cumpleanioResidente.id">
          <div>{{ cumpleanioResidente.persona.nombres }} {{ cumpleanioResidente.persona.nombres }} </div>
        </div>
      </div> -->


    </div>

  </div>
</template>


<style></style>