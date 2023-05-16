<template>
  <div class="container">
    <div class="row">
    <div class="col-12 col-md-6">
      <h1>{{ this.problem.name }}</h1>
      <Task v-if="this.problem.task" :zadanie="this.problem.task"></Task>
      <img :src="this.problem.image" class="img-fluid" alt="task image">
    </div>
    <div class="col-12 col-md-6 mt-5">
      <MathEditor></MathEditor>
    </div>

  </div>
  </div>


</template>

<script>
import {PROBLEM_BY_ID_GET} from "../../constants/edpoints";
import api from "../../utils/api";
import Task from "../latex/Task.vue";
import MathEditor from "../editor/MathEditor.vue";

export default {
  components: {MathEditor, Task},

  data() {
    return {
      problem: {}
    }
  },

  mounted() {
    this.getProblem();
  },

  methods: {
    async getProblem() {
      this.problem = await api.get(PROBLEM_BY_ID_GET(this.$route.params.id));
    }
  }
}
</script>

<style  scoped>

</style>
