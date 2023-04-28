<template>
  <div>

      <AssignThesis/>
      <div class="select">
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Vlož LaTex súbor:</label>
            <input class="form-control" type="file" id="formFileMultiple" multiple>
          </div>
          <button type="submit">Submit</button>
        </form>

      </div>
      <TeacherTable/>
  </div>
</template>

<script>

import api from "../../utils/api";
import {LATEX_POST} from "../../constants/edpoints";
import TeacherTable from "./TeacherTable.vue";
import AssignThesis from "./AssignThesis.vue";
export default {
  name: 'InsertLatex',
  components: {
    TeacherTable,
    AssignThesis
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
      //reload page
      location.reload();
    }
  }
}
</script>
