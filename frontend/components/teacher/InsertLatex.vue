<template>
  <div>

      <AssignThesis/>
      <div class="select">
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Vlož LaTex súbor:</label>
            <input class="form-control" type="file" id="latex-file" multiple>
          </div>
          <button type="submit">Submit</button>
        </form>
      </div>
      <TeacherTable :rows="rows"/>
  </div>
</template>

<script>

import api from "../../utils/api";
import {LATEX_GET, LATEX_POST} from "../../constants/edpoints";
import TeacherTable from "./TeacherTable.vue";
import AssignThesis from "./AssignThesis.vue";
import { useToast } from "vue-toastification";
import toast from "bootstrap/js/src/toast";

export default {
  name: 'InsertLatex',
  components: {
    TeacherTable,
    AssignThesis
  },

  setup(){
    const toast = useToast();
    return {
      toast: function(msg) { toast.error(msg) },
    }
  },

  data(){
    return {
      rows: [],
    }
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
    submitForm() {
      //if there are no files selected, return
      if(document.querySelector('#latex-file').files.length === 0){
        this.toast("Nebol vybraný žiaden súbor");
      }

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
          this.fetchData();
        })
        .catch(error => {
          // Handle error
          console.error('Error:', error);
        });
      //reload page
      // location.reload();
    }
  }
}
</script>
