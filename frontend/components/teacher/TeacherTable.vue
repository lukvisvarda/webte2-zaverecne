<template>
  <div>
    <vue-good-table :columns="columns" :rows="rows" style="margin-left: 50px; margin-right: 50px; margin-bottom: 50px">
      <template v-slot:table-row="props">
        <span v-if="props.column.field === 'name' || props.column.field === 'file_name'">{{ props.formattedRow[props.column.field] }}</span>
        <span v-if="props.column.field === 'task' || props.column.field === 'solution'">
          <Task :zadanie="props.formattedRow[props.column.field]"></Task>
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
import { VueGoodTable } from 'vue-good-table-next';
import 'vue-good-table-next/dist/vue-good-table-next.css';
import api from "../../utils/api";
import {LATEX_GET} from "../../constants/edpoints";
import Task from "../latex/Task.vue";

export default {
  name: 'TeacherTable',
  components: {
    VueGoodTable,
    Task
  },
  data() {
    return {
      columns: [
        {
          label: 'File name',
          field: 'file_name',
        },
        {
          label: 'Name',
          field: 'name',
        },
        {
          label: 'Task',
          field: 'task',
        },
        {
          label: 'Solution',
          field: 'solution',
        },

      ],
      rows: [],
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      api.get(LATEX_GET)
        .then(response => {
          //loop through the response and push the data to the rows array
          for (let i = 0; i < response.length; i++) {
            // loop over parsed data and push to rows
            for(let j = 0; j < response[i].parsed.length; j++){
              this.rows.push({
                name: response[i].parsed[j].name,
                task: response[i].parsed[j].task,
                // solution: response[i].parsed[j].solution,
                solution: response[i].parsed[j].solution,
                file_name: response[i].name
              });
            }
          }
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
};
</script>
