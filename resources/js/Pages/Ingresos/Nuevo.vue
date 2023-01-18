<template>
  <div>

    <Head title="Crear Ingreso" />
    <h1 class="mb-5 text-2xl font-bold text-cyan-900 ">
      Crear Ingreso
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form>
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <select-input v-model="form.tipo" :error="errors.tipo" class="pb-8 pr-6 w-full lg:w-1/2" label="Tipo Ingreso">
            <option :value="null" />
            <option value="Aportes">Aportes Municipales</option>
            <option value="Donaciones">Donaciones Privadas</option>
            <option value="Penciones">Pensiones de Residentes</option>
            <option value="otros">Otros</option>
          </select-input>
          <text-input v-model="form.subtipo" :error="errors.subtipo" class="pb-7 pr-6 w-full lg:w-1/2" label="Subtipo"
            :id="subtipo" />
          <text-input v-model="form.detalle" :error="errors.detalle" class="pb-7 pr-6 w-full lg:w-1/2" label="Detalle"
            :id="detalle" />
          <text-input v-model="form.ingreso_fecha" :error="errors.ingreso_fecha" class="pb-7 pr-6 w-full lg:w-1/2"
            label="Fecha" type="date" :id="ingreso_fecha" />
          <text-input v-model="form.monto" :error="errors.monto" class="pb-7 pr-6 w-full lg:w-1/2" label="Monto"
            type="number" :id="monto" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <Link type="button" :href="route('ingresos.index')" class="btn-cancelar">
          <span class="text-white font-bold">Cancelar</span>
          </Link>
          <button class="btn-indigo mx-1" @click.prevent="guardar()" type="submit">
            Crear Ingreso
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import TextInput from "../../Shared/TextInput.vue"
import SelectInput from '../../Shared/SelectInput.vue'
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

export default {
  components: {
    Head,
    Link,
    TextInput,
    SelectInput
  },

  props: {
    errors: Object
  },

  layout: Layout,

  setup() {

    const tipo = ref("");
    const subtipo = ref("");
    const detalle = ref("");
    const ingreso_fecha = ref("");
    const monto = ref("");




    const form = useForm({
      tipo: "",
      subtipo: "",
      detalle: "",
      ingreso_fecha: "",
      monto: "",
    });

    const guardar = async () => {

      form.post(route('ingresos.store'), form);
    }


    return { form, guardar }
  }
};
</script>

<style>

</style>