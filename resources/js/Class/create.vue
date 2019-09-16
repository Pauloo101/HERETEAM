<template>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Class</h4>
                <form @submit.prevent="createclass" @keydown="form.onKeydown($event)">
                    <div class="form-group">
                        <input
                                v-model="form.name"
                                type="text"
                                class="form-control form-control-sm"
                                name="name"
                                :class="{'is-invalid':form.errors.has('name')}"
                                placeholder="Enter Class name "
                        >
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div>
                        <b-form-group label="select class sections">
                            <b-form-checkbox-group id="checkbox-group-2" v-model="form.section_id" name="section_id">
                                <b-form-checkbox
                                        v-for="section in sections"
                                        :key="section.id"
                                        :value="section.id"
                                >{{section.name}}
                                </b-form-checkbox>
                            </b-form-checkbox-group>
                            <b-form-invalid-feedback :state="state">Please select accordingly</b-form-invalid-feedback>
                            <b-form-valid-feedback :state="state">Okay</b-form-valid-feedback>
                        </b-form-group>
                    </div>
                    <!-- <p>{{form.section_id}}</p> -->
                    <div class="form-group">
                        <button class="btn btn-outline-success" type="submit" :hidden="update">Save</button>
                        <div :hidden="!update">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <a class="btn btn-outline-success"  @click="updateclass">update</a>
                                </div>
                                <div class="col">
                                    <p></p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">Current Section : </li>
                                        <li class="list-inline-item" v-for="temp in previoussection.sections">{{temp.name}}</li>
                                    </ul>
                                </div>
                            </div>
                            <a class="text-center btn btn-outline-danger" @click="update = false">Cancel</a>
                        </div>


                    </div>
                </form>
                    <!-- <v-select  multiple label="name" :reduce="classrooms => classrooms.id" :options="classrooms" v-model="sele"></v-select>

                <p>{{sele}}</p>
<hr/>
                <div>
                    <classroom></classroom>
                </div> -->

            </div>
        </div>
        <!--<p>{{form.section_id}}</p>-->
    </div>
</template>

<script>

    export default {

        data() {
            return {
                // Deselect:{
                //     render: createElement => createElement('span','❌')
                // },
                update:false,
                previoussection:{},
                classrooms:[],
                sele:[],
                log: "hello",
                section_id: "",
                kkk: "",
                form: new Form({
                    name: "",
                    section_id: [],
                    //selected: []
                }),
                selected: [] // Must be an array reference!
            };
        },
        methods: {

            updateclass(){
                this.form.id = this.previoussection.id
                this.form.post("/classupdate").then(() => {
                    this.$bvToast.toast('Class created', {
                        title: 'Class Update',
                        variant: 'success',
                        solid: true
                    })
                    this.form.reset();
                    this.update = false;
                })
                    .catch(() => {
                        this.$bvToast.toast('An error Occured', {
                            title: 'Error',
                            variant: 'danger',
                            solid: true
                        })
                    })
            },

            createclass() {
                this.form.post("/Class").then(() => {
                    this.$bvToast.toast('Class created', {
                        title: 'Action successful',
                        variant: 'success',
                        solid: true
                    })
                    this.form.reset();
                })
                    .catch(() => {
                        this.$bvToast.toast('An error Occured', {
                            title: 'Error',
                            variant: 'danger',
                            solid: true
                        })
                    })
            },
            search() {
                axios.get('/search/' + this.section_id)
                    .then(({data}) => this.kkk = data)
            }

            // this.sections.forEach(element => {
            //     alert(this.options)
            // });
            //  this.todos.forEach((todo) => todo.completed = event.target.checked)
        },

        mounted() {
            // axios.get('/section')
            //     .then(({data}) => this.here = data);
        },
        computed: {
            state() {
                return this.form.section_id.length >= 1;
            },
            sections() {
                return this.$store.state.sections;
            }
        },
        created(){
            Fire.$on('editclass',(editclass) =>{
                this.form.name = editclass.name
                this.previoussection= editclass
                this.update = true
                // editclass.sections.forEach((section) => section.id = this.sr)
                // alert(this.sr)

                // let i;
                // for (i = 0; i < editclass.sections; i++) {
                //     text += cars[i] + "<br>";
                // }
            })
             axios.get('/classroom')
            .then(({data})=> this.classrooms = data)
        }
    };
</script>

<style scoped>
</style>
