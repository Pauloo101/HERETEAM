<template>
  <div class="pt-3">
    <div>
      <ul class="nav nav-tabs nav-pills justify-content-center mb-3">
        <li class="nav-item">
          <a class="nav-link active" role="tab" data-toggle="tab" href="#v-pills-home">Edit by class</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" role="tab" data-toggle="tab" href="#v-pills-profile">Edit by student</a>
        </li>
      </ul>

      <div class>
        <div class="tab-content" id="v-pills-tabContent" style="background-color:#DFE2E6">
          <div
            class="tab-pane fade show active"
            id="v-pills-home"
            role="tabpanel"
            aria-labelledby="v-pills-home-tab"
          >
            <edit-subject></edit-subject>
          </div>
          <div
            class="tab-pane fade"
            id="v-pills-profile"
            role="tabpanel"
            aria-labelledby="v-pills-profile-tab"
          >
            <edit-student></edit-student>
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

      }
  },
  created() {
      this.$store.dispatch("loadsubjects")
  },

};
</script>

<style>
</style>
