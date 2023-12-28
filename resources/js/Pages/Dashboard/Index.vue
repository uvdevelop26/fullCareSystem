
<script>
import LayoutApp from '../../Layouts/LayoutApp.vue';
import Icon from '../../Shared/Icon.vue';
import { Head } from "@inertiajs/inertia-vue3";

export default {

  layout: LayoutApp,

  components: {
    Icon,
    Head
  },

  props: {
    habitacion1: Array,
    habitacion2: Array,
    habitacion3: Array,
    habitacion4: Array,
    habitacion5: Array
  },

  setup() {




    return {}
  }

}
</script>
<template>
  <div>
    <Head title="dashboard" />
    <!-- HEADER -->
    <div class="py-3 mb-3 max-w-7xl border-b border-turquesa flex justify-between">
      <h1 class="uppercase">
        <span class="text-turquesa text-2xl font-semibold">Dashboard</span>
      </h1>
    </div>
    <!-- CONTENIDO -->
    <div class="flex flex-col gap-4 lg:flex-row lg:flex-wrap lg:items-start">
      <!--========== componente habitación 1 ===========-->
      <div class="shadow-md rounded-md overflow-hidden w-full max-w-sm" v-for="habitac1 in habitacion1" :key="habitac1.id">
        <!-- header -->
        <div class="py-2 bg-indigo-400 text-white font-semibold text-center">
          Habitación N° {{ habitac1.numero }}
        </div>
        <!-- cuerpo -->
        <div class="p-2 bg-white">
          <div class="flex gap-1">
            <div class="w-2/6">
              <div v-for="residentes in habitac1.residentes" class="text-center border-r-2 mb-1">
                <Icon name="residentes" class="w-7 h-7 mx-auto fill-indigo-400" />
                <span class="block py-1 text-sm font-semibold">{{ residentes.persona.nombres }}</span>
                <span class="block py-1 text-xs font-semibold">{{ residentes.fecha_ingreso}}</span>
              </div>
            </div>
            <div class="w-full flex flex-col">
              <div v-for="estados in habitac1.residentes" class="h-full flex items-center border-b">
                <span v-if="estados.estados.length == 0">vacio</span>
                <ul v-else class="w-full">
                  <li v-for="nombres in estados.estados.slice().reverse()" class="text-center mb-1 mx-auto">
                    <span v-if="nombres.nombre == 1" class="text-sm font-semibold">Activo</span>
                    <span v-else class="text-sm font-semibold">Inactivo desde {{ nombres.fecha_salida }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ==============componente habitación 2 ==============-->
      <div class="shadow-md rounded-md overflow-hidden w-full max-w-sm" v-for="habitac2 in habitacion2" :key="habitac2.id">
        <!-- header -->
        <div class="py-2 bg-red-400 text-white font-semibold text-center">
          Habitación N° {{ habitac2.numero }}
        </div>
        <!-- cuerpo -->
        <div class="p-2 bg-white">
          <div class="flex gap-1">
            <div class="w-2/6">
              <div v-for="residentes in habitac2.residentes" class="text-center border-r-2 mb-1">
                <Icon name="residentes" class="w-7 h-7 mx-auto fill-red-400" />
                <span class="block py-1 text-sm font-semibold">{{ residentes.persona.nombres }}</span>
                <span class="block py-1 text-xs font-semibold">{{ residentes.fecha_ingreso}}</span>
              </div>
            </div>
            <div class="w-full flex flex-col">
              <div v-for="estados in habitac2.residentes" class="h-full flex items-center border-b">
                <span v-if="estados.estados.length == 0">vacio</span>
                <ul v-else class="w-full">
                  <li v-for="nombres in estados.estados.slice().reverse()" class="text-center mb-1 mx-auto">
                    <span v-if="nombres.nombre == 1" class="text-sm font-semibold">Activo</span>
                    <span v-else class="text-sm font-semibold">Inactivo desde {{ nombres.fecha_salida }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ==================== componente habitación 3 ================== -->
      <div class="shadow-md rounded-md overflow-hidden w-full max-w-sm" v-for="habitac3 in habitacion3" :key="habitac3.id">
        <!-- header -->
        <div class="py-2 bg-emerald-400 text-white font-semibold text-center">
          Habitación N° {{ habitac3.numero }}
        </div>
        <!-- cuerpo -->
        <div class="p-2 bg-white">
          <div class="flex gap-1">
            <div class="w-2/6">
              <div v-for="residentes in habitac3.residentes" class="text-center border-r-2 mb-1">
                <Icon name="residentes" class="w-7 h-7 mx-auto fill-emerald-400" />
                <span class="block py-1 text-sm font-semibold">{{ residentes.persona.nombres }}</span>
                <span class="block py-1 text-xs font-semibold">{{ residentes.fecha_ingreso}}</span>
              </div>
            </div>
            <div class="w-full flex flex-col">
              <div v-for="estados in habitac3.residentes" class="h-full flex items-center border-b">
                <span v-if="estados.estados.length == 0">vacio</span>
                <ul v-else class="w-full">
                  <li v-for="nombres in estados.estados.slice().reverse()" class="text-center mb-1 mx-auto">
                    <span v-if="nombres.nombre == 1" class="text-sm font-semibold">Activo</span>
                    <span v-else class="text-sm font-semibold">Inactivo desde {{ nombres.fecha_salida }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ============== componente habitación 4 ==================== -->
      <div class="shadow-md rounded-md overflow-hidden w-full max-w-sm" v-for="habitac4 in habitacion4" :key="habitac4.id">
        <!-- header -->
        <div class="py-2 bg-orange-400 text-white font-semibold text-center">
          Habitación N° {{ habitac4.numero }}
        </div>
        <!-- cuerpo -->
        <div class="p-2 bg-white">
          <div class="flex gap-1">
            <div class="w-2/6">
              <div v-for="residentes in habitac4.residentes" class="text-center border-r-2 mb-1">
                <Icon name="residentes" class="w-7 h-7 mx-auto fill-orange-400" />
                <span class="block py-1 text-sm font-semibold">{{ residentes.persona.nombres }}</span>
                <span class="block py-1 text-xs font-semibold">{{ residentes.fecha_ingreso}}</span>
              </div>
            </div>
            <div class="w-full flex flex-col">
              <div v-for="estados in habitac4.residentes" class="h-full flex items-center border-b">
                <span v-if="estados.estados.length == 0">vacio</span>
                <ul v-else class="w-full">
                  <li v-for="nombres in estados.estados.slice().reverse()" class="text-center mb-1 mx-auto">
                    <span v-if="nombres.nombre == 1" class="text-sm font-semibold">Activo</span>
                    <span v-else class="text-sm font-semibold">Inactivo desde {{ nombres.fecha_salida }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ======================= componente habitación 5 ============================ -->
      <div class="shadow-md rounded-md overflow-hidden w-full max-w-sm" v-for="habitac5 in habitacion5" :key="habitac5.id">
        <!-- header -->
        <div class="py-2 bg-amber-400 text-white font-semibold text-center">
          Habitación N° {{ habitac5.numero }}
        </div>
        <!-- cuerpo -->
        <div class="p-2 bg-white">
          <div class="flex gap-1">
            <div class="w-2/6">
              <div v-for="residentes in habitac5.residentes" class="text-center border-r-2 mb-1">
                <Icon name="residentes" class="w-7 h-7 mx-auto fill-amber-400" />
                <span class="block py-1 text-sm font-semibold">{{ residentes.persona.nombres }}</span>
                <span class="block py-1 text-xs font-semibold">{{ residentes.fecha_ingreso}}</span>
              </div>
            </div>
            <div class="w-full flex flex-col">
              <div v-for="estados in habitac5.residentes" class="h-full flex items-center border-b">
                <span v-if="estados.estados.length == 0">vacio</span>
                <ul v-else class="w-full">
                  <li v-for="nombres in estados.estados.slice().reverse()" class="text-center mb-1 mx-auto">
                    <span v-if="nombres.nombre == 1" class="text-sm font-semibold">Activo</span>
                    <span v-else class="text-sm font-semibold">Inactivo desde {{ nombres.fecha_salida }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>


<style></style>