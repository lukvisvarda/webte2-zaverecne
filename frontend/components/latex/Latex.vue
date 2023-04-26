<template>
  <span v-html="rendered"></span>
</template>

<script>
import katex from 'katex';
import 'katex/dist/katex.min.css'

export default {
  props: {
    str: {
      required: true
    }
  },
  computed: {
    rendered() {
      try {
        return katex.renderToString(this.str);
      } catch (error) {
        console.error(error);
        return this.str;
      }
    }
  }
};
</script>