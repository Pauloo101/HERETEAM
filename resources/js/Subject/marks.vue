<template>
  <div class="col-md-12">
    <div class="row no-gutters">
      <div class="col-md-2">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label for="float-input">Select Subject</label>
              <select @change="fetchclass" class="form-control form-control-sm" v-model="subject">
                <optgroup label="This is a group">
                  <option
                    v-for="subject in subjects"
                    :key="subject.id"
                    :value="subject.id"
                  >{{subject.name}}</option>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="float-input">Select Class</label>
              <select class="form-control form-control-sm" @change="search" v-model="classroom">
                <optgroup label="This is a group">
                  <option v-for="temp in classrooms" :key="temp.id" :value="temp.id">{{temp.name}}</option>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="float-input">Select Section</label>
              <select class="form-control form-control-sm" v-model="section">
                <optgroup label="This is a group">
                  <option v-for="temp in sections" :key="temp.id" :value="temp.id">{{temp.name}}</option>
                </optgroup>
              </select>
            </div>

            <button class="btn btn-outline-primary" @click="fetchmarks">Fetch</button>
          </div>
        </div>
      </div>
      <div class="col-md-10">
        <div class="table-responsive table-hover table-bordered">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Classroom</th>
                <th>Section</th>
                <th>Test 1</th>
                <th>Test 2</th>
                <th>Test 3</th>
                <th>Exam</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(mark, index) in marks" :key="index.id">
                <td>{{mark.student_id}}</td>
                <td>{{mark.student_name}}</td>

                <td>
                 {{mark.classroom_name}}
                </td>

                <td>
                  {{mark.section_name}}
                </td>

                <td>
                  <div>
                    <label @click="edittestone(mark)" v-if="!mark.edit">{{mark.testone}}</label>
                    <input
                      class="form-control form-control-sm"
                      v-focus
                      v-else
                      style="border: 0px"
                      @keyup.enter="testone(mark)"
                      @keyup.esc="canceledit(mark)"
                      type="number"
                      v-model="mark.testone"
                    >
                  </div>
                </td>

                <td>
                  <label v-if="!mark.edit">{{mark.testtwo}}</label>
                  <input
                    class="form-control form-control-sm"
                    v-focus
                    v-else

                    type="number"
                    @keyup.enter="testtwo(mark)"
                    @keyup.esc="canceledit(mark)"
                    v-model="mark.testtwo"
                  >
                </td>
                <td>
                  <label  v-if="!mark.edit">{{mark.testthree}}</label>
                  <input
                    class="form-control form-control-sm"
                    v-focus
                    v-else

                    type="number"
                    @keyup.enter="testthree(mark)"
                    @keyup.esc="canceledit(mark)"
                    v-model="mark.testthree"
                  >
                </td>
                <td>
                  <label  v-if="!mark.edit">{{mark.exam}}</label>
                  <input
                    class="form-control form-control-sm"
                    v-focus
                    v-else
                    type="number"
                    v-model="mark.exam"

                    @keyup.enter="exam(mark)"
                    @keyup.esc="canceledit(mark)"
                  >
                </td>
                <td>
                    <button class="btn btn-sm btn-outline-info" @click="edittestone(mark)">
                    edit</button>
                    <button  class="btn btn-sm btn-outline-success" @click="save(mark)"> Save
                    </button>

                </td>
              </tr>
            </tbody>
          </table>
          <!-- <p>{{marks}}</p> -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      subject: "",
      classrooms: "",
      sections: "",
      classroom: "",
      section: "",
      marks: [],
      here: [],
      show: false,
      test_one:'',
      test_two: "",
      test_three: "",
      editcache: "",
      cachetestone: "",
      cachetesttwo: "",
      cachethree: ""
    };
  },
  directives: {
    focus: {
      inserted: function(el) {
        el.focus();
      }
    }
  },

  created() {
    this.$store.dispatch("loadsubjects");
    // this.$store.dispatch("loadclassrooms");
  },
  computed: {
    subjects() {
      return this.$store.state.subjects;
    }
  },
  methods: {
    fetchclass() {
      axios
        .get("/fetchclass/" + this.subject)
        .then(({ data }) => (this.classrooms = data));
    },
    search() {
      axios
        .get("/search/" + this.classroom)
        .then(({ data }) => (this.sections = data));
    },

    fetchmarks() {
      axios
        .get("/fetchmarks/", {
          params: {
            subject: this.subject,
            classroom: this.classroom,
            section: this.section
          }
        })
        .then(({ data }) => (this.marks = data));
      // this.marks.push({
      //     editing:false
      // })
    },
    testone(mark) {
      axios
        .post("/testone", { testone: mark.testone, id: mark.id })
        .then(response => {
          this.$bvToast.toast("Test One Saved", {
            title: mark.student_name,
            variant: "success",
            solid: true
          });
          mark.edit = false;
        })
        .catch(() => {
          this.$bvToast.toast("An error occured ", {
            title: "Error",
            variant: "danger",
            solid: true
          });
        });
    },
    save(mark) {
        axios.post("/save", {testtwo: mark.testtwo, testone: mark.testone, testthree: mark.testthree, exam: mark.exam, id:mark.id})
        .then(response => {
            this.$bvToast.toast(" Saved ", {
            title: mark.student_name,
            variant: "success",
            solid: true
        });
        mark.edit = false
        })
        .catch(() => {
          this.$bvToast.toast("An error occured ", {
            title: "Error",
            variant: "danger",
            solid: true
          });
        });

    },
    testthree(mark) {
        axios.post("/testthree", {testthree: mark.testthree, id:mark.id})
        .then(responce => {
        this.$bvToast.toast("Test Three Saved", {
        title: mark.student_name,
        variant: "success",
        solid: true
        });
        mark.edit = false
        })
         .catch(() => {
          this.$bvToast.toast("An error occured ", {
            title: "Error",
            variant: "danger",
            solid: true
          });
        });
    },
    exam(mark){
        axios.post("/exam", {exam: mark.exam, id: mark.id})
        .then(response => {
            this.$bvToast.toast("Exam Saved", {
            title: mark.student_name,
            variant: "success",
            solid: true
          });
          mark.edit = false;
        })
        .catch(() => {
          this.$bvToast.toast("An error occured ", {
            title: "Error",
            variant: "danger",
            solid: true
          });
        });
    },
    edittestone(mark) {
      mark.edit = true;
      this.cachetestone = mark.testone;
    },
    // edittesttwo(mark) {
    //   mark.edit = true;
    //   this.cachetesttwo = mark.testtwo;
    // },
    // edittestthree(mark) {
    //   mark.edit = true;
    //   this.cachetestthree = mark.testthree;
    // },
    // editexam(mark) {
    //   mark.edit = true;
    //   exam = mark.exam;
    // },
    // canceledit(mark) {
    //   mark.edit = false;
    //   mark.testone = this.cachetestone;
    // }
  }
};
</script>
