<template>
  <div class="card m-0">
    <div class="card-header">
      Term
      <div class="card-tools">
        <div>
          <button
            v-b-modal.term
            v-b-tooltip.hover
            title="create term"
            class="btn btn-outline-success btn-sm"
          >
            <i class="fas fa-plus"></i>
          </button>
          <b-modal ref="term" id="term" size="sm" centered title="Create Term" @ok="handleok">
            <div class="form-group">
              <label>Term</label>
              <input
                class="form-control form-control-sm"
                :class="{'is-invalid':form.errors.has('name')}"
                placeholder="Term"
                v-model="form.name"
                name="name"
              >
              <has-error :form="form" field="name"></has-error>
            </div>
            <div class="form-group">
                 <label>Started at</label>
              <date-picker v-model="started_at" lang="en" type="month" format="YYYY-MM"></date-picker>
               <label class="mr-3">End at</label>
              <date-picker v-model="end_at" lang="en" type="month" format="YYYY-MM"></date-picker>
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
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="temp in terms" :key="temp.id">
              <td>{{temp.name}}</td>
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
export default {
  data() {
    return {
        started_at:new Date(),
        end_at:new Date(),
      form: new Form({
        name: "",
        started_at:'',
        ended_at:'',
      })
    };
  },
  computed: {
      terms(){
          return this.$store.state.terms;
      },
      getstartyear() {
      return this.started_at.getFullYear();
    },
    getstartmonth(){
      return this.started_at.toLocaleString('default', { month: 'long' });
    },
    getendmonth(){
        return this.end_at.toLocaleString('default', { month: 'long' });
    },
    getendyear() {
      return this.end_at.getFullYear();
    },
    details(){
        let start = this.getstartmonth + " "+ this.getstartyear
        let end = this.getendmonth + " " + this.getendyear
         this.form.started_at = start
         this.form.ended_at = end
         return details;
    }
  },
  mounted() {},
  methods: {
    handleok(bvModalEvt) {
      bvModalEvt.preventDefault();
      this.form
        .post("/term")
        .then(() => {
          this.$refs["term"].hide();
          this.$bvToast.toast("Term Created", {
            title: "Action Successful",
            variant: "success",
            solid: true
          });
          Fire.$emit("term");
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
   this.$store.dispatch("loadterms");
    Fire.$on("term", () => {
      this.$store.dispatch("loadterms");
    });

  }
};
</script>
