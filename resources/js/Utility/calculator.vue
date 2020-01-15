<template>
    <div class="open-button">

    <b-button id="popover-button-open" variant="primary" ref="button">
         <i class="fas fa-calculator"></i>
    </b-button>

        <!-- <a class="btn btn-app" id="popover-reactive-1" ref="button">
         <i class="fas fa-calulator-alt"></i>
        </a> -->
       <!-- <b-popover show target="popover-button-open" title="Popover">
            I start <strong>open</strong>
        </b-popover> -->
    </div>
</template>

<script>
import cal from './cal'
export default {
    components:{cal},

  }
</script>

<style>
.open-button {
  /* background-color: #555; */
  /* color: white; */
  /* padding: 16px 20px; */
  border: none;
  cursor: pointer;
  /* opacity: 0.8; */
  position: fixed;
  bottom: 55px;
  right: -13%;
  width: 300px;
}
</style>
