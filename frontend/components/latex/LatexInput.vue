<template>
  <div>
    <p>Enter a LaTeX string:</p>
    <input v-model="latexInput" @input="renderLatex" />
    <div v-html="katexString"></div>
  </div>
</template>

<script>
import katex from 'katex'
import 'katex/dist/katex.min.css'

export default {
  name: "LatexInput",
  data() {
    return {
      latexInput: '',
      katexString: ''
    }
  },
  methods: {
    renderLatex() {
      // Render the LaTeX string using KaTeX
      try {
        this.katexString = katex.renderToString(this.latexInput)
      } catch (error) {
        // Handle invalid LaTeX input
        this.katexString = 'Invalid LaTeX input'
      }
    }
  }
}
</script>
