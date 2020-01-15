<template>
  <div>
       <div role="tablist" id="accordion-1">
    <div class="card">
        <div class="card-header" role="tab">
            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1">School Bill</a></h5>
        </div>
        <div class="collapse show item-1" role="tabpanel" data-parent="#accordion-1">
            <div class="bg-info mt-2 mb-3 p-2">
                <div class="row">
                    <div class="col">
                        <div class="row no-gutters" >
                            <div class="col-4">
                            <label>Select class</label>
                            </div>
                            <div class="col">
                                 <select class="form-control form-control-sm" v-model="classroom" @change="search">
                                    <optgroup label="select a class">
                                        <option value="0">all</option>
                                        <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id">{{classroom.name}}</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row no-gutters">
                            <div class="col-4">
                               <label>
                                  Select section
                                </label>
                            </div>
                            <div class="col">
                                <select class="form-control form-control-sm" v-model="section" @change="fetchbill">
                                    <optgroup label="select a section">
                                        <option value="0">all</option>
                                        <option v-for="section in sections " :key="section.id" :value="section.id">{{section.name}}</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Descripition</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="b in bill" :key="b.id">
                            <td>{{b.name}}</td>
                            <td>{{b.amount}}</td>
                            <td>{{b.description}}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            classroom:'',
            section:'',
            sections:'',
            bill:'',
        }
    },
    created() {
        this.$store.dispatch('loadclassrooms');
    },
    computed: {
        classrooms(){
            return this.$store.state.classrooms
        }
    },
    methods: {
        //search for classrooms
     search(){
          this.$Progress.start()
         this.fetchbill()
         if (this.classroom == 0) {
             this.section =0
         }
         else{
             axios.get('/search/'+ this.classroom)
            .then(response=>{
                this.sections = response.data
            })
         }
         this.$Progress.finish()

    },
    fetchbill(){
        axios.get('/fetchbill',{
            params:{
                classroom:this.classroom,
                section:this.section
            }
        })
        .then(({data})=> this.bill = data)
        .catch(()=>{
            console.log(e);
        })
    }
    },

}
</script>

<style>

</style>
