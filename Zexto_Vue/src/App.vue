<template>
<div>

  <div id="modal" v-if="modal">
     <pop-up-modal></pop-up-modal>
  </div>
  <keep-alive>
    <router-view></router-view>
   </keep-alive>
  
</div>
</template>

<script>
import { mapGetters } from 'vuex'
import Modal from './fashi/Modal.vue'
export default {

    components:
    {
      'popUpModal': Modal,
    },

    computed:
    {
      ...mapGetters(
        {
          modal: 'getterModalVisibility'
        }
      ),
    },
}
</script>
<style>
#modal{
position: absolute;
z-index: +5;
}
</style>
