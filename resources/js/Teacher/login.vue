<template>
  <div class="card-body">
      <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <alert-error :form="form"></alert-error>

         <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>
                 <div class="col-md-6">
                <input v-model="form.email" id="email" type="email" class="form-control"
                :class="{'is-invalid':form.errors.has('email')}" name="email" autofocus>
             <has-error :form="form" field="email"></has-error>
             </div>
         </div>

        <div class="form-group row">
             <label for="password" class="col-md-4 col-form-label text-md-right">password</label>
            <div class="col-md-6">
                 <input v-model="form.password" id="password" type="password" class="form-control"
                 :class="{'is-invalid':form.errors.has('password')}"
                  name="password" >
                  <has-error :form="form" field="password"></has-error>
                </div>
            </div>
            <button type="submit" class="shadow btn btn-outline-success">Login</button>
      </form>
  </div>
</template>

<script>
export default {
    data(){
        return{
            form : new Form({
                email:'',
                password:'',

       })
        }
    },
    methods:{
        login(){
            this.form.post('/login')
            .then((response)=> {
                console.log(response)
            })
            .catch((e)=>{
                console.log(e)
            })

        }
    }

}
</script>

<style>

</style>
