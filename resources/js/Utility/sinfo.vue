<template>
    <div>
        <b-alert
                :show="dismissCountDown"
                dismissible
                variant="info"
                @dismissed="dismissCountDown=0"
                @dismiss-count-down="countDownChanged"
        >
            Saved!
        </b-alert>

        <!--<b-button @click="showAlert" variant="info" class="m-1">-->
            <!--Show alert with count-down timer-->
        <!--</b-button>-->

    </div>
</template>

<script>
    export default {
        props:["dismissCountDown"],
        data() {
            return {
                dismissSecs: 5,
                dismissCountDown: 0,
                showDismissibleAlert: false
            }
        },
        methods: {
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            showAlert() {
                this.dismissCountDown = this.dismissSecs
            }
        }
    }
</script>

<style scoped>

</style>