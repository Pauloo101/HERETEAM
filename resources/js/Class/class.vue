<template>
  <table class="table">
      <thead>
          <tr>
              <th>Class</th>
              <th>Section</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="item in classroom" :key="item.id">
          <td>{{item.name}}</td>
          <td>
              <label class="mr-3" v-for="temp in item.sections" :key="temp.id">
                {{temp.name}}
              </label >
        </td>
          <td>
     <div role="group" class="btn-group">
          <b-button
            variant="outline-success"
            v-b-tooltip.hover
            title="Edit"
            class="btn btn-sm"
            @click="edit(item)"
          >
            <i class="far fa-edit"></i>
          </b-button>
          <button class="btn btn-danger btn-sm" v-b-tooltip.hover @click="classdelete(item)" title="Delete">
            <i class="fas fa-trash"></i>
          </button>
    </div>
          </td>
          </tr>
      </tbody>
      <!--<p>{{here}}</p>-->
  </table>

</template>
<script>
export default {
     props: ['classroom'],
    data(){
         return{
             item:{},
             name:{},
             section:{}
         }

    },
    methods:{
        edit(item){
            this.item = item
            Fire.$emit('editclass', this.item)
        },
        classdelete(item){
            axios.post("/classdelete", {id: item.id})
                .then(response => {
                    this.$bvToast.toast(" CLass Deleted ", {
                        title: "Completed",
                        variant: "success",
                        solid: true
                    });
                })
                .catch(() => {
                    this.$bvToast.toast("Unable to delete", {
                        title: "Error",
                        variant: "danger",
                        solid: true
                    });
                });

        }
},
    created(){

    }
}
</script>

