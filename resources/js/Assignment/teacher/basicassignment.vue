<template>
  <div>
    <div class="card">
      <div class="card-header">Manage Assignments</div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header p-1 m-0 bg-primary text-white">Create a quick Assignment</div>
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label>Enter Assignment Question(s)</label>
                      <textarea
                        name="question"
                        class="form-control"
                        v-model="quick.question"
                        :class="{'is-invalid':quick.errors.has('question')}"
                        placeholder="Enter Assignment"
                        cols="30"
                        rows="10"
                      ></textarea>
                      <has-error :form="quick" field="question"></has-error>
                    </div>
                    <div class="form-group">
                      <label>Enter instructions</label>
                      <textarea
                        class="form-control"
                        v-model="quick.instruction"
                        :class="{'is-invalid':quick.errors.has('instruction')}"
                        name="instruction"
                        placeholder="instructions"
                      ></textarea>
                      <has-error :form="quick" field="instruction"></has-error>
                    </div>
                    <label>due date</label>
                    <input
                      type="date"
                      v-model="quick.duedate"
                      name="duedate"
                      :class="{'is-invalid':quick.errors.has('duedate')}"
                      class="form-control form-control-sm"
                    />
                    <has-error :form="quick" field="duedate"></has-error>
                  </div>

                  <div class="col">
                    <div class>
                      <div class="card p-3">
                        <div class="form-group">
                          <label>Select Subject</label>
                          <select
                            @change="fetchclass"
                            v-model="quick.subject"
                            class="form-control form-control-sm"
                            name="subject"
                            :class="{'is-invalid':quick.errors.has('subject')}"
                          >
                            <option
                              v-for="subject in subjects"
                              :key="subject.subject_id"
                              :value="subject.subject_id"
                            >{{subject.subject}}</option>
                          </select>
                          <has-error :form="quick" field="subject"></has-error>
                        </div>
                        <div class="form-group">
                          <label>select classroom</label>
                          <select
                            @change="search"
                            class="form-control form-control-sm"
                            name="classroom"
                            :class="{'is-invalid':quick.errors.has('classroom')}"
                            v-model="quick.classroom"
                          >
                            <option
                              v-for="classroom in classrooms"
                              :key="classroom.class_id"
                              :value="classroom.class_id"
                            >{{classroom.classroom}}</option>
                          </select>
                          <has-error :form="quick" field="classroom"></has-error>
                        </div>
                        <div class="form-group">
                          <label>select section</label>
                          <v-select
                            multiple
                            label="name"
                            v-model="quick.section"
                            :options="sections"
                            :reduce="sections => sections.sect_id"
                          ></v-select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer bg-light">
                <button
                  class="float-right btn btn-outline-info"
                  :disabled="quick.busy"
                  @click="storebasic"
                >save</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      quick: new Form({
        question: "",
        instruction: "",
        classroom: "",
        section: "",
        duedate: "",
        subject: ""
      }),
      classrooms: "",
      sections: [],
      subjects: ""
    };
  },
  created() {
    this.$Progress.start();
    axios
      .get("/teachers/subjectlist")
      .then(({ data }) => (this.subjects = data))
      .catch(e => {
        Toast.fire({
          type: "error",
          title: "Contact Admin",
          timer: 9000
        });
      });
  },
  methods: {
    fetchclass() {
      this.$Progress.start();
      axios
        .get("/teachers/getclassroom", {
          params: {
            subject: this.quick.subject
          }
        })
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
        .get("/teachers/getsection", {
          params: {
            classroom: this.quick.classroom,
            subject: this.quick.subject
          }
        })
        .then(({ data }) => (this.sections = data));
    },
    storebasic() {
      this.$Progress.start();
      this.quick
        .post("/teachers/storebasic")
        .then(response => {
          Toast.fire({
            type: "success",
            title: "Basic Assignment Saved!"
          });
        })
        .catch(e => {
          Toast.fire({
            type: "error",
            title: "Fill the input field correctly",
            timer: 6000
          });
          this.$Progress.fail();
        });
    }
  }
};
</script>

<style>
</style>
