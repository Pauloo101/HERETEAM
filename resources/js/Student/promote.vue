<template>
  <div class="card" >

    <div class="row">
      <div class="col-4">
        <settings></settings>
      </div>
      <div class="col">
          <div>
              <b-tabs>
                  <b-tab title="Promote to new Session">
                      <form @submit.prevent="promotestudent" @keydown="form.onKeydown($event)">
              <alert-error :form="form"></alert-error>
          <div class="card">
          <div class="card-header">
          <label>Promotion criteria</label>
      </div>
        <div
          class="row pt-3 mb-3 ml-3 mr-3 bg-success"
          v-b-tooltip.hover
          title="Set the promotion criteria"
        >
          <div class="col">

            <div class="row no-gutters">
              <div class="col-4">
                <div class="form-group">
                  <label>Select Session</label>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <select class="form-control form-control-sm" name="session"
                  :class="{'is-invalid':form.errors.has('session')}"
                  v-model="form.session" @change="getterm">
                    <optgroup label="Select Session">
                      <option
                        v-for="session in sessions"
                        :key="session.id"
                        :value="session.id"
                      >{{session.session}}</option>
                    </optgroup>
                  </select>
                  <has-error :form="form" field="session"></has-error>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="row no-gutters">
              <div class="col-4">
                <div class="form-group">
                  <label>Select term</label>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <select class="form-control form-control-sm" :class="{'is-invalid':form.errors.has('term')}"
                  name="term"  v-model="form.term">
                    <optgroup label="Select Term">
                      <option
                        v-for="term in terms"
                        :key="term.term_id"
                        :value="term.term_id"
                      >{{term.term_name}}</option>
                    </optgroup>
                  </select>
                  <has-error :form="form" field="term"></has-error>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row pt-3 ml-3 mr-3 bg-info" >
            <div class="col" v-b-tooltip.hover title="select class to promote">
                <div class="row">
                    <div class="col">
                          <div class="form-group">
                    <label>Select Class</label>
                    <select class="form-control form-control-sm" @change="search" v-model="form.classroom"
                  :class="{'is-invalid':form.errors.has('classroom')}" name="classroom" >
                    <optgroup label="Select Class">
                      <option
                        v-for="classroom in classrooms"
                        :key="classroom.id"
                        :value="classroom.id"
                      >{{classroom.name}}</option>
                    </optgroup>
                  </select>
                    <has-error :form="form" field="classroom"></has-error>
                </div>
                    </div>
                    <div class="col">
                         <div class="form-group">
                     <label>Select section</label>
                     <select name="section"
                    class="form-control form-control-sm" :class="{'is-invalid':form.errors.has('section')}"
                    v-model="form.section"
                    @change="fetchstudent"
                  >
                    <optgroup label="Select section">
                      <option value>all</option>
                      <option
                        v-for="section in sections"
                        :key="section.id"
                        :value="section.id"
                      >{{section.name}}</option>
                    </optgroup>
                  </select>
                   <has-error :form="form" field="section"></has-error>
                </div>
                    </div>
                </div>

            </div>

            <div class="col" v-b-tooltip.hover title="Select destination class">
                 <div class="row">
               <div class="col">
                    <div class="form-group">
                     <label>Select Class to promote to </label>
                     <select name="targetclass"
                    class="form-control form-control-sm" :class="{'is-invalid':form.errors.has('targetclass')}"
                    v-model="form.targetclass"
                    @change="fetchstudent"
                  >
                    <optgroup label="Select section">
                      <!-- <option value>all</option> -->
                      <option
                        v-for=" tc in tclassroom"
                        :key="tc.id"
                        :value="tc.id"
                      >{{tc.name}}</option>
                    </optgroup>
                  </select>
                   <has-error :form="form" field="targetclass"></has-error>
                </div>
               </div>
                </div>
            </div>


        </div>
        <div class="row">
          <div class="col mt-3 ml-3 mr-3">
           <div class="card">
               <div class="card-header">
                   Enter the name(s) of student(s) you don't want to promote
                   <!-- <div class="card-tools">
                       <button class="btn btn-outline-success"> Promote student </button>
                   </div> -->
                   <div class="card-body">

                        <v-select
               class="bg-light"
               label="first_name"
                  :filterable="true"
                   multiple
                   v-model="form.student"
                  :options="students"
                   :reduce="students => students.id"
                >
                <template slot="no-options">
                    Enter the name of the students
                </template>
                <template slot="option" slot-scope="option">
                    <div class="text-center">
                     {{option.matric_no}}  -- {{option.first_name}} {{option.surname}}
                    </div>
                </template>
                <template slot="selected-option" slot-scope="option">
                    <div class="text-center">
                     {{option.matric_no}} -- {{option.first_name}} {{option.surname}}
                    </div>
                </template>
            </v-select>
                   </div>
                   <div class="card-footer">
                        <button class="btn btn-outline-success" type="submit"> Promote student </button>
                   </div>
               </div>
           </div>


            <p>{{form.student}}</p>
          </div>
        </div>
      </div>
      </form>
                  </b-tab>
                  <!-- tab 2 -->
                  <b-tab title="Promote to term">
                      <term></term>
                  </b-tab>
              </b-tabs>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
    import term from './promoteterm'
export default {
    components:{term},
  data() {
    return {
      form:new Form({
          session:'',
          term:'',
          classroom:'',
          student:[],
          section:'',
          targetclass:''
      }),
      session: "",
      terms: "",
      term: "",
      student: [],
      students: [],
      classroom: "",
      sections: "",
      section: "",
      selectMode: "multi",
      selected: [],
      status: "",
      findstudent:"",
    };
  },
  computed: {
    tclassroom(){
        let tclass = this.form.classroom
        let classrooms = this.classrooms
        let value = classrooms.filter(function (classroom) {
         return classroom.id !=  tclass
        console.log(value);
    })
    return value;
    },
    classrooms() {
      return this.$store.state.classrooms;
    },

    sessions() {
      return this.$store.state.sessions;
    },
    filteredstudents() {
        // if(this.students.length == 0){
        //     return [];
        // } else{
            //  let filter = new RegExp(this.findstudent, '')
            //  return this.students.filter(el => el.match(filter))
            // return this.students
           return this.students.filter((student, index) => {
                 return student.first_name.match(this.findstudent, index);
      });
        // }
      // let filter = new RegExp(this.findquestion, 'i')
      // return this.questions.filter(el => el.match(filter))
    },

  },

  methods: {
    fetchstudent() {
      axios
        .get("/fetchstudent", {
          params: {
            classroom: this.form.classroom,
            section: this.form.section
          }
        })
        .then(({ data }) => (this.students = data));
    },
    search() {

      axios
        .get("/search/" + this.form.classroom)
        .then(response => {
          this.sections = response.data;
          this.fetchstudent();
        })
        .catch(e => {
          console.log(e);
        });
    },
    getterm() {

      axios
        .get("/getterms", {
          params: {
            session: this.form.session
          }
        })
        .then(({ data }) => (this.terms = data))
        .catch(e => {
          this.$bvToast.toast(e.response.data, {
            title: "Error",
            variant: "danger",
            solid: true
          });
          this.terms = [];
        });
    },
    promotestudent(){
        this.form.post('/promotestudent')
        .then((response)=>{
            console.log(response)
        })
        .catch((e)=>{
            console.log(e);
        })
    }

  },
  created() {
    this.$store.dispatch("loadclassrooms");
  }
};
</script>

<style>
</style>
