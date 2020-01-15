<template>
  <div class="row ml-3 mr-3">
    <div class="col-md-8 col-sm-12">
      <b-container fluid>
        <!-- User Interface controls -->
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

        <!-- Main table element -->
        <b-table
          striped
          hover
          show-empty
          small
          stacked="md"
          :items="students"
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

          <template v-slot:row-details="row">
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
                  <button class="btn btn-outline-success" @click="saverecord(row)">Save</button>
                </div>
              </div>
            </b-card>
          </template>
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
        <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
          <pre>{{ infoModal.content }}</pre>
        </b-modal>
      </b-container>
    </div>
    <div class="col-md-4 col-sm-12">
      <ul class="list-group">
        <li class="list-group-item bg-info">
          <div>
            <span class="float-left m-auto">Subject</span>
            <span class="float-right">(section)</span>
            <span class="float-right">Classroom</span>
          </div>
        </li>
        <!-- <li v-for="subject in subjects" :key="subject.subject_id + subject.classroom_id + subject.section" class="list-group-item list-group-item-action">
                <button @click="wired(subject)" class="btn btn-block m-0">
                    <span class="float-left m-auto">{{subject.subject}}</span>
                    <span class="float-right">{{subject.section}}</span>
                    <span class="float-right">{{subject.classroom}}</span>
                </button>
        </li>-->
        <li
          v-for="subject in subjects"
          :key="subject.subject_id"
          class="list-group-item list-group-item-action"
        >
          <div class="row">
            <div class="col">
              <span>{{subject.subject.subject}}</span>
            </div>
            <div class="col-8">
              <span v-for="(why , index) in subject.classroom" :key="index">
                <button class="btn btn-sm btn-primary mr-1 mb-1" @click="wired(subject.subject.subject ,subject.subject.subject_id , subject.classroom[index].class_id, subject.classroom[index].sect_id,
                 subject.classroom[index].classroom,
                 subject.classroom[index].section)">

                  {{subject.classroom[index].classroom}}
                  {{subject.classroom[index].section}}
                </button>
              </span>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      subjects: "",
      subject: "",
      students: [],
      testone: [],
      testtwo: [],
      testthree: [],
      exam: [],
      request: {},

      fields: [
        {
          key: "student_name",
          label: "Student",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "testone",
          label: "Test One",
          sortable: true,
          class: "text-center"
        },
        { key: "testtwo", label: "Test Two", class: "text-center" },
        {
          key: "testthree",
          label: "Test Three",
          sortable: true,
          class: "text-center"
        },
        { key: "exam", label: "Exam", sortable: true, class: "text-center" },
        { key: "actions", label: "Actions" }
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
    axios
      .get("/teachers/teacher-subject")
      .then(({ data }) => (this.subjects = data))
      .catch(e => {
        console.log(e);
      });
  },
  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key };
        });
    }
  },
  methods: {
    wired(name, subject, classroom_id, section_id, classroom, section) {
      this.request.subject = name
      this.request.subject_id = subject
      this.request.classroom_id=classroom_id
      this.request.section_id=section_id
      this.request.classroom = classroom
      this.request.section = section
        //   console.log(this.request);
      this.fetchrecord();
    },
    fetchrecord() {
      this.subject = this.request;
      axios
        .get("/fetchmarks/", {
          params: {
            subject: this.request.subject_id,
            classroom: this.request.classroom_id,
            section: this.request.section_id
          }
        })
        .then(({ data }) => (this.students = data));
    },
    saverecord(row) {
      let id = row.item.id;
      //    this.request = subject;
      axios
        .post("/teachers/saverecord", {
          testone: this.testone[id],
          testtwo: this.testtwo[id],
          testthree: this.testthree[id],
          exam: this.exam[id],
          id: id
        })
        .then(response => {
          this.$bvToast.toast("Record(s) saved!", {
            title: "Success",
            variant: "success",
            solid: true
          });
          this.fetchrecord();
        })
        .catch(() => {
          this.$bvToast.toast("Check your input fields", {
            title: "Error",
            variant: "danger",
            solid: true
          });
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
  }
};
</script>

<style>
</style>
