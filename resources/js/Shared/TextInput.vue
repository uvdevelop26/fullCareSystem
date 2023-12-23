  <template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input :id="id" ref="input" v-bind="{ ...$attrs, class: null }" class="form-input" :class="{error: error}" :type="type" :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"/>
      <span class="text-xs text-red-400" v-if="reference">Ejemplo {{ reference }}</span>
      <div v-if="error" class="form-error"> {{ error }}</div> 
  </div>
</template>

<script>
import { stringify, v4 as uuid } from "uuid";

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`;
      },
    },

    type: {
      type: String,
      default: 'text',
    },
    error: String,
    label: String,
    reference: String,
    modelValue: String,
  },

  emits: ["update:modelValue"],

  methods: {
    focus() {
      this.$refs.input.focus();
    },

    select() {
      this.$refs.input.select();
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end);
    },
  },
};
</script>

<style>
</style>