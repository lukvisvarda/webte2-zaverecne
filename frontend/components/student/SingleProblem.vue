<template>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <h1>{{ problem.name }}</h1>
        <Task v-if="problem.task" :zadanie="problem.task"></Task>
        <img :src="problem.image" class="img-fluid" alt="task image">
      </div>
      <div class="col-12 col-md-6 mt-5">
        <MathEditor ref="mathEditor"></MathEditor>
        <button @click="checkEquationValue">Check Equation Value</button>
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
import {convertLatexToMarkup, convertLatexToMathMl} from 'mathlive';

export default {
  components: { MathEditor, Task },

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
      const response = await api.get(PROBLEM_BY_ID_GET(this.$route.params.id));
      this.problem = await api.get(PROBLEM_BY_ID_GET(this.$route.params.id));

    },

    async checkEquationValue() {
      const mathEditorComponent = this.$refs.mathEditor;
      //musi to tu byt latex ma na zlomky dfrac, vue pouziva frac
      const equationValue = "$\n" + "        " + mathEditorComponent.value.replace(/\\frac/g, '\\dfrac') + "\n    $";

      console.log(equationValue);
      const response = await api.post('/api/check-equation', {
        id: this.$route.params.id,
        equationValue: equationValue
      });

      console.log(response);
      console.log(response.solution);

      this.renderedEquation = response.solution;

      // Check if the mathEditor value is the same as renderedEquation
      if (equationValue === this.renderedEquation) {
        console.log('Yes');
      } else {
        console.log('No');
      }
    }


  }
};
</script>

<style scoped>
.equation-value {
  margin-top: 10px;
  font-size: 16px;
  color: #333;
}
</style>
