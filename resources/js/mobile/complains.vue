<template>
  <div>
      <form @submit.prevent="complain" @keydown="form.onKeydown($event)">
          <div class="form-group">
              <label>Title</label>
              <input class="form-control-sm form-control" placeholder="title" v-model="form.title"/>
          </div>
           <div class="form-group">
            <label>Message</label>
            <textarea class="form-control form-control-sm" placeholder="message" v-model="form.message">
            </textarea>
        </div>
          <button type="submit" class="btn btn-outline-success">Send</button>
      </form>
       <hr>
      <hr>
      <form @submit.prevent="reply" @keydown="form.onKeydown($event)">
      <div class="form-group">
          <label>Complains</label>
          <select class="form-control form-control-sm" v-model="rep.complain">
              <option v-for="complain in complains" :key="complain.id" :value="complain.id" >{{complain.title}}</option>
          </select>
      </div>
      <div class="form-group">
              <label>Message</label>
              <textarea class="form-control form-control-sm" placeholder="Reply" v-model="rep.reply"></textarea>
          </div>
          <button type="submit" class="btn btn-outline-success">Reply</button>
      </form>

  </div>
</template>

<script>
export default {
    data() {
        return {
            complains:'',
            form: new Form({
                title:'',
                message:'',

            }),
            rep: new Form({
                complain:'',
                reply:'',
            })
        }
    },
    methods: {
        complain(){
            this.form.post('/complain')
            .then(()=>{
                alert('done')
            })
            .catch((e)=>{
                console.log(e)
            })
        },
        reply(){
            this.rep.post('/reply')
            .then(()=>{
                alert('done')
            })
            .catch((e)=>{
                console.log(e)
            })
        },

    },
    created() {
        axios.get('/complains')
        .then(({data}) => this.complains = data)
        .catch(()=>{
            console.log('couldnt fetch complains')
        })
    },

}
</script>

<style>

</style>
