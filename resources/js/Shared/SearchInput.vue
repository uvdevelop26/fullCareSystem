<script>
import Icon from './Icon.vue';

export default {
    components:{
        Icon
    },
    props: {
        modelValue: String
    },

    emits: ['update:modelValue', 'reset'],
}

</script>
<template>
    <div class="flex items-center">
        <div class="flex w-full max-w-xl relative">
            <input type="text" class="relative bg-white  focus:ring-0 focus:outline-cyan-600 px-6 py-2 w-full rounded-3xl border-none " autocomplete="off"
                name="search" placeholder="buscar..." :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)" />
                <Icon name="search" class="w-4 h-4 absolute right-3 top-3 fill-textColor" />
        </div>
        <button class="ml-3  hover:text-cyan-600 text-sm focus:text-cyan-700" type="button"
            @click="$emit('reset')">Reset</button>
    </div>

</template>
