<template>
  <div class="container">
    <div v-if="isLoading" class="loading">
      <VueSpinnerHourglass :size="100" color="#0d6efd"/>
    </div>
    <div v-else>
      <h1 class="center">{{ $t("tutorial.header") }}</h1>
      <div>
        {{ text }}
      </div>
      <button class="btn btn-primary" @click="generatePDF">{{ $t("tutorial.generatePDF") }}</button>
      <div v-if="loggedInUser.role === 'teacher'">
        <button class="btn btn-primary" @click="edit = !edit">Edit</button>

        <div v-if="edit">
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="text"></textarea>
          <button class="btn btn-primary" @click="save">Save</button>
        </div>

      </div>

    </div>
  </div>
</template>

<script>
import {useStore} from "vuex";
import api from "../../utils/api";
import { TUTORIAL_GET_PUT } from "../../constants/edpoints";
import { VueSpinnerHourglass } from 'vue3-spinners'
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';

export default {
  name: "Tutorial",

  components: {
    VueSpinnerHourglass,
  },

  setup(){
    const store = useStore();
    const loggedInUser = store.getters.getUser;
    pdfMake.vfs = pdfFonts.pdfMake.vfs;
    return {
      loggedInUser,
    }
  },

  mounted() {
    this.fetchData();
  },

  methods:{
    async fetchData(){
       this.text = (await api.get(TUTORIAL_GET_PUT)).text;
       this.isLoading = false;
    },
    generatePDF() {
      const docDefinition = {
        content: [
          { text: "Návod", style: 'header' }, // Header element
          this.text
        ],
        styles: {
          header: {
            fontSize: 18,
            bold: true,
            margin: [0, 0, 0, 10], // Adjust margin as needed
          },
        },
      };

      pdfMake.createPdf(docDefinition).download('navod.pdf');
    },
    async save() {
      await api.put(TUTORIAL_GET_PUT, {text: this.text});
    }
  },

  data(){
    return{
      text: "",
      edit: false,
      isLoading: true
    }
  }
}
</script>
