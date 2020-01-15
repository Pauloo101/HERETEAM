<template>
  <div>
    <div>
      <b-tabs content-class="mt-3" align="center">
        <b-tab title="Edit Assignment" active>
          <div class="row">
            <!-- select assignment -->
            <div class="col-3">
              <div class="card">
                <div class="card-header">Pick assignment by Topic</div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Select Subject</label>
                    <select
                      class="form-control form-control-sm"
                      @change="gettopics(subject)"
                      v-model="subject"
                    >
                      <optgroup label="Select subject">
                        <option
                          v-for="subject in subjects"
                          :key="subject.subject_id"
                          :value="subject.subject_id"
                        >{{subject.subject}}</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Select Topic</label>
                    <select
                      class="form-control form-control-sm"
                      v-model="topic"
                      @change="getquestions"
                    >
                      <optgroup label="select class">
                        <option
                          v-for="(topic, index) in topics"
                          :key="index"
                          :value="topic"
                        >{{topic}}</option>
                      </optgroup>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card">
                <div class="card-header">
                  Questions
                  <div class="card-tools">
                    <label
                      :class="stats.count == '' ? 'btn btn-danger m-0' : 'btn btn-success m-0'"
                    >{{stats.message}} {{stats.count}}</label>
                  </div>
                </div>
                <div class="card-body pt-0">
                  <div class="row mt-2 mb-2">
                    <div class="col float-left">Q.({{number + 1}})</div>
                    <div class="col float-right text-right">
                      <button class="btn btn-sm btn-outline-success">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </div>
                  <div class="row mb-3" v-if="!questions == '' ">
                    <div class="border border-success p-3">{{question.question}}</div>
                  </div>
                  <div class="row" v-if="!questions == '' ">
                    <div class="col border">
                      <div
                        :class="question.answer == 'A' ? 'p-2 bg-success block text-white' : 'bg-danger p-2 block text-white'"
                        ref="A"
                      >A</div>
                      <label>{{question.A}}</label>
                    </div>
                    <div class="col border">
                      <div
                        :class="question.answer == 'B' ? 'p-2 bg-success block text-white' : 'bg-danger p-2 block text-white'"
                        ref="B"
                      >B</div>
                      <label>{{question.B}}</label>
                    </div>
                    <div class="col border">
                      <div
                        :class="question.answer == 'C' ? 'p-2 bg-success block text-white' : 'bg-danger p-2 block text-white'"
                        ref="C"
                      >C</div>
                      <label>{{question.C}}</label>
                    </div>
                    <div class="col border">
                      <div
                        :class="question.answer == 'D' ? 'p-2 bg-success block text-white' : 'bg-danger p-2 block text-white'"
                        ref="D"
                      >D</div>
                      <label>{{question.D}}</label>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <button
                      type="button"
                      v-for="(no, index) in numbers"
                      @click="change(index)"
                      :key="index"
                      class="btn btn-outline-primary"
                    >{{no}}</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="card">
                <div class="card-header">Class and student that can access this assignment</div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Classroom</label>
                    <select class="form-control form-control-sm" v-model="classroom">
                      <option
                        v-for="classroom in classrooms"
                        :key="classroom.id"
                        :value="classroom.id"
                      >{{classroom.name}}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Section</label>
                    <select class="form-control form-control-sm">
                      <option></option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" class="form-control form-control-sm" v-model="due" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </b-tab>
        <b-tab title="Manage Assignments">
          <div class="row">
            <div class="col-md-3">
              <quick-manage></quick-manage>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header">Assignment Record(s)</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                        <label>Select Subject</label>
                        <select
                          class="form-control form-control-sm"
                          @change="gettopics(manage.subject)"
                          v-model="manage.subject"
                        >
                          <optgroup label="Select subject">
                            <option
                              v-for="subject in subjects"
                              :key="subject.subject_id"
                              :value="subject.subject_id"
                            >{{subject.subject}}</option>
                          </optgroup>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Select Topic</label>
                        <select
                          class="form-control form-control-sm"
                          v-model="manage.topic"

                        >
                          <optgroup label="select class">
                            <option
                              v-for="(topic, index) in topics"
                              :key="index"
                              :value="topic"
                            >{{topic}}</option>
                          </optgroup>
                        </select>
                      </div>
                    </div>
                    <div class="col">
                      <b-container fluid>
                        <div class="row text-center">
                          <div class="col">
                            <label>Subject:</label>
                            <label>{{subject.subject}}</label>
                          </div>
                          <div class="col">
                            <label>Class: {{subject.classroom}}</label> &nbsp;
                            <label>Section: {{subject.section}}</label>
                          </div>
                        </div>
                        <b-row>
                          <b-col md="6" class="my-1">
                            <b-form-group label-cols-sm="3" label="Filter" class="mb-0">
                              <b-input-group>
                                <b-form-input v-model="filter" placeholder="Type to Search"></b-form-input>
                                <b-input-group-append>
                                  <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                                </b-input-group-append>
                              </b-input-group>
                            </b-form-group>
                          </b-col>

                          <b-col md="6" class="my-1">
                            <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
                              <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
                            </b-form-group>
                          </b-col>
                        </b-row>
                        <b-table
                          striped
                          hover
                          show-empty
                          small
                          stacked="md"
                          :items="manage.students"
                          :fields="fields"
                          :current-page="currentPage"
                          :per-page="perPage"
                          :filter="filter"
                          :sort-by.sync="sortBy"
                          :sort-desc.sync="sortDesc"
                          :sort-direction="sortDirection"
                          @filtered="onFiltered"
                        >
                          <template v-slot:cell(actions)="row">
                            <!-- <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
                         Info modal
                            </b-button>-->
                            <b-button
                              size="sm"
                              @click="row.toggleDetails"
                            >{{ row.detailsShowing ? 'Cancel' : 'Edit' }}</b-button>
                          </template>
                          <!-- <template v-slot:row-details="row">
                            <b-card>
                              <div class="row">
                                <div class="col">
                                  <label>Test One</label>
                                  <input
                                    class="form-control"
                                    :placeholder="row.item.testone"
                                    v-model="testone[row.item.id]"
                                    type="number"
                                  />
                                </div>
                                <div class="col">
                                  <label>Test Two</label>
                                  <input
                                    class="form-control"
                                    :placeholder="row.item.testtwo"
                                    v-model="testtwo[row.item.id]"
                                    type="number"
                                  />
                                </div>
                                <div class="col">
                                  <label>Test Three</label>
                                  <input
                                    class="form-control"
                                    :placeholder="row.item.testthree"
                                    v-model="testthree[row.item.id]"
                                    type="number"
                                  />
                                </div>
                                <div class="col">
                                  <label>Exam</label>
                                  <input
                                    class="form-control"
                                    :placeholder="row.item.exam"
                                    v-model="exam[row.item.id]"
                                    type="number"
                                  />
                                </div>
                              </div>

                              <div class="row mt-3">
                                <div class="col text-right">
                                  <button
                                    class="btn btn-outline-success"
                                    @click="saverecord(row)"
                                  >Save</button>
                                </div>
                              </div>
                            </b-card>
                          </template> -->
                        </b-table>

                        <b-row>
                          <b-col md="6" class="my-1">
                            <b-pagination
                              v-model="currentPage"
                              :total-rows="totalRows"
                              :per-page="perPage"
                              class="my-0"
                            ></b-pagination>
                          </b-col>
                        </b-row>

                        <!-- get modal -->
                        <b-modal
                          :id="infoModal.id"
                          :title="infoModal.title"
                          ok-only
                          @hide="resetInfoModal"
                        >
                          <pre>{{ infoModal.content }}</pre>
                        </b-modal>
                      </b-container>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </b-tab>
      </b-tabs>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      subjects: "",
      questions: "",
      subject: "",
      topics: "",
      topic: "",
      number: 0,
      classroom: "",
      stats: "",
      due: "",
      manage: {
        subjects: "",
        subject: "",
        topics: "",
        topic: "",
        students: []
      },
      fields:[
          {
              key:'first_name',
              label:'First Name',
              sortable:true,
              sortDirection:"desc"
          },
          {
              key:'surname',
              label:'Surname',
              sortable:true,
              sortDirection:'desc'
          },
          {
              key:'score',
              label:'Score',
              sortable:true,
              sortDirection:'desc'
          },
          {
              key:'status',
              label:"Status",
              sortable:true,
              sortDirection:'desc'
          }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: "5",
      pageOptions: [5, 10, 15, 20],
      sortBy: null,
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      infoModal: {
        id: "info-modal",
        title: "",
        content: ""
      }
    };
  },
  created() {
    this.$Progress.start();
    axios
      .get("/teachers/subjectlist")
      .then((response)=>{
          this.subjects = response.data
          this.manage.subjects = response.data
      })
      .catch(e => {
        Toast.fire({
          type: "error",
          title: "Contact Admin",
          timer: 9000
        });
      });
    this.$store.dispatch("loadclassrooms");
  },
  methods: {
    gettopics(subject) {
      axios
        .get("/teachers/gettopics", {
          params: {
            subject: subject
          }
        })
        .then((response)=>{
            this.topics = response.data
            this.manage.topics = response.data
        });
    },
    getquestions() {
      axios
        .get("/teachers/getquestions", {
          params: {
            topic: this.topic
          }
        })
        .then(response => {
          this.questions = response.data;
          this.classroom = this.questions[0].classroom_id;
          this.assignmentstats();
        });
    },
    change(index) {
      this.number = index;
    },
    assignmentstats() {
      axios
        .get("/teachers/assignmentstats", {
          params: {
            topic: this.topic
          }
        })
        .then(response => {
          this.stats = response.data;
          this.due = this.stats.due;
        });
    },
    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`;
      this.infoModal.content = item;
      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
      this.newquantity = "";
      this.newprice = "";
    },
    resetdeleteModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    }
  },
  // created() {
  //     // if () {

  //     // }
  // },
  computed: {
    question() {
      let i = this.number;
      return this.questions[i];
    },
    numbers() {
      return this.questions.length;
    },
    anwser() {
      let option = this.question.anwser;
      // this.$refs[element].classList.remove("my-border");
      this.$refs.option.className = "bg-sccuess";
    },
    classrooms() {
      return this.$store.state.classrooms;
    },
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key };
        });
    }
  },
//   updated() {
//     if (this.question) {
//     }
//   }
};
</script>

<style>
</style>
