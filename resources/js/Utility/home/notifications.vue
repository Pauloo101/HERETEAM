<template>
    <div>
         <div class="card">
            <div class="card-header bg-info text-white p-2">
                <span class="text-white">
                    <h3 class="card-title">Notifications</h3>
                </span>
                <div class="card-tools">
                    <a class="nav-link" href="#">
                        <i class="fas fa-comments text-white" style="font-size: 20px"></i>
                        <span class="badge badge-danger navbar-badge">{{len}}</span>
                    </a>
                </div>
            </div>
            <div class="card-body m-0 p-2 " >
                <div class=" overflow-auto">
                     <ul class="list-group" style="height:300px" >
                        <li class="list-group-item" v-for="n in notifications" :key="n.id">
                            <span class="d-block text-bold">{{n.title}}</span>
                            <span class="text-info">{{n.message}}</span>
                        </li>
                    </ul>
                </div>

            </div>
              <div class="card-footer text-right">
                <b-button class="btn btn-sm btn-outline-success"  v-b-modal.modal-center><i class="far fa-bell mr-2"></i>Create Notification</b-button>

                <b-modal id="modal-center" centered title="Send Notification">
                    <notification></notification>
                </b-modal>
        </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            notifications:[],
            len:'',
        }
    },
    created() {
        axios.get('/getnotifications')
            .then(response =>{
                this.notifications = response.data
                this.len = this.notifications.length
            })
            .catch((e)=>{
                Toast.fire({
                    type:'error',
                    title:'Error fetching notifications'
                })
            })
    },
}
</script>

<style>

</style>
