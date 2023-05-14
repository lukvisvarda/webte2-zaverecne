<template>
  <div>
    <vue-good-table :columns="columns" :rows="rows" style="margin-left: 50px; margin-right: 50px; margin-top: 50px">
      <template v-slot:table-row="props">
        <span v-if="props.column.field === 'name_problem' || props.column.field === 'submited' || props.column.field === 'max_points' || props.column.field === 'points'">{{ props.formattedRow[props.column.field] }}</span>
        <span v-if="props.column.field === 'action' && props.formattedRow['submitted'] === 'Neodovzdané'">
            <RouterLink :to="`/students/problem/${props.formattedRow['id']}`" class="btn btn-primary" >Riešiť</RouterLink>
          </span>
        <span v-if="props.column.field === 'task'">
          <Task :zadanie="props.formattedRow[props.column.field]"></Task>
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
import api from "../../utils/api";
import {PROBLEM_BY_USER_GET} from "../../constants/edpoints";
import {VueGoodTable} from "vue-good-table-next";
import Task from "../latex/Task.vue";

export default {

  components: {VueGoodTable, Task},

  props: {
    rows: {
      type: Array,
      default: () => [],
      required: true
    },
  },

  data() {
    return {
      columns: [
        {
          label: 'Id',
          field: 'id',
        },
        {
          label: 'Názov príkladu',
          field: 'name_problem',
        },
        {
          label: 'Zadanie',
          field: 'task',
        },
        {
          label: 'Odovzdané',
          field: 'submitted',
        },
        {
          label: 'Maximálny počet bodov',
          field: 'max_points',
        },
        {
          label: 'Počet bodov',
          field: 'points',
        },
        {
          label: 'Akcia',
          field: 'action',
        },
      ],
    }
  },

  // mounted() {
  //   this.getProblems();
  // },
  //
  // methods: {
  //   async getProblems() {
  //     const problems = await api.get(PROBLEM_BY_USER_GET(this.$store.getters.getUser.id))
  //     console.log(JSON.stringify(problems));
  //     for(let i = 0; i < problems.length; i++){
  //       this.rows.push({
  //         id: problems[i].problem.id,
  //         name_problem: problems[i].problem.name,
  //         task: problems[i].problem.task,
  //         submitted: problems[i].submitted !== 0 ? "Odovzdané" : "Neodovzdané",
  //         max_points: problems[i].maxPoints,
  //         points:problems[i].points,
  //       })
  //     }
  //   }
  // }
}
</script>

<style scoped>

</style>
