<script>
import Icon from './Icon.vue';

export default {
    components: {
        Icon
    },
    props: {
        label: String,
        modelValue: String,
        id: String,
        
 
    },

    emits: ['update:modelValue'],
}

</script>
<template>
        <div :class="$attrs.class" class="relative">
            <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
            <input type="search"
                class="relative bg-white border-turquesa px-6 py-2 w-full rounded focus:border-turquesa focus:ring focus:ring-turquesa focus:ring-opacity-5"
                name="search" placeholder="buscar..." :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)" :id="id" />
            <Icon name="search" class="w-4 h-4 absolute right-2 top-12 lg:right-5 fill-turquesa" />
        </div>
</template>
