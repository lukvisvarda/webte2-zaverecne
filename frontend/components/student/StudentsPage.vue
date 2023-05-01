<template>
  <div class="student-wrapper">
    <button class="our-student-button" @click="generate">Generovať</button>
    <button class="our-student-button" @click="seeTasks">Prehľad zadaných úloh</button>
  </div>
</template>

<script>
import api from "../../utils/api";
import {GENERATE_POST} from "../../constants/edpoints";

export default {
  name: "StudentsPage",

  methods: {
    async generate() {

      const problem = await api.post(GENERATE_POST);
      console.log(problem);
    },
    seeTasks() {
      console.log("seeTasks")
    }
  },
};



</script>

<style scoped>
  .student-wrapper {
    height: 90vh;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
  }

  .our-student-button {
    margin: 10px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #000;
    color: #000;
    font-size: 16px;
    cursor: pointer;
    min-width: 300px;
    min-height: 300px;
    background: red;
  }
</style>
