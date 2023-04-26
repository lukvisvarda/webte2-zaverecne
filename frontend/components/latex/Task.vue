<template>
  <p>{{ startString }}</p>
  <latex :str="this.substring"></latex>
  <p>{{ endString }}</p>
</template>

<script>
import Latex from './Latex.vue';

export default{
  name:"Task",
  components:{
    Latex
  },

  props:{
    zadanie:{
      type: String,
      required: true
    }
  },

  computed: {
      startString(){
          return this.zadanie.substring(0, this.zadanie.indexOf('$'));
      },
    substring(){
        let str = this.zadanie;
        let start = str.indexOf('$')+1;
        let end = str.indexOf('$', start + 1)-1;
        let substring = str.substring(start, end + 1).trim();
        console.log(substring)
        return str.substring(start, end + 1).trim();
    },
      endString(){
        let substring = this.zadanie.substring(this.zadanie.lastIndexOf('$'));
        if(substring.length > 1){
          while (substring.charAt(0) === '$'){
            substring = substring.substring(1);
          }
          return substring;
        }else{
          return "";
        }
      }
  }
}

</script>
