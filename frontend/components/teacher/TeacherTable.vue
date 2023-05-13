<template>
  <div>
    <vue-good-table :columns="columns" :rows="rows" style="margin-left: 50px; margin-right: 50px; margin-bottom: 50px">
      <template v-slot:table-row="props">
        <span v-if="props.column.field === 'name' || props.column.field === 'file_name'">{{ props.formattedRow[props.column.field] }}</span>
        <span v-if="props.column.field === 'task' || props.column.field === 'solution'">
          <Task :zadanie="props.formattedRow[props.column.field]"></Task>
        </span>
        <template v-if="props.column.field === 'action'">
          <form @submit.prevent="uploadImages(props.row)">
            <input type="file" class="form-control" id="files" name="files" multiple @change="handleFileUpload">
            <input type="submit" value="Upload image" class="btn btn-primary">
          </form>
        </template>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
import { VueGoodTable } from 'vue-good-table-next';
import 'vue-good-table-next/dist/vue-good-table-next.css';
import api from "../../utils/api";
import {IMAGE_POST, LATEX_GET} from "../../constants/edpoints";
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
      selectedFiles: [],
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
        {
          label: 'Points',
          field: 'points',
        },
        {
          label: 'Upload images',
          field: 'action'
        }
      ],
    };
  },
  mounted() {
    // this.fetchData();
  },
  methods: {
    handleFileUpload(event) {
      this.selectedFiles = Array.from(event.target.files);
    },
    uploadImages(row) {
      const formData = new FormData();
      formData.append('name', row.name);
      this.selectedFiles.forEach(file => {
        formData.append('images[]', file);
      });

      api.post(IMAGE_POST, formData)
        .then(response => {
          console.log('Success:', response);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  },
};
</script>
