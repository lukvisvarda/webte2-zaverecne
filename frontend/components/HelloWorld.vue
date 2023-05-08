<template>
    <div class="hello">
        <router-link to="/login">
            <button>login</button>
        </router-link>
        <router-link to="/latex">
          <button>latex</button>
        </router-link>
        <router-link to="/insert">
          <button>insert</button>
        </router-link>
      <MathEditor :on-value-change="handleMathEditorChange"></MathEditor>
      <button @click="handleClick">Click me </button>
    </div>
</template>

<script>
import MathEditor from "./editor/MathEditor.vue";

export default {
    name: "HelloWorld",
  components: {MathEditor},
    props: {
        msg: String,
    },
  data(){
      return {
          value: 'f(x) = ',
          rendered: ''
      }
  },

  methods:{
      handleMathEditorChange(value) {
          console.log("handleMathEditorChange")
          this.value = value;
      },
      handleClick(){
          console.log(this.value)
      }
  }
};
</script>

<style scoped>
h3 {
    margin: 40px 0 0;
}
ul {
    list-style-type: none;
    padding: 0;
}
li {
    display: inline-block;
    margin: 0 10px;
}
a {
    color: #42b983;
}
</style>
