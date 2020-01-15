<template>
  <div>
    <div class="card card-danger card-outline">
      <div class="card-header">
        <h3 class="card-title">Complains</h3>
        <div class="card-tools">
          <i class="fas fa-comments text-" style="font-size: 20px"></i>
          <span class="badge badge-danger navbar-badge">{{len}}</span>
        </div>
      </div>
      <div class="caed-body">
        <div class="overflow-auto">
          <ul class="list-group" style="height:330px">
            <button
              type="button" @click="read(c)"
              class="list-group-item list-group-item-action" v-for="(c, index) in complains" :key="index"
            >
            <div class="row">
                <div class="col-2">
                  <img src="/img/profile.png" class="profile-user-img img-fluid img-circle" alt />
                </div>
                <div class="col">
                  <span>Mr {{c.father_name}} & Mrs {{c.mother_name}} {{c.name}}</span>
                  <span class="d-block text-bold bg-info">{{c.title}}</span>
                  <span class="d-block text-info">{{c.message}}</span>
                </div>
              </div>
            </button>
            <!-- <li class="list-group-item p-0 pl-2 pt-2" v-for="c in complains" :key="c.id"> -->
            <!-- </li> -->
          </ul>
        </div>
      </div>
      <div class="card-footer">
        <label>Search</label>
        <input class="form-control form-control-sm" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
    // props:['complain'],
  data() {
    return {
      complains: [],
      len: ""
    };
  },
  methods: {
      read(c){
          Fire.$emit('read',c)
      }
  },
  created() {
    axios
      .get("/getcomplain")
      .then(response => {
        this.complains = response.data;
        this.len = this.complains.length;
      })
      .catch(e => {
        console.log(e);
      });
  }
};
</script>

<style>
</style>
