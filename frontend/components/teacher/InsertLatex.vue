<template>
  <div>
    <form @submit.prevent="submitForm">
      <label for="latex-file">Select LaTeX file:</label>
      <input type="file" id="latex-file" name="latex-file" accept=".tex, application/x-tex">
      <button type="submit">Submit</button>
    </form>
    <TeacherTable/>
  </div>
</template>

<script>

import api from "../../utils/api";
import {LATEX_POST} from "../../constants/edpoints";
import TeacherTable from "./TeacherTable.vue";
export default {
  name: 'InsertLatex',
  components: {
    TeacherTable
  },
  methods: {
    submitForm() {
      const fileInput = document.querySelector('#latex-file');
      const file = fileInput.files[0];
      const formData = new FormData();
      formData.append('file', file);
      formData.append('name', 'test');

      api.post(LATEX_POST, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(response => {
          console.log('Success:', response);
        })
        .catch(error => {
          // Handle error
          console.error('Error:', error);
        });
    }
  }
}
</script>
