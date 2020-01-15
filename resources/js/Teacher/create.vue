<template>
  <div>
    <div class="card card-primary card-outline">
      <form @submit.prevent="createteacher" @keydown="form.onKeydown($event)">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">{{form.first_name}}  {{form.last_name}}</h3>

          <p class="text-muted text-center">Class teacher for </p>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group pb">
                <label>First name</label>
                <input
                  class="form-control form-control-sm"
                  v-model="form.first_name" name="first_name"
                  placeholder="First Name" :class="{ 'is-invalid':form.errors.has('first_name')}"
                >
                <has-error :form="form" field="first_name"></has-error>
              </div>
              <div class="form-group">
                <label>Last name</label>
                <input
                  class="form-control form-control-sm"
                  v-model="form.last_name" name="last_name"
                  placeholder="Last Name" :class="{'is-invalid':form.errors.has('last_name')}"
                >
                <has-error :form="form" field="last_name"></has-error>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input
                  class="form-control form-control-sm"
                  v-model="form.email" name="email"
                  placeholder="Email" :class="{'is-invalid':form.errors.has('email')}"
                >
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group">
                <label>Select Role</label>
                <input class="form-control form-control-sm" placeholder="Role">

              </div>
              <div class="form-group">
                <label>Username</label>
                <input
                  class="form-control form-control-sm"
                  v-model="form.user_name" name="user_name"
                  placeholder="Username" :class="{'is-invalid':form.errors.has('user_name')}"
                >
                <has-error :form="form" field="user_name"></has-error>
              </div>

             <div class="form-group">
               <label for="password">Password</label>
               <input :class="{'is-invalid':form.errors.has('password')}"
               type="password" name="password" id="password" v-model="form.password"
               class="form-control form-control-sm" placeholder="password" >
               <has-error :form="form" field="password" ></has-error>
             </div>





              <div class="form-group">
                <label >Gender</label>
                <select
                  v-model="form.gender"
                  name="gender"
                  class="form-control form-control-sm"
                  :class="{'is-invalid':form.errors.has('gender')}"
                >
                  <optgroup label="This is a group">
                    <option value="M" selected>Male</option>
                    <option value="F">Female</option>
                  </optgroup>
                </select>
                <has-error :form="form" field="gender"></has-error>
              </div>
            </div>
            <div class="col-md-6">
              <div class>
                <!-- Class Teacher -->
                <div class="card card-primary card-outline">
                  <div class="card-header form-control">
                    <h6>Class Teacher</h6>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>

                  <div class="card-body p-2">
                    <div>
                      <label class="mb-0">Select Class</label>
                      <select
                        class="form-control form-control-sm"
                        @change="search"
                        v-model="form.class_teacher"
                      >
                        <optgroup label="This is a group">
                          <option
                            v-for="classroom in classrooms"
                            :value="classroom.id"
                            :key="classroom.id"
                            selected
                          >{{classroom.name}}</option>
                        </optgroup>
                      </select>
                    </div>
                    <div>
                      <label class="mb-0">Select Section</label>
                      <select class="form-control form-control-sm" v-model="form.section_teacher">
                        <optgroup label="This is a group">
                          <option
                            v-for="temp in section"
                            :key="temp.id"
                            :value="temp.id"
                            selected
                          >{{temp.name}}</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-2">
                <!-- Select Subject -->
                <div class="card card-primary card-outline">
                  <div class="card-header form-control">
                    <h6>{{form.subject}} {{form.classroom}} {{form.section_id}}</h6>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>

                  <div class="card-body p-2">
                    <div>
                      <label>Select Subject</label>
                      <select
                        @change="fetchclass"
                        class="form-control form-control-sm"
                        v-model="form.subject"
                      >
                        <optgroup label="There are subject">
                          <option
                            v-for="subject in subjects"
                            :key="subject.id"
                            :value="subject.id"
                          >{{subject.name}}</option>
                        </optgroup>
                      </select>

                      <label class="mb-0">Select Class</label>
                      <select
                        class="form-control form-control-sm"
                        @change="teachersearch"
                        v-model="form.classroom"
                      >
                        <optgroup label="This is a group">
                          <option
                            v-for="temp in here"
                            :value="temp.id"
                            :key="temp.id"
                            selected
                          >{{temp.name}}</option>
                        </optgroup>
                      </select>
                    </div>
                    <div>
                      <label class="mb-0">Select Section</label>
                      <select class="form-control form-control-sm" v-model="form.section_id">
                        <optgroup label="section">
                            <option value="0">all</option>
                          <option
                            v-for="temp in teachersection"
                            :key="temp.id"
                            :value="temp.id"
                            selected
                          >{{temp.name}}</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block">
            <b>Create Teacher</b>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        first_name: "",
        password:'',
        last_name: "",
        email: "",
        user_name: "",
        gender:'',
        class_teacher:'',
        section_teacher:'',
        subject:'',
        classroom:{},
        section_id:'',
      }),
      classrooms: {},
      section: {}, //for regular class and section search
      teachersection: {},
      here: "",

    };
  },
  methods: {
    search() {
      axios
        .get("/search/" + this.form.class_teacher)
        .then(({ data }) => (this.section = data));
    },
    teachersearch() {
        this.form.section_id = 0;
      //this is for subject teacher
      axios
        .get("/search/" + this.form.classroom)
        .then(({ data }) => (this.teachersection = data));
    },
    fetchclass() {
      axios
        .get("/fetchclass/" + this.form.subject)
        .then(({ data }) => (this.here = data));
    },
    createteacher() {
        this.form.post('/teacher')
            .then(()=>{
                this.$bvToast.toast('Saved', {
                            title: 'Action Successful',
                            variant: 'success',
                            solid:true
                        })
                        this.form.reset();
                        Fire.$emit('createteacher')
            })
            .catch(()=>{
                        this.$bvToast.toast('An error Occured' ,{
                            title: 'Error',
                            variant: 'danger',
                            solid:true
                        })
                    })
    }
  },
  created() {
    this.$store.dispatch("loadsubjects");
    this.$store.dispatch("loadclassrooms");
    // this.$store.dispatch('loadsections');

    // this.all = this.$store.state.sections;
    axios.get("/why").then(({ data }) => (this.section = data));

    axios.get("/classroom").then(({ data }) => (this.classrooms = data));
  },
  computed: {
    subjects() {
      return this.$store.state.subjects;
    }
    // classrooms() {
    //     return this.$store.state.classrooms;
    // },
    // all(){
    //     return this.$store.state.sections
    // }
  }
};
</script>

<style scoped>
</style>
