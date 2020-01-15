<template>
  <div>
    <div class="card">
      <div class="card-header">
        <button class="btn btn-outline-danger" @click="back">
          <i class="fas fa-arrow-alt-circle-left"></i>
        </button> Mr {{complain.father_name}} & Mrs {{complain.mother_name}} {{complain.name}}
      </div>
      <div class="card-body p-1">

          <div class="card-footer bg-primary text-center">
              <span class="text-bold d-block">{{complain.title}}</span>
              <span>{{complain.message}}</span>
          </div>
          <div class="text-center">
              <b-spinner  v-show="!loading" label="Large Spinner"></b-spinner>
          </div>
        <div class="direct-chat-messages">
            <div v-for="r in replys" :key="r.id">
          <!-- Message. Default to the left -->
          <div class="direct-chat-msg" v-if="r.type == 1">
            <div class="direct-chat-info clearfix">
              <span class="direct-chat-name float-left">Alexander Pierce</span>
              <!-- <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span> -->
            </div>
            <!-- /.direct-chat-info -->
            <img class="direct-chat-img" src="/img/profile.png" alt="Message User Image" />
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text" >{{r.message}}</div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->

          <!-- Message to the right -->
          <div class="direct-chat-msg right" v-else>
            <div class="direct-chat-info clearfix">
              <span class="direct-chat-name float-right">Fountain</span>
              <!-- <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span> -->
            </div>
            <!-- /.direct-chat-info -->
            <img class="direct-chat-img" src="img/fountainlogo.png" alt="Message User Image" />
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">{{r.message}}</div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- /.direct-chat-msg -->
            </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="input-group">
          <input type="text" v-model="reply" name="message" placeholder="Type Message ..." class="form-control" />
          <span class="input-group-append">
            <button type="submit" class="btn btn-success" @click="sendreply" :disabled="btn">Send</button>
          </span>
        </div>
        <!-- <p>{{complain}}</p> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props:['complain'],
    data() {
        return {
            replys:'',
            reply:'',
            loading:false
        }
    },
  methods: {
    back() {
      Fire.$emit("back");
      this.$destroy();
    },
    getreply(){
         axios.get('/getreply',{
          params:{
              complain:this.complain.id
          }
      })
        .then(response => {
            this.replys = response.data
        })
    },
    sendreply(){
        axios.post('/reply',{reply:this.reply, complain:this.complain.id})
            .then(response =>{
                Toast.fire({
                    type:'success',
                    title:'Delivered'
                })
                // Fire.$emit('getreply');
                this.getreply();
                this.reply = ''
            })
            .catch((e)=>{
                Toast.fire({
                    type:'error',
                    title:"couldn't send the message"
                })
            })
    }
  },computed: {
      btn(){
          if(this.reply == ''){
              return true;
          }else{
              return false
          }
      }
  },
    // beforeUpdate() {
    //      axios.get('/getreply',{
    //       params:{
    //           complain:this.complain.id
    //       }
    //   })
    //     .then(response => {
    //         this.replys = response.data
    //     })
    // },

  created() {
      axios.get('/getreply',{
          params:{
              complain:this.complain.id
          }
      })
        .then(response => {
            this.replys = response.data
            this.loading = true
        })
    // Fire.$on('getreply', () =>{
    //         axios.get('/getreply',{
    //             params:{
    //                 complain:this.complain.id
    //             }
    //      })
    //     .then(response => {
    //         this.replys = response.data
    //     })
    //     })
  },
};
</script>

<style>
</style>
