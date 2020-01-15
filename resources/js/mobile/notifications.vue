<template>
<div>
    <div>
        <div class="form-group">
          <label>Title</label>
          <input class="form-control form-control-sm" placeholder="notification title" v-model="title"/>
      </div>
      <div class="form-group">
          <label>Message</label>
          <textarea class="form-control form-control-sm" placeholder="notification  message" v-model="message"></textarea>
      </div>
      <hr>
      <label>select recipient </label>
      <div class="form-group">
          <label>Send to</label>
         <select class="form-control form-control-sm" v-model="recipient">
            <option value="all">All Parents</option>
            <option value="classroom">Specific Class</option>
            <option value="one">A particular parent</option>
         </select>
      </div>
      <p> {{recipient}}</p>
    <div v-if="recipient == 'classroom'">
        <div class="form-group">
        <select class="form-control form-control-sm" v-model="classroom" @change="search">
            <optgroup label="Select Class">
                <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id">{{classroom.name}}</option>
            </optgroup>

        </select>
    </div>
    <div class="form-group">
        <select class="form-control form-control-sm"  v-model="section">
            <optgroup label="Select class section">
             <option v-for="section in sections" :key="section.id" :value="section.id" >
                 {{section.name}}
            </option>
            </optgroup>
        </select>
    </div>
    </div>
    <div class="form-group" v-if="recipient == 'one'">
        <input class="form-control form-control-sm" type="text" placeholder="enter the parent's phone number" v-model="parent"/>
    </div>
     <div class="row">
          <div class="col">
              <button class="btn btn-primary ml-2 mr-3" @click="manypush">save & send</button>
              <!-- <button class="btn btn-outline-success ml-3" @click="sendpush"> Send </button>
              <button @click="xpo" >xpo</button> -->
          </div>
      </div>
    </div>
</div>

</template>

<script>

    import Expo from 'expo-server-sdk'
         let expo = new Expo();
export default {
    data() {
        return {
            title:'',
            parents:'',
            parent:'',
            message:'',
            recipient:'',
            sections:'',
            classroom:'',
            section:'',
        }
    },
    methods: {
       async xpo(){

            let messages = [];
           messages.push({
               to: 'ExponentPushToken[kLGYdHPpr2hJfQKgPrbRtt]',
               sound: 'default',
               body:'This hello world',
               data:{ withSome:'data' }
           })
           let chunks = await expo.chunkPushNotifications(messages);
            console.log(chunks)
            this.newm(chunks)
        },
        async newm(chunks){
            let tickets = [];
            for (let chunk in chunks) {
              try {
            let ticketChunk = await expo.sendPushNotificationsAsync(chunks[chunk]);
            console.log(ticketChunk);
            tickets.push(...ticketChunk);

            } catch (error) {
            console.log(error);
            }
            }
        },
        sendpush(){
            axios.post('/sendpush',{
                title:this.title,
                message:this.message,
                parent:this.parent,
                recipient:this.recipient
            })
            .then(()=>{
                alert('done')
            })
            .catch((e)=>{
                console.log(e)
            })
        },
         manypush(){
            axios.post('/manypush' ,{
                title:this.title,
                message:this.message,
                parents:this.parents,
                section:this.section,
                classroom:this.classroom,
                recipient:this.recipient
            })
            .then(()=>{
                alert('done')
            })
            .catch((e)=>{
                console.log(e)
            })
        },
         search(){
        axios.get('/search/'+ this.classroom)
            .then(response=>{
                this.sections = response.data
                this.fetchstudent()
            })
            .catch((e)=>{
                console.log(e)
            })
         }
    },
    created() {
        this.$store.dispatch('loadclassrooms')
        // axios.get('/getclass')
        // .then(({data})=>this.classrooms=data)
        // .catch((e)=>{
        //     console.log(e)
        // })

    },
    computed: {
        classrooms(){
            return this.$store.state.classrooms
    },
    },
}
</script>

<style>

</style>
