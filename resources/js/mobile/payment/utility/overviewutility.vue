<template>
  <div class="">
    <ul class="list-group p-0 text-white">
      <li class="list-group-item p-1 bg-info text-white" v-for="d in details" :key="d.id">
        <span class="text-white">{{d.name}}</span > -- <span class="text-white">{{d.amount}}</span>
      </li>

    </ul>
  </div>
</template>

<script>
export default {
    data(){
       return{
            details:'',
       }
    },
    created() {
        Fire.$on('billdetails',(details)=>{
            this.details = details
        })
    },
};
</script>

<style>
</style>
