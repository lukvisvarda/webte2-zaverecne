<template>
  <div>
    <math-field  v-on:change="handleChange" :value="value"></math-field>
<!--    <math-field></math-field>-->
<!--    <p v-html="rendered"></p>-->
<!--    <p>{{ this.value }}</p>-->
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

  // computed:{
  //   rendered() {
  //     try {
  //       return convertLatexToMarkup(this.value);
  //     } catch (error) {
  //       console.error(error);
  //       return this.value;
  //     }
  //   }
  // }
}
</script>
