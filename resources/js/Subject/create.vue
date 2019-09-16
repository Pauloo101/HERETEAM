<template>
    <div>
        <div class="card-header">
            Create Subject
        </div>
        <div class="card-body">
            <form @submit.prevent="createsubject" @keydown="form.onKeydown($event)">
                <div>
                    <input placeholder="Subject name" v-model="form.name" class="form-control" name="name"
                           type="text" :class="{ 'is-invalid':form.errors.has('name')}"/>
                    <has-error :form="form" field="name"></has-error>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" style="margin-left: 5px">Create</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                form: new Form({
                    name: ''
                })
            }
        },
        methods: {
            createsubject() {
                this.form.post('/subject')
                    .then(()=>{
                        this.$bvToast.toast('Saved', {
                            title: 'Action Successful',
                            variant: 'success',
                            solid:true
                        })
                        this.form.reset();
                    })
                    .catch(()=>{
                        this.$bvToast.toast('An error Occured' ,{
                            title: 'Error',
                            variant: 'danger',
                            solid:true
                        })
                    })
            }
        }
    }
</script>
