<template>
  <div>
    <Head title="Crear Ingreso" />
    <h1 class="mb-5 text-2xl font-bold text-cyan-900 ">
        Registrar Egreso
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
        <form @submit.prevent="submit">
            <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                <select-input v-model="form.tipo_egreso" class="pb-8 pr-6 w-full lg:w-1/2" label="Tipo Egreso">
                  <option :value="null" />
                  <option value="Comida">Comida</option>
                  <option value="Medicamentos">Medicamentos</option>
                  <option value="Reparaciones">Reparaciones</option>
                  <option value="Impuestos">Impuestos</option>
                  <option value="otros">Otros</option>
                </select-input>
                <text-input v-model="form.subtipo" class="pb-7 pr-6 w-full lg:w-1/2" label="Subtipo" :id="subtipo" />
                <text-input v-model="form.detalle" class="pb-7 pr-6 w-full lg:w-1/2" label="Detalle"  :id="detalle" />
                <text-input v-model="form.fecha_egreso" class="pb-7 pr-6 w-full lg:w-1/2" label="Fecha Egreso" type="date" :id="fecha_egreso" />
                <text-input v-model="form.monto" class="pb-7 pr-6 w-full lg:w-1/2" label="Monto" type="number" :id="monto" />
            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <Link type="button" 
              :href="route('egresos.index')"
              class="btn-cancelar">
                <span class="text-white font-bold">Cancelar</span>
              </Link>
              <loading-button class="btn-indigo mx-1" type="submit">Editar Egreso</loading-button>
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

  props: ['egreso'],

    data(){
        return {
            form:{
                tipo_egreso: this.$props.egreso.tipo_egreso,
                subtipo:this.$props.egreso.subtipo,
                detalle: this.$props.egreso.detalle,
                fecha_egreso: this.$props.egreso.fecha_egreso,
                monto: this.$props.egreso.monto
            }
        }
    },

    methods:{
        submit(){
            this.$inertia.put(
                route('egresos.update', this.$props.egreso.id),
                this.form
            );
        }
    },

  layout: Layout,
};
</script>

<style>
</style>