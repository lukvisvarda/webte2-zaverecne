<template>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <h1>{{ this.problem.name }}</h1>
        <Task v-if="this.problem.task" :zadanie="this.problem.task"></Task>
        <img :src="this.problem.image" class="img-fluid" :alt="$t('singleProblem.missingImage')">
      </div>
      <div class="col-12 col-md-6 mt-5">
        <MathEditor ref="mathEditor"></MathEditor>

<!--        <router-link :to="{ path: '/student' }" class="btn btn-primary btn-md px-5">-->
<!--          {{ $t("singleProblem.submit") }}-->
<!--        </router-link>        -->
         <button class="btn btn-primary btn-md px-5" v-on:click="checkEquationValue">
          {{ $t("singleProblem.submit") }}
        </button>
        <div class="equation-value" v-html="renderedEquation"></div>
      </div>
    </div>
  </div>
</template>


<script>
import { PROBLEM_BY_ID_GET } from "../../constants/edpoints";
import api from "../../utils/api";
import Task from "../latex/Task.vue";
import MathEditor from "../editor/MathEditor.vue";
import {useRouter} from "vue-router";
import router from "../../router";

export default {
  components: { MathEditor, Task },

  setup(){
    const router = useRouter();
    return {
      router
    }
  },

  data() {
    return {
      problem: {},
      renderedEquation: '',

    };
  },

  mounted() {
    this.getProblem();
  },

  methods: {
    async getProblem() {
      this.problem = await api.get(PROBLEM_BY_ID_GET(this.$route.params.id));
    },

    async checkEquationValue() {
      const mathEditorComponent = this.$refs.mathEditor;

      //musi to tu byt latex ma na zlomky dfrac, vue pouziva frac
      const equationValue = "$\n" + "        " + mathEditorComponent.value.replace(/\\frac/g, '\\dfrac') + "\n    $";
      const data = {
        id: this.$route.params.id,
        equationValue: equationValue
      }
      console.log("data",data);
      const response = await api.post('/api/check-equation', data);
      await this.router.push({path: '/student'});

    }
  }
};
</script>

<style scoped>
</style>
