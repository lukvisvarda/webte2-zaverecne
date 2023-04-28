<template>
  <div class="select">
    <VueMultiselect
      v-model="value"
      :options="options"
      :multiple="true"
      :taggable="true"
      @tag="addTag"
      tag-placeholder="Add this as new tag"
      placeholder="Type to search or add tag"
      label="name"
      track-by="code"
    />
  <button class="btn btn-primary select-button">Potvrdiť</button>
  </div>
</template>

<script>
import VueMultiselect from 'vue-multiselect'
import api from "../../utils/api";
import {LATEX_GET} from "../../constants/edpoints";
import {reactive} from "vue";
export default {
  name: "AssignThesis",
  components: {VueMultiselect},

  // data () {
  //   return {
  //     value: [],
  //     options: [{name: "Aasdfas", code:"asd"}]
  //   }
  // },
  setup() {
    const options = reactive([]);
    const value = reactive([]);

    api.get(LATEX_GET)
      .then(response => {
        // Clear options array before pushing new values
        options.splice(0, options.length);
        //loop through the response and push the data to the options array
        for (let i = 0; i < response.length; i++) {
          // loop over parsed data and push to options array
            options.push({
              name: response[i].name,
              code: response[i].name
            });
            value.push({
              name: response[i].name,
              code: response[i].name
            });
        }
      });

    console.log(options)
    const addTag = (newTag) => {
      // api.get(LATEX_GET)
      //   .then(response => {
      //     // Clear options array before pushing new values
      //     options.splice(0, options.length);
      //     //loop through the response and push the data to the options array
      //     for (let i = 0; i < response.length; i++) {
      //       // loop over parsed data and push to options array
      //       for(let j = 0; j < response[i].parsed.length; j++){
      //         options.push({
      //           name: response[i].parsed[j].name,
      //           code: response[i].parsed[j].name
      //         });
      //       }
      //     }
      //   });

    //   const tag = {
    //     name: newTag,
    //     code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
    //   }
    //
    //   options.push(tag);
    //   value.push(tag);
    }

    return {
      options,
      value,
      // addTag
    };
  },




//   methods: {
//     addTag (newTag) {
//     console.log("SOM TUUUUUUUUUU")
// //       api.get(LATEX_GET)
// //         .then(response => {
// // //loop through the response and push the data to the rows array
// //           for (let i = 0; i < response.length; i++) {
// //             // loop over parsed data and push to rows
// //             for(let j = 0; j < response[i].parsed.length; j++){
// //               this.options.push({
// //                 name: response[i].parsed[j].name,
// //                 code: response[i].parsed[j].name
// //               });
// //             }
// //           }
// //         })
//
//       const tag = {
//         name: newTag,
//         code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
//       }
//       this.options.push(tag)
//       this.value.push(tag)
//     }
//   }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style>
  .select {
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 400px;
    flex-direction: column;
    margin: 0 auto;
  }
  .select-button{
    width:100%;
    margin-bottom: 2rem
  }
</style>
