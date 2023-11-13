<script>
import LayoutApp from "../../Layouts/LayoutApp.vue";
import TextInput from "../../Shared/TextInput.vue";
import SelectInput from "../../Shared/SelectInput.vue";
import Icon from "../../Shared/Icon.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "vue";
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
        medicamento: Array,
        medicamentoHasHorario: Array,
        presentaciones: Array,
        errors: Object
    },


    setup(props) {

        const form = useForm({
            _method: "PUT",
            id: props.medicamento.id,
            nombre: props.medicamento.nombre,
            descripcion: props.medicamento.descripcion,
            dosis: props.medicamento.dosis,
            indicaciones: props.medicamento.indicaciones,
            efectos_secundarios: props.medicamento.efectos_secundarios,
            residente_id: props.medicamento.residente_id,
            presentacione_id: props.medicamento.presentacione_id,
            horarios: props.medicamentoHasHorario

        });

        const eliminarHorario = (index)=>{
            form.horarios.splice(index, 1);
        }

        const agregarHorario = ()=>{
            form.horarios.push({ valor: ''})
        }

        const actualizar = () => {
            form.post(
                route("medicamentos.update", form.id),
                {
                    preserveScroll: true,
                }
            );
        };

        return { form, actualizar, eliminarHorario, agregarHorario };
    },
};
</script>
<template>
    <div>

        <Head title="Editar Empleados" />
        <!-- header -->
        <h1 class="py-3 px-2 max-w-4xl flex items-center gap-4 bg-white rounded-md border text-2xl">
            <div class="inline-block p-2 bg-teal-50 border border-turquesa rounded-md">
                <Icon name="medicine" class="w-7 h-7 fill-turquesa" />
            </div>
            <span class="text-turquesa drop-shadow-md">Editar Medicamento</span>
        </h1>
        <!-- formulario -->
        <div class="max-w-4xl overflow-hidden pt-2">
            <form @submit.prevent="actualizar">
                <div class="py-3 px-3 flex flex-wrap bg-white border rounded-md">
                    <text-input type="text" label="Residente" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="residente_id"
                        v-model="form.residente_id" name="residente_id" :error="errors.residente_id"/>
                    <text-input type="text" label="Nombre del Medicamento" class="pb-5 lg:pr-3 w-full lg:w-1/2" id="nombre"
                        v-model="form.nombre" :error="errors.nombre" />
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="descripcion" class="form-label">Descripcion:</label>
                        <textarea name="descripcion" id="descripcion" cols="20" rows="3" class="form-textarea"
                            v-model="form.descripcion"></textarea>
                        <span v-if="errors.descripcion" class="text-red-500">{{ errors.descripcion }}</span>
                    </div>
                    <text-input type="text" label="Dosis" class="pb-5 lg:pr-3 w-full lg:w-1/2" v-model="form.dosis"
                        id="dosis" name="dosis" :error="errors.dosis" />
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="indicaciones" class="form-label">Indicaciones:</label>
                        <textarea name="indicaciones" id="indicaciones" cols="20" rows="3" class="form-textarea"
                            v-model="form.indicaciones"></textarea>
                        <span v-if="errors.indicaciones" class="text-red-500">{{ errors.indicaciones }}</span>
                    </div>
                    <div class="pb-5 lg:pr-3 w-full lg:w-1/2">
                        <label for="efectos_secundarios" class="form-label">Efectos Secundarios:</label>
                        <textarea name="indicaciones" id="efectos_secundarios" cols="20" rows="3" class="form-textarea"
                            v-model="form.efectos_secundarios"></textarea>
                        <span v-if="errors.efectos_secundarios" class="text-red-500">{{ errors.efectos_secundarios }}</span>
                    </div>
                    <select-input class="pb-5 lg:pr-3 w-full lg:w-1/2" label="Presentacion" id="presentacione_id"
                        v-model="form.presentacione_id" :error="errors.presentacione_id">
                        <option :value="null" />
                        <option v-for="presentacione in presentaciones" :key="presentacione.id" :value="presentacione.id"
                            class="capitalize">
                            {{ presentacione.nombre }}
                        </option>
                    </select-input>
                    <div class="flex-wrap">
                        <div class="block pb-2">Horarios de Suministro:</div>
                        <div v-for="(horario, index) in form.horarios" :key="index">
                            <input type="text" v-model="horario.hora" placeholder="HH:MM" >
                            <button type="button" @click="eliminarHorario(index)">Eliminar</button>
                        </div>
                        <button type="button" @click="agregarHorario">Agregar Horario</button>
                        <span v-if="errors.horarios" class="text-red-500">{{ errors.horarios }}</span>
                    </div>
                    <div class="py-4 lg:pr-2 flex w-full items-center justify-end bg-white border-t">
                        <Link type="button" :href="route('medicamentos.index')" class="btn-cancelar">
                        <span class="text-white font-bold">Cancelar</span>
                        </Link>
                        <button class="btn-indigo mx-1" type="submit">
                            Editar Medicamento
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</template>


