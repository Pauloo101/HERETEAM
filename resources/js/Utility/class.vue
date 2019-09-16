<template>
    <div>
        <div>
            <label class="mb-0" for="float-input">Select Class</label>
            <select class="form-control form-control-sm"  @change="search" v-model="classroom_id">
                <optgroup label="This is a group">
                    <option v-for="classroom in classrooms" :value="classroom.id" :key="classroom.id" selected>{{classroom.name}}</option>
                </optgroup>
            </select>
        </div>
        <div >
        <label class="mb-0" for="float-input">Select Section</label>
        <select class="form-control form-control-sm" v-model="section_id">
            <optgroup label="This is a group">
                <option v-for="temp in section" :key="temp.id" :value="temp.id" selected>{{temp.name}}</option>
            </optgroup>
        </select>
    </div>
        <!-- <div v-for="temp in section" :key="temp.id">
             <p>{{temp.sections}}</p>
             <hr/>
             <div v-for="rrr in temp.sections" >
                  <p>{{rrr.name}}</p>
             </div>

        </div> -->
        <!-- <p>{{classrooms}}</p> -->

    </div>

</template>

<script>
    export default {
        data() {
           return{
               classroom_id:'',
               section_id:'',
               section:{},
               all:{},
               classrooms:{}
           }
        },
        methods: {
            search() {
                axios.get('/search/' + this.classroom_id)
                    .then(({data}) => this.section = data)
            }
        },
        created() {
            this.$store.dispatch('loadclassrooms');
            // this.$store.dispatch('loadsections');

            // this.all = this.$store.state.sections;
            axios.get('/why')
            .then(({data}) => this.section = data)

            axios.get('/classroom')
            .then(({data})=> this.classrooms = data)
        },
        computed: {
            // classrooms() {
            //     return this.$store.state.classrooms;
            // },
            // all(){
            //     return this.$store.state.sections
            // }
        },

    }
</script>

