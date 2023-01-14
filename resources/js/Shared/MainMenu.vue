<template>
  <div>
    <!-- Dashboard -->
    <div class="mb-3">
      <Link class="group flex items-center py-3" href="/dashboard">
      <!-- Este ícono tiene varios svg -->
      <icon name="dashboard" class="mr-2 w-4 h-4"
        :class="isUrl('dashboard') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
      <div :class="isUrl('dashboard') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Dashboard</div>
      </Link>
    </div>
    <!-- Residentes -->
    <div class="mb-3">
      <div class="group flex items-center">
        <icon name="residentes" class="mr-1 w-4 h-4"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
        <button @click.stop="isOpen = !isOpen"
          :class="isUrl('') ? 'text-white' : 'text-cyan-300  w-full text-start group-hover:text-white'">Residentes</button>
        <icon name="plus" class="ml-auto w-2 h-2"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
      </div>
      <div v-show="isOpen">
        <Link class="block pt-2 pl-2" href="/residentes">
        <div :class="isUrl('residentes') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Admin. Residentes
        </div>
        </Link>
        <Link class="block pt-2 pl-2" href="/familiares">
        <div :class="isUrl('familiares') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Admin. Familiares
        </div>
        </Link>
      </div>
    </div>
    <!-- Empleados -->
    <div class="mb-3">
      <div class="group flex items-center">
        <icon name="empleados" class="mr-1 w-4 h-4"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
        <button @click.stop="isOpen2 = !isOpen2"
          :class="isUrl('') ? 'text-white' : 'text-cyan-300  w-full text-start group-hover:text-white'">Empleados</button>
        <icon name="plus" class="ml-auto w-2 h-2"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
      </div>
      <div v-if="isOpen2">
        <Link class="block pt-2 pl-2" href="/empleados">
        <div :class="isUrl('empleados') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Admin. Empleados
        </div>
        </Link>
        <Link class="block pt-2 pl-2" href="/sueldos">
        <div :class="isUrl('sueldos') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Planilla de Sueldos
        </div>
        </Link>
        <Link class="block pt-2 pl-2">Jornadas de Trabajo</Link>
        <Link class="block pt-2 pl-2" href="/permisos">
        <div :class="isUrl('permisos') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Permisos
        </div>
        </Link>
        <Link class="block pt-2 pl-2">Gráfico de Turnos</Link>
      </div>
    </div>
    <!-- Usuarios -->
    <div class="mb-3">
      <div class="group flex items-center">
        <icon name="usuarios" class="mr-1 w-4 h-4"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
        <button @click.stop="isOpen3 = !isOpen3"
          :class="isUrl('') ? 'text-white' : 'text-cyan-300  w-full text-start group-hover:text-white'">Usuarios</button>
        <icon name="plus" class="ml-auto w-2 h-2"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
      </div>
      <div v-if="isOpen3">
        <Link class="block pt-2 pl-2" href="/usuarios">
        <div :class="isUrl('usuarios') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Usuarios
        </div>
        </Link>
        <Link class="block pt-2 pl-2" href="/roles">
        <div :class="isUrl('roles') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Roles
        </div>
        </Link>
        <Link class="block pt-2 pl-2" href="/permissions">
        <div :class="isUrl('permissions') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Permissions
        </div>
        </Link>
      </div>
    </div>
    <!-- Finanzas -->
    <div class="mb-3">
      <div class="group flex items-center">
        <icon name="finanzas" class="mr-1 w-4 h-4"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
        <button @click.stop="isOpen4 = !isOpen4"
          :class="isUrl('') ? 'text-white' : 'text-cyan-300  w-full text-start group-hover:text-white'">Finanzas</button>
        <icon name="plus" class="ml-auto w-2 h-2"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
      </div>
      <div v-if="isOpen4">
        <Link class="block pt-2 pl-2" href="/ingresos">
        <div :class="isUrl('ingresos') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Ingresos</div>
        </Link>
        <Link class="block pt-2 pl-2" href="/egresos">
        <div :class="isUrl('egresos') ? 'text-white' : 'text-cyan-300 group-hover:text-white'">Egresos</div>
        </Link>
        <Link class="block pt-2 pl-2">Movimientos Diarios</Link>
        <Link class="block pt-2 pl-2">Gráfico de Finanzas</Link>
      </div>
    </div>
    <!-- Salud -->
    <div class="mb-3">
      <div class="group flex items-center">
        <icon name="salud" class="mr-1 w-4 h-4"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
        <button @click.stop="isOpen5 = !isOpen5"
          :class="isUrl('') ? 'text-white' : 'text-cyan-300  w-full text-start group-hover:text-white'">Salud</button>
        <icon name="plus" class="ml-auto w-2 h-2"
          :class="isUrl('') ? 'fill-white' : 'fill-cyan-400 group-hover:fill-white'" />
      </div>
      <div v-if="isOpen5" class="transition-all duration-100">
        <Link class="block pt-2 pl-2">Historial Clínico</Link>
        <Link class="block pt-2 pl-2">Medicamentos</Link>
        <Link class="block pt-2 pl-2">Suministros y Control</Link>
      </div>
    </div>
    <!-- Reportes -->
    <div class="mb-3">
      <Link>Consultas y Reportes</Link>
    </div>

  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "../Shared/Icon.vue";

export default {
  components: {
    Icon,
    Link,
  },

  data() {
    return {
      isOpen: false,
      isOpen2: false,
      isOpen3: false,
      isOpen4: false,
      isOpen5: false
    }

  },

  //método define cuando un link está activo o no y le asigna clases para diferenciar
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1);
      if (urls[0] === "") {
        return currentUrl === "";
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length;
    },

  },
};
</script>

<style>

</style>