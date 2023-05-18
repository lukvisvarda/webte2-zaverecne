<template>
  <div class="m-5">
    <div v-if="isLoading" class="loading">
      <VueSpinnerHourglass :size="100" color="##212529" />
    </div>
    <div v-else>
      <div class="row">
        <div class="col-12 col-md-6 d-flex">
          <AssignThesis
          :options="options"
          :initial-selected-options="selectedOptions"
        />
        </div>
        <div class="col-12 col-md-6">
          <div class="select">
            <form @submit.prevent="submitForm">
              <div class="mb-3">
                <label for="formFileMultiple" class="form-label"
                >{{ $t('content.insertLaTex') }}:</label
                >
                <input class="form-control" type="file" id="latex-file" multiple />
              </div>
              <div class="form-outline">
                <label class="form-label" for="typeNumber"> {{ $t('content.pointsForTask') }} </label>
                <input type="number" id="typeNumber" class="form-control" min="0" />
              </div>
              <button class="btn btn-dark select-button" type="submit">
                {{ $t("assignThesis.submit") }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <TeacherTable :rows="rows" />
</template>

<script>
import api from "../../utils/api";
import { ASSIGN_GET, LATEX_GET, LATEX_POST } from "../../constants/edpoints";
import TeacherTable from "./TeacherTable.vue";
import AssignThesis from "./AssignThesis.vue";
import { useToast } from "vue-toastification";
import { VueSpinnerHourglass } from "vue3-spinners";

export default {
  name: "InsertLatex",
  components: {
    TeacherTable,
    AssignThesis,
    VueSpinnerHourglass,
  },

  setup() {
    const toast = useToast();
    return {
      toast: function (msg) {
        toast.error(msg);
      },
    };
  },

  data() {
    return {
      isLoading: true,
      rows: [],
      options: [],
      selectedOptions: [],
    };
  },

  mounted() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      //clear rows
      this.rows.splice(0, this.rows.length);
      let response = await api.get(LATEX_GET);
      for (let i = 0; i < response.length; i++) {
        // loop over parsed data and push to rows
        for (let j = 0; j < response[i].parsed.length; j++) {
          this.rows.push({
            name: response[i].parsed[j].name,
            task: response[i].parsed[j].task,
            // solution: response[i].parsed[j].solution,
            solution: response[i].parsed[j].solution,
            file_name: response[i].name,
            points: response[i].points,
          });
        }
      }
      this.options.splice(0, this.options.length);
      for (let i = 0; i < response.length; i++) {
        // loop over parsed data and push to options array

        this.options.push({
          name: response[i].name,
          code: response[i].name,
        });
      }

      response = await api.get(ASSIGN_GET);
      if (response.selectedFiles) {
        for (let i = 0; i < response.selectedFiles.length; i++) {
          this.selectedOptions.push(response.selectedFiles[i]);
        }
      }

      this.isLoading = false;
    },
    submitForm() {
      //if there are no files selected, return
      if (document.querySelector("#latex-file").files.length === 0) {
        this.toast("Nebol vybraný žiaden súbor");
      }

      const fileInput = document.querySelector("#latex-file");
      const pointsInput = document.querySelector("#typeNumber");
      const points = pointsInput.value;
      console.log(points);
      const file = fileInput.files[0];
      const formData = new FormData();
      formData.append("file", file);
      formData.append("name", "test");
      formData.append("points", points);

      api
        .post(LATEX_POST, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          console.log("Success:", response);
          this.fetchData();
        })
        .catch((error) => {
          // Handle error
          console.error("Error:", error);
        });
      //reload page
      // location.reload();
    },
  },
};
</script>

<style>
.loading {
  height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.select {
  display: flex;
  align-items: center;
  justify-content: center;
  max-width: 400px;
  flex-direction: column;
  margin: 0 auto;
}

.select-button {
  width: 100%;
  margin-bottom: 2rem;
}
</style>
