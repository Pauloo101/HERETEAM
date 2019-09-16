<template>
  <b-container fluid>
    <!-- User Interface controls -->
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
      show-empty
      stacked="md"
      :items="teachers"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template slot="actions" slot-scope="row">
        <div role="group" class="btn-group">
          <b-button
            variant="outline-success"
            v-b-tooltip.hover
            title="Edit"
            class="btn btn-sm"
            @click="info(row.item, row.index, $event.target)"
          >
            <i class="far fa-edit"></i>
          </b-button>
          <button class="btn btn-danger btn-sm" v-b-tooltip.hover title="Delete">
            <i class="fas fa-trash"></i>
          </button>
        </div>

        <!-- <b-button
          size="sm"
          @click="row.toggleDetails"
        >{{ row.detailsShowing ? 'Hide' : 'Show' }} Details</b-button>-->
      </template>

      <template slot="row-details" slot-scope="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul>
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

    <!-- Info modal -->
    <b-modal :id="infoModal.id" :title="infoModal.title" @hide="resetInfoModal" ref="my-modal">
      <!--<pre>{{ infoModal.content }}</pre>-->
      <!-- <p>{{infoModal.content}}j</p> -->
      <div class="form-group">
        <label>First Name</label>
        <input class="form-control form-control-sm" :value="infoModal.content.first_name">
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input class="form-control form-control-sm" :value="infoModal.content.last_name">
      </div>
      <div class="form-group">
        <label>User Name</label>
        <input class="form-control form-control-sm" :value="infoModal.content.user_name">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input class="form-control form-control-sm" :value="infoModal.content.email">
      </div>

      <template slot="modal-footer" slot-scope="{ cancel }">
        <!-- Emulate built in modal footer ok and cancel button actions -->

        <b-button size="sm" variant="danger" @click="cancel()">Cancel</b-button>
        <!-- Button with custom close trigger value -->
        <b-button size="sm" variant="outline-success" @click="update()">Update</b-button>
      </template>
    </b-modal>
  </b-container>
</template>
<script>
export default {
  data() {
    return {
      fields: [
        {
          key: "first_name",
          label: "First Name",
          sortable: true,
          sortDirection: "desc"
        },
        {
          key: "last_name",
          label: "Last Name",
          sortable: true,
          class: "text-center"
        },
        {
          key: "user_name",
          label: "User Name",
          sortable: true,
          class: "text-center"
        },
        { key: "email", label: "Email", sortable: true, class: "text-center" },
        // { key: "gender", label: "Gender", class: "text-center" },
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
  computed: {
    teachers() {
      return this.$store.state.teachers;
    }
  },
  created() {
    this.$store.dispatch("loadteachers");
  },
  methods: {
    info(item, index, button) {
      this.infoModal.title = `Update : ${item.first_name}`;
      this.infoModal.content = item;
      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    update() {
      console.log("here");
      this.$refs["my-modal"].hide();
    }
  }
};
</script>

