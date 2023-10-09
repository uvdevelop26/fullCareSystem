<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import TextInput from "../../Shared/TextInput.vue"
import SelectInput from '../../Shared/SelectInput.vue'
import Icon from "../../Shared/Icon.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";


export default {

  layout: LayoutApp,

  components: {
    Head,
    Link,
    TextInput,
    SelectInput,
    Icon
  },

  props: {
    categorias: Array,
    errors: Object
  },


  setup() {

    const form = useForm({
      fecha: "",
      concepto: "",
      detalle: "",
      monto: "",
      nro_comprobante: "",
      user_id: "",
      categoria_id: ""
    });

    const guardar = async () => {

      form.post(route('egresos.store'), form);
    }


    return { form, guardar }
  }
};
</script>
<template>
  <div>

    <Head title="Crear Egresos" />
    <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
      <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
        <Icon name="egresos" class="w-7 h-7 fill-turquesa" />
      </div>
      <span class="text-turquesa drop-shadow-md">Crear Egreso</span>
    </h1>
    <div class="max-w-4xl overflow-hidden pt-2">
      <form @submit.prevent="guardar">
        <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
          <text-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Fecha" type="date" v-model="form.fecha"
            :error="errors.fecha" :id="fecha" />
          <text-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Concepto" :id="concepto" v-model="form.concepto"
            :error="errors.concepto" />
          <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
            <label for="detalle" class="form-label">Detalle:</label>
            <textarea name="detalle" id="detalle" cols="20" rows="3" class="form-textarea "
              v-model="form.detalle"></textarea>
            <span v-if="errors.detalle" class="text-red-500">Este campo es requerido</span>
          </div>
          <text-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Monto" type="number" :id="monto" v-model="form.monto"
            :error="errors.monto" />
          <text-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Comprobante Nro." type="number" :id="nro_comprobante"
            v-model="form.nro_comprobante" :error="errors.nro_comprobante" />
          <select-input v-model="form.categoria_id" :error="errors.categoria_id" class="pb-5 lg:pr-3 w-full lg:w-1/2"
            label="Categoria">
            <option :value="null" />
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id" class="capitalize">
              {{ categoria.nombre }}</option>
          </select-input>
          <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
            <Link type="button" :href="route('egresos.index')" class="btn-cancelar">
            <span class="text-white font-bold">Cancelar</span>
            </Link>
            <button class="btn-indigo mx-1" type="submit">
              Crear Egreso
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>



<style></style>