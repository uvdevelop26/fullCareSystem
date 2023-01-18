<template>
  <div>

    <Head title="Editar Ingreso" />
    <h1 class="text-cyan-400 font-medium">
      Editar Ingreso
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form>
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <select-input  v-model="form.tipo" :error="errors.tipo" class="pb-8 pr-6 w-full lg:w-1/2" label="Tipo Ingreso">
            <option :value="null" />
            <option value="Aportes">Aportes Municipales</option>
            <option value="Donaciones">Donaciones Privadas</option>
            <option value="Penciones">Pensiones de Residentes</option>
            <option value="otros">Otros</option>
          </select-input>
          <text-input  v-model="form.subtipo" :error="errors.subtipo" class="pb-7 pr-6 w-full lg:w-1/2" label="Subtipo"
            :id="subtipo" />
          <text-input  v-model="form.detalle" :error="errors.detalle" class="pb-7 pr-6 w-full lg:w-1/2" label="Detalle"
            :id="detalle" />
          <text-input  v-model="form.ingreso_fecha" :error="errors.ingreso_fecha" class="pb-7 pr-6 w-full lg:w-1/2"
            label="Fecha" type="date" :id="ingreso_fecha" />
          <text-input v-model="form.monto" :error="errors.monto" class="pb-7 pr-6 w-full lg:w-1/2" label="Monto"
            type="number" :id="monto" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <Link type="button" :href="route('ingresos.index')" class="btn-cancelar">
          <span class="text-white font-bold">Cancelar</span>
          </Link>
          <button class="btn-indigo mx-1" @click.prevent="actualizarIngreso()" type="submit">
            Actualizar Ingreso
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
import LoadingButton from "../../Shared/LoadingButton.vue"
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Head,
    Link,
    TextInput,
    LoadingButton,
    SelectInput
  },

  layout: Layout,

  props:{
    ingreso: Object,
    errors: Object,
  },

  setup(props){

    const form = useForm({
      _method: "PUT",
      id: props.ingreso.id,
      tipo: props.ingreso.tipo,
      subtipo: props.ingreso.subtipo,
      detalle: props.ingreso.detalle,
      ingreso_fecha: props.ingreso.ingreso_fecha,
      monto: props.ingreso.monto

    });

    const actualizarIngreso = () =>{
      form.post(route('ingresos.update', form), {
        preserveScroll: true
      });
    };

    return { form, actualizarIngreso}
  }

  

  
};
</script>

<style>

</style>