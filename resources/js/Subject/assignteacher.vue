<template>
  <div class="col-md-3">
    <form>
      <div class="card">
        <div class="card-header">Assign a Subject teacher</div>
        <div class="card-body pt-0">
          <div class="field">
            <label class="mb-0" for="float-input">Select Subject</label>
            <select @change="fetchclass" class="form-control form-control-sm" v-model="form.subject">
              <optgroup label="There are subject">
                <option
                  v-for="subject in subjects"
                  :key="subject.id"
                  :value="subject.id"
                >{{subject.name}}</option>
              </optgroup>
            </select>
          </div>

          <div class="field">
            <label class="mb-0" >Select Class</label>
                 <select class="form-control form-control-sm" v-model="form.classroom" @change="search">
                  <optgroup label="This is a group">
                    <option v-for="temp  in here" :key="temp.id" :value="temp.id">{{temp.name}}</option>
                  </optgroup>
                </select>
          </div>
           <div>
                <label class="mb-0" >Select Section</label>
                <select class="form-control form-control-sm"  v-model="form.section" >
                  <optgroup label="This is a group">
                    <option
                      v-for="temp in sections"
                      :key="temp.id"
                      :value="temp.id"
                      selected
                    >{{temp.name}}</option>
                  </optgroup>
                </select>
              </div>
    <!-- todo
    my component
     -->
          <div class="field">
            <label class="mb-0" for="float-input">Select Teacher</label>
            <select class="form-control form-control-sm" v-model="form.teacher_id">
                <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">{{teacher.first_name}} </option>
            </select>
          </div>
        </div>

        <button class="btn btn-outline-success" @click="subjectteacher">Save</button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
    data(){
        return{
            form : new Form({
            teacher_id:'',
            subject:'',
            classroom:'',
            section:''
            }),
            here:'',

            sections:'',

        }
    },
  computed: {
    subjects() {
      return this.$store.state.subjects;
    },
    classrooms() {
      return this.$store.state.classrooms;
    },
    // sections() {
    //   return this.$store.state.sections;
    // },
    teachers(){
        return this.$store.state.teachers;
    }
  },
  created() {
    this.$store.dispatch("loadsections");
    this.$store.dispatch("loadteachers");
  },
  methods:{
      fetchclass(){
           axios
        .get("/fetchclass/" + this.subject)
        .then(({ data }) => (this.here = data));
      },
       search(){
        axios.get('/search/'+ this.classroom)
            .then(({data}) => this.sections = data)
    },
    subjectteacher(){
        this.form.post('/subjectteacher')
        .then(response => {
            this.$bvToast.toast("Saved ", {
            title: "Teacher assigned to class!",
            variant: "success",
            solid: true
          });
        })
        .catch(() => {
          this.$bvToast.toast("Check your input fields", {
            title: "Error",
            variant: "danger",
            solid: true
          });
        });
    }
  }
};
</script>
