<template>
  <div>
      <div class="card">
          <div class="card-header">
              Import Student
              <div class="card-tools">
                  <button class="btn btn-sm btn-outline-info">download template</button>
              </div>
          </div>
              <div class="card-body">
                  <input type="file" ref="file" @change="handlefileupload" class="form-control form-control-sm">
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-outline-success" @click="submitfile">Save</button>
              </div>

      </div>

  </div>
</template>

<script>
export default {
    data(){
        return{
            file:'',
        }
    },
    methods:{
        here(){
            axios.post('/importparse',{file:this.file})
                .then(response => {
                console.log(response);
            }).catch((e)=>{
                console.log(e);
            })
        },
        submitfile(){
            let formData = new FormData();
            formData.append('file',this.file);
            axios.post('/importparse', formData,{
                headers:{
                    'Content-Type' :'multipart/form-data'
                }
            }).then(response => {
                console.log(response);
            }).catch((e)=>{
                console.log(e);
            })
        },
        handlefileupload(){
            this.file = this.$refs.file.files[0];
            console.log(this.$refs.file.files)
        }
    }
}
</script>

<style>

</style>
