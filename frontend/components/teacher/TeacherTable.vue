<template>
  <div>
    <vue-good-table :columns="columns" :rows="rows" />
  </div>
</template>

<script>
import { VueGoodTable } from 'vue-good-table-next';
import 'vue-good-table-next/dist/vue-good-table-next.css';
import api from "../../utils/api";
import {LATEX_GET} from "../../constants/edpoints";

export default {
  name: 'TeacherTable',
  components: {
    VueGoodTable,
  },
  data() {
    return {
      columns: [
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
                solution: response[i].parsed[j].solution,
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
