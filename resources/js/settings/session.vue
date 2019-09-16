<template>
  <div class="card m-0">
    <div class="card-header">
      session
      <div class="card-tools">
        <div>
          <button
            v-b-modal.modal-center
            v-b-tooltip.hover
            title="create session"
            class="btn btn-outline-success btn-sm"
          >
            <i class="fas fa-plus"></i>
          </button>
          <b-modal
            ref="session"
            id="modal-center"
            @ok="handleok"
            size="sm"
            centered
            title="Create Session"
          >
            <div class="form-group">
              <input
                class="form-control form-control-sm mb-2"
                v-model="form.session"
                name="session"
                :class="{'is-invalid':form.errors.has('session')}"
                placeholder="name would show here"
                disabled
              >
              <has-error :form="form" field="session"></has-error>
            </div>

            <p v-show="false">{{name}}</p>
            <div class="form-group">
              <label>Started at</label>
              <date-picker v-model="started_at" lang="en" type="year" format="YYYY"></date-picker>
            </div>
            <div class="form-group">
              <label class="mr-3">End at</label>
              <date-picker v-model="end_at" lang="en" type="year" format="YYYY"></date-picker>
            </div>
          </b-modal>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Session</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="temp in sessions" :key="temp.id">
              <td>{{temp.session}}</td>
              <td>
                <button class="btn btn-primary" type="button">
                  <i class="far fa-edit"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import DatePicker from "vue2-datepicker";

export default {
  components: { DatePicker },

  data() {
    return {
      started_at: new Date(),
      end_at: new Date(),
      form: new Form({
        session: ""
      })
    };
  },
  computed: {
    jum() {
      return this.started_at.getFullYear();
    },
    hum() {
      return this.end_at.getFullYear();
    },
    name() {
      this.form.session = this.jum + "/" + this.hum;
      return this.form.session;
    },
    sessions(){
        return this.$store.state.sessions;
    }
  },
  mounted() {},
  methods: {
    handleok(bvModalEvt) {
      bvModalEvt.preventDefault();
      this.form
        .post("/session")
        .then(() => {
          this.$refs["session"].hide();
          this.$bvToast.toast("Session created", {
            title: "Action Successful",
            variant: "success",
            solid: true
          });
          Fire.$emit('session')
        })
        .catch(() => {
          this.$bvToast.toast("An error Occured", {
            title: "Error",
            variant: "danger",
            solid: true
          });
        });
    },


  },
  created() {
     this.$store.dispatch("loadsessions");
     Fire.$on('session', () => {
                this.$store.dispatch("loadsessions");
            });
  }
};
</script>
