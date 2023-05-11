<template>
    <div class="hello">
      <MathEditor :on-value-change="handleMathEditorChange"></MathEditor>
      <button @click="handleClick">Click me </button>
    </div>
</template>

<script>
import MathEditor from "./editor/MathEditor.vue";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

export default {
    name: "HelloWorld",
  components: {MathEditor},
    props: {
        msg: String,
    },
  setup(){
    const store = useStore();
    const router = useRouter();
    const isLoggedIn = store.getters.isLoggedIn;
    if(!isLoggedIn){
      router.push('/login');
      // location.reload();
    }
    return{
      user: store.getters.getUser,
      isLoggedIn: store.getters.isLoggedIn,
      router
    }
  },
  data(){
      return {
          value: 'f(x) = ',
          rendered: ''
      }
  },

  mounted() {

      if(this.isLoggedIn && this.user.role === 'teacher'){
        this.router.push('/insert');
      }

    if(this.isLoggedIn && this.user.role === 'student'){
      this.router.push('/student');
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
