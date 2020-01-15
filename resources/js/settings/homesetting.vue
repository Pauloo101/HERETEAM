<template>
  <div>
       <div class="card shadow border-danger py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col">
                        <div class="text-uppercase text-danger font-weight-bold text-xs mb-1"><span>Current Settings</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{settings.session_name}} {{settings.term_name}}</span></div>
                    </div>

                    <div class="col-auto"><i class="fas fa-cogs fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            settings:''
        }
    },
    created() {
        axios.get('/getactivesettings')
        .then((response) => {
            this.settings = response.data
        }).catch((err) => {

        });
    },
}
</script>

<style>

</style>
