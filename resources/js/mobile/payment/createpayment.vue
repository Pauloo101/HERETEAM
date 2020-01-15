<template>
   <div>
       <form @submit.prevent="createpayment" @keydown="form.onKeydown($event)">
            <alert-error :form="form"></alert-error>
            <div class="form-group">
                <input name="name" v-model="form.name" type="text" class="form-control-sm form-control"
                placeholder="Enter Payment name" :class="{'is-invalid':form.errors.has('name')}"/>
                <has-error :form="form" field="name"></has-error>
            </div>
            <div class="form-group">
                <input type="number" name="amount" class="form-control form-control-sm" v-model="form.amount"
                       placeholder="Amount in Naira" :class="{'is-invalid':form.errors.has('amount')}">
                <has-error :form="form" field="amount"></has-error>
            </div>
            <div class="form-group">
                <textarea class="form-control-sm form-control" name="description" placeholder="description" v-model="form.description"
                 :class="{'is-invalid':form.errors.has('description')}" ></textarea>
                <has-error :form="form" field="description"></has-error>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <select class="form-control form-control-sm" placeholder="select cLass" v-model="form.classroom" @change="search">
                            <option value="0">all</option>
                            <option v-for="classroom in classrooms" :value="classroom.id" :key="classroom.id">{{classroom.name}}</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control form-control-sm" placeholder="select sectioon" v-model="form.section">
                            <option value="0">all</option>
                            <option v-for="section in sections" :value="section.id" :key="section.id">{{section.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
                <div class="col">
                    <button @click="createpayment" class="btn btn-outline-success">Save</button>
                </div>
                <div class="col">
                <button v-b-tooltip.hover.bottomleft title="Click to clear input fields"
                class="btn btn-danger btn-sm float-right" @click="reset">
                    <i class="fas fa-undo"></i>
                    reset form </button>
                </div>
            </div>
   </div>
</template>

<script>
export default {
    name : 'createpayment',
    data() {
        return {
                sections: '',
                form : new Form({
                    name:'',
                    amount:'',
                    description:'',
                    classroom:'',
                    section:''
                })
        }
    },
    methods:{
        reset(){
            this.form.reset();
        },
           createpayment(){
               this.form.post('/createpayment')
                   .then(() => {
                      this.$bvToast.toast('Bill Saved',{
                          title:"Success",
                          variant:'success',
                          solid:true
                      })
                   })
                   .catch(() => {
                        this.$bvToast.toast('Unable to save ',{
                          title:"Error",
                          variant:'danger',
                          solid:true
                      })
                   })
            },
              search(){
                  this.$Progress.start()
                  if(this.form.classroom == 0){

                      this.form.section = 0
                  }
                  else{
                      axios.get('/search/'+ this.form.classroom)
                        .then(response=>{
                            this.sections = response.data
                        })
                        .catch((e)=>{
                            console.log(e)
                        })
                  }
                  this.$Progress.finish()

    },

},
created() {
    this.$store.dispatch('loadclassrooms')
},
computed: {
    classrooms(){
        return this.$store.state.classrooms
    }
},

}
</script>

<style>

</style>
