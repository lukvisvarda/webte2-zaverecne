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
    };
  },
  mounted() {
    // this.fetchData();
  },
  methods: {

  },
};
</script>
