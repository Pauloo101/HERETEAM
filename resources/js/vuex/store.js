import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        sections:[],
        classrooms:[],
        subjects:[],
        sessions:[],
        terms:[],
        teachers:[],


    },
    mutations: {
        setsections(state, sections){
            state.sections = sections
        },
        setclassrooms(state , classrooms){
            state.classrooms = classrooms
        },
        setsubjects(state, subjects){
            state.subjects = subjects
        },
        setsessions(state, sessions){
            state.sessions = sessions
        },
        setterms(state, terms){
            state.terms = terms
        },
        setteachers(state, teachers){
            state.teachers = teachers
        }
    },
    actions: {
       loadsections({commit}){
            axios.get('/section').then((response) => {
                commit('setsections', response.data)
            }).catch((err) => {
                console.log(err)
            });
       },
        loadclassrooms({commit}){
           axios.get('/classroom').then((response) => {
               commit('setclassrooms', response.data)
           }).catch((err) => {
              console.log(err)
           });
        },
        loadsubjects({commit}){
            axios.get('/getsubject').then((response)=>{
                commit('setsubjects', response.data)
            }).catch((err)=>{
                console.log(err);
            });
        },
        loadsessions({commit}){
            axios.get('/session').then((response)=>{
                commit('setsessions', response.data)
            }).catch((err)=>{
                console.log(err);
            })
        },
        loadterms({commit}){
            axios.get('/term').then((response) =>{
                commit('setterms', response.data)
            }).catch((err)=> {
                console.log(err);
            })
        },
        loadteachers({commit}){
            axios.get('/getteachers').then((response) => {
                commit('setteachers', response.data)
            }).catch((err) => {
                console.log(err);
            })
        }
    },
    getters:{

    }
})
