<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
    label: String,
    error: String
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>


<template>
    <div :class="$attrs.class" >
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input v-model="proxyChecked" type="checkbox" :value="value"
            class="ml-1 rounded border-gray-300 text-indigo-400 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            :class="{ error: error }">
      <!--   <div v-if="error" class="form-error"> {{ error }}</div> -->
    </div>
</template>
