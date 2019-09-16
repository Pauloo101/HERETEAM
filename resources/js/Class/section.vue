<template>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Section</h4>
                <form @submit.prevent="storesection" @keydown="form.onKeydown($event)">
                    <div class="form-group">
                        <input v-model="form.name" type="text" class="form-control-sm form-control"
                               name="name" :class="{'is-invalid':form.errors.has('name')}"
                               placeholder="Enter section name "/>
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-success" type="submit">Save</button>
                    </div>
                </form>
                <div class="form-group">
                    <!--{{sections}}-->
                    <ul class="list-inline text-left">

                        <li class="list-inline-item" v-for="(section , index) in sections " :key="section.id">

                            <div @dblclick="edit(section)" v-show="!section.edit">
                                {{section.name}}
                            </div>
                            <div v-show="section.edit">
                                <input class="form-control form-control-sm" style="width: 50px" v-model="cache" required/>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-danger p-1 m-0" @click="cancel(section)" type="button">
                                        <i class="far fa-window-close"></i>
                                    </button>
                                    <button class="btn btn-outline-success p-1 m-0" @click="update(section)" :disabled="btnenable" type="button">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>

                        </li>
                        <!-- <p>{{this.$store.state.sections}}</p> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


    export default {
        data: () => {
            return {
                cache:'',
                form: new Form({
                    name: '',
                })
            }
        },
        directives:{
            focus:{
                inserted:function (el){
                    el.focus()
                }
            }
            },
        watch: {},
        methods: {
            edit(section){
                this.cache = section.name;
                section.edit = true;
            },
            cancel(section){
               section.edit = false;
                this.cache = '';
            },
            update(section){
                axios.post('/updatesection',{section : section , cache: this.cache})
                    .then(response => {
                        this.$bvToast.toast("Student Details Saved! ", {
                            title: "Student Created",
                            variant: "success",
                            solid: true
                        });
                        Fire.$emit('store');
                        section.edit = false;
                        this.cache = ''
                    })
                    .catch(() => {
                        this.$bvToast.toast("Check your input fields", {
                            title: "Error",
                            variant: "danger",
                            solid: true
                        });
                    });
            },
            storesection() {
                this.form.post('/storesection')
                    .then(() => {
                        this.$bvToast.toast(`Saved`, {
                            title: `Action successful`,
                            variant: 'success',
                            solid: true
                        })
                        this.form.reset();
                        Fire.$emit('store');
                    })
                    .catch(() => {
                        this.$bvToast.toast(`An error Occured `, {
                            title: `Error`,
                            variant: 'danger',
                            solid: true
                        });

                    })

            },

            loadsection() {
            }
        },
        mounted() {

        },
        created() {

            this.$store.dispatch('loadsections');
            // ...mapActions([
            //     'loadsections'
            // ])
            Fire.$on('store', () => {
                this.$store.dispatch('loadsections');
            });
            // setInterval(()=> this.loadsection(), 3000)
        },
        computed: {
            sections() {
                return this.$store.state.sections;
            },
            btnenable(){
                if(this.cache == ''){
                    return true
                }
                else
                    return false
            },
        }
    }


</script>
