<template>
    <div class="col-md-6">
        <div class="card">
            <!-- <p>{{subjects}}</p> -->
            <div class="table-responsive">
    <table class="table table-hover table-sm">
        <thead>
            <tr class="d-flex">
                <th class="col-3">Name</th>
                <th class="col-7">Assigned Class</th>
                <th class="col-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="subject in subjects" :key="subject.id" class="d-flex">
                <td class="col-3"> {{subject.name}}</td>
                <td class="col-7">
                    <div role="group" class="btn-group" v-for="classroom in subject.classrooms" :key="classroom.id">
                    <button class="btn btn-outline-primary btn-sm ml-1" type="button">{{classroom.name}}</button>
                    </div>
                </td>
                <td class="col-2">
                    <div role="group" class="btn-group">
                    <button class="btn btn-outline-success btn-sm " type="button"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-outline-danger btn-sm " type="button"><i class="far fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{

        }
    },
    methods:{
        deletesubject(){
            axios.post('/deletesubject')
            .then(()=>{

            })
            .catch(() => {
 ;kp
            })
        }
    },
    created(){
         this.$store.dispatch('loadsubjects');
    },
    computed:{
        subjects(){
            return this.$store.state.subjects
        }
    }
}
</script>
