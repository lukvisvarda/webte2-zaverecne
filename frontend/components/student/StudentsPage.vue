<template>
  <div class="d-flex justify-content-start mt-4">
    <button type="button" class="btn btn-outline-success float-right" @click="generate"> Generovať </button>
  </div>
<!--  <button type="button" class="btn btn-secondary" @click="seeTasks"> Prehľad zadaných úloh </button>-->
  <problems-table></problems-table>
</template>

<script>
import api from "../../utils/api";
import {GENERATE_POST} from "../../constants/edpoints";
import {useToast} from "vue-toastification";
import ProblemsTable from "./ProblemsTable.vue";

export default {
  name: "StudentsPage",
  components: { ProblemsTable },

  setup() {
    const toast = useToast();
    return {
      toastErr: function (msg) {
        toast.error(msg)
      },
      toastSuccess: function (msg) {
        toast.success(msg)
      },
    }
  },

  methods: {
    async generate() {
      const problem = await api.post(GENERATE_POST);
      if(problem.message){
        this.toastErr("Nemáte žiadne úlohy na vygenerovanie");
        return;
      }
      this.toastSuccess("Úloha bola vygenerovaná");
      //if there are no tasks to generate, return

    },
    seeTasks() {
      console.log("seeTasks")
    }
  },
};



</script>

<style scoped>
  .btn {
    margin-left: 50px;
  }
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
