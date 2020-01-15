<template>
  <div>
    <div class="card">
      <div class="card-body">
        <form @submit.prevent="promotetoterm" @keydown="form.onKeydown($event)">
          <alert-error :form="form"></alert-error>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Current session</label>
                <select class="form-control form-control-sm" v-model="session" disabled>
                  <option :value="settings.id">{{settings.session_name}}</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Select term</label>
                <select
                  class="form-control form-control-sm"
                  name="term"
                  :class="{'is-invalid':form.errors.has('term')}"
                  v-model="form.term"
                >
                  <option v-for="t in terms" :key="t.term_id" :value="t.term_id">{{t.term_name}}</option>
                </select>
                <has-error :form="form" field="term"></has-error>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                  <label>Select Classroom</label>
              <select
                class="form-control form-control-sm"
                name="classroom"
                :class="{'is-invalid':form.errors.has('classroom')}"
                v-model="form.classroom"
              >
                <option v-for="c in classrooms" :key="c.id" :value="c.id">{{c.name}}</option>
              </select>
              <has-error :form="form" field="classroom"></has-error>
              </div>
            </div>
            <div class="col text-right">
              <button class="btn btn-sn btn-outline-info" type="submit">Promote to term</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      form: new Form({
        term: "",
        classroom: ""
      }),
      settings: "",
      session: "",
      terms: ""
    };
  },
  computed: {
    classrooms() {
      return this.$store.state.classrooms;
    }
  },
  created() {
    axios
      .get("/getactivesettings")
      .then(response => {
        //   console.log(response)
        this.settings = response.data;
        this.session = this.settings.session_id;
        this.getterm();
      })
      .catch(e => {
        Toast.fire({
          type: "error",
          title: "Unable to get Active Settings"
        });
      });
  },
  methods: {
    getterm() {
      axios
        .get("/getterms", {
          params: {
            session: this.session
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
    promotetoterm(){
        this.form.post('/migratetoterm')
            .then((response) => {
                Toast.fire({
                    type:'success',
                    title:response.data
                })
            }).catch((err) => {
                Toast.fire({
                    type:'error',
                    title:'Couldnt perform operation check your input fields'
                })
            });
    }
  }
};
</script>

<style>
</style>
