<template>
  <div class="card">
    <div class="card-header">
      Set Active term and session
      <div class="card-tools">
        <button
          v-b-modal.active
          v-b-tooltip.hover
          title="Register term and session"
          class="btn btn-outline-success btn-sm"
        >
          <i class="fas fa-plus"></i>
        </button>

        <b-modal
          ref="session"
          id="active"
          @ok="handleok"
          centered
          title="Register term and session"
        >
          <div class="form-group">
            <label>Select Session</label>
            <select class="form-control" v-model="session" required>
                <option
                  v-for="session in sessions"
                  :key="session.id"
                  :value="session"
                >{{session.session}}</option>
            </select>
          </div>
          <div class="form-group">
            <label>Select Term</label>
            <select class="form-control" v-model="term" required>
                <option v-for="term in terms" :key="term.id" :value="term">{{term.name}}</option>
            </select>
          </div>
          <div>
            <b-form-checkbox v-model="value" :state="state" name="checkbox-validation">{{state ? 'Active' : 'inactive'}}</b-form-checkbox>
          </div>
        </b-modal>
      </div>
    </div>
    <div class="card-body p-3">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Session</th>
              <th>Term</th>
              <th>Active</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="setting in settings" :key="setting.id">
              <td>{{setting.session_name}}</td>
              <td>{{setting.term_name}}</td>
              <td>{{setting.Is_Active}}</td>
              <td>action</td>
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
        settings:'',
      value: [],
      session: "",
      term: ""
    };
  },
  computed: {
    // active() {
    //     if(this.state){
    //         return 'active'
    //     }else return 'Inactive'
    // },
    state() {
      return this.value.length === 1;
    },
    sessions() {
      return this.$store.state.sessions;
    },
    terms() {
      return this.$store.state.terms;
    }
  },
  created() {
    this.$store.dispatch("loadsessions");
    this.$store.dispatch("loadterms");
    axios.get('/getsettings')
    .then(({data})=> this.settings = data)
  },
  methods: {
    handleok() {
        axios.post('/settings',{'session':this.session, 'term':this.term, 'state':this.state})

    }
  }
};
</script>

