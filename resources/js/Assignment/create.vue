<template>
  <div>
    <!-- tool bar -->
    <form @sumbit.prevent="storecbt" @keydown="form.onKeydown($event)">
      <!-- <alert-error :form="form"></alert-error> -->

      <div class="card">
        <div class="row">
          <div class="col text-center">
            <label class>Select Subject</label>
            <select
              required
              class="form-control form-control-sm"
              name="subject"
              :class="{'is-invalid':form.errors.has('subject')}"
              v-model="form.subject"
              @change="fetchclass"
            >
              <option
                v-for="subject in subjects"
                :key="subject.id"
                :value="subject.id"
              >{{subject.name}}</option>
            </select>
            <has-error :form="form" field="subject"></has-error>
          </div>
          <div class="col text-center">
            <label>Select Classroom</label>
            <select
              required
              class="form-control form-control-sm"
              name="classroom"
              :class="{'is-invalid':form.errors.has('classroom')}"
              v-model="form.classroom"
              @change="search"
            >
              <option
                v-for="classroom in classrooms"
                :key="classroom.id"
                :value="classroom.id"
              >{{classroom.name}}</option>
            </select>
            <has-error :form="form" field="classroom"></has-error>
          </div>
          <div class="col text-center">
            <label>Select section</label>
            <!-- <input   v-model="form.section"  name="section"
            :class="{'is-invalid':form.errors.has('section')}" />-->

            <v-select
              multiple
              label="name"
              v-model="form.section"
              :options="sections"
              :reduce="sections => sections.id"
            >
              <template #search="{attributes, events}">
                <input
                  class="vs__search"
                  :required="!form.section"
                  v-bind="attributes"
                  v-on="events"
                />
              </template>
            </v-select>
            <!-- <alert-error.section ></alert-error.section> -->
          </div>
          <div class="col text-center">
            <label>Due date</label>
            <input
              type="date"
              name="duedate"
              :class="{'is-invalid':form.errors.has('duedate')}"
              v-model="form.duedate"
              class="form-control form-control-sm"
            />
            <has-error :form="form" field="duedate"></has-error>
          </div>
          <div class="col text-center">
            <label>Assignment code/ Identification</label>
            <input
              :class="{'is-invalid':form.errors.has('code')}"
              class="form-control form-control-sm"
              v-model="form.code"
              name="code"
              required
            />
            <has-error :form="form" field="code"></has-error>
          </div>
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-6">
        <label v-show="editmode">You are editing question number ({{number}})</label>
        <textarea v-model="question" placeholder="Type question here"  rows="20" cols="70" class="form-control form-control-sm">

        </textarea>
        <div class="row mt-4">
          <div class="col">
            <b-form-radio
              v-model="selected"
              id="1"
              @change="option('optionA')"
              name="some-radios"
              value="A"
            >Option A</b-form-radio>
            <textarea
              v-model="optionA"
              ref="optionA"
              class="my-size my-border form-control form-control-lg text-size-2"
            ></textarea>
          </div>
          <div class="col">
            <b-form-radio
              v-model="selected"
              @change="option('optionB')"
              id="optionB"
              name="some-radios"
              value="B"
            >Option B</b-form-radio>
            <textarea
              v-model="optionB"
              id="optionB"
              ref="optionB"
              class="my-size aa form-control form-control-lg"
            ></textarea>
          </div>
          <div class="col">
            <b-form-radio
              v-model="selected"
              @change="option('optionC')"
              name="some-radios"
              value="C"
            >Option C</b-form-radio>
            <textarea
              v-model="optionC"
              id="optionC"
              ref="optionC"
              class="my-size bb form-control form-control-lg"
            ></textarea>
          </div>
          <div class="col">
            <b-form-radio
              v-model="selected"
              @change="option('optionD')"
              name="some-radios"
              value="D"
            >Option D</b-form-radio>
            <textarea
              v-model="optionD"
              id="optionD"
              ref="optionD"
              class="my-size cc form-control form-control-lg"
            ></textarea>
          </div>
        </div>
        <div v-if="editmode == false">
          <button class="btn btn-outline-info mt-3" :disabled="btn" @click="createquestion">
            <i class="fas fa-plus"></i>Add
          </button>
        </div>
        <div v-else>
          <button class="btn btn-outline-success mt-3" :disabled="btn" @click="updatequestion">
            <i class="fas fa-upload mr-2"></i>Update question
          </button>
          <a
            class="btn btn-danger btn-circle rounded-circle ml-1 mt-3"
            @click="canceledit"
            role="button"
          >
            <i class="far fa-window-close text-white"></i>
          </a>
        </div>

      </div>
      <div class="col">
        <div class="card-header bg-secondary">
            <div class="row w-50">
            <label class="ml-1">
              List of Question(s)
          </label>
          <b-form-checkbox v-model="checkbox"  name="check-button" class=" ml-2 w-50"  switch>
              <b> {{ check ? 'Accessisble by students' :'Not Accessible by students' }}</b>
             </b-form-checkbox>
            </div>

          <!-- <p>{{form.questions}}</p> -->
          <div class="card-tools">
            <button
              type="submit"
              :disabled="form.busy"
              class="btn btn-sm btn-success text-white "
              @click="storecbt"
            >Save Questions</button>
            <button class="btn btn-sm btn-danger" @click="deletequestion('all')">Delete all</button>
          </div>
        </div>
        <div class="card overflow-auto h-75 width-100">
          <div class="row mt-2 block">
            <div class="col-2">
              <label>Search :</label>
            </div>
            <div class="col">
              <input
                class="form-control form-control-sm"
                placeholder="Enter the question"
                v-model="findquestion"
              />
            </div>
          </div>

          <ul class="list-group overflow-auto">
            <li class="list-group-item" v-for="(q, index) in filteredquestions" :key="index">
              <div class="row">
                <div class="col">
                  <label class="inline">({{index + 1}})</label>
                </div>
                <div class="col">
                  <button
                    v-b-tooltip.hover
                    placement="left"
                    @click="editquestion(index)"
                    title="Edit question"
                    class="btn btn-sm btn-outline-success float-right ml-2"
                  >
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                  <button
                    v-b-tooltip.hover
                    placement="topright"
                    @click="deletequestion(index)"
                    title="Delete Question"
                    class="btn btn-sm btn-outline-danger float-right"
                  >
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>

              <p class="inline" v-html="q.question"></p>
              <label>Answer: {{q.answer}}</label>
              <div class="row">
                <div class="col">
                  <label>(a)</label>
                  <label class="col-form-label">{{q.A}}</label>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label>(b)</label>
                  <label class="col-form-label">{{q.B}}</label>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label>(c)</label>
                  <label class="col-form-label">{{q.C}}</label>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label>(d)</label>
                  <label class="col-form-label">{{q.D}}</label>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- <p>{{cats}}</p> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        questions: [],
        code: "",
        duedate: "",
        subject: "",
        purpose: "",
        classroom: "",
        section: ""
      }),
      classrooms: "",
      sections: [],
      question: "",
      optionA: "",
      optionB: "",
      optionC: "",
      optionD: "",
      selected: "A",
      number: null,
      name: "here",
      filterquestion: "",
      findquestion: "",
      checkbox:''

    };
  },
  methods: {
    access(){
        if(this.checkbox == true){
            this.form.purpose == 'assign'

        }
        else if(this.checkbox == false){
            this.form.purpose = ''
        }
    },
    resetform() {
      this.question = "";
      this.optionA = "";
      this.optionB = "";
      this.optionC = "";
      this.optionD = "";
    },
    createquestion() {
      this.$Progress.start();
      this.form.questions.push({
        question: this.question,
        A: this.optionA,
        B: this.optionB,
        C: this.optionC,
        D: this.optionD,
        answer: this.selected
      });
      this.number = null;
      this.savequestion();
      this.$Progress.finish();
      this.resetform();
    },
    editquestion(index) {
      this.question = this.filteredquestions[index].question;
      this.optionA = this.filteredquestions[index].A;
      this.optionB = this.filteredquestions[index].B;
      this.optionC = this.filteredquestions[index].C;
      this.optionD = this.filteredquestions[index].D;
      this.selected = this.filteredquestions[index].answer;
      this.number = index + 1;
      this.savequestion();
    },
    canceledit() {
      this.number = null;
      this.resetform();
    },
    updatequestion() {
      let index = this.number - 1;
      this.filteredquestions[index].question = this.question;
      this.filteredquestions[index].A = this.optionA;
      this.filteredquestions[index].B = this.optionB;
      this.filteredquestions[index].C = this.optionC;
      this.filteredquestions[index].D = this.optionD;
      this.filteredquestions[index].answer = this.selected;
      this.form.number = null;
      this.savequestion();
      Toast.fire({
        type: "success",
        title: "question updated "
      });
      this.resetform();
    },
    option(id) {
      let options = ["optionA", "optionB", "optionC", "optionD"];
      let h = options.indexOf(id);
      // console.log(h)
      options.forEach(element => {
        this.$refs[element].classList.remove("my-border");
      });
      this.$refs[id].className = "my-border";
      // console.log(this.$refs[id].className = "my-border")
      // console.log(this.$refs)
    },
    deletequestion(index) {
      if (index == "all") {
        Swal.fire({
          title: "Are you sure?",
          text: "You are about to all the questions",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Yes"
        }).then(result => {
          if (result.value) {
            this.form.questions = [];
            localStorage.removeItem("questions");
          }
        });
      } else {
        let number = index + 1;
        Swal.fire({
          title: "Are you sure?",
          text: "You are about to delete question" + " " + number,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Yes"
        }).then(result => {
          if (result.value) {
            this.form.questions.splice(index, 1);
          }
        });
      }
    },

    savequestion() {
      const parsed = JSON.stringify(this.form.questions);
      localStorage.setItem("questions", parsed);
    },
    fetchclass() {
      this.$Progress.start();
      axios
        .get("/fetchclass/" + this.form.subject)
        .then(response => {
          this.classrooms = response.data;
          if (this.classrooms == []) {
            Toast.fire({
              type: "info",
              title: "The system isnt configured"
            });
          }
          this.$Progress.finish();
        })
        .catch(e => {
          Toast.fire({
            type: "error",
            title: "Contact Admin"
          });
          this.$Progress.fail();
        });
    },
    search() {
      axios
        .get("/search/" + this.form.classroom)
        .then(({ data }) => (this.sections = data));
    },
    storecbt() {
      if (this.form.section == "") {
        Toast.fire({
          type: "error",
          title: "Section is required",
          timer: 10000
        });
      } else {
          this.$Progress.start();
        this.form
          .post("/storecbt")
          .then(response => {
            this.$bvToast.toast("Assignment Created ", {
              title: "Sccuess",
              variant: "success",
              solid: true
            });
            this.form.questions = [];
            localStorage.removeItem("questions");
            this.$Progress.finish()
          })
          .catch(e => {
            // console.log(e.response)
            Toast.fire({
              type: "error",
              title: e.response.data.message
            });
            this.$Progress.fail()
          });
      }
    }
  },
  mounted() {
    this.$Progress.start();
    if (localStorage.getItem("questions")) {
      try {
        this.form.questions = JSON.parse(localStorage.getItem("questions"));
        this.$Progress.finish();
      } catch (e) {
        localStorage.removeItem("questions");
        this.$Progress.fail();

        Toast.fire({
          type: "error",
          title: "No question is avaliable "
        });
      }
    }
    // asking if the question should be given to student
    Swal.fire({
      title: "Give assignment to student ?",
      text:
        " After creating the Assignment should student have access to it immediately? ",
      type: "info",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      cancelButtonText: "No"
    }).then(result => {
      if (result.value) {
        this.form.purpose = "assign"
        this.checkbox = true
      }
    });
  },
  created() {
    this.$store.dispatch("loadsubjects");
  },
  computed: {
      check(){
           if(this.checkbox == true){
           this.form.purpose = 'assign'
           console.log(this.form.purpose)
            return true
        }else if(this.checkbox == false){
          this.form.purpose = ""
          console.log(this.form.purpose)
            return false
        }
      },
    editmode() {
      if (this.number == null) {
        return false;
      } else {
        return true;
      }
    },
    btn() {
      if (
        this.question == "" ||
        this.optionA == "" ||
        this.optionB == "" ||
        this.optionC == "" ||
        this.optionD == ""
      ) {
        return true;
      } else {
        return false;
      }
    },

    filteredquestions() {
      return this.form.questions.filter((question, index) => {
        return question.question.match(this.findquestion, index);
      });

      // let filter = new RegExp(this.findquestion, 'i')
      // return this.questions.filter(el => el.match(filter))
    },

    subjects() {
      return this.$store.state.subjects;
    }
  }
};
</script>

<style>
.my-size {
  font-size: 12px;
}
.my-border {
  border-color: green;
  border-width: 5px;
}
</style>
