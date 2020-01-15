<template>
  <div>
    <div class="card">
      <div class="card-header">
        <label>Match parent to student</label>
        <div class="card-tools">
          <button class="btn btn-outline-primary">Show students without parents</button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <label>Select Parent</label>
            <v-select
              label="id"
              :filterable="false"
              v-model="parent"
              @search="searchparent"
              :options="parents"
            >
              <template slot="no-options">Enter the Surname or phone number</template>
              <template slot="option" slot-scope="option">
                <div
                  class="text-center"
                >{{option.name}} {{option.father_phone}} {{option.mother_phone}}</div>
              </template>
              <template slot="selected-option" slot-scope="option">
                <div
                  class="text-center"
                >{{option.name}} {{option.father_phone}} {{option.mother_phone}}</div>
              </template>
            </v-select>
          </div>
          <div class="col">
            <label>Select Student</label>
            <v-select
              label="id"
              :filterable="false"
              v-model="student"
              @search="searchstudent"
              @input="addstudent"
              :options="students"

            >
              <template slot="no-options">Enter the Student's name or matric Number</template>
              <template slot="option" slot-scope="option">
                <div class="text-center">{{option.first_name}} {{option.surname}}</div>
              </template>
              <template slot="selected-option" slot-scope="option">
                <div class="text-center">{{option.first_name}} {{option.surname}}</div>
              </template>
            </v-select>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Info</div>
      <div class="card-body">
        <div class="row">
          <div class="col col-md-4">
            <div class="card">
              <div class="card-header">
                <label class="d-block">Surname: {{parent == null ? '' : parent.name}}</label>
              </div>
              <div class="card-body">
                <div class="row no-gutters">
                  <div class="col-6 text-center">
                      <label class="d-block">Father</label>
                    <img
                      src="/img/profile.png"
                      class="profile-user-img img-fluid img-circle"
                      alt="User Image"
                    />

                    <label class="d-block">{{parent == null  ? '' : parent.father_name}}</label>
                    <label class="d-block">{{parent == null ? '' :parent.father_phone}}</label>
                  </div>
                  <div class="col-6 text-center p-0">
                    <div>
                         <label class="d-block">Mother</label>
                      <img
                        src="/img/profile.png"
                        class="profile-user-img img-fluid img-circle"
                        alt="User Image"
                      />
                      <label class="d-block">{{parent == null ? '' : parent.mother_name }}</label>
                      <label class="d-block">{{parent == null ? '' : parent.mother_phone}}</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="row">
              <div class="col-4" v-for="(c, index) in child" :key="index">
                <div class="card callout callout-success p-0">
                    <div class="text-right">
                            <button class="btn btn-sm btn-outline-danger" @click="remove(index)">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                  <div class="row">
                    <div class="col-4">
                      <img
                        src="/img/profile.png"
                        class="profile-user-img img-fluid img-circle"
                        alt="User Image"
                      />
                    </div>
                    <div class="col">

                      <label class="d-block">First name :{{c.first_name}}</label>
                      <label class="d-block">Surname :{{c.surname}}</label>
                      <label class="d-block">Class :{{c.classroom}}</label>
                      <label class="d-block">Section :{{c.section}}</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button class="btn btn-primary" @click="match" :disabled="btn">match</button>
        <!-- <p>{{btn}}</p> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      parent: "",
      parents: [],
      student: "",
      students: [],
      child:[],
    };
  },
  created() {},
  methods: {
    searchstudent(search, loading) {
      loading(true);
      axios
        .get("/searchstudent", {
          params: {
            search: search
          }
        })
        .then(response => {
          this.students = response.data;
          loading(false);
        })
        .catch(e => {
          console.log(e);
        });
    },
    searchparent(search, loading) {
      loading(true);
      axios
        .get("/searchparent", {
          params: {
            search: search
          }
        })
        .then(response => {
          this.parents = response.data;
          loading(false);
        })
        .catch(e => {
          console.log(e);
        });
    },
    addstudent(){
        this.child.push(this.student);
    },
    match(){
        axios.post('/matchparent',{parent:this.parent.id, student:this.child})
            .then(response =>{
                Toast.fire({
                    type:'success',
                    title:"here"
                })
            })
            .catch((e)=>{
                Toast.fire({
                    type:'error',
                    title:'Error Matching Students'
                })
            })
    },
    remove(index){
        this.child.splice(index, 1)
    }

  },
  computed: {
      btn(){
          if((this.parent == "")||(this.child.length == 0)){
              return true;
          }else{
              return false;
          }
      }
  },
};
</script>

<style>
</style>
