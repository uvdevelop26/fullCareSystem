<template>
  <div>
    <Head title="Crear Ingreso" />
    <h1 class="text-cyan-400 font-medium">
        Crear Ingreso
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="submit">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                <select-input v-model="form.tipo_ingreso" class="pb-7 pr-6 w-full lg:w-1/2" label="Tipo Ingreso">
                  <option :value="null" />
                  <option value="Aportes Municipales">Aportes Municipales</option>
                  <option value="Donaciones">Donaciones Privadas</option>
                  <option value="Penciones">Pensiones de Residentes</option>
                  <option value="otros">Otros</option>
                </select-input>
                <text-input v-model="form.detalle" class="pb-7 pr-6 w-full lg:w-1/2" label="Detalle" :id="detalle" />
                <text-input v-model="form.fecha_ingreso" class="pb-7 pr-6 w-full lg:w-1/2" label="Fecha Ingreso" type="date" :id="fecha_ingreso" />
                <text-input v-model="form.monto" class="pb-7 pr-6 w-full lg:w-1/2" label="Monto" type="number" :id="monto" />
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button class="btn-indigo" type="submit">Editar Ingreso</loading-button>
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
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Head,
    Link,
    TextInput,
    LoadingButton,
    SelectInput
  },

  props:['ingreso'],

    data(){
        return {
            form:{
                tipo_ingreso: this.$props.ingreso.fecha_ingreso,
                detalle: this.$props.ingreso.detalle,
                fecha_ingreso: this.$props.ingreso.fecha_ingreso,
                monto: this.$props.ingreso.monto
            }
        }
    },

    methods:{
        submit(){
            this.$inertia.put(
                route('ingresos.update', this.$props.ingreso.id),
                this.form
                );
                
        }
    },

  layout: Layout,
};
</script>

<style>
</style>