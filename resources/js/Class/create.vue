<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Class.vue
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input class="shadow form-control" placeholder="Class name" type="text" style="width: 80%"/>
                            <button class="btn btn-primary" style="margin-left: 5px">Create</button>
                            <button class="btn btn-primary" style="margin-left: 5px">Show</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }}
</script>

<style scoped>

</style>