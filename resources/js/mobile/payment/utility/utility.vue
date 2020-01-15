<template>
  <div>
      <div class="card">
     <div class="card-header">
         Utility pane
     </div>
     <div class="card-body p-0">
         <component :is="currentcom"></component>
         <!-- <p>{{currentcom}}</p> -->
     </div>
  </div>
  </div>
</template>

<script>
import overviewutility from './overviewutility'
import extra from './extra'
export default {
    components:{overviewutility,extra},
    data() {
        return {

        }
    },
    computed: {
        currentcom(){
            if(this.$route.name == "paymentoverview"){
                return "overviewutility"
            }
            // else{
            //     return 'here'
            // }
            // let v = this.$route.name
            // return v;
        }
    },
};
</script>

<style>
</style>
