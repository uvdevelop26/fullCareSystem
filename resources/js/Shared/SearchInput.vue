<template>
    <div class="flex items-center">
        <div class="flex w-full bg-white rounded shadow">
            <input type="text" class="relative px-6 py-2 w-full rounded-r focus:shadow-outline" autocomplete="off"
                name="search" placeholder="buscar..." :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)" />
        </div>
        <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button"
            @click="$emit('reset')">Reset</button>
    </div>

</template>
<script>
export default {
    props: {
        modelValue: String
    },

    emits: ['update:modelValue', 'reset'],
}

</script>