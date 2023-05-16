<template>
  <div>
    <math-field :config="config" :value="value" @input="handleChange"></math-field>
    <p v-html="rendered"></p>
  </div>
</template>

<script>
import { MathfieldElement, convertLatexToMarkup } from 'mathlive'

export default {
  components: {
    MathfieldElement
  },

  props: {
    onValueChange: {
      type: Function,
      default: () => {},
      required: true
    }
  },

  data() {
    return {
      config: {
        virtualKeyboardMode: 'onfocus'
      },
      value: '',
      rendered: ''
    }
  },

  methods:{
    handleChange(event) {
      this.value = event.target.value;
    }
  },

  watch: {
    value(newLatex) {
      console.log("WATCHING")
      this.rendered = convertLatexToMarkup(newLatex);
      this.onValueChange(newLatex);
    }
  }
}
</script>
